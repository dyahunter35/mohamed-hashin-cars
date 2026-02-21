<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Enums\OrderStatus;
use App\Filament\Resources\OrderResource;
use App\Models\Product;
use App\Services\InventoryService;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Filament\Support\Exceptions\Halt;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    /**
     * This method runs AFTER the form is submitted but BEFORE the update happens.
     * It cleans up the data before it's saved.
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['caused_by'] = auth()->id();
        // If the order is for a registered customer...
        if ($data['is_guest'] === false) {
            // ...ensure the guest_customer field is null.
            $data['guest_customer'] = null;
        } else {
            // Otherwise, if it's a guest, ensure customer_id is null.
            $data['customer_id'] = null;
        }

        return $data;
    }

    /**
     * This is the main logic for handling the update process.
     * Overriding this gives us full control over the stock management transaction.
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $inventoryService = new InventoryService();
        $currentBranch = Filament::getTenant();
        $currentUser = auth()->user();

        // Get the new state of items from the form data
        // With ->relationship(), Filament prepares the data for the relation.
        $newItemsData = $data['items'] ?? [];

        return DB::transaction(function () use ($record, $data, $newItemsData, $inventoryService, $currentBranch, $currentUser) {
            $oldStatus = $record->status;
            $newStatus = $data['status'] instanceof OrderStatus ? $data['status'] : (OrderStatus::tryFrom($data['status']) ?? OrderStatus::New);

            // 1. Restock original items IF they were previously deducted (i.e., not Proforma)
            if ($oldStatus !== OrderStatus::Proforma) {
                foreach ($record->items as $item) {
                    $product = Product::find($item->product_id);
                    $inventoryService->addStockForBranch(
                        $product,
                        $currentBranch,
                        $item->qty,
                        $item->condition,
                        "Order Update #{$record->number}",
                        $currentUser
                    );
                }
            }

            if (($record->total != $data['total']) && $newStatus !== OrderStatus::Proforma) {
                $data['status'] = OrderStatus::Processing;
            }

            // 2. Update the main order and its related items
            $record->update($data);
            $record->refresh();

            // 3. Deduct stock for the new set of items IF the NEW status is NOT Proforma
            if ($newStatus !== OrderStatus::Proforma) {
                if ($record->items->isEmpty()) {
                    Notification::make()->title(__('order.actions.create.notifications.at_least_one'))->warning()->send();
                }

                foreach ($record->items as $newItem) {
                    $product = Product::find($newItem->product_id);
                    if (!$inventoryService->isAvailableInBranch($product, $currentBranch, $newItem->qty, $newItem->condition instanceof \App\Enums\ItemCondition ? $newItem->condition : (\App\Enums\ItemCondition::tryFrom($newItem->condition) ?? \App\Enums\ItemCondition::New))) {
                        Notification::make()
                            ->title(__('order.actions.create.notifications.stock.title'))
                            ->body(__('order.actions.create.notifications.stock.message', ['product' => $product->name]))
                            ->danger()
                            ->send();
                        throw new Halt();
                    }

                    $inventoryService->deductStockForBranch(
                        $product,
                        $currentBranch,
                        $newItem->qty,
                        $newItem->condition instanceof \App\Enums\ItemCondition ? $newItem->condition : (\App\Enums\ItemCondition::tryFrom($newItem->condition) ?? \App\Enums\ItemCondition::New),
                        "Order Update #{$record->number}",
                        $currentUser
                    );
                }
            }

            $inventoryService->updateAllBranches();

            // 4. Add an update log
            $record->orderLogs()->create([
                'log' => "Invoice updated By: " . $currentUser->name . ($newStatus === OrderStatus::Proforma ? " (Proforma)" : ""),
                'type' => 'updated'
            ]);

            return $record;
        });
    }
}
