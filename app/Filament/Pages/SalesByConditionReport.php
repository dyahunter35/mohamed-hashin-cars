<?php

namespace App\Filament\Pages;

use App\Filament\Resources\ProductResource;
use App\Filament\Resources\ProductResource\Widgets\SalesConditionStats;
use App\Models\OrderItem;
use App\Models\Product;
use Filament\Pages\Page;
use Filament\Actions;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\DB;

class SalesByConditionReport extends Page
{

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static string $view = 'filament.resources.product-resource.pages.sales-by-condition-report';

    protected static ?int $navigationSort = 10;

    protected static ?string $navigationLabel = 'تقرير المبيعات حسب الحالة';

    protected static bool $shouldRegisterNavigation = true;

    public function getTitle(): string|Htmlable
    {
        return 'تقرير المبيعات حسب حالة المنتجات';
    }

    public static function getNavigationLabel(): string
    {
        return 'مبيعات حسب الحالة';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('branch_reports.navigation.group');
    }

    protected function getHeaderWidgets(): array
    {
        return [
            SalesConditionStats::class,
        ];
    }

    /**
     * Get sales data grouped by product and condition
     */
    protected function getViewData(): array
    {
        $salesData = OrderItem::query()
            ->select([
                    'order_items.product_id',
                    'order_items.condition',
                    DB::raw('SUM(order_items.qty) as total_qty'),
                    DB::raw('SUM(order_items.qty * order_items.price) as total_revenue'),
                    DB::raw('COUNT(DISTINCT order_items.order_id) as order_count'),
                ])
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->groupBy('order_items.product_id', 'order_items.condition')
            ->get();

        // Group by product
        $productSales = [];
        foreach ($salesData as $sale) {
            $productId = $sale->product_id;
            if (!isset($productSales[$productId])) {
                $product = Product::find($productId);
                $productSales[$productId] = [
                    'product_name' => $product->name,
                    'brand_name' => $product->brand?->name,
                    'category' => $product->category?->name,
                    'new' => ['qty' => 0, 'revenue' => 0, 'orders' => 0],
                    'used' => ['qty' => 0, 'revenue' => 0, 'orders' => 0],
                ];
            }

            $condition = $sale->condition->value;
            $productSales[$productId][$condition] = [
                'qty' => $sale->total_qty,
                'revenue' => $sale->total_revenue,
                'orders' => $sale->order_count,
            ];
        }

        return [
            'sales' => collect($productSales)->values(),
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
        ];
    }
}
