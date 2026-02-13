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
        // استعلام المنتجات الجديدة التي قل مخزونها عن حد الأمان الخاص بها
        $lowStockNew = DB::table('branch_product')
            ->join('products', 'branch_product.product_id', '=', 'products.id')
            ->join('branches', 'branch_product.branch_id', '=', 'branches.id')
            // استخدام whereColumn للمقارنة مع security_stock لكل منتج بشكل ديناميكي
            ->whereColumn('branch_product.new_quantity', '<', 'products.security_stock')
            ->where('branch_product.new_quantity', '>', 0)
            ->select([
                    'products.id',
                    'products.name as product_name',
                    'products.low_stock_notified_at', // جلب تاريخ التنبيه
                    'products.security_stock',        // جلب حد الأمان للعرض
                    'branches.name as branch_name',
                    'branch_product.new_quantity as quantity',
                    DB::raw("'new' as product_status")
                ])
            ->get();

        // استعلام المنتجات المستعملة
        $lowStockUsed = DB::table('branch_product')
            ->join('products', 'branch_product.product_id', '=', 'products.id')
            ->join('branches', 'branch_product.branch_id', '=', 'branches.id')
            ->whereColumn('branch_product.used_quantity', '<', 'products.security_stock')
            ->where('branch_product.used_quantity', '>', 0)
            ->select([
                    'products.id',
                    'products.name as product_name',
                    'products.low_stock_notified_at',
                    'products.security_stock',
                    'branches.name as branch_name',
                    'branch_product.used_quantity as quantity',
                    DB::raw("'used' as product_status")
                ])
            ->get();

        return $lowStockNew->concat($lowStockUsed)
            ->sortBy('quantity')
            ->take(20)
            ->map(function ($item) {
                return (array) $item;
            })
            ->toArray();
    }
}