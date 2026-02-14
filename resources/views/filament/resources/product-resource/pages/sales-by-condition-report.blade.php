<x-filament-panels::page>
    {{-- قسم الفلترة - يختفي عند الطباعة --}}
    <x-filament::section class="mb-4 shadow-sm no-print border-slate-200">
        <div class="flex flex-col gap-4 md:flex-row md:items-end">
            <div class="flex-1">
                {{ $this->form }}
            </div>
            <x-filament::button wire:click="$refresh" color="gray" icon="heroicon-m-arrow-path">
                تحديث البيانات
            </x-filament::button>
        </div>
    </x-filament::section>

    <div class="text-gray-800">
        <main class="w-full max-w-7xl mx-auto p-4 sm:p-6 md:p-8 m-4" id="report-content">
            
            <x-report-header :label="'تقرير المبيعات حسب حالة المنتجات'" />

            <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-right text-gray-600">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-bold text-base" rowspan="2">المنتج</th>
                                <th scope="col" class="px-6 py-4 font-semibold" rowspan="2">الفئة</th>
                                <th scope="col" class="px-4 py-2 font-semibold text-center border-l border-gray-300 bg-blue-50/50" colspan="3">
                                    المنتجات الجديدة
                                </th>
                                <th scope="col" class="px-4 py-2 font-semibold text-center border-l border-gray-300 bg-orange-50/50" colspan="3">
                                    المنتجات المستعملة
                                </th>
                                <th scope="col" class="px-4 py-2 font-semibold text-center bg-gray-100" colspan="3">
                                    الإجمالي الكلي
                                </th>
                            </tr>
                            <tr class="bg-gray-100/50">
                                <th class="px-2 py-2 text-center border-r border-gray-200">الكمية</th>
                                <th class="px-2 py-2 text-center">الإيراد</th>
                                <th class="px-2 py-2 text-center border-l border-gray-300">الطلبات</th>
                                <th class="px-2 py-2 text-center">الكمية</th>
                                <th class="px-2 py-2 text-center">الإيراد</th>
                                <th class="px-2 py-2 text-center border-l border-gray-300">الطلبات</th>
                                <th class="px-2 py-2 text-center bg-gray-200/50">الكمية</th>
                                <th class="px-2 py-2 text-center bg-gray-200/50">الإيراد</th>
                                <th class="px-2 py-2 text-center bg-gray-200/50">الطلبات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($this->sales as $sale)
                                @php
                                    $rowTotalQty = $sale['new']['qty'] + $sale['used']['qty'];
                                    $rowTotalRevenue = $sale['new']['revenue'] + $sale['used']['revenue'];
                                    $rowTotalOrders = $sale['new']['orders'] + $sale['used']['orders'];
                                @endphp
                                <tr class="bg-white border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        <div class="flex flex-col">
                                            <span class="font-bold">{{ $sale['product_name'] }}</span>
                                            <span class="text-xs text-gray-400">{{ $sale['brand_name'] }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 italic">
                                        {{ $sale['category'] }}
                                    </td>

                                    <td class="px-2 py-4 text-center border-r border-gray-100">
                                        <span class="px-2 py-1 rounded bg-blue-100 text-blue-800 font-medium">
                                            {{ number_format($sale['new']['qty']) }}
                                        </span>
                                    </td>
                                    <td class="px-2 py-4 text-center font-semibold text-green-700">
                                        {{ number_format($sale['new']['revenue'], 2) }}
                                    </td>
                                    <td class="px-2 py-4 text-center border-l border-gray-200 text-gray-500">
                                        {{ number_format($sale['new']['orders']) }}
                                    </td>

                                    <td class="px-2 py-4 text-center">
                                        <span class="px-2 py-1 rounded bg-orange-100 text-orange-800 font-medium">
                                            {{ number_format($sale['used']['qty']) }}
                                        </span>
                                    </td>
                                    <td class="px-2 py-4 text-center font-semibold text-green-700">
                                        {{ number_format($sale['used']['revenue'], 2) }}
                                    </td>
                                    <td class="px-2 py-4 text-center border-l border-gray-200 text-gray-500">
                                        {{ number_format($sale['used']['orders']) }}
                                    </td>

                                    <td class="px-2 py-4 text-center bg-gray-50 font-bold text-gray-900">
                                        {{ number_format($rowTotalQty) }}
                                    </td>
                                    <td class="px-2 py-4 text-center bg-gray-50 font-bold text-green-800">
                                        {{ number_format($rowTotalRevenue, 2) }}
                                    </td>
                                    <td class="px-2 py-4 text-center bg-gray-50 font-bold text-gray-700">
                                        {{ number_format($rowTotalOrders) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-400">
                                            <x-heroicon-o-inbox class="w-12 h-12 mb-2" />
                                            <p>لا توجد بيانات مبيعات للفترة المختارة</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                        @if($this->sales->isNotEmpty())
                        <tfoot class="bg-gray-800 text-white font-bold">
                            <tr>
                                <td class="px-6 py-4 text-base" colspan="2">الإجمالي العام للتقرير</td>
                                @php
                                    $gNewQty = $this->sales->sum('new.qty');
                                    $gNewRev = $this->sales->sum('new.revenue');
                                    $gNewOrd = $this->sales->sum('new.orders');
                                    
                                    $gUsedQty = $this->sales->sum('used.qty');
                                    $gUsedRev = $this->sales->sum('used.revenue');
                                    $gUsedOrd = $this->sales->sum('used.orders');
                                @endphp
                                {{-- New Totals --}}
                                <td class="px-2 py-4 text-center bg-blue-900/50">{{ number_format($gNewQty) }}</td>
                                <td class="px-2 py-4 text-center bg-blue-900/50">{{ number_format($gNewRev, 2) }}</td>
                                <td class="px-2 py-4 text-center bg-blue-900/50 border-l border-gray-600">{{ number_format($gNewOrd) }}</td>
                                
                                {{-- Used Totals --}}
                                <td class="px-2 py-4 text-center bg-orange-900/50">{{ number_format($gUsedQty) }}</td>
                                <td class="px-2 py-4 text-center bg-orange-900/50">{{ number_format($gUsedRev, 2) }}</td>
                                <td class="px-2 py-4 text-center bg-orange-900/50 border-l border-gray-600">{{ number_format($gUsedOrd) }}</td>
                                
                                {{-- Grand Totals --}}
                                <td class="px-2 py-4 text-center bg-black/20">{{ number_format($gNewQty + $gUsedQty) }}</td>
                                <td class="px-2 py-4 text-center bg-black/20 text-yellow-400">{{ number_format($gNewRev + $gUsedRev, 2) }}</td>
                                <td class="px-2 py-4 text-center bg-black/20">{{ number_format($gNewOrd + $gUsedOrd) }}</td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </main>
    </div>

    

    <style>
        @media print {
            body { background: white !important; }
            .no-print { display: none !important; }
            #report-content { 
                position: static; 
                width: 100%; 
                margin: 0; 
                padding: 0; 
                box-shadow: none; 
            }
            table { border: 1px solid #e5e7eb; }
            th { background-color: #f9fafb !important; color: black !important; }
            tfoot { background-color: #1f2937 !important; color: white !important; -webkit-print-color-adjust: exact; }
        }
    </style>
</x-filament-panels::page>