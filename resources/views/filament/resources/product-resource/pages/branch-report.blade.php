@php
    use App\Enums\StockCase;
@endphp

<x-filament-panels::page>
    <x-filament::section class="mb-4 shadow-sm no-print border-slate-200">
        <div class="flex flex-col gap-4 md:flex-row md:items-end">
            <div class="flex-1">{{ $this->form }}</div>
        </div>
    </x-filament::section>

    <div class="text-gray-800">
        <main class="w-full mx-auto p-4 sm:p-6 md:p-8 m-4" id="report-content">
            <x-report-header label="تقرير المنتجات للفروع" :value="$branch->name" />

            <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
                <header class="border-b border-gray-200 p-6 bg-gray-50/50">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">جرد تفصيلي للمنتجات</h1>
                            <p class="text-md text-primary-600 font-medium mt-1">{{ $branch->name }}</p>
                        </div>
                        <div
                            class="text-sm text-gray-600 mt-4 sm:mt-0 text-left sm:text-right bg-white p-2 rounded-lg shadow-sm border border-gray-100">
                            <p class="font-semibold text-gray-400 uppercase tracking-wider">تاريخ التقرير</p>
                            <p class="text-gray-900 font-bold">{{ now()->format('Y-m-d') }}</p>
                        </div>
                    </div>
                </header>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-right text-gray-600">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b border-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-bold text-right">المنتج</th>
                                <th scope="col" class="px-6 py-4 font-bold text-center">الرصيد الابتدائي</th>
                                <th scope="col" class="px-6 py-4 font-bold text-center">التوريدات (+)</th>
                                <th scope="col" class="px-6 py-4 font-bold text-center">المبيعات (-)</th>
                                <th scope="col" class="px-6 py-4 font-bold text-center bg-primary-50 text-primary-900">
                                    المجموع الصافي</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($products as $product)
                                <tr class="bg-white hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap">
                                        {{ $product->name }}
                                    </td>
                                    <td class="px-6 py-4 text-center text-blue-600 font-medium">
                                        {{ number_format($product->initial_qty ?? 0) }}
                                    </td>
                                    <td class="px-6 py-4 text-center text-green-600 font-medium">
                                        {{ number_format($product->increases_qty ?? 0) }}
                                    </td>
                                    <td class="px-6 py-4 text-center text-red-600 font-medium">
                                        {{ number_format(abs($product->sales_qty ?? 0)) }}
                                    </td>
                                    <td class="px-6 py-4 text-center font-bold text-gray-900 bg-gray-50/30">
                                        @php
                                            $total = ($product->initial_qty ?? 0) + ($product->increases_qty ?? 0) - abs($product->sales_qty ?? 0);
                                        @endphp
                                        {{ number_format($total) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic">
                                        لا توجد بيانات متاحة لهذا الفرع
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <style>
        @media print {
            body {
                background: white !important;
            }

            .no-print,
            .fi-sidebar,
            .fi-topbar,
            .fi-header,
            .fi-actions {
                display: none !important;
            }

            #report-content {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0 !important;
                padding: 0 !important;
            }

            .shadow-lg {
                box-shadow: none !important;
            }

            .rounded-xl {
                border-radius: 0 !important;
            }

            table {
                border: 1px solid #e5e7eb !important;
            }
        }
    </style>
</x-filament-panels::page>