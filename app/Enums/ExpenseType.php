<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
enum ExpenseType: string implements HasColor, HasIcon, HasLabel
{
    case Food = "food";
    case Salary = "salary";
    case Rent = "rent";
    case Utility = "utility";
    case Other = "other";

    public function getLabel(): string
    {
        return __('expense.fields.type.options.' . $this->value);
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Food => 'warning',
            self::Salary => 'info',
            self::Rent => 'danger',
            self::Utility => 'success',
            self::Other => 'secondary',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Food => 'heroicon-o-cake',
            self::Salary => 'heroicon-o-user',
            self::Rent => 'heroicon-o-home',
            self::Utility => 'heroicon-o-bolt',
            self::Other => 'heroicon-o-ellipsis-horizontal',
        };
    }

}
