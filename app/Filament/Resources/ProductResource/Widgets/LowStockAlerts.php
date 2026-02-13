<?php
namespace App\Filament\Resources\ProductResource\Widgets;

use App\Models\Product;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class LowStockAlerts extends Widget
{
    protected static string $view = 'filament.resources.product-resource.widgets.low-stock-alerts';

    protected int|string|array $columnSpan = 'full';

    public function getLowStockProducts(): array
    {
        return DB::table('branch_product')
            ->join('products', 'branch_product.product_id', '=', 'products.id')
            ->join('branches', 'branch_product.branch_id', '=', 'branches.id')
            ->select([
                    'products.id',
                    'products.name as product_name',
                    'products.low_stock_notified_at',
                    'products.security_stock',
                    'branches.name as branch_name',
                    // حساب الكمية الكلية (جديد + مستعمل)
                    DB::raw('(branch_product.new_quantity + branch_product.used_quantity) as total_quantity')
                ])
            // المقارنة: حيث المجموع أقل من حد الأمان الخاص بالمنتج
            ->whereRaw('(branch_product.new_quantity + branch_product.used_quantity) < products.security_stock')
            // والتأكد أن المجموع أكبر من صفر (لتجنب عرض المنتجات غير المتوفرة نهائياً إذا أردت)
            ->whereRaw('(branch_product.new_quantity + branch_product.used_quantity) > 0')
            ->orderBy('total_quantity')
            ->take(20)
            ->get()
            ->map(function ($item) {
                return (array) $item;
            })
            ->toArray();
    }
}