<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Models\OrderItem;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class SalesConditionStats extends BaseWidget
{
    public ?string $filter = 'month';

    protected function getStats(): array
    {
        $dateFilter = $this->getDateFilter();

        // Calculate revenue by condition
        $newRevenue = OrderItem::query()
            ->where('condition', 'new')
            ->whereHas('order', function ($query) use ($dateFilter) {
                $query->where('created_at', '>=', $dateFilter);
            })
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->sum(DB::raw('order_items.qty * order_items.price'));

        $usedRevenue = OrderItem::query()
            ->where('condition', 'used')
            ->whereHas('order', function ($query) use ($dateFilter) {
                $query->where('created_at', '>=', $dateFilter);
            })
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->sum(DB::raw('order_items.qty * order_items.price'));

        // Calculate units sold
        $newUnitsSold = OrderItem::query()
            ->where('condition', 'new')
            ->whereHas('order', function ($query) use ($dateFilter) {
                $query->where('created_at', '>=', $dateFilter);
            })
            ->sum('qty');

        $usedUnitsSold = OrderItem::query()
            ->where('condition', 'used')
            ->whereHas('order', function ($query) use ($dateFilter) {
                $query->where('created_at', '>=', $dateFilter);
            })
            ->sum('qty');

        // Calculate average order value
        $newAvgOrderValue = $newUnitsSold > 0 ? $newRevenue / $newUnitsSold : 0;
        $usedAvgOrderValue = $usedUnitsSold > 0 ? $usedRevenue / $usedUnitsSold : 0;

        $totalRevenue = $newRevenue + $usedRevenue;
        $newPercentage = $totalRevenue > 0 ? round(($newRevenue / $totalRevenue) * 100, 1) : 0;
        $usedPercentage = $totalRevenue > 0 ? round(($usedRevenue / $totalRevenue) * 100, 1) : 0;

        return [
            Stat::make('مبيعات المنتجات الجديدة', number_format($newRevenue, 2) . ' ج.س')
                ->description("{$newPercentage}% من إجمالي المبيعات | {$newUnitsSold} وحدة")
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('info'),

            Stat::make('مبيعات المنتجات المستعملة', number_format($usedRevenue, 2) . ' ج.س')
                ->description("{$usedPercentage}% من إجمالي المبيعات | {$usedUnitsSold} وحدة")
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning'),

            Stat::make(
                'متوسط سعر البيع',
                'جديد: ' . number_format($newAvgOrderValue, 2) . ' | مستعمل: ' . number_format($usedAvgOrderValue, 2)
            )
                ->description('ج.س للوحدة')
                ->descriptionIcon('heroicon-m-calculator')
                ->color('success'),
        ];
    }

    protected function getDateFilter()
    {
        return match ($this->filter) {
            'today' => now()->startOfDay(),
            'week' => now()->startOfWeek(),
            'month' => now()->startOfMonth(),
            'year' => now()->startOfYear(),
            default => now()->startOfMonth(),
        };
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'اليوم',
            'week' => 'هذا الأسبوع',
            'month' => 'هذا الشهر',
            'year' => 'هذا العام',
        ];
    }
}
