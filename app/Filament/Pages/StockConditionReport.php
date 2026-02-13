<?php

namespace App\Filament\Pages;

use App\Filament\Resources\ProductResource;
use App\Filament\Resources\ProductResource\Widgets\StockConditionStats;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Scopes\IsVisibleScope;
use App\Services\InventoryService;
use Filament\Pages\Page;
use Filament\Actions;
use Filament\Facades\Filament;
use Illuminate\Contracts\Support\Htmlable;

class StockConditionReport extends Page
{

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static string $view = 'filament.resources.product-resource.pages.stock-condition-report';

    protected static ?int $navigationSort = 9;

    protected static ?string $navigationLabel = 'تقرير المخزون حسب الحالة';

    protected static bool $shouldRegisterNavigation = true;

    public function getTitle(): string|Htmlable
    {
        return 'تقرير المخزون حسب الحالة';
    }

    public static function getNavigationLabel(): string
    {
        return 'تقرير حسب الحالة';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('branch_reports.navigation.group');
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StockConditionStats::class,
        ];
    }

    /**
     * Get data for the view
     */
    protected function getViewData(): array
    {
        $branches = Branch::all();

        $products = Product::query()
            ->withOutGlobalScope(IsVisibleScope::class)
            ->with([
                    'branches' => function ($query) {
                        $query->withPivot('new_quantity', 'used_quantity', 'total_quantity');
                    }
                ])
            ->get()
            ->map(function ($product) use ($branches) {
                $branchData = [];
                foreach ($branches as $branch) {
                    $pivot = $product->branches->where('id', $branch->id)->first()?->pivot;
                    $branchData[$branch->id] = [
                        'new' => $pivot->new_quantity ?? 0,
                        'used' => $pivot->used_quantity ?? 0,
                        'total' => $pivot->total_quantity ?? 0,
                    ];
                }

                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'category' => $product->category?->name,
                    'total_new' => $product->total_new_stock,
                    'total_used' => $product->total_used_stock,
                    'total_stock' => $product->total_stock,
                    'branches' => $branchData,
                ];
            });

        return [
            'products' => $products,
            'branches' => $branches,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('print')
                ->label('طباعة')
                ->icon('heroicon-o-printer')
                ->color('info')
                ->action(function () {
                    $this->js('window.print()');
                }),

            Actions\Action::make('refresh')
                ->label('تحديث')
                ->icon('heroicon-o-arrow-path')
                ->color('primary')
                ->action(function () {
                    $service = new InventoryService;
                    $service->updateAllBranches();
                    $this->redirect(static::getUrl());
                }),
        ];
    }
}
