<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ItemCondition: string implements HasColor, HasIcon, HasLabel
{

    case New = 'new';
    case Used = 'used';

    public function getLabel(): string
    {
        return __('order.fields.condition.options.' . $this->value);
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::New => 'info',
            self::Used => 'warning',

        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::New => 'heroicon-m-sparkles',
            self::Used => 'heroicon-m-arrow-trending-up',
        };
    }
}
