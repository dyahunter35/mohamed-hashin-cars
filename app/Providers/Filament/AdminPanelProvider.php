<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Dashboard\MainDashboard;
use App\Filament\Pages\Tenancy\EditBranch;
use BezhanSalleh\FilamentShield\Middleware\SyncShieldTenant;
use App\Filament\Pages\Tenancy\RegisterBranch;
use App\Filament\Resources\OrderResource\Pages\SalesReport;
use App\Filament\Resources\ProductResource\Pages\BranchReport;
use App\Filament\Resources\ProductResource\Pages\ProductStockReport;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use App\Models\Branch;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Middleware\ShareErrorsFromSession;

use lockscreen\FilamentLockscreen\Lockscreen;
use lockscreen\FilamentLockscreen\Http\Middleware\Locker;
use lockscreen\FilamentLockscreen\Http\Middleware\LockerTimer;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('/dashboard')
            ->login()
            ->font('Poppins')
            ->databaseTransactions()
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->brandName(fn() => __('app.name'))
            ->brandLogo(fn() => asset('asset/images/logo-sm.png'))
            ->favicon(asset('asset/images/logo-sm.png'))
            ->colors([
                    'primary' => Color::Green,
                    'secondary' => Color::Amber,
                ])
            ->tenant(Branch::class, slugAttribute: 'slug')
            ->tenantRegistration(RegisterBranch::class)
            ->tenantProfile(EditBranch::class)
            // disable user impersonation
            //->errorNotifications(false)

            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                    MainDashboard::class,
                    //BranchReport::class,
                    //ProductStockReport::class
                ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                    //Widgets\AccountWidget::class,
                    //Widgets\FilamentInfoWidget::class,
                ])
            ->middleware([
                    EncryptCookies::class,
                    AddQueuedCookiesToResponse::class,
                    StartSession::class,
                    AuthenticateSession::class,
                    ShareErrorsFromSession::class,
                    VerifyCsrfToken::class,
                    SubstituteBindings::class,
                    DisableBladeIconComponents::class,
                    DispatchServingFilamentEvent::class,
                    //LockerTimer::class,
                ])
            ->plugins([
                    FilamentShieldPlugin::make()
                        ->gridColumns([
                                'default' => 1,
                                'sm' => 2,
                                'lg' => 3
                            ])
                        ->sectionColumnSpan(1)
                        ->checkboxListColumns([
                                'default' => 1,
                                'sm' => 2,
                                'lg' => 4,
                            ])
                        ->resourceCheckboxListColumns([
                                'default' => 1,
                                'sm' => 2,
                            ]),
                    //new Lockscreen()  // <- Add this

                ])
            ->tenantMiddleware([
                    //SyncShieldTenant::class,
                ], isPersistent: true)
            ->authMiddleware([
                    Authenticate::class,
                    //Locker::class,
                ]);
    }
}
