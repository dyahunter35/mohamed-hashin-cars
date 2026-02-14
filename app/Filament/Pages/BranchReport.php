<?php

namespace App\Filament\Pages;
use App\Models\Branch;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Pages;
use App\Models\Product;
use App\Models\Scopes\IsVisibleScope;
use App\Services\InventoryService;
use Filament\Pages\Page;
use Filament\Actions;
use Filament\Facades\Filament;
use Illuminate\Contracts\Support\Htmlable;

class BranchReport extends Page implements HasForms
{

    use InteractsWithForms;

    public $branch_id = null;
    public $branch = null;


    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    protected static bool $shouldRegisterNavigation = true;

    protected static ?int $navigationSort = 7;

    // --- NAVIGATION ---
    public function getTitle(): string|Htmlable
    {
        return __('branch_reports.single_branch.label', ['b' => Filament::getTenant()->name]);
    }
    public static function getNavigationLabel(): string
    {
        return __('branch_reports.single_branch.model_label');
    }

    public function mount()
    {
        $this->branch_id = Filament::getTenant()->id;
        $this->branch = Filament::getTenant();
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                    Select::make('branch_id')
                        ->label(__('product.fields.branch.label'))
                        ->options(Branch::all()->pluck('name', 'id'))
                        ->required()
                        ->live()
                        ->afterStateUpdated(fn($state) => [
                            $this->branch->id => $state,
                            $this->branch = Branch::find($this->branch_id),
                            $this->getViewData()
                        ])
                        ->default($this->branch_id),
                ])
        ;
    }

    public static function getNavigationGroup(): ?string
    {
        return __('branch_reports.navigation.group');
    }

    // protected static string $view = 'filament.resources.product-resource.pages.product-stock-report';
    protected static string $view = 'filament.resources.product-resource.pages.branch-report';
    // protected static string $view = 'welcome';


    /**
     * إعداد البيانات التي سيتم تمريرها إلى ملف العرض (Blade).
     *
     * @return array<string, mixed>
     */
    protected function getViewData(): array
    {
        // جلب كل الفروع لإنشاء أعمدة الجدول بشكل ديناميكي
        $branch = Filament::getTenant();

        // جلب كل المنتجات مع علاقاتها بالفروع
        // نستخدم withSum لحساب الإجمالي بكفاءة عالية
        $products = Product::query()
            ->with('history')
            ->withOutGlobalScope(IsVisibleScope::class)
            // ->with('branches') // لجلب بيانات pivot لكل فرع
            ->get();

        return [
            'products' => $products,
            'branch' => $branch,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('print')
                ->label(__('product.actions.print.label'))
                ->icon('heroicon-o-printer')
                ->color('info')
                ->action(function () {
                    $this->js('window.print()');
                }),

            Actions\Action::make('refresh')
                ->label(__('product.actions.refresh.label'))
                ->icon('heroicon-o-arrow-path')
                ->color('primary')
                ->action(function () {
                    $servies = new InventoryService;
                    $servies->updateAllBranches();
                }),
        ];
    }
}
