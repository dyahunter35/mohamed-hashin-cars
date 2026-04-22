<?php

namespace App\Filament\Pages;

use App\Enums\ItemCondition;
use App\Enums\OrderStatus;
use App\Enums\Payment;
use App\Filament\Pages\Dashboard\MainDashboard;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Services\InventoryService;
use Filament\Actions\Action as PageAction;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Facades\DB;

// Imports for Filament Table
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action as TableAction;

class POS2 extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.p-o-s2';

    public function getMaxContentWidth(): ?string
    {
        return 'full';
    }

    // --- POS State (Cart & Totals) ---
    public string $barcode = '';
    public array $searchResults = [];
    public array $cart = [];
    public float $shippingCost = 0.0;
    public float $installCost = 0.0;
    public float $totalDiscount = 0.0;
    public float $grandTotal = 0.0;
    public float $subTotal = 0.0;

    // --- Manual Form Data Properties ---
    public bool $is_guest = true;
    public ?int $customer_id = null;
    public string $guest_name = '';
    public string $guest_phone = '';
    public string $status = '';
    public string $currency = 'SDG';
    public string $payment_method = '';
    public string $notes = '';
    public float $paid_amount = 0.0;
    public ?int $lastOrderId = null;

    public function mount()
    {
        $this->status = OrderStatus::New ->value;
        $this->payment_method = Payment::Cash->value ?? 'cash';
        $this->calculateTotals();
    }

    public function getHeaderActions(): array
    {
        return [
            PageAction::make('back')
                ->label('Back to Dashboard')
                ->icon('heroicon-o-arrow-left')
                ->color('gray')
                ->url(MainDashboard::getUrl()),
        ];
    }

    // --- تمرير قائمة العملاء للواجهة ---
    protected function getViewData(): array
    {
        return [
            'customersList' => Customer::where('branch_id', Filament::getTenant()->id)->pluck('name', 'id'),
        ];
    }

    // --- Table Configuration (Recent Orders) ---
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()
                    ->where('branch_id', Filament::getTenant()->id)
                    ->latest()
            )
            ->columns([
                TextColumn::make('number')
                    ->label('رقم الفاتورة')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('customer_name')
                    ->label('العميل')
                    ->getStateUsing(function (Order $record) {
                        return $record->is_guest
                            ? ($record->guest_customer['name'] ?? 'زائر')
                            : $record->customer?->name;
                    })
                    ->searchable(['guest_customer', 'customer.name']),

                TextColumn::make('total')
                    ->label('الإجمالي')
                    ->money(fn($record) => $record->currency ?? 'SDG')
                    ->sortable()
                    ->color('primary')
                    ->weight('bold'),

                TextColumn::make('status')
                    ->label('الحالة')
                    ->badge(),

                TextColumn::make('created_at')
                    ->label('التاريخ')
                    ->dateTime('d M Y - h:i A')
                    ->sortable(),
            ])
            ->actions([
                TableAction::make('print')
                    ->label('طباعة')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    ->button()
                    ->action(fn(Order $record) => $this->dispatch('print-receipt', orderId: $record->id)),
            ])
            ->paginated([10, 25, 50])
            ->defaultSort('created_at', 'desc');
    }

    // --- Live Search ---
    public function updatedBarcode()
    {
        $query = trim($this->barcode);

        if (strlen($query) < 1) {
            $this->searchResults = [];
            return;
        }

        $currentBranchId = Filament::getTenant()->id;

        $this->searchResults = Product::query()
            ->where(function ($q) use ($query) {
                $q->where('barcode', 'like', "%{$query}%")
                  ->orWhere('name', 'like', "%{$query}%");
            })
            ->whereHas('branches', fn($q) => $q->where('branches.id', $currentBranchId))
            ->limit(8)
            ->get(['id', 'name', 'barcode', 'price'])
            ->toArray();
    }

    public function selectProduct(string $barcode)
    {
        $this->barcode = $barcode;
        $this->searchResults = [];
        $this->addBarcodeItem();
    }

    // --- POS Cart Actions ---
    public function addBarcodeItem()
    {
        $barcode = trim($this->barcode);
        $this->barcode = '';

        if (empty($barcode))
            return;

        $currentBranchId = Filament::getTenant()->id;
        $product = Product::query()
            ->where('barcode', $barcode)
            ->whereHas('branches', fn($q) => $q->where('branches.id', $currentBranchId))
            ->first();

        if (!$product) {
            Notification::make()->title('المنتج غير موجود في هذا الفرع')->warning()->send();
            return;
        }

        $condition = ItemCondition::New ->value;
        $existingIndex = collect($this->cart)->search(function ($item) use ($product, $condition) {
            return $item['product_id'] == $product->id && $item['condition'] === $condition;
        });

        if ($existingIndex !== false) {
            $currentQty = $this->cart[$existingIndex]['qty'];
            $inventoryService = new InventoryService();
            if (!$inventoryService->isAvailableInBranch($product, Filament::getTenant(), $currentQty + 1, ItemCondition::from($condition))) {
                Notification::make()->title('المخزون غير كافٍ لـ ' . $product->name)->danger()->send();
                return;
            }
            $this->cart[$existingIndex]['qty'] += 1;
        } else {
            $inventoryService = new InventoryService();
            if (!$inventoryService->isAvailableInBranch($product, Filament::getTenant(), 1, ItemCondition::from($condition))) {
                Notification::make()->title('المخزون غير كافٍ لـ ' . $product->name)->danger()->send();
                return;
            }
            $this->cart[] = [
                'id' => uniqid(),
                'product_id' => $product->id,
                'product' => ['name' => $product->name, 'price' => $product->price],
                'qty' => 1,
                'price' => $product->price,
                'condition' => $condition,
                'sub_discount' => 0,
                'sub_total' => $product->price,
            ];
        }

        Notification::make()->title('تمت الإضافة: ' . $product->name)->success()->send();
        $this->calculateTotals();
    }

    public function updateCartItemQty($index, $qty)
    {
        $qty = (float) $qty;
        if (!isset($this->cart[$index]))
            return;
        if ($qty <= 0) {
            $this->removeCartItem($index);
            return;
        }

        $item = $this->cart[$index];
        $product = Product::find($item['product_id']);

        $inventoryService = new InventoryService();
        if (!$inventoryService->isAvailableInBranch($product, Filament::getTenant(), $qty, ItemCondition::from($item['condition']))) {
            Notification::make()->title('المخزون غير كافٍ لـ ' . $product->name)->danger()->send();
            return;
        }

        $this->cart[$index]['qty'] = $qty;
        $this->calculateTotals();
    }

    public function incrementQty($index)
    {
        $this->updateCartItemQty($index, $this->cart[$index]['qty'] + 1);
    }
    public function decrementQty($index)
    {
        $this->updateCartItemQty($index, $this->cart[$index]['qty'] - 1);
    }

    public function updateCartItemCondition($index, $conditionStr)
    {
        if (!isset($this->cart[$index]))
            return;
        $item = $this->cart[$index];
        $product = Product::find($item['product_id']);
        $inventoryService = new InventoryService();
        if (!$inventoryService->isAvailableInBranch($product, Filament::getTenant(), $item['qty'], ItemCondition::from($conditionStr))) {
            Notification::make()->title('المخزون غير كافٍ بهذه الحالة')->danger()->send();
            return;
        }
        $this->cart[$index]['condition'] = $conditionStr;
        $this->calculateTotals();
    }

    public function updateCartItemDiscount($index, $discount)
    {
        if (!isset($this->cart[$index]))
            return;
        $this->cart[$index]['sub_discount'] = (float) $discount;
        $this->calculateTotals();
    }

    public function removeCartItem($index)
    {
        if (isset($this->cart[$index])) {
            unset($this->cart[$index]);
            $this->cart = array_values($this->cart);
            $this->calculateTotals();
        }
    }

    public function updatedShippingCost()
    {
        $this->calculateTotals();
    }
    public function updatedInstallCost()
    {
        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->subTotal = 0.0;
        $this->totalDiscount = 0.0;

        foreach ($this->cart as &$item) {
            $qty = (float) ($item['qty'] ?? 1);
            $unitPrice = (float) ($item['price'] ?? 0);
            $itemDiscount = (float) ($item['sub_discount'] ?? 0);
            $subTotal = max(0, ($unitPrice - $itemDiscount)) * $qty;
            $item['sub_total'] = round($subTotal, 2);

            $this->subTotal += $item['sub_total'];
            $this->totalDiscount += ($itemDiscount * $qty);
        }

        $this->shippingCost = (float) ($this->shippingCost ?? 0.0);
        $this->installCost = (float) ($this->installCost ?? 0.0);
        $this->grandTotal = round($this->subTotal + $this->shippingCost + $this->installCost, 2);

        $this->paid_amount = $this->grandTotal; // Update manual property
    }

    public function checkout()
    {
        if (empty($this->cart)) {
            Notification::make()->title('السلة فارغة.')->warning()->send();
            return;
        }

        // Validate Manual Form
        if (!$this->is_guest && empty($this->customer_id)) {
            Notification::make()->title('الرجاء اختيار العميل!')->warning()->send();
            return;
        }

        $currentBranch = Filament::getTenant();
        $currentUser = auth()->user();

        DB::transaction(function () use ($currentBranch, $currentUser) {
            $orderData = [
                'number' => Order::generateInvoiceNumber(),
                'caused_by' => $currentUser->id,
                'branch_id' => $currentBranch->id,
                'is_guest' => $this->is_guest,
                'status' => $this->status,
                'currency' => $this->currency,
                'notes' => $this->notes,
                'total' => $this->grandTotal,
                'shipping' => $this->shippingCost,
                'install' => $this->installCost,
                'discount' => $this->totalDiscount,
                'paid' => (float) $this->paid_amount,
            ];

            if ($this->is_guest) {
                $orderData['guest_customer'] = [
                    'name' => $this->guest_name,
                    'phone' => $this->guest_phone,
                ];
            } else {
                $orderData['customer_id'] = $this->customer_id;
            }

            $order = Order::create($orderData);
            $inventoryService = new InventoryService();
            $shouldDeduct = !in_array($order->status->value, [OrderStatus::Proforma->value, OrderStatus::Cancelled->value]);

            foreach ($this->cart as $item) {
                $conditionEnum = ItemCondition::from($item['condition']);

                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'condition' => $conditionEnum,
                    'sub_discount' => $item['sub_discount'],
                    'sub_total' => $item['sub_total']
                ]);

                if ($shouldDeduct) {
                    $product = Product::find($item['product_id']);
                    if (!$inventoryService->isAvailableInBranch($product, $currentBranch, $item['qty'], $conditionEnum)) {
                        throw new Halt();
                    }

                    $inventoryService->deductStockForBranch(
                        $product,
                        $currentBranch,
                        $item['qty'],
                        $conditionEnum,
                        "POS Order #{$order->number}",
                        $currentUser,
                        $order->id
                    );
                }
            }

            if ($shouldDeduct) {
                $inventoryService->updateAllBranches();
            }

            if ($orderData['paid'] > 0) {
                $order->orderMetas()->create([
                    'key' => 'payments',
                    'group' => $this->payment_method ?? 'cash',
                    'value' => $orderData['paid']
                ]);
                $order->orderLogs()->create([
                    'log' => 'دفع مبلغ (POS) ' . number_format($orderData['paid'], 2) . ' ' . $order->currency . ' بواسطة: ' . $currentUser->name,
                    'type' => 'payment',
                ]);
            }

            $order->orderLogs()->create([
                'log' => "POS Invoice created By: " . $currentUser->name,
                'type' => 'created'
            ]);

            Notification::make()->title('تم تأكيد الطلب بنجاح!')->success()->send();

            // Reset all state manually
            $this->reset(['cart', 'barcode', 'shippingCost', 'installCost', 'guest_name', 'guest_phone', 'customer_id', 'notes']);
            $this->is_guest = true;
            $this->status = OrderStatus::New ->value;
            $this->payment_method = Payment::Cash->value ?? 'cash';
            $this->calculateTotals();

            $this->dispatch('print-receipt', orderId: $order->id);
        });
    }
}