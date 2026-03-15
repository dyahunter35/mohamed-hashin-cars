<?php

namespace App\Services;

use App\Enums\ItemCondition;
use App\Models\Branch;
use App\Models\Order;
use App\Models\Product;
use App\Models\Scopes\IsVisibleScope;
use App\Models\StockHistory;
use App\Models\User;
use Exception;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Facades\DB;

/**
 * Class InventoryService
 *
 * Handles all inventory logic based on a multi-tenant (Branch) system.
 * The source of truth for stock levels is the `branch_product` pivot table.
 * All changes are logged in the `stock_histories` table.
 */
class InventoryService
{
    /**
     * إضافة كمية إلى مخزون منتج في فرع معين.
     *
     * @param Product $product المنتج الذي ستتم إضافة المخزون إليه.
     * @param Branch $branch الفرع الذي سيتم تحديث المخزون فيه.
     * @param int $quantity الكمية المراد إضافتها.
     * @param ItemCondition $condition حالة المنتج (جديد أو مستعمل).
     * @param string|null $notes ملاحظات حول العملية (مثال: "شحنة جديدة").
     * @param User|null $causer المستخدم الذي قام بالعملية.
     * @return StockHistory السجل التاريخي الذي تم إنشاؤه.
     */

    public function addStockForBranch(Product $product, Branch $branch, int|float $quantity, ItemCondition $condition = ItemCondition::New , ?string $notes = 'Manual Update', ?User $causer = null, ?int $orderId = null): StockHistory
    {
        if ($quantity <= 0)
            throw new Exception('الكمية يجب أن تكون أكبر من صفر.');

        return DB::transaction(function () use ($product, $branch, $quantity, $condition, $notes, $causer, $orderId) {
            $pivot = DB::table('branch_product')
                ->where('product_id', $product->id)
                ->where('branch_id', $branch->id)
                ->first();

            $currentQty = $pivot->total_quantity ?? 0;

            return StockHistory::create([
                'product_id' => $product->id,
                'branch_id' => $branch->id,
                'order_id' => $orderId,
                'type' => 'increase',
                'quantity_change' => $quantity,
                'condition' => $condition,
                'new_quantity' => $currentQty + $quantity,
                'notes' => $notes,
                'user_id' => $causer?->id,
            ]);
        });
    }

    /**
     * خصم مخزون مع ربطه بـ order_id
     */
    public function deductStockForBranch(Product $product, Branch $branch, int|float $quantity, ItemCondition $condition = ItemCondition::New , ?string $notes = 'Sale', ?User $causer = null, ?int $orderId = null): StockHistory
    {
        if ($quantity <= 0) {
            Notification::make()->title('الكمية يجب أن تكون أكبر من صفر.')->warning()->send();
            throw new Halt();
        }

        return DB::transaction(function () use ($product, $branch, $quantity, $condition, $notes, $causer, $orderId) {
            $pivotRow = DB::table('branch_product')
                ->where('product_id', $product->id)
                ->where('branch_id', $branch->id)
                ->lockForUpdate()
                ->first();

            $currentQty = $pivotRow ? $pivotRow->total_quantity : 0;
            $conditionQty = $pivotRow ? (($condition === ItemCondition::New) ? ($pivotRow->new_quantity ?? 0) : ($pivotRow->used_quantity ?? 0)) : 0;

            if ($conditionQty < $quantity) {
                Notification::make()
                    ->title("المخزون غير كافٍ للمنتج '{$product->name}'")
                    ->danger()
                    ->send();
                throw new Halt();
            }

            return StockHistory::create([
                'product_id' => $product->id,
                'branch_id' => $branch->id,
                'order_id' => $orderId,
                'type' => 'decrease',
                'quantity_change' => $quantity,
                'condition' => $condition,
                'new_quantity' => $currentQty - $quantity,
                'notes' => $notes,
                'user_id' => $causer?->id,
            ]);
        });
    }

    public function adjustStock(Product $product, Branch $branch, float $quantityChange, ItemCondition $condition = ItemCondition::New , ?string $notes = 'Adjustment', ?User $causer = null, ?int $orderId = null): StockHistory
    {
        return DB::transaction(function () use ($product, $branch, $quantityChange, $condition, $notes, $causer, $orderId) {

            // جلب الرصيد الإجمالي الحالي من الـ Pivot
            $pivot = DB::table('branch_product')
                ->where('product_id', $product->id)
                ->where('branch_id', $branch->id)
                ->first();

            $currentTotal = $pivot->total_quantity ?? 0;

            return StockHistory::create([
                'product_id' => $product->id,
                'branch_id' => $branch->id,
                'order_id' => $orderId,
                'type' => 'initial', // توحيد النوع كما طلبت
                'quantity_change' => $quantityChange, // تخزين الإشارة (+ أو -)
                'condition' => $condition,
                'new_quantity' => $currentTotal + $quantityChange,
                'notes' => $notes,
                'user_id' => $causer?->id,
            ]);
        });
    }

