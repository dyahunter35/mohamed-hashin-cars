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

        // الاستعلام من جدول تفاصيل الطلب للحصول على المبيعات الحقيقية
        $salesData = \App\Models\OrderItem::query()
            ->select([
                'order_items.product_id',
                'order_items.condition',
                DB::raw("SUM(order_items.qty) as total_qty"),
                DB::raw("SUM(order_items.sub_total) as total_revenue"),
                DB::raw("COUNT(DISTINCT order_items.order_id) as order_count"),
            ])
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereNull('orders.deleted_at')
            ->whereNotIn('orders.status', ['cancelled', 'proforma'])
            ->when($from && $to, fn($q) => $q->whereBetween('orders.created_at', [$from, $to]))
            ->when($this->products, fn($q) => $q->whereIn('order_items.product_id', $this->products))
            ->groupBy('order_items.product_id', 'order_items.condition')
            ->get();

        // جلب بيانات المنتجات والعلامات التجارية
        $productIds = $salesData->pluck('product_id')->unique();
        $productsInfo = Product::with(['brand', 'category'])
            ->whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        $report = [];

        foreach ($salesData as $sale) {
            $id = $sale->product_id;

            if (!$id)
                continue;

            $product = $productsInfo->get($id);

            if (!$product)
                continue;

            if (!isset($report[$id])) {
                $report[$id] = [
                    'product_name' => $product->name,
                    'brand_name' => $product->brand?->name ?? '-',
                    'category' => $product->category?->name ?? '-',
                    'new' => ['qty' => 0, 'revenue' => 0, 'orders' => 0],
                    'used' => ['qty' => 0, 'revenue' => 0, 'orders' => 0],
                ];
            }

            // تحديد الحالة (جديد أو مستعمل)
            $condRaw = is_object($sale->condition) ? $sale->condition->value : $sale->condition;
            $cond = strtolower(trim($condRaw));

            if ($cond === 'new' || $cond === 'used') {
                $report[$id][$cond] = [
                    'qty' => (float) $sale->total_qty,
                    'revenue' => (float) $sale->total_revenue,
                    'orders' => (int) $sale->order_count,
                ];
            }
        }

        return collect($report)->values();
    }
}