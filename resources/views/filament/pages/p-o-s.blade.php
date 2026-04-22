<x-filament-panels::page class="p-0 max-w-full">
    <style>
        .fi-main-ctn {
            padding: 0 !important;
            margin: 0 !important;
            max-width: 100% !important;
        }

        .fi-main {
            padding: 0 !important;
        }

        .fi-topbar,
        .fi-sidebar {
            display: none !important;
        }

        html,
        body {
            height: 100vh;
            overflow: hidden;
            background-color: #f3f4f6;
        }

        /* تجميل شريط التمرير */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #475569;
        }
    </style>

    <div class="flex flex-col xl:flex-row h-screen w-screen bg-gray-50 dark:bg-gray-950 overflow-hidden font-sans">

        <div class="w-full xl:w-8/12 h-full flex flex-col p-6 overflow-hidden">

            <div class="relative z-50 mb-6" x-data="{ open: false }" @click.away="open = false">
                <div
                    class="flex items-center bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 px-4 py-2 focus-within:ring-2 focus-within:ring-primary-500 transition-all">
                    <x-heroicon-o-magnifying-glass class="w-6 h-6 text-gray-400 ml-3" />
                    <input type="text" wire:model.live.debounce.300ms="barcode"
                        wire:keydown.enter.prevent="addBarcodeItem" @input="open = true" autofocus
                        class="flex-grow text-lg font-medium bg-transparent border-none focus:ring-0 text-gray-800 dark:text-gray-100 placeholder-gray-400 py-3"
                        placeholder="امسح الباركود أو ابحث عن منتج..." />
                    <x-heroicon-o-qr-code class="w-8 h-8 text-primary-500" />
                </div>

                @if(!empty($barcode) && !empty($searchResults))
                    <div x-show="open" x-transition
                        class="absolute top-full left-0 right-0 mt-2 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-xl z-50 max-h-96 overflow-y-auto">
                        <div class="p-2 divide-y divide-gray-100 dark:divide-gray-800">
                            @foreach($searchResults as $product)
                                <button type="button" wire:click="selectProduct('{{ $product->barcode }}')"
                                    @click="open = false"
                                    class="w-full flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-xl transition-all text-right">
                                    <div>
                                        <div class="font-bold text-gray-900 dark:text-white">{{ $product->name }}</div>
                                        <div class="text-xs text-gray-500 font-mono mt-1">{{ $product->barcode }} | متوفر:
                                            {{ $product->qty }}
                                        </div>
                                    </div>
                                    <div class="font-black text-primary-600 dark:text-primary-400 text-lg">
                                        {{ number_format($product->price, 2) }} <span class="text-xs">SDG</span>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="flex items-center justify-between mb-4 px-2">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">سلة المشتريات</h2>
                <span
                    class="bg-primary-100 text-primary-700 dark:bg-primary-900 dark:text-primary-300 text-sm font-bold px-3 py-1 rounded-full">
                    {{ count($cart) }} عناصر
                </span>
            </div>

            <div class="flex-1 overflow-y-auto pr-2 pb-20 space-y-3">
                @forelse($cart as $index => $item)
                    <div class="bg-white dark:bg-gray-900 rounded-2xl p-4 flex items-center justify-between shadow-sm border border-gray-100 dark:border-gray-800 hover:shadow-md transition-shadow"
                        wire:key="cart-item-{{ $item['id'] }}">

                        <div class="flex items-start gap-4 flex-1">
                            <div
                                class="w-10 h-10 rounded-full bg-gray-50 dark:bg-gray-800 flex items-center justify-center text-gray-400 font-bold shrink-0">
                                {{ $loop->iteration }}
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 dark:text-white text-lg leading-tight">
                                    {{ $item['product']['name'] }}
                                </h3>
                                <div class="flex items-center gap-3 mt-2">
                                    <span class="text-xs text-gray-400 font-mono">{{ $item['barcode'] ?? 'N/A' }}</span>
                                    <select wire:change="updateCartItemCondition({{ $index }}, $event.target.value)"
                                        class="text-xs py-1 px-6 border-none bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 rounded-lg cursor-pointer focus:ring-0">
                                        <option value="new" @selected($item['condition'] === 'new')>جديد</option>
                                        <option value="used" @selected($item['condition'] === 'used')>مستخدم</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div
                            class="flex items-center bg-gray-50 dark:bg-gray-800 rounded-xl p-1 mx-6 border border-gray-100 dark:border-gray-700 shrink-0">
                            <button wire:click="incrementQty({{ $index }})"
                                class="w-8 h-8 rounded-lg bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 shadow-sm hover:text-primary-600 transition-colors">+</button>
                            <input type="number" value="{{ $item['qty'] }}"
                                wire:change="updateCartItemQty({{ $index }}, $event.target.value)"
                                class="w-12 text-center bg-transparent border-none font-bold text-gray-900 dark:text-white focus:ring-0 p-0" />
                            <button wire:click="decrementQty({{ $index }})"
                                class="w-8 h-8 rounded-lg bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 shadow-sm hover:text-danger-600 transition-colors">-</button>
                        </div>

                        <div class="flex flex-col items-end w-32 shrink-0">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-[10px] text-gray-400">خصم:</span>
                                <input type="number" value="{{ $item['sub_discount'] }}"
                                    wire:change="updateCartItemDiscount({{ $index }}, $event.target.value)"
                                    class="w-16 h-6 text-left py-0 px-1 border border-gray-200 dark:border-gray-700 rounded text-xs font-bold text-warning-600 bg-white dark:bg-gray-900 focus:ring-1 focus:ring-warning-500" />
                            </div>
                            <span
                                class="font-black text-gray-900 dark:text-white text-xl">{{ number_format($item['sub_total'], 2) }}</span>
                        </div>

                        <button wire:click="removeCartItem({{ $index }})"
                            class="mr-4 p-2 text-gray-300 hover:text-danger-500 hover:bg-danger-50 dark:hover:bg-danger-900/20 rounded-lg transition-all">
                            <x-heroicon-m-trash class="w-6 h-6" />
                        </button>
                    </div>
                @empty
                    <div class="h-full flex flex-col items-center justify-center opacity-40">
                        <x-heroicon-o-shopping-bag class="w-32 h-32 mb-6 text-gray-400" />
                        <p class="text-3xl font-bold text-gray-500">السلة فارغة</p>
                        <p class="text-gray-400 mt-2">قم بمسح الباركود لإضافة منتجات</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div
            class="w-full xl:w-4/12 h-full bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 shadow-2xl flex flex-col relative z-10">

            <div class="flex-1 overflow-y-auto p-6">
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-6 flex items-center gap-2">
                    <x-heroicon-o-user class="w-6 h-6 text-primary-500" />
                    بيانات العميل
                </h2>
                {{ $this->form }}
            </div>

            <div class="p-6 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-800">

                <div class="space-y-3 mb-6 text-sm font-medium">
                    <div class="flex justify-between text-gray-500 dark:text-gray-400">
                        <span>المجموع الفرعي (Subtotal)</span>
                        <span class="text-gray-900 dark:text-white">{{ number_format($subTotal, 2) }} SDG</span>
                    </div>
                    @if($shippingCost > 0)
                        <div class="flex justify-between text-gray-500 dark:text-gray-400">
                            <span>تكلفة التوصيل (Shipping)</span>
                            <span class="text-gray-900 dark:text-white">{{ number_format($shippingCost, 2) }} SDG</span>
                        </div>
                    @endif
                    @if($installCost > 0)
                        <div class="flex justify-between text-gray-500 dark:text-gray-400">
                            <span>تكلفة التركيب (Install)</span>
                            <span class="text-gray-900 dark:text-white">{{ number_format($installCost, 2) }} SDG</span>
                        </div>
                    @endif
                    @if($totalDiscount > 0)
                        <div class="flex justify-between text-warning-600 dark:text-warning-500">
                            <span>إجمالي الخصم (Discount)</span>
                            <span>- {{ number_format($totalDiscount, 2) }} SDG</span>
                        </div>
                    @endif
                </div>

                <button wire:click="checkout" wire:loading.attr="disabled" @if(empty($cart)) disabled @endif
                    class="w-full bg-primary-600 hover:bg-primary-500 dark:bg-primary-600 dark:hover:bg-primary-500 text-white rounded-2xl py-6 px-6 flex items-center justify-between shadow-xl transition-all transform active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">

                    <div class="flex items-center gap-3">
                        <x-heroicon-o-check-circle class="w-8 h-8" wire:loading.remove wire:target="checkout" />
                        <x-heroicon-o-arrow-path class="w-8 h-8 animate-spin" wire:loading wire:target="checkout" />
                        <span class="text-2xl font-bold">تأكيد الطلب</span>
                    </div>

                    <div class="text-right">
                        <div class="text-3xl font-black tabular-nums tracking-tight">{{ number_format($grandTotal, 2) }}
                        </div>
                        <div class="text-sm opacity-70 font-bold">SDG</div>
                    </div>
                </button>
            </div>

        </div>

    </div>
</x-filament-panels::page>