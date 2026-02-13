<x-filament-panels::page>
    @php
        // جلب البيانات بناءً على إجمالي الكمية وحد الأمان
        $allLowStock = \Illuminate\Support\Facades\DB::table('branch_product')
            ->join('products', 'branch_product.product_id', '=', 'products.id')
            ->join('branches', 'branch_product.branch_id', '=', 'branches.id')
            ->select([
                'products.id',
                'products.name as product_name',
                'products.security_stock',
                'branches.name as branch_name',
                \Illuminate\Support\Facades\DB::raw('(branch_product.new_quantity + branch_product.used_quantity) as total_quantity')
            ])
            ->whereRaw('(branch_product.new_quantity + branch_product.used_quantity) < products.security_stock')
            ->whereRaw('(branch_product.new_quantity + branch_product.used_quantity) > 0')
            ->get();

        // إحصائية الحالة الحرجة: إذا كانت الكمية أقل من أو تساوي نصف حد الأمان
        $urgentCount = $allLowStock->filter(function($item) {
            return $item->total_quantity <= ($item->security_stock / 2);
        })->count();

        $totalAlerts = $allLowStock->count();
    @endphp
    
    <div class="text-gray-800">
        <main class="w-full max-w-7xl mx-auto p-4" id="report-content">
            <x-report-header label="تقرير المخزون المنخفض" />
            <div class="bg-white shadow-sm rounded-xl border border-gray-200 dark:bg-gray-900 dark:border-white/10">
                <div class="grid gap-4 md:grid-cols-2 p-6">
                    <div class="bg-red-50 p-4 rounded-lg border border-red-100 dark:bg-red-950/20 dark:border-red-900/50">
                        <p class="text-sm font-medium text-red-800 dark:text-red-300">حالات حرجة (أقل من نصف حد الأمان)</p>
                        <p class="text-3xl font-bold text-red-900 dark:text-white">{{ $urgentCount }}</p>
                    </div>
                    <div class="bg-amber-50 p-4 rounded-lg border border-amber-100 dark:bg-amber-950/20 dark:border-amber-900/50">
                        <p class="text-sm font-medium text-amber-800 dark:text-amber-300">إجمالي المنتجات المنخفضة</p>
                        <p class="text-3xl font-bold text-amber-900 dark:text-white">{{ $totalAlerts }}</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-right divide-y divide-gray-200 dark:divide-white/5">
                        <thead class="bg-gray-50 dark:bg-white/5">
                            <tr>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase dark:text-gray-400">المنتج</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase dark:text-gray-400">الفرع</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400">حد الأمان</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400">الكمية الحالية</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-white/5">
                            @foreach($allLowStock as $item)
                                @php $isUrgent = $item->total_quantity <= ($item->security_stock / 2); @endphp
                                <tr class="hover:bg-gray-50 dark:hover:bg-white/5">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">{{ $item->product_name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $item->branch_name }}</td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-400">{{ $item->security_stock }}</td>
                                    <td @class([
                                        'px-6 py-4 text-center text-sm font-bold',
                                        'text-red-600 dark:text-red-400' => $isUrgent,
                                        'text-amber-600 dark:text-amber-400' => !$isUrgent,
                                    ])>
                                        {{ $item->total_quantity }}
                                        <span class="text-[10px] block font-normal opacity-70">
                                            {{ $isUrgent ? '(حرج)' : '(منخفض)' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</x-filament-panels::page>