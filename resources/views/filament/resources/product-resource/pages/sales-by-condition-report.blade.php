<x-filament-panels::page>

    <div class="text-gray-800">

        <!-- Main Container -->
        <main class="w-full max-w-7xl mx-auto p-4 sm:p-6 md:p-8 m-4" id="report-content">

            <!-- Report Card -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">

                <!-- Header Section -->
                <header class="border-b border-gray-200 p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">تقرير المبيعات حسب حالة المنتجات</h1>
                            <p class="text-sm text-gray-500 mt-1">تحليل شامل للمبيعات والإيرادات حسب حالة المنتج</p>
                        </div>
                        <div class="text-sm text-gray-600 mt-4 sm:mt-0 text-left sm:text-right">
                            <p class="font-semibold">تاريخ التقرير:</p>
                            <p>{{ now()->format('Y-m-d') }}</p>
                        </div>
                    </div>
                </header>

                <!-- Table Container -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-right text-gray-600">
                        <!-- Table Head -->
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-semibold" rowspan="2">المنتج</th>
                                <th scope="col" class="px-6 py-4 font-semibold" rowspan="2">الفئة</th>
                                <th scope="col" class="px-4 py-2 font-semibold text-center border-l border-gray-300"
                                    colspan="3">
                                    المنتجات الجديدة
                                </th>
                                <th scope="col" class="px-4 py-2 font-semibold text-center border-l border-gray-300"
                                    colspan="3">
                                    المنتجات المستعملة
                                </th>
                                <th scope="col" class="px-4 py-2 font-semibold text-center bg-blue-50" colspan="3">
                                    الإجمالي</th>
                            </tr>
                            <tr class="bg-gray-100">
                                <!-- New Products -->
                                <th class="px-2 py-2 text-xs text-center">الكمية</th>
                                <th class="px-2 py-2 text-xs text-center">الإيراد</th>
                                <th class="px-2 py-2 text-xs text-center border-l border-gray-300">الطلبات</th>
                                <!-- Used Products -->
                                <th class="px-2 py-2 text-xs text-center">الكمية</th>
                                <th class="px-2 py-2 text-xs text-center">الإيراد</th>
                                <th class="px-2 py-2 text-xs text-center border-l border-gray-300">الطلبات</th>
                                <!-- Totals -->
                                <th class="px-2 py-2 text-xs text-center bg-blue-100">الكمية</th>
                                <th class="px-2 py-2 text-xs text-center bg-blue-100">الإيراد</th>
                                <th class="px-2 py-2 text-xs text-center bg-blue-100">الطلبات</th>
                            </tr>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                            @forelse ($sales as $sale)
                                @php
                                    $totalQty = $sale['new']['qty'] + $sale['used']['qty'];
                                    $totalRevenue = $sale['new']['revenue'] + $sale['used']['revenue'];
                                    $totalOrders = $sale['new']['orders'] + $sale['used']['orders'];
                                @endphp
                                <tr
                                    class="bg-white border-b border-gray-200 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $sale['product_name'] }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $sale['category'] ?? '-' }}
                                    </td>

                                    <!-- New Products Data -->
                                    <td class="px-2 py-4 text-center">
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ number_format($sale['new']['qty']) }}
                                        </span>
                                    </td>
                                    <td class="px-2 py-4 text-center text-green-700 font-semibold">
                                        {{ number_format($sale['new']['revenue'], 2) }}
                                    </td>
                                    <td class="px-2 py-4 text-center border-l border-gray-300">
                                        {{ number_format($sale['new']['orders']) }}
                                    </td>

                                    <!-- Used Products Data -->
                                    <td class="px-2 py-4 text-center">
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-orange-100 text-orange-800">
                                            {{ number_format($sale['used']['qty']) }}
                                        </span>
                                    </td>
                                    <td class="px-2 py-4 text-center text-green-700 font-semibold">
                                        {{ number_format($sale['used']['revenue'], 2) }}
                                    </td>
                                    <td class="px-2 py-4 text-center border-l border-gray-300">
                                        {{ number_format($sale['used']['orders']) }}
                                    </td>

                                    <!-- Totals -->
                                    <td class="px-2 py-4 text-center bg-blue-50 font-bold">
                                        {{ number_format($totalQty) }}
                                    </td>
                                    <td class="px-2 py-4 text-center bg-blue-50 text-green-800 font-bold">
                                        {{ number_format($totalRevenue, 2) }}
                                    </td>
                                    <td class="px-2 py-4 text-center bg-blue-50 font-bold">
                                        {{ number_format($totalOrders) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="px-6 py-8 text-center text-gray-500">
                                        لا توجد مبيعات
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                        <!-- Table Footer with Totals -->
                        <tfoot class="bg-gray-100 font-bold">
                            <tr>
                                <td class="px-6 py-4 text-base" colspan="2">الإجمالي الكلي</td>
                                @php
                                    $grandTotalNewQty = $sales->sum('new.qty');
                                    $grandTotalNewRevenue = $sales->sum('new.revenue');
                                    $grandTotalNewOrders = $sales->sum('new.orders');
                                    $grandTotalUsedQty = $sales->sum('used.qty');
                                    $grandTotalUsedRevenue = $sales->sum('used.revenue');
                                    $grandTotalUsedOrders = $sales->sum('used.orders');
                                @endphp
                                <td class="px-2 py-4 text-center bg-blue-100 text-blue-900">
                                    {{ number_format($grandTotalNewQty) }}
                                </td>
                                <td class="px-2 py-4 text-center bg-blue-100 text-green-800">
                                    {{ number_format($grandTotalNewRevenue, 2) }}
                                </td>
                                <td class="px-2 py-4 text-center bg-blue-100 border-l border-gray-400">
                                    {{ number_format($grandTotalNewOrders) }}
                                </td>
                                <td class="px-2 py-4 text-center bg-orange-100 text-orange-900">
                                    {{ number_format($grandTotalUsedQty) }}
                                </td>
                                <td class="px-2 py-4 text-center bg-orange-100 text-green-800">
                                    {{ number_format($grandTotalUsedRevenue, 2) }}
                                </td>
                                <td class="px-2 py-4 text-center bg-orange-100 border-l border-gray-400">
                                    {{ number_format($grandTotalUsedOrders) }}
                                </td>
                                <td class="px-2 py-4 text-center bg-gray-200 text-gray-900">
                                    {{ number_format($grandTotalNewQty + $grandTotalUsedQty) }}
                                </td>
                                <td class="px-2 py-4 text-center bg-gray-200 text-green-900">
                                    {{ number_format($grandTotalNewRevenue + $grandTotalUsedRevenue, 2) }}
                                </td>
                                <td class="px-2 py-4 text-center bg-gray-200 text-gray-900">
                                    {{ number_format($grandTotalNewOrders + $grandTotalUsedOrders) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>

        </main>

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
        }
    </style>

</x-filament-panels::page>