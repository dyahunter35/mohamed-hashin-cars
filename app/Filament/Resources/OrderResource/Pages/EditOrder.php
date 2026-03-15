<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Enums\ItemCondition;
use App\Enums\OrderStatus;
use App\Filament\Resources\OrderResource;
use App\Models\Product;
use App\Services\InventoryService;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Collection;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected Collection $oldItems;
    protected ?OrderStatus $oldStatus = null;

    protected function getHeaderActions(): array
    {
        return [Actions\ViewAction::make(), Actions\DeleteAction::make()];
    }

    protected function beforeSave(): void
    {
        $record = $this->getRecord();
        $this->oldStatus = $record->status;

        $generateKey = fn($item) => $item['product_id'] . '_' . ($this->parseCondition($item['condition'])->value);

        $this->oldItems = $record->items->map(fn($item) => [
            'product_id' => (int) $item->product_id,
            'qty' => (float) $item->qty,
            'condition' => $item->condition,
        ])->keyBy($generateKey);
    }

    protected function afterSave(): void
    {
        $record = $this->getRecord()->refresh();
        $inventoryService = new InventoryService;
        $currentBranch = Filament::getTenant();
        $currentUser = auth()->user();

        $generateKey = fn($item) => $item['product_id'] . '_' . ($this->parseCondition($item['condition'])->value);

        $newItems = $record->items->map(fn($item) => [
            'product_id' => (int) $item->product_id,
            'qty' => (float) $item->qty,
            'condition' => $item->condition,
        ])->keyBy($generateKey);

        $wasDeducting = !in_array($this->oldStatus, [OrderStatus::Proforma, OrderStatus::Cancelled]);
        $isDeducting = !in_array($record->status, [OrderStatus::Proforma, OrderStatus::Cancelled]);

        $hasStockAction = false;

        // الحالة 1: تعديل كميات في طلب فعال
        if ($wasDeducting && $isDeducting) {
            $added = $newItems->diffKeys($this->oldItems);
            $removed = $this->oldItems->diffKeys($newItems);
            $changed = $newItems->filter(fn($item, $key) => $this->oldItems->has($key) && $this->oldItems->get($key)['qty'] != $item['qty']);

            foreach ($added as $item) {
                $this->applyStockInitial($inventoryService, $item, -abs($item['qty']), $currentBranch, $currentUser, $record->id, "إضافة صنف للطلب #{$record->number}");
                $hasStockAction = true;
            }
            foreach ($removed as $item) {
                $this->applyStockInitial($inventoryService, $item, abs($item['qty']), $currentBranch, $currentUser, $record->id, "حذف صنف من الطلب #{$record->number}");
                $hasStockAction = true;
            }
            foreach ($changed as $key => $newItem) {
                $diff = $this->oldItems->get($key)['qty'] - $newItem['qty'];
                $this->applyStockInitial($inventoryService, $newItem, $diff, $currentBranch, $currentUser, $record->id, "تعديل كمية الطلب #{$record->idnumber}");
                $hasStockAction = true;
            }
        }
        // الحالة 2: تحول من غير فعال إلى فعال (خصم الكل)
        elseif (!$wasDeducting && $isDeducting) {
            foreach ($newItems as $item) {
                $this->applyStockInitial($inventoryService, $item, -abs($item['qty']), $currentBranch, $currentUser, $record->id, "تفعيل الطلب #{$record->number}");
            }
            $hasStockAction = true;
        }
        // الحالة 3: تحول من فعال إلى غير فعال (إرجاع الكل)
        elseif ($wasDeducting && !$isDeducting) {
            foreach ($this->oldItems as $item) {
                $this->applyStockInitial($inventoryService, $item, abs($item['qty']), $currentBranch, $currentUser, $record->id, "إلغاء الطلب #{$record->number}");
            }
            $hasStockAction = true;
        }

        if ($hasStockAction)
            $inventoryService->updateAllBranches();
    }

    private function applyStockInitial($service, $itemData, $change, $branch, $user, $orderId, $notes)
    {
        $product = Product::find($itemData['product_id']);
        $condition = $this->parseCondition($itemData['condition']);

        if ($change < 0 && !$service->isAvailableInBranch($product, $branch, abs($change), $condition)) {
            Notification::make()->title("المخزون غير كافٍ: {$product->name}")->danger()->send();
            throw new Halt();
        }

        $service->adjustStock($product, $branch, $change, $condition, $notes, $user, $orderId);
    }

    private function parseCondition($condition): ItemCondition
    {
        return $condition instanceof ItemCondition ? $condition : (ItemCondition::tryFrom($condition) ?? ItemCondition::New);
    }
}