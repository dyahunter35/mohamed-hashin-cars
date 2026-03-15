<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use App\Services\InventoryService;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Exceptions\Halt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    /**
     * This hook runs AFTER the order and its items have been successfully created.
     * This is the perfect place to handle stock deduction.
     */
    protected function afterCreate(): void
    {
        $inventoryService = new InventoryService();
        $currentBranch = Filament::getTenant();
        $currentUser = auth()->user();
        $order = $this->record;

        DB::transaction(function () use ($inventoryService, $currentBranch, $currentUser, $order) {

            // Skip stock deduction if the order is a Proforma invoice
            $shouldDeduct = !in_array($order->status, [\App\Enums\OrderStatus::Proforma, \App\Enums\OrderStatus::Cancelled]);

            if (!$shouldDeduct) {
                $order->orderLogs()->create([
                    'log' => "Proforma Invoice created By: " . $currentUser->name,
                    'type' => 'created'
                ]);
                return;
            }
            if ($shouldDeduct) {

                foreach ($order->items as $item) {
                    $product = Product::find($item->product_id);

                    // Final check for stock before deduction
                    if (!$inventoryService->isAvailableInBranch($product, $currentBranch, $item->qty, $item->condition instanceof \App\Enums\ItemCondition ? $item->condition : \App\Enums\ItemCondition::from($item->condition))) {
                        Notification::make()
                            ->title(__('order.actions.create.notifications.stock.title'))
                            ->body(__('order.actions.create.notifications.stock.message', ['product' => $product->name]))
                            ->danger()
                            ->send();

                        throw new Halt();
                    }

                    // Deduct the stock
                    $inventoryService->deductStockForBranch(
                        $product,
                        $currentBranch,
                        $item->qty,
                        $item->condition,
                        "Order #{$order->number}",
                        $currentUser,
                        $order->id
                    );
                }

                $inventoryService->updateAllBranches();
            }
            $order->orderLogs()->create([
                'log' => "Invoice created By: " . $currentUser->name,
                'type' => 'created'
            ]);
        });
    }

    /**
     * This method runs BEFORE the main record is created.
     * It's used to prepare the data.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $currentBranch = Filament::getTenant();
        $currentUser = auth()->user();

        // Handle guest customer logic
        if (isset($data['is_guest'])) {
            if ($data['is_guest'] === false) {
                $data['guest_customer'] = null;
            } else {
                $data['customer_id'] = null;
            }
        }

        $data['number'] = Order::generateInvoiceNumber();
        $data['caused_by'] = $currentUser->id;
        $data['branch_id'] = $currentBranch->id;

        return $data;
    }
}
