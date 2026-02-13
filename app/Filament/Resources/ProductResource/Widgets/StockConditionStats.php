<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StockConditionStats extends BaseWidget
{
    protected function getStats(): array
    {
        // Calculate totals across all branches
        $totalNew = DB::table('branch_product')->sum('new_quantity');
        $totalUsed = DB::table('branch_product')->sum('used_quantity');
        $totalStock = $totalNew + $totalUsed;

        // Calculate percentages
        $newPercentage = $totalStock > 0 ? round(($totalNew / $totalStock) * 100, 1) : 0;
        $usedPercentage = $totalStock > 0 ? round(($totalUsed / $totalStock) * 100, 1) : 0;

        // Count products
        $totalProducts = Product::count();

        return [
            Stat::make('إجمالي المنتجات الجديدة', number_format($totalNew))
                ->description("{$newPercentage}% من إجمالي المخزون")
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('info')
                ->chart($this->getNewStockTrend()),

            Stat::make('إجمالي المنتجات المستعملة', number_format($totalUsed))
                ->description("{$usedPercentage}% من إجمالي المخزون")
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning')
                ->chart($this->getUsedStockTrend()),

            Stat::make('إجمالي المخزون', number_format($totalStock))
                ->description("{$totalProducts} منتج")
                ->descriptionIcon('heroicon-m-cube')
                ->color('success'),
        ];
    }

    /**
     * Get trend data for new stock over last 7 days
     */
    protected function getNewStockTrend(): array
    {
        $trend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $total = DB::table('stock_histories')
                ->where('condition', 'new')
                ->whereDate('created_at', '<=', $date)
                ->sum(DB::raw('CASE WHEN type = "increase" or type = "initial" THEN quantity_change ELSE -quantity_change END'));
            $trend[] = $total;
        }
        return $trend;
    }

    /**
     * Get trend data for used stock over last 7 days
     */
    protected function getUsedStockTrend(): array
    {
        $trend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $total = DB::table('stock_histories')
                ->where('condition', 'used')
                ->whereDate('created_at', '<=', $date)
                ->sum(DB::raw('CASE WHEN type = "increase" or type = "initial" THEN quantity_change ELSE -quantity_change END'));
            $trend[] = $total;
        }
        return $trend;
    }
}
