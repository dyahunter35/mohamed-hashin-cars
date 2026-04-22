<x-filament-panels::page class="p-0 max-w-full">
    <style>
        /* إخفاء الواجهة الافتراضية */
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
            background-color: #f1f5f9;
        }

        .dark body {
            background-color: #020617;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .search-result-item:hover .search-result-code {
            color: var(--color-primary-600, #4f46e5);
        }

        /* إظهار زر الطباعة في الجدول */
        .fi-ta-action[data-action-name="print"],
        [wire\:click*="mountTableAction('print'"] {
            background-color: #16a34a !important;
            color: white !important;
            border-color: #16a34a !important;
            border-radius: 0.5rem !important;
            padding: 0.35rem 0.9rem !important;
            font-weight: 700 !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.3rem !important;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #print-area,
            #print-area * {
                visibility: visible;
            }

            #print-area {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
            }
        }
    </style>

    <div x-data="{ activeTab: 'pos' ,confirmCheckout: false}"
        class="flex h-screen w-screen bg-gray-50 dark:bg-gray-950 overflow-hidden font-sans dir-rtl text-sm">

        <aside
            class="w-20 bg-white dark:bg-gray-900 border-l border-gray-200 dark:border-gray-800 flex flex-col items-center py-6 shadow-xl z-30 shrink-0">
            <div class="w-12 h-12 bg-primary-600 text-white rounded-2xl flex items-center justify-center font-black text-xl shadow-lg mb-8 cursor-pointer hover:scale-105 transition-transform"
                onclick="window.location.reload()">S</div>
            <nav class="flex-1 w-full flex flex-col gap-6 px-2">
                <button @click="activeTab = 'pos'"
                    :class="activeTab === 'pos' ? 'text-primary-600 bg-primary-50 dark:bg-primary-900/20' : 'text-gray-400'"
                    class="w-full py-3 rounded-xl flex flex-col items-center gap-1 transition-all relative">
                    <x-heroicon-s-squares-2x2 class="w-6 h-6" />
                    <span class="text-[9px] font-bold">الرئيسية</span>
                    <div x-show="activeTab === 'pos'" class="absolute left-0 w-1 h-6 bg-primary-600 rounded-r-full">
                    </div>
                </button>
                <button @click="activeTab = 'orders'"
                    :class="activeTab === 'orders' ? 'text-primary-600 bg-primary-50 dark:bg-primary-900/20' : 'text-gray-400'"
                    class="w-full py-3 rounded-xl flex flex-col items-center gap-1 transition-all relative">
                    <x-heroicon-s-clipboard-document-list class="w-6 h-6" />
                    <span class="text-[9px] font-bold">الطلبات</span>
                    <div x-show="activeTab === 'orders'" class="absolute left-0 w-1 h-6 bg-primary-600 rounded-r-full">
                    </div>
                </button>
            </nav>
            <a href="{{ \App\Filament\Pages\Dashboard\MainDashboard::getUrl() }}"
                class="w-10 h-10 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-500 flex items-center justify-center hover:text-danger-600 transition-all"><x-heroicon-o-arrow-right-on-rectangle
                    class="w-5 h-5" /></a>
        </aside>

        <main class="flex-1 flex overflow-hidden">

            <div x-show="activeTab === 'pos'"
                class="flex-1 flex flex-col p-6 overflow-hidden bg-slate-50 dark:bg-gray-950 border-l border-gray-200 dark:border-gray-800">
                <div class="relative z-50 mb-6" x-data="{ open: false }" @click.away="open = false">
                    <div
                        class="flex items-center bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 p-1.5 focus-within:ring-2 focus-within:ring-primary-500/30 transition-all">
                        <div class="bg-primary-50 dark:bg-primary-900/20 p-3 rounded-xl text-primary-500">
                            <x-heroicon-o-magnifying-glass class="w-5 h-5" />
                        </div>
                        <input type="text" wire:model.live.debounce.300ms="barcode"
                            wire:keydown.enter.prevent="addBarcodeItem" @input="open = true" autofocus
                            class="flex-grow text-base bg-transparent border-none focus:ring-0 text-gray-800 dark:text-gray-100 px-4 placeholder-gray-400"
                            placeholder="ابحث بالاسم أو الكود..." />
                        <div wire:loading wire:target="barcode" class="ml-2 mr-2">
                            <svg class="animate-spin h-4 w-4 text-primary-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                        </div>
                        @if(!empty($barcode))
                            <button type="button" wire:click.prevent="$set('barcode', ''); $set('searchResults', [])"
                                @click="open = false"
                                class="ml-1 mr-1 p-2 rounded-xl text-gray-400 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">
                                <x-heroicon-o-x-mark class="w-4 h-4" />
                            </button>
                        @endif
                    </div>
                    @if(!empty($searchResults))
                        <div x-show="open"
                            class="absolute top-full left-0 right-0 mt-2 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-700 rounded-2xl shadow-2xl z-[60] overflow-hidden">
                            <div class="p-2 max-h-80 overflow-y-auto custom-scrollbar space-y-1">
                                @foreach($searchResults as $product)
                                    <button type="button" wire:click="selectProduct('{{ $product['barcode'] }}')"
                                        @click="open = false"
                                        class="search-result-item w-full flex items-center justify-between p-3 hover:bg-primary-50 dark:hover:bg-primary-900/20 rounded-xl transition-all text-right group">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-9 h-9 bg-primary-100 dark:bg-primary-900/30 text-primary-600 rounded-xl flex items-center justify-center font-black text-sm shrink-0">
                                                {{ mb_substr($product['name'], 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-900 dark:text-white text-sm">
                                                    {{ $product['name'] }}</div>
                                                <div
                                                    class="search-result-code text-[10px] text-gray-400 font-mono transition-colors">
                                                    {{ $product['barcode'] }}</div>
                                            </div>
                                        </div>
                                        <div class="text-right shrink-0">
                                            <div class="font-black text-primary-600 text-sm">
                                                {{ number_format($product['price'], 2) }}</div>
                                            <div class="text-[9px] text-gray-400">SDG</div>
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="flex-1 overflow-y-auto custom-scrollbar space-y-3 pr-1">
                    @forelse($cart as $index => $item)
                        <div class="bg-white dark:bg-gray-900 rounded-2xl p-4 flex items-center gap-4 shadow-sm border border-gray-100 dark:border-gray-800 group"
                            wire:key="cart-{{ $item['id'] }}">
                            <div class="w-12 h-12 rounded-xl bg-gray-50 dark:bg-gray-800 flex items-center justify-center">
                                <x-heroicon-o-cube class="w-6 h-6 opacity-30" />
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-gray-900 dark:text-white text-sm truncate">
                                    {{ $item['product']['name'] }}
                                </h3>
                            </div>
                            <div
                                class="flex items-center bg-gray-100 dark:bg-gray-800 rounded-xl p-1 border border-gray-200 dark:border-gray-700">
                                <button wire:click="decrementQty({{ $index }})"
                                    class="w-7 h-7 flex items-center justify-center rounded-lg bg-white dark:bg-gray-700 shadow-sm">-</button>
                                <input type="number" value="{{ $item['qty'] }}"
                                    wire:change="updateCartItemQty({{ $index }}, $event.target.value)"
                                    class="w-8 text-center bg-transparent border-none font-black text-xs p-0 focus:ring-0" />
                                <button wire:click="incrementQty({{ $index }})"
                                    class="w-7 h-7 flex items-center justify-center rounded-lg bg-white dark:bg-gray-700 shadow-sm">+</button>
                            </div>
                            <div class="w-24 text-left border-r dark:border-gray-800 pr-4">
                                <div class="font-black text-gray-900 dark:text-white text-md">
                                    {{ number_format($item['sub_total'], 2) }}
                                </div>
                            </div>
                            <button wire:click="removeCartItem({{ $index }})"
                                class="p-2 text-gray-300 hover:text-danger-500 transition-all"><x-heroicon-m-trash
                                    class="w-5 h-5" /></button>
                        </div>
                    @empty
                        <div class="h-full flex flex-col items-center justify-center text-gray-300 opacity-40">
                            <x-heroicon-o-shopping-bag class="w-20 h-20 mb-4" />
                            <p class="text-lg font-bold">السلة فارغة</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div x-show="activeTab === 'pos'"
                class="w-[450px] h-screen bg-white dark:bg-gray-900 shadow-2xl flex flex-col z-20 shrink-0 border-r border-gray-100 dark:border-gray-800">

                <div
                    class="p-5 border-b dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-gray-800/20 shrink-0">
                    <h2 class="text-xl font-black text-gray-900 dark:text-white">تفاصيل الفاتورة</h2>
                    <span
                        class="bg-primary-600 text-white px-3 py-1 rounded-full text-[10px] font-bold">{{ count($cart) }}
                        أصناف</span>
                </div>

                <div class="flex-1 overflow-y-auto custom-scrollbar p-5 space-y-6 pb-[180px]">
                    <div class="bg-gray-100 dark:bg-gray-800 p-1.5 rounded-2xl flex gap-1 shadow-inner">
                        <button type="button" wire:click="$set('is_guest', true)"
                            :class="$wire.is_guest ? 'bg-white dark:bg-gray-700 shadow-sm text-primary-600' : 'text-gray-500'"
                            class="flex-1 py-3 rounded-xl text-xs font-bold transition-all">عميل نقدي</button>
                        <button type="button" wire:click="$set('is_guest', false)"
                            :class="!$wire.is_guest ? 'bg-white dark:bg-gray-700 shadow-sm text-primary-600' : 'text-gray-500'"
                            class="flex-1 py-3 rounded-xl text-xs font-bold transition-all">عميل دائم</button>
                    </div>

                    <div x-show="!$wire.is_guest" x-collapse>
                        <label class="block text-[10px] font-black text-gray-400 mb-2">اختر العميل</label>
                        <select wire:model="customer_id"
                            class="w-full rounded-2xl border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-950 focus:ring-primary-500 text-sm font-bold">
                            <option value="">-- ابحث عن عميل --</option>
                            @foreach($customersList as $id => $name) <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 mb-3 uppercase tracking-wider">طريقة
                            السداد</label>
                        <div class="grid grid-cols-1 gap-2">
                            @foreach(\App\Enums\Payment::cases() as $case)
                                <button type="button" wire:click="$set('payment_method', '{{ $case->value }}')"
                                    class="py-3 px-4 rounded-xl text-sm font-bold border-2 transition-all text-right flex justify-between items-center"
                                    :class="$wire.payment_method === '{{ $case->value }}' ? 'border-primary-600 bg-primary-50 text-primary-700 dark:bg-primary-900/20' : 'border-gray-50 dark:border-gray-800 bg-gray-50 dark:bg-gray-900 text-gray-500'">
                                    {{ $case->getLabel() }}
                                    <div x-show="$wire.payment_method === '{{ $case->value }}'"
                                        class="w-3 h-3 rounded-full bg-primary-600 shadow-sm"></div>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 mb-2">الحالة</label>
                            <select wire:model="status"
                                class="w-full rounded-xl border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-950 text-xs font-bold">
                                @foreach(\App\Enums\OrderStatus::cases() as $case) <option value="{{ $case->value }}">
                                {{ $case->getLabel() }}</option> @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 mb-2">العملة</label>
                            <select wire:model="currency"
                                class="w-full rounded-xl border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-950 text-xs font-bold">
                                <option value="SDG">SDG</option>
                                <option value="USD">USD</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 mb-2">ملاحظات إضافية</label>
                        <textarea wire:model="notes" rows="2"
                            class="w-full rounded-xl border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-950 text-xs font-bold focus:ring-primary-500"
                            placeholder="أدخل أي ملاحظات..."></textarea>
                    </div>
                </div>

                <div
                    class="absolute bottom-0 left-0 w-full p-6 bg-white/95 backdrop-blur-md dark:bg-gray-900/95 border-t border-gray-100 dark:border-gray-800 space-y-4 z-50 shadow-[0_-15px_30px_rgba(0,0,0,0.06)]">
                    <div class="flex justify-between items-end">
                        <div>
                            <span class="block text-[10px] font-black text-gray-400 uppercase tracking-tighter">المبلغ
                                المطلوب</span>
                            <div class="flex items-baseline gap-1">
                                <span class="text-4xl font-black text-gray-900 dark:text-white tabular-nums">
                                    {{ number_format($grandTotal, 2) }}
                                </span>
                                <span class="text-xs font-bold text-primary-600 uppercase tracking-widest">SDG</span>
                            </div>
                        </div>
                    </div>

                    <x-filament::button type="button" color="primary" size="xl" icon="heroicon-o-check"
                        label="تأكيد الفاتورة" :disabled="empty($cart)" x-on:click="confirmCheckout = true"
                        class="group !rounded-2xl transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-xl hover:shadow-primary-500/40 active:scale-[0.97]">

                        تأكيد الفاتورة
                    </x-filament::button>
                </div>

                <div x-show="confirmCheckout" style="display: none;"
                    class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm"
                    x-transition.opacity x-effect="if('{{ empty($cart) }}' == '1') confirmCheckout = false">
                    <div @click.away="confirmCheckout = false"
                        class="bg-white dark:bg-gray-900 p-6 rounded-3xl shadow-2xl w-[400px] max-w-[90%] border border-gray-100 dark:border-gray-800"
                        x-transition.scale.origin.bottom>

                        <div class="flex items-start gap-4 mb-6">
                            <div
                                class="w-12 h-12 rounded-2xl bg-warning-50 dark:bg-warning-900/30 text-warning-500 flex items-center justify-center shrink-0">
                                <x-heroicon-o-exclamation-triangle class="w-6 h-6" />
                            </div>
                            <div>
                                <h3 class="text-lg font-black text-gray-900 dark:text-white mt-1">تأكيد العملية</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 leading-relaxed">هل أنت متأكد من
                                    حفظ الفاتورة وطباعتها؟ سيتم خصم الكميات من المخزون فوراً.</p>
                            </div>
                        </div>

                        <div class="flex gap-3 mt-8">
                            <button wire:click="checkout"
                                class="flex-1 bg-primary-600 hover:bg-primary-700 text-white py-3.5 rounded-xl font-bold transition-all flex justify-center items-center gap-2 shadow-lg shadow-primary-500/30">
                                <x-heroicon-o-check-circle class="w-5 h-5" wire:loading.remove wire:target="checkout" />
                                <x-heroicon-o-arrow-path class="w-5 h-5 animate-spin" wire:loading
                                    wire:target="checkout" />
                                <span>تأكيد وطباعة</span>
                            </button>
                            <button @click="confirmCheckout = false"
                                class="flex-1 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 py-3.5 rounded-xl font-bold hover:bg-gray-200 dark:hover:bg-gray-700 transition-all">
                                تراجع
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div x-show="activeTab === 'orders'"
                class="flex-1 bg-gray-50 dark:bg-gray-950 p-8 overflow-y-auto custom-scrollbar">
                <div class="max-w-6xl mx-auto">
                    <div class="flex items-center justify-between mb-8">
                        <h1 class="text-3xl font-black text-gray-900 dark:text-white">سجل العمليات</h1>
                        <button @click="activeTab = 'pos'"
                            class="bg-white dark:bg-gray-900 px-6 py-2 rounded-xl shadow-sm border dark:border-gray-800 font-bold">عودة
                            للبيع</button>
                    </div>
                    <div class="bg-white dark:bg-gray-900 rounded-[2rem] shadow-sm border dark:border-gray-800 p-4">
                        {{ $this->table }}
                    </div>
                </div>
            </div>

        </main>
    </div>
</x-filament-panels::page>