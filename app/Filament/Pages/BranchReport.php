<?php

namespace App\Filament\Pages;

use App\Models\Branch;
use App\Models\Product;
use App\Models\Scopes\IsVisibleScope;
use App\Services\InventoryService;
use App\Enums\StockCase;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions;
use Filament\Facades\Filament;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\DB;

class BranchReport extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static ?int $navigationSort = 7;
    protected static string $view = 'filament.resources.product-resource.pages.branch-report';

    public function mount(): void
    {
        $this->form->fill([
            'branch_id' => Filament::getTenant()->id,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('branch_id')
                    ->label(__('product.fields.branch.label'))
                    ->options(Branch::all()->pluck('name', 'id'))
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn() => $this->render())
                    ->default(Filament::getTenant()->id),
            ])
            ->statePath('data');
    }

    public function getTitle(): string|Htmlable
    {
        $branchName = Branch::find($this->data['branch_id'] ?? null)?->name ?? Filament::getTenant()->name;
        return __('branch_reports.single_branch.label', ['b' => $branchName]);
    }

    public static function getNavigationLabel(): string
    {
        return __('branch_reports.single_branch.model_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('branch_reports.navigation.group');
    }

    protected function getViewData(): array
    {
        $selectedBranchId = $this->data['branch_id'] ?? Filament::getTenant()->id;
        $branch = Branch::find($selectedBranchId);

        $products = Product::query()
            ->withOutGlobalScope(IsVisibleScope::class)
            // 1. حساب الرصيد الابتدائي
            ->withSum([
                'history as initial_qty' => fn($q) =>
                    $q->where('stock_histories.branch_id', $selectedBranchId) // تحديد اسم الجدول هنا
                        ->where('stock_histories.type', StockCase::Initial)
            ], 'quantity_change')

            // 2. حساب التوريدات (الزيادة)
            ->withSum([
                'history as increases_qty' => fn($q) =>
                    $q->where('stock_histories.branch_id', $selectedBranchId) // تحديد اسم الجدول هنا
                        ->where('stock_histories.type', StockCase::Increase)
            ], 'quantity_change')

            // 3. حساب المبيعات (النقص) مع استبعاد المحذوف
            ->withSum([
                'history as sales_qty' => fn($q) =>
                    $q->where('stock_histories.branch_id', $selectedBranchId) // تحديد اسم الجدول هنا
                        ->where('stock_histories.type', StockCase::Decrease)
                        ->leftJoin('orders', 'stock_histories.order_id', '=', 'orders.id')
                        ->whereNull('orders.deleted_at')
            ], 'quantity_change')
            ->get();

        return [
            'products' => $products,
            'branch' => $branch,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('print')
                ->label(__('product.actions.print.label'))
                ->icon('heroicon-o-printer')
                ->color('info')
                ->action(fn() => $this->js('window.print()')),

            Actions\Action::make('refresh')
                ->label(__('product.actions.refresh.label'))
                ->icon('heroicon-o-arrow-path')
                ->color('primary')
                ->action(function () {
                    (new InventoryService)->updateAllBranches();
                }),
        ];
    }
}