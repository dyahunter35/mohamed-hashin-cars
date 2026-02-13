<?php

namespace App\Filament\Pages;

use App\Filament\Resources\ProductResource;
use App\Filament\Resources\ProductResource\Widgets\LowStockAlerts;
use Filament\Actions;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class LowStockAlertReport extends Page
{

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-triangle';

    protected static string $view = 'filament.resources.product-resource.pages.low-stock-alert-report';

    protected static ?int $navigationSort = 11;

    protected static ?string $navigationLabel = 'تنبيهات المخزون المنخفض';

    protected static bool $shouldRegisterNavigation = true;

    public function getTitle(): string|Htmlable
    {
        return 'تنبيهات المخزون المنخفض';
    }

    public static function getNavigationLabel(): string
    {
        return 'تنبيهات المخزون';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('branch_reports.navigation.group');
    }

    protected function getHeaderWidgets(): array
    {
        return [
            LowStockAlerts::class,
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
