<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;
use Filament\Facades\Filament;
use App\Enums\OrderStatus;


class SalesStats extends BaseWidget
{
    protected function getStats(): array
    {
        $dateFilter = function () {};

        if (!auth()->user()->hasRole('super_admin')) {
            $dateFilter = function ($q) {
                $q->where('branch_id', Filament::getTenant()->id);
            };
        }

        // إحصائيات هذا الشهر
        $query = Order::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->where('status', '!=', OrderStatus::Proforma)
            ->where($dateFilter);


        $thisMonthTotal = $query->sum('total');

        $thisMonthOrders = $query->count();

        // الإحصائيات الكلية
        $overallTotal = Order::where($dateFilter)
            ->where('status', '!=', OrderStatus::Proforma)
            ->sum('total');


        return [
            Stat::make('إجمالي الإيرادات (هذا الشهر)', number_format($thisMonthTotal) . ' ' . 'SDG')
                ->description('إجمالي مبيعات الشهر الحالي')
                ->color('success'),
            Stat::make('عدد الطلبات (هذا الشهر)', $thisMonthOrders)
                ->description('إجمالي عدد الطلبات في الشهر الحالي')
                ->color('info'),
            Stat::make('إجمالي الإيرادات (الكلي)', number_format($overallTotal) . ' ' . 'SDG')
                ->description('إجمالي المبيعات منذ البداية')
                ->color('warning'),
        ];
    }
}
