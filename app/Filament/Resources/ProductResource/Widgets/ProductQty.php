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
            Stat::make('New', $new_quantity),
            Stat::make('Used', $used_quantity),
            Stat::make('Total', $total_quantity),
        ];
    }
}
