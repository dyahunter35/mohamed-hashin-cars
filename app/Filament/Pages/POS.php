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
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Facades\DB;

class POS extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.p-o-s';

    public function getMaxContentWidth(): ?string
    {
        return 'full';
    }
    // --- POS State ---
    public string $barcode = '';

    public array $cart = [];

    public float $shippingCost = 0.0;
    public float $installCost = 0.0;
    public float $totalDiscount = 0.0;
    public float $grandTotal = 0.0;
    public float $subTotal = 0.0;

    // Form Data
    public ?array $data = [];

    public function mount()
    {
        $this->form->fill([
            'is_guest' => true,
            'status' => OrderStatus::New ->value,
            'currency' => 'SDG',
            'payment_method' => Payment::Cash->value ?? 'cash',
            'paid_amount' => 0,
            'notes' => '',
        ]);
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

    // --- Form Configuration ---
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('order.sections.details.label') ?? 'Customer Information')
                    ->columns(4)
                    ->schema([
                        ToggleButtons::make('is_guest')
                            ->label(__('order.fields.is_guest.label') ?? 'Guest Customer')
                            ->live()
                            ->default(true)
                            ->inline()
                            ->grouped()
                            ->columnSpan(1)
                            ->boolean(),

                        Select::make('customer_id')
                            ->label(__('order.fields.customer.label') ?? 'Select Customer')
                            ->placeholder(__('order.fields.customer.placeholder') ?? 'Search...')
                            ->options(Customer::where('branch_id', Filament::getTenant()->id)->pluck('name', 'id'))
                            ->searchable()
                            ->columnSpan(3)
                            ->required(fn(Get $get) => !$get('is_guest'))
                            ->preload()
                            ->visible(fn(Get $get) => !$get('is_guest'))
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label(__('customer.fields.name.label') ?? 'Name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('email')
                                    ->label(__('customer.fields.email.label') ?? 'Email')
                                    ->email()
                                    ->maxLength(255)
                                    ->unique(Customer::class, 'email'),
                                TextInput::make('phone')
                                    ->label(__('customer.fields.phone.label') ?? 'Phone')
                                    ->maxLength(255),
                                Hidden::make('branch_id')
                                    ->default(Filament::getTenant()->id),
                            ]),

                        Section::make(__('order.sections.guest_customer.label') ?? 'Guest Details')
                            ->columnSpan(3)

                            ->schema([
                                TextInput::make('guest_customer.name')->label(__('order.fields.guest_customer.name.label') ?? 'Name'),
                                TextInput::make('guest_customer.phone')->label(__('order.fields.guest_customer.phone.label') ?? 'Phone')->tel(),
                                TextInput::make('guest_customer.email')->label(__('order.fields.guest_customer.email.label') ?? 'Email')->email(),
                            ])->columns(3)->visible(fn(Get $get) => $get('is_guest')),
                    ]),

                Section::make(__('order.sections.status_and_totals.label') ?? 'Details')
                    ->columns(4)
                    ->schema([
                        Select::make('status')
                            ->label(__('order.fields.status.label') ?? 'Status')
                            ->options(OrderStatus::class)
                            ->default(OrderStatus::New ->value)
                            ->columnSpan(1)
                            ->required(),

                        Select::make('currency')
                            ->label(__('order.fields.currency.label') ?? 'Currency')
                            ->searchable()
                            ->columnSpan(1)
                            ->default('SDG')
                            ->options(['SDG' => 'SDG', 'USD' => 'USD'])
                            ->required(),

                        ToggleButtons::make('payment_method')
                            ->inline()
                            ->columnSpan(2)
                            ->label(__('order.fields.payment_method.label') ?? 'Payment Method')
                            ->options(Payment::class)
                            ->default(Payment::Cash->value ?? 'cash')
                            ->required(),

                        TextInput::make('notes')
                            ->label(__('order.fields.notes.label') ?? 'Notes')
                            ->columnSpanFull()
                    ]),
                Action::make('submit')
                    ->label(__('order.actions.submit.label') ?? 'Submit')
                    ->columnSpan(1)
                    ->color('primary')

            ])
            ->statePath('data');
    }

    // --- POS Cart Actions ---

    public function addBarcodeItem()
    {
        $barcode = trim($this->barcode);
        $this->barcode = '';

        if (empty($barcode))
            return;

        // Try to find the product in current branch
        $currentBranchId = Filament::getTenant()->id;

        $product = Product::query()
            ->where('barcode', $barcode)
            // Ensure product is in this branch
            ->whereHas('branches', fn($q) => $q->where('branches.id', $currentBranchId))
            ->first();

        if (!$product) {
            Notification::make()->title('Product not found or not in this branch')->warning()->send();
            return;
        }

        // Add or Setup
        $condition = ItemCondition::New ->value; // Default condition

        $existingIndex = collect($this->cart)->search(function ($item) use ($product, $condition) {
            return $item['product_id'] == $product->id && $item['condition'] === $condition;
        });

        if ($existingIndex !== false) {
            $currentQty = $this->cart[$existingIndex]['qty'];

            // Check inventory before bumping qty
            $inventoryService = new InventoryService();
            if (!$inventoryService->isAvailableInBranch($product, Filament::getTenant(), $currentQty + 1, ItemCondition::from($condition))) {
                Notification::make()->title('Stock not available for ' . $product->name)->danger()->send();
                return;
            }

            $this->cart[$existingIndex]['qty'] += 1;
        } else {
            // Check inventory
            $inventoryService = new InventoryService();
            if (!$inventoryService->isAvailableInBranch($product, Filament::getTenant(), 1, ItemCondition::from($condition))) {
                Notification::make()->title('Stock not available for ' . $product->name)->danger()->send();
                return;
            }

            $this->cart[] = [
                'id' => uniqid(),
                'product_id' => $product->id,
                'product' => [
                    'name' => $product->name,
                    'price' => $product->price,
                ],
                'qty' => 1,
                'price' => $product->price,
                'condition' => $condition,
                'sub_discount' => 0,
                'sub_total' => $product->price,
            ];
        }

        Notification::make()->title('Added: ' . $product->name)->success()->send();
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
            Notification::make()->title('Insufficient stock for ' . $product->name)->danger()->send();
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
            Notification::make()->title('Insufficient stock for condition: ' . $conditionStr)->danger()->send();
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

        // Auto-fill paid amount with grand total dynamically
        $this->data['paid_amount'] = $this->grandTotal;
    }

    public function checkout()
    {
        if (empty($this->cart)) {
            Notification::make()->title('Cart is empty.')->warning()->send();
            return;
        }

        $formData = $this->form->getState();
        $currentBranch = Filament::getTenant();
        $currentUser = auth()->user();

        // 1. Validate Form Data
        $isGuest = $formData['is_guest'] ?? true;

        DB::transaction(function () use ($formData, $currentBranch, $currentUser, $isGuest) {

            // 2. Setup Order Data
            $orderData = [
                'number' => Order::generateInvoiceNumber(),
                'caused_by' => $currentUser->id,
                'branch_id' => $currentBranch->id,
                'is_guest' => $isGuest,
                'status' => $formData['status'] ?? OrderStatus::New ->value,
                'currency' => $formData['currency'] ?? 'SDG',
                'notes' => $formData['notes'] ?? '',

                'total' => $this->grandTotal,
                'shipping' => $this->shippingCost,
                'install' => $this->installCost,
                'discount' => $this->totalDiscount,

                // Track payment initially
                'paid' => (float) ($formData['paid_amount'] ?? $this->grandTotal),
            ];

            if ($isGuest) {
                $orderData['guest_customer'] = $formData['guest_customer'] ?? [];
            } else {
                $orderData['customer_id'] = $formData['customer_id'];
            }

            // 3. Create Order
            $order = Order::create($orderData);

            // 4. Create OrderItems & Deduct Stock
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

            // 5. Create Payment Meta if paid amount > 0
            if ($orderData['paid'] > 0) {
                $order->orderMetas()->create([
                    'key' => 'payments',
                    'group' => $formData['payment_method'] ?? 'cash',
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

            Notification::make()->title('Order Completed successfully!')->success()->send();

            // Reset state
            $this->cart = [];
            $this->barcode = '';
            $this->shippingCost = 0;
            $this->installCost = 0;
            $this->calculateTotals();
            $this->form->fill([
                'is_guest' => true,
                'status' => OrderStatus::New ->value,
                'currency' => 'SDG',
                'payment_method' => Payment::Cash->value ?? 'cash',
                'paid_amount' => 0,
                'notes' => '',
            ]);

            $this->dispatch('print-receipt', orderId: $order->id);
        });
    }
}
