<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Facades\Filament;

class ExpenseStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $branchId = Filament::getTenant()?->id;

        $totalSales = Order::query()
            ->when($branchId, fn($query) => $query->where('branch_id', $branchId))
            ->whereNotIn('status', ['cancelled', 'proforma'])
            ->sum('total');

        $totalExpenses = Expense::query()
            ->sum('amount');

        $balance = $totalSales - $totalExpenses;

        return [
            Stat::make(__('expense.reports.total_sales'), number_format($totalSales, 2) . ' SDG')
                ->description(__('expense.reports.sales_description'))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make(__('expense.reports.total_expenses'), number_format($totalExpenses, 2) . ' SDG')
                ->description(__('expense.reports.expenses_description'))
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make(__('expense.reports.net_profit'), number_format($balance, 2) . ' SDG')
                ->description(__('expense.reports.profit_description'))
                ->descriptionIcon('heroicon-m-banknotes')
                ->color($balance >= 0 ? 'success' : 'danger'),
        ];
    }
}
