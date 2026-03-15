<?php

namespace App\Filament\Actions\Resource;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use App\Services\InventoryService;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Support\Exceptions\Halt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ToProcessAction extends Action
{
    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'convertToProcessing';
    }

    protected function setUp(): void
    {
        parent::setUp();

        // الإعدادات الافتراضية للـ Action
        $this->label('تحويل إلى معالجة')
            ->icon('heroicon-o-arrow-path')
            ->color('success')
            ->requiresConfirmation()
            ->modalHeading('تحويل الفاتورة المبدئية')
            ->modalDescription('هل أنت متأكد من تحويل هذه الفاتورة المبدئية إلى فاتورة عادية؟ سيتم خصم الكميات من المخزن الآن.')

            // التحكم في الظهور بناءً على حالة الطلب
            ->visible(
                fn(Model $record): bool =>
                $record instanceof Order && $record->status === OrderStatus::Proforma
            );

        // المنطق البرمجي (Action Logic)
        $this->action(function (Order $record): void {
            $this->process(function () use ($record) {

                $inventoryService = new InventoryService();
                $currentBranch = Filament::getTenant();
                $currentUser = auth()->user();

                DB::transaction(function () use ($record, $inventoryService, $currentBranch, $currentUser) {
                    foreach ($record->items as $item) {
                        $product = $item->product;

                        // 1. التحقق من التوفر
                        $isAvailable = $inventoryService->isAvailableInBranch(
                            $product,
                            $currentBranch,
                            $item->qty,
                            $item->condition
                        );

                        if (!$isAvailable) {
                            Notification::make()
                                ->title(__('order.actions.create.notifications.stock.title'))
                                ->body(__('order.actions.create.notifications.stock.message', ['product' => $product->name]))
                                ->danger()
                                ->send();

                            // إيقاف العملية (Halt) لمنع إغلاق المودال أو تحديث الحالة
                            throw new Halt();
                        }

                        // 2. خصم المخزون
                        $inventoryService->deductStockForBranch(
                            $product,
                            $currentBranch,
                            $item->qty,
                            $item->condition,
                            "Proforma Conversion #{$record->number}",
                            $currentUser
                        );
                    }

                    // 3. تحديث حالة الطلب والسجلات
                    $record->update(['status' => OrderStatus::Processing]);

                    $inventoryService->updateAllBranches();

                    $record->orderLogs()->create([
                        'log' => "Converted from Proforma to Processing By: " . $currentUser->name,
                        'type' => 'status_updated'
                    ]);
                });

                // إرسال إشعار النجاح
                Notification::make()
                    ->title('تم التحويل بنجاح')
                    ->success()
                    ->send();
            });
        });
    }
}