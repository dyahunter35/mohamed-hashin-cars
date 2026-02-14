<?php
namespace App\Filament\Pages;

use App\Models\OrderItem;
use App\Models\Product;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Attributes\Url;
use Malzariey\FilamentDaterangepickerFilter\Fields\DateRangePicker;

class SalesByConditionReport extends Page implements HasForms
{
    use InteractsWithForms;

    #[Url()] public $date_range;

    public $products = [];


    // ملاحظة: لا نحتاج لتعريف $sales كـ property إذا استخدمنا Computed Property
    protected static string $view = 'filament.resources.product-resource.pages.sales-by-condition-report';
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    public function getTitle(): string|Htmlable
    {
        return __('product.reports.sales_by_condition.label');
    }
    public static function getNavigationLabel(): string
    {
        return __('product.reports.sales_by_condition.model_label');
    }
    protected static ?int $navigationSort = 8;


    public static function getNavigationGroup(): ?string
    {
        return __('product.reports.sales_by_condition.navigation.group');
    }
    public function mount(): void
    {
        $this->form->fill([
            'date_range' => $this->date_range,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                    Select::make('products')
                        ->multiple()
                        ->options(Product::all()->pluck('name', 'id'))
                        ->label('المنتجات')
                        ->reactive()
                        ->afterStateUpdated(fn($state) => [$this->products = $state ?? [], $this->loadData()]), // لضمان التحديث اللحظي

                    DateRangePicker::make('date_range')
                        ->label('فترة التقرير')
                        ->displayFormat('DD/MM/YYYY')
                        ->reactive()
                        ->suffixAction(
                            Action::make('clear')
                                ->label(__('filament-daterangepicker-filter::message.clear'))
                                ->icon('heroicon-m-calendar-days')
                                ->action(fn() => [$this->date_range = null, $this->loadData()])
                        )
                        ->afterStateUpdated(fn($state) => [$this->date_range = $state ?? '', $this->loadData()]) // لضمان التحديث اللحظي
                ])->columns(2)
        ;
    }

    // استخدام Computed Property لضمان جلب البيانات دائماً بشكل طازج
    public function getSalesProperty(): Collection
    {
        return $this->loadData();
    }

    public function loadData(): Collection
    {
        [$from, $to] = parseDateRange($this->date_range ?? '');

        $salesData = OrderItem::query()
            ->select([
                    'order_items.product_id',
                    'order_items.condition',
                    DB::raw('SUM(order_items.qty) as total_qty'),
                    DB::raw('SUM(order_items.qty * order_items.price) as total_revenue'),
                    DB::raw('COUNT(DISTINCT order_items.order_id) as order_count'),
                ])
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->when($from && $to, fn($q) => $q->whereBetween('order_items.created_at', [$from, $to]))
            ->when($this->products, fn($q) => $q->whereIn('order_items.product_id', $this->products))
            ->groupBy('order_items.product_id', 'order_items.condition')
            ->get();

        $productIds = $salesData->pluck('product_id')->unique();
        $products = Product::with(['brand', 'category'])->whereIn('id', $productIds)->get()->keyBy('id');

        $report = [];
        foreach ($salesData as $sale) {
            $id = $sale->product_id;
            $product = $products->get($id);

            if (!isset($report[$id])) {
                $report[$id] = [
                    'product_name' => $product?->name ?? 'غير معروف',
                    'brand_name' => $product?->brand?->name ?? '-',
                    'category' => $product?->category?->name ?? '-',
                    'new' => ['qty' => 0, 'revenue' => 0, 'orders' => 0],
                    'used' => ['qty' => 0, 'revenue' => 0, 'orders' => 0],
                ];
            }

            $condition = is_object($sale->condition) ? $sale->condition->value : $sale->condition;

            if (in_array($condition, ['new', 'used'])) {
                $report[$id][$condition] = [
                    'qty' => (float) $sale->total_qty,
                    'revenue' => (float) $sale->total_revenue,
                    'orders' => (int) $sale->order_count,
                ];
            }
        }

        return collect($report)->values();
    }
}