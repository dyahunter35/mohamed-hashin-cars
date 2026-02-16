<?php

namespace App\Filament\Pages;

use App\Models\Order;
use App\Models\Product;
use App\Models\Branch;
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

class SalesAndPaymentsReport extends Page implements HasForms
{
    use InteractsWithForms;

    #[Url()] public $date_range;
    #[Url()] public $selected_products = [];
    #[Url()] public $selected_branches = [];
    #[Url()] public $payment_status = 'all';

    protected static string $view = 'filament.resources.product-resource.pages.sales-and-payments-report';
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?int $navigationSort = 9;

    public function getTitle(): string|Htmlable
    {
        return __('product.reports.sales_and_payments.label');
    }

    public static function getNavigationLabel(): string
    {
        return __('product.reports.sales_and_payments.model_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('product.reports.sales_and_payments.navigation.group');
    }

    public function mount(): void
    {
        $this->form->fill([
            'date_range' => $this->date_range,
            'selected_products' => $this->selected_products,
            'selected_branches' => $this->selected_branches,
            'payment_status' => $this->payment_status,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                    DateRangePicker::make('date_range')
                        ->label('فترة التقرير')
                        ->displayFormat('DD/MM/YYYY')
                        ->reactive()
                        ->afterStateUpdated(fn($state) => [$this->date_range = $state ?? '', $this->loadData()]),

                    Select::make('selected_branches')
                        ->label('الفروع')
                        ->multiple()
                        ->options(Branch::all()->pluck('name', 'id'))
                        ->reactive()
                        ->visible(fn() => Branch::count() > 1)
                        ->afterStateUpdated(fn($state) => [$this->selected_branches = $state ?? [], $this->loadData()]),

                    Select::make('selected_products')
                        ->multiple()
                        ->options(Product::all()->pluck('name', 'id'))
                        ->label('تصفية حسب المنتجات')
                        ->searchable()
                        ->reactive()
                        ->afterStateUpdated(fn($state) => [$this->selected_products = $state ?? [], $this->loadData()]),

                    Select::make('payment_status')
                        ->label(__('product.reports.sales_and_payments.filters.payment_status.label'))
                        ->options(__('product.reports.sales_and_payments.filters.payment_status.options'))
                        ->default('all')
                        ->reactive()
                        ->afterStateUpdated(fn($state) => [$this->payment_status = $state ?? 'all', $this->loadData()]),
                ])->columns(4);
    }

    public function getOrdersProperty(): Collection
    {
        return $this->loadData();
    }

    public function loadData(): Collection
    {
        [$from, $to] = parseDateRange($this->date_range ?? '');

        $query = Order::query()
            ->with(['branch'])
            ->select('orders.*');

        if ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        }

        if (!empty($this->selected_branches)) {
            $query->whereIn('branch_id', $this->selected_branches);
        }

        if (!empty($this->selected_products)) {
            $query->whereHas('items', function ($q) {
                $q->whereIn('product_id', $this->selected_products);
            });
        }

        if ($this->payment_status === 'paid') {
            $query->whereColumn('paid', '>=', 'total');
        } elseif ($this->payment_status === 'debt') {
            $query->whereColumn('paid', '<', 'total');
        }

        return $query->latest()->get();
    }
}