    /**
     * عكس وحذف جميع الحركات السابقة المرتبطة بطلب معين
     */
    public function revertOrderMovements(int $orderId, Branch $branch)
    {
        DB::transaction(function () use ($orderId, $branch) {
            // جلب كل الحركات المرتبطة بهذا الطلب في هذا الفرع
            $movements = StockHistory::where('order_id', $orderId)
                ->where('branch_id', $branch->id)
                ->get();

            foreach ($movements as $movement) {
                // ملاحظة: الحذف هنا كافٍ لأن دالة updateAllBranches تعيد حساب الإجمالي 
                // بناءً على السجلات الموجودة فقط في جدول التاريخ.
                $movement->delete();
            }
        });
    }

    /**
     * التحقق مما إذا كانت كمية معينة من منتج متوفرة في فرع معين.
     *
     * @param Product $product المنتج.
     * @param Branch $branch الفرع.
     * @param int $quantity الكمية المطلوبة.
     * @param ItemCondition $condition حالة المنتج (جديد أو مستعمل).
     * @return bool
     */
    public function isAvailableInBranch(Product|int $product, Branch|int $branch, int|float $quantity, ItemCondition $condition = ItemCondition::New): bool
    {
        $productId = $product instanceof Product ? $product->id : $product;
        $branchId = $branch instanceof Branch ? $branch->id : $branch;

        $pivot = DB::table('branch_product')
            ->where('product_id', $productId)
            ->where('branch_id', $branchId)
            ->first();

        if (!$pivot) {
            // محاولة أولية لإعادة بناء البيانات لو مش موجودة
            $this->updateStockInBranch($productId, $branchId);
            $pivot = DB::table('branch_product')
                ->where('product_id', $productId)
                ->where('branch_id', $branchId)
                ->first();
        }

        if (!$pivot) {
            return false;
        }

        $available = ($condition === ItemCondition::New) ? ($pivot->new_quantity ?? 0) : ($pivot->used_quantity ?? 0);

        return (float) $available >= (float) $quantity;
    }



    /**
     * Recalculates and updates the total stock for a specific product in a specific branch.
     *
     * @param Product $product
     * @param Branch $branch
     * @return int The number of affected rows (usually 1 if successful, 0 if not found).
     */
    public function updateStockInBranch(Product|int $product, Branch|int $branch): void
    {
        $productId = $product instanceof Product ? $product->id : $product;
        $branchId = $branch instanceof Branch ? $branch->id : $branch;

        /**
         * المنطق الحسابي الموحد:
         * 1. إذا كان النوع 'decrease' -> نحول القيمة دائماً لسالب.
         * 2. في الحالات الأخرى (initial, increase) -> نأخذ القيمة كما هي.
         * هذا يضمن أن 'initial' لو كان سالباً سيُطرح، ولو موجباً سيُجمع.
         */
        $sumExpression = 'SUM(CASE WHEN type = "decrease" THEN -ABS(quantity_change) ELSE quantity_change END)';

        // حساب المجاميع بناءً على الحالة (جديد / مستعمل)
        $newTotal = StockHistory::where('product_id', $productId)
            ->where('branch_id', $branchId)
            ->where('condition', 'new')
            ->selectRaw($sumExpression . ' as total')
            ->value('total') ?? 0;

        $usedTotal = StockHistory::where('product_id', $productId)
            ->where('branch_id', $branchId)
            ->where('condition', 'used')
            ->selectRaw($sumExpression . ' as total')
            ->value('total') ?? 0;

        $total = $newTotal + $usedTotal;

        // تحديث جدول الـ Pivot (branch_product)
        DB::table('branch_product')
            ->updateOrInsert(
                ['product_id' => $productId, 'branch_id' => $branchId],
                [
                    'total_quantity' => $total,
                    'new_quantity' => $newTotal,
                    'used_quantity' => $usedTotal,
                    'updated_at' => now(),
                ]
            );
    }
    public function updateAll()
    {
        $products = Product::query()
            ->withOutGlobalScope(IsVisibleScope::class)
            // ->with('branches') // لجلب بيانات pivot لكل فرع
            ->get();
        $branch = Filament::getTenant();
        foreach ($products as $product) {
            $this->updateStockInBranch($product, $branch);
        }
    }

    public function updateAllBranches(): void
    {
        // المنطق المشترك لحساب الكمية بناءً على النوع
        // Initial & Increase -> (+)
        // Decrease -> (-)
        $sqlCalculation = 'COALESCE(SUM(
            CASE 
                WHEN type = "decrease" THEN -ABS(quantity_change)
                ELSE quantity_change 
            END
        ), 0)';

        DB::table('branch_product')->update([
            'total_quantity' => DB::raw(
                "(SELECT $sqlCalculation 
              FROM stock_histories 
              WHERE stock_histories.product_id = branch_product.product_id 
              AND stock_histories.branch_id = branch_product.branch_id)"
            ),
            'new_quantity' => DB::raw(
                "(SELECT $sqlCalculation 
              FROM stock_histories 
              WHERE stock_histories.product_id = branch_product.product_id 
              AND stock_histories.branch_id = branch_product.branch_id 
              AND stock_histories.condition = 'new')"
            ),
            'used_quantity' => DB::raw(
                "(SELECT $sqlCalculation 
              FROM stock_histories 
              WHERE stock_histories.product_id = branch_product.product_id 
              AND stock_histories.branch_id = branch_product.branch_id 
              AND stock_histories.condition = 'used')"
            )
        ]);
    }
}
