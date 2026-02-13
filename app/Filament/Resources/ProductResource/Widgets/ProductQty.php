<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Models\Product;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductQty extends BaseWidget
{
    public ?Product $record = null;

    protected function getStats(): array
    {
        $pivot = $this->record->branches()->find(Filament::getTenant()->id)?->pivot;
        $new_quantity = $pivot->new_quantity ?? 0;
        $used_quantity = $pivot->used_quantity ?? 0;
        $total_quantity = $pivot->total_quantity ?? 0;
        return [
            Stat::make('New', $new_quantity)
                ->color('success')
                ->icon('heroicon-o-sparkles')
                ->label(__('order.fields.condition.options.new')),
            Stat::make('Used', $used_quantity)
                ->color('warning')
                ->icon('heroicon-o-wrench-screwdriver')
                ->label(__('order.fields.condition.options.used')),
            Stat::make('Total', $total_quantity)
                ->color('info')
                ->icon('heroicon-o-archive-box')
                ->label(__('order.fields.condition.options.total')),
        ];
    }
}
