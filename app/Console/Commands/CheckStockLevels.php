<?php

namespace App\Console\Commands;

use App\Mail\LowStockSummaryMail;
use App\Models\Product;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CheckStockLevels extends Command
{
    protected $signature = 'stock:check-levels';
    protected $description = 'التحقق من مستويات المخزون وإرسال تنبيهات للمدراء';

    public function handle()
    {
        $this->info('بدء فحص مستويات المخزون...');

        // 1. جلب المنتجات التي قل مخزونها عن حد الأمان
        // استخدمنا subquery لحساب المجموع بشكل أسرع
        $lowStockProducts = Product::query()
            ->select('products.*')
            ->selectSub(function ($query) {
                $query->from('branch_product')
                    ->whereColumn('product_id', 'products.id')
                    ->selectRaw('SUM(new_quantity + used_quantity)');
            }, 'actual_total_stock')
            ->whereNull('low_stock_notified_at')
            ->whereRaw('COALESCE((select sum(new_quantity + used_quantity) from branch_product where product_id = products.id), 0) <= security_stock')
            ->get();

        if ($lowStockProducts->isEmpty()) {
            $this->info('لا توجد منتجات جديدة منخفضة المخزون.');
            $this->checkRestockedProducts(); // فحص المنتجات التي تم إعادة تعبئتها
            return self::SUCCESS;
        }

        $allUsers = User::role(['مدير', 'super_admin'])->get();

        if ($allUsers->isEmpty()) {
            $this->warn('لا يوجد مدراء لإرسال التنبيهات إليهم.');
            return self::FAILURE;
        }

        $this->info("تم العثور على {$lowStockProducts->count()} منتج مخزونه منخفض.");

        // إرسال تنبيهات Filament (تظهر في جرس التنبيهات بالموقع)
        foreach ($lowStockProducts as $product) {
            Notification::make()
                ->title('تنبيه: انخفاض مخزون منتج')
                ->danger()
                ->icon('heroicon-o-shopping-cart')
                ->body("المنتج: {$product->name}\nالكمية الحالية: {$product->actual_total_stock}\nحد الأمان: {$product->security_stock}")
                ->sendToDatabase($allUsers);
        }

        // إرسال إيميل ملخص لكل مدير (إيميل واحد يحتوي كل المنتجات بدلاً من إيميل لكل منتج)
        foreach ($allUsers as $user) {
            try {
                Mail::to($user)->send(new LowStockSummaryMail($lowStockProducts));
                $this->line("تم إرسال الإيميل إلى: {$user->email}");
            } catch (\Exception $e) {
                Log::error("فشل إرسال إيميل لـ {$user->email}: " . $e->getMessage());
            }
        }

        // تحديث التاريخ لعدم إرسال التنبيه مرة أخرى حتى يتم الشحن
        Product::whereIn('id', $lowStockProducts->pluck('id'))
            ->update(['low_stock_notified_at' => now()]);

        $this->checkRestockedProducts();

        $this->info('تمت عملية الفحص بنجاح.');
        return self::SUCCESS;
    }

    /**
     * إعادة تعيين التاريخ للمنتجات التي تم تزويد مخزونها
     */
    protected function checkRestockedProducts()
    {
        $restockedProductIds = Product::query()
            ->whereNotNull('low_stock_notified_at')
            ->whereRaw('COALESCE((select sum(new_quantity + used_quantity) from branch_product where product_id = products.id), 0) > security_stock')
            ->pluck('id');

        if ($restockedProductIds->isNotEmpty()) {
            Product::whereIn('id', $restockedProductIds)->update(['low_stock_notified_at' => null]);
            $this->info("تم إعادة تفعيل التنبيهات لـ {$restockedProductIds->count()} منتج تم شحنها.");
        }
    }
}