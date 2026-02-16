<x-filament-panels::page>
    {{-- قسم الفلترة - مدمج وأقل حجماً --}}
    <x-filament::section class="mb-4 shadow-sm no-print border-gray-200">
        <div class="flex flex-col gap-3 md:flex-row md:items-end">
            <div class="flex-1">
                {{ $this->form }}
            </div>
            <x-filament::button wire:click="$refresh" color="gray" variant="outline" icon="heroicon-m-arrow-path" class="text-xs">
                تحديث
            </x-filament::button>
            <x-filament::button color="success" icon="heroicon-o-printer" size="md"
                class="!rounded-full shadow-2xl hover:scale-105 active:scale-95 transition-all duration-300"
                onclick="window.print()" x-tooltip="{
                    content: 'طباعة التقرير (Ctrl+P)',
                    placement: 'bottom'
                }">
                طباعة
            </x-filament::button>            
        </div>
    </x-filament::section>

    <div class="text-black dark:text-white">
        <div id="report-content" class="print:m-0 print:p-0">
            <div class="w-full max-w-[100rem] mx-auto px-2">
                
                {{-- الهيدر - بسيط ورسمي --}}
                <x-report-header :label="'تقرير المبيعات والتحصيل'" />

                {{-- Statistics Widgets - التقسيم المطلوب --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6 print-stats-grid">
                    @php
                        $totalSales = $this->orders->sum('total');
                        $totalPaid = $this->orders->sum('paid');
                        $totalDebt = $totalSales - $totalPaid;
                        $ordersCount = $this->orders->count();
                        
                        $stats = [
                            ['label' => 'إجمالي المبيعات', 'value' => $totalSales, 'icon' => 'heroicon-o-shopping-bag'],
                            ['label' => 'إجمالي التحصيل', 'value' => $totalPaid, 'icon' => 'heroicon-o-banknotes'],
                            ['label' => 'إجمالي الديون', 'value' => $totalDebt, 'icon' => 'heroicon-o-clock'],
                            ['label' => 'عدد الفواتير', 'value' => $ordersCount, 'icon' => 'heroicon-o-document-text', 'is_num' => true],
                        ];
                    @endphp

                    @foreach($stats as $stat)
                        <div class="bg-white dark:bg-gray-900 p-4 rounded-xl border border-gray-300 dark:border-gray-700 flex items-center justify-between shadow-sm">
                            <div>
                                <p class="text-[10px] font-bold text-gray-500 uppercase">{{ $stat['label'] }}</p>
                                <p class="text-lg font-black tabular-nums mt-1 text-black dark:text-white">
                                    {{ isset($stat['is_num']) ? number_format($stat['value']) : number_format($stat['value'], 2) }}
                                </p>
                            </div>
                            <div class="p-2 bg-gray-100 dark:bg-gray-800 rounded-lg">
                                <x-dynamic-component :component="$stat['icon']" class="w-5 h-5 text-black dark:text-white" />
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- الجدول - مدمج واحترافي --}}
                <div class="bg-white dark:bg-gray-900 border border-black dark:border-gray-700 rounded-lg overflow-hidden shadow-sm my-5" style="margin-top: 10px;">
                    <div class="overflow-x-auto">
                        <table class="w-full text-[12px] text-right border-collapse">
                            <thead>
                                <tr class="bg-gray-900 text-black uppercase font-bold tracking-wider">
                                    <th class="px-4 py-3 border-l border-gray-800">رقم الفاتورة</th>
                                    <th class="px-4 py-3 border-l border-gray-800">التاريخ</th>
                                    <th class="px-4 py-3 border-l border-gray-800">العميل / الفرع</th>
                                    <th class="px-4 py-3 text-center border-l border-gray-800">الإجمالي</th>
                                    <th class="px-4 py-3 text-center border-l border-gray-800">المدفوع</th>
                                    <th class="px-4 py-3 text-center border-l border-gray-800">المتبقي</th>
                                    <th class="px-4 py-3 text-center">الحالة</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-800 text-gray-900 dark:text-gray-100">
                                @forelse ($this->orders as $order)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                        <td class="px-4 py-2 font-bold italic">#{{ $order->number }}</td>
                                        <td class="px-4 py-2 tabular-nums text-gray-500">{{ $order->created_at->format('Y/m/d') }}</td>
                                        <td class="px-4 py-2">
                                            <div class="font-bold">{{ $order->customer->name ?? "عميل نقدي"}}</div>
                                            <div class="text-[10px] text-gray-400">{{ $order->branch?->name ?? 'المركز' }}</div>
                                        </td>
                                        <td class="px-4 py-2 text-center font-bold tabular-nums">{{ number_format($order->total, 2) }}</td>
                                        <td class="px-4 py-2 text-center tabular-nums">{{ number_format($order->paid, 2) }}</td>
                                        <td class="px-4 py-2 text-center tabular-nums">
                                            @php $debt = $order->total - $order->paid @endphp
                                            <span class="{{ $debt > 0 ? 'bg-gray-100 px-1 rounded font-black' : 'text-gray-400' }}">
                                                {{ number_format($debt, 2) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 text-center">
                                            <span class="text-[9px] font-black border border-black px-2 py-0.5 rounded uppercase">
                                                {{ $order->status->getLabel()}}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7" class="py-10 text-center text-gray-400">لا توجد بيانات</td></tr>
                                @endforelse
                                <tr class="bg-gray-100 font-black text-sm uppercase dark:bg-white border-t-2 border-black text-black">
                                <!-- <tr class=""> -->
                                    <td class="px-4 py-4" colspan="3">الإجمالي الكلي </td>
                                    <td class="px-4 py-4 text-center tabular-nums">{{ number_format($totalSales, 2) }}</td>
                                    <td class="px-4 py-4 text-center tabular-nums">{{ number_format($totalPaid, 2) }}</td>
                                    <td class="px-4 py-4 text-center tabular-nums bg-black text-gray-700" colspan="2">
                                        {{ number_format($totalDebt, 2) }}
                                    </td>
                                <!-- </tr> -->
                    </tr>
                            </tbody>
                            {{-- الفوتر - تم إصلاح الألوان والحجم --}}
                            
                        </table>
                    </div>
                </div>

                {{-- التواقيع عند الطباعة --}}
                <div class="hidden print:grid grid-cols-3 gap-8 mt-12 text-center font-bold text-[10px]">
                    <div class="border-t border-black pt-2">توقيع المحاسب</div>
                    <div class="border-t border-black pt-2">ختم الشركة</div>
                    <div class="border-t border-black pt-2">المدير العام</div>
                </div>
                    </div>
        </div>
    </div>

    <style>
        @media print {
              body * {
                  visibility: hidden;
              }

              #report-content,
              #report-content * {
                  visibility: visible;
              }

              #report-content {
                  position: absolute;
                  left: 0;
                  top: 0;
                  width: 100%;
                  margin: 0;
                  padding: 0;
                  border: none;
                  box-shadow: none;
              }
              #report-content { width: 100% !important; margin: 0 !important; }

            .no-print { display: none !important; }
            table { border: 1px solid black !important; font-size: 9px !important; }
            th { background-color: black !important; color: white !important; -webkit-print-color-adjust: exact; }
            tfoot { background-color: #f3f4f6 !important; color: black !important; -webkit-print-color-adjust: exact; }
            .bg-black { background-color: black !important; color: white !important; -webkit-print-color-adjust: exact; }
       
            /* إجبار الـ Stats على الظهور في 4 أعمدة */
            .print-stats-grid {
                display: grid !important;
                grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
                gap: 10px !important;
            }

            /* تصغير الحشوات لتناسب المساحة الأفقية للورقة */
            .print-stats-grid > div {
                padding: 8px !important;
                border: 1px solid #000 !important; /* لضمان ظهور الحدود في الطباعة */
            }

            /* إخفاء الأيقونات في الطباعة لتوفير مساحة للنصوص */
            .print-stats-grid svg {
                display: none !important;
            }
          }
       
    </style>
</x-filament-panels::page>
