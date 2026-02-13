<div class="fi-wi-stats-overview-card relative rounded-xl bg-white p-2 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
    <div class="p-4 border-b border-gray-100 dark:border-gray-800">
        <div class="flex items-center gap-x-3">
            <div class="p-2 bg-red-50 dark:bg-red-950/30 rounded-lg">
                <x-heroicon-m-exclamation-triangle class="h-5 w-5 text-red-600 dark:text-red-400" />
            </div>
            <div>
                <h3 class="text-base font-semibold leading-6 text-gray-950 dark:text-white">
                    تنبيهات المخزون المنخفض (إجمالي الكميات)
                </h3>
                <p class="text-xs text-gray-500 dark:text-gray-400">المنتجات التي تجاوزت حد الأمان المحدد لها</p>
            </div>
        </div>
    </div>

    @php $products = $this->getLowStockProducts(); @endphp

    @if(count($products) > 0)
        <div class="overflow-x-auto max-h-[400px] overflow-y-auto custom-scrollbar">
            <table class="w-full table-auto divide-y divide-gray-200 text-right dark:divide-white/5">
                <thead>
                    <tr class="bg-gray-50 dark:bg-white/5">
                        <th class="px-4 py-3 text-right text-xs font-bold text-gray-700 uppercase dark:text-gray-300">المنتج</th>
                        <th class="px-4 py-3 text-right text-xs font-bold text-gray-700 uppercase dark:text-gray-300">الفرع</th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-700 uppercase dark:text-gray-300">حد الأمان</th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-700 uppercase dark:text-gray-300">الكمية الحالية</th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-700 uppercase dark:text-gray-300">آخر تنبيه</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-white/5">
                    @foreach($products as $item)
                        @php 
                            $item = (object) $item; 
                            // تحديد حالة الاستعجال إذا كانت الكمية أقل من نصف حد الأمان
                            $isUrgent = $item->total_quantity <= ($item->security_stock / 2);
                        @endphp
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                            <td class="px-4 py-3">
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $item->product_name }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $item->branch_name }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="text-sm font-medium text-gray-500">
                                    {{ $item->security_stock }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex flex-col items-center gap-1">
                                    <span @class([
                                        'text-sm font-bold',
                                        'text-red-600 dark:text-red-400' => $isUrgent,
                                        'text-amber-600 dark:text-amber-400' => !$isUrgent,
                                    ])>
                                        {{ $item->total_quantity }}
                                    </span>
                                    <span @class([
                                        'text-[10px] px-1.5 py-0.5 rounded uppercase font-bold tracking-tighter',
                                        'bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-300' => $isUrgent,
                                        'bg-amber-100 text-amber-700 dark:bg-amber-900/50 dark:text-amber-300' => !$isUrgent,
                                    ])>
                                        {{ $isUrgent ? 'حرج جدًا' : 'منخفض' }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="text-xs text-gray-400">
                                    {{ $item->low_stock_notified_at ? \Carbon\Carbon::parse($item->low_stock_notified_at)->diffForHumans() : '---' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-12">
            <div class="rounded-full bg-green-50 dark:bg-green-950/30 p-3 mb-4">
                <x-heroicon-o-check-circle class="h-8 w-8 text-green-600 dark:text-green-400" />
            </div>
            <p class="text-sm font-medium text-gray-900 dark:text-white">المخزون ممتاز</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">جميع الكميات في الفروع فوق حد الأمان.</p>
        </div>
    @endif
</div>