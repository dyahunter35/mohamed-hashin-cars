<div class="p-2 sm:p-4 lg:p-8">
    <x-filament-panels::page>
        <x-filament::section class="overflow-hidden border-none shadow-none bg-white dark:bg-gray-900 print:bg-transparent print:p-0">
            {{-- Header Section --}}
            <div
                class="flex  md:flex-row justify-between items-start gap-8 border-b border-gray-100 dark:border-gray-800 pb-8">
                <div class="flex items-center gap-5">
                    @if(file_exists(public_path('asset/images/logo/gas 200.png')))
                        <img src="{{ asset('asset/images/logo/gas 200.png') }}" class="w-20 h-20 object-contain print:w-16"
                            alt="Logo">
                    @endif
                    <div>
                        <h1 class="text-2xl font-black tracking-tight text-gray-950 dark:text-white uppercase">
                            {{ __('app.name') }}
                        </h1>
                        <p class="text-lg font-bold text-primary-600 dark:text-primary-400">
                            {{ $this->getRecord()->branch->name }}
                        </p>
                    </div>
                </div>

                <div class="text-right flex flex-col items-end">
                    <h2
                        class="text-4xl font-light text-gray-300 dark:text-gray-700 uppercase tracking-widest mb-2 print:text-gray-400">
                        {{ trans('filament-invoices::messages.invoices.view.invoice') }}
                    </h2>
                    <span
                        class="text-xl font-mono font-bold text-gray-950 dark:text-white bg-gray-100 dark:bg-gray-800 px-3 py-1 rounded">
                        #{{ $this->getRecord()->number }}
                    </span>
                </div>
            </div>

            {{-- Info Section --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mt-10">
                <div class="space-y-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        {{ trans('filament-invoices::messages.invoices.view.bill_to') }}
                    </h3>
                    <div
                        class="bg-gray-50 dark:bg-gray-800/50 p-2 m-2 rounded-xl print:bg-transparent border border-gray-100 dark:border-gray-700">
                        <p class="text-lg font-bold text-gray-900 dark:text-white">
                            {{ $this->getRecord()->customer?->name ?? 'عميل' }}</p>
                        @if($this->getRecord()->customer?->phone)
                            <p class="text-gray-600 dark:text-gray-400 flex items-center gap-2 mt-1">
                                <x-heroicon-m-phone class="w-4 h-4" />
                                {{ $this->getRecord()->customer?->phone }}
                            </p>
                        @endif
                        @if($this->getRecord()->customer?->address)
                            <p class="text-gray-600 dark:text-gray-400 flex items-center gap-2 mt-1">
                                <x-heroicon-m-map-pin class="w-4 h-4" />
                                {{ $this->getRecord()->customer?->address }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="flex flex-col md:items-end justify-end space-y-2 m-2">
                    <div class="flex justify-between w-full md:w-64 border-b border-gray-50 dark:border-gray-800 pb-1">
                        <span class="text-gray-500 text-bold">{{ trans('order.invoice.labels.today') }}:</span>
                        <span class="font-medium">{{ now()->toDateString() }}</span>
                    </div>
                    <div class="flex justify-between w-full md:w-64 border-b border-gray-50 dark:border-gray-800 pb-1">
                        <span
                            class="text-gray-500 text-bold">{{ trans('filament-invoices::messages.invoices.view.issue_date') }}:</span>
                        <span class="font-medium">{{ $this->getRecord()->created_at->toDateString() }}</span>
                    </div>
                    <div class="flex justify-between w-full md:w-64">
                        <span
                            class="text-gray-500 text-bold">{{ trans('filament-invoices::messages.invoices.view.status') }}:</span>
                        <x-filament::badge :color="$this->getRecord()->status->getColor()">
                            {{ $this->getRecord()->status->getLabel() }}
                        </x-filament::badge>
                    </div>
                </div>
            </div>

            {{-- Items Table --}}
            <div class="mt-12 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm">
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr
                            class="bg-gray-50 dark:bg-white/5 text-gray-500 dark:text-gray-400 print:bg-transparent text-xs uppercase font-bold">
                            <th class="px-6 py-4">{{ trans('filament-invoices::messages.invoices.view.item') }}</th>
                            <th class="px-6 py-4 text-center">{{ trans('order.fields.condition.label') }}</th>
                            <th class="px-6 py-4 text-center">
                                {{ trans('filament-invoices::messages.invoices.view.qty') }}</th>
                            <th class="px-6 py-4 text-center">
                                {{ trans('filament-invoices::messages.invoices.view.price') }}</th>
                            <th class="px-6 py-4 text-center">
                                {{ trans('filament-invoices::messages.invoices.view.discount') }}</th>
                            <th class="px-6 py-4 text-left">
                                {{ trans('filament-invoices::messages.invoices.view.total') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        @foreach ($this->getRecord()->items as $item)
                                                <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 print:bg-transparent transition-colors">
                                                    <td class="px-6 py-5">
                                                        <p class="font-bold text-gray-950 dark:text-white">
                                                            {{  sprintf(
                                '%s - %s (%s)',
                                $item->product?->name,
                                $item->product?->category?->name,
                                $item->product?->brand?->name,
                            )
                                                             }}
                                                        </p>
                                                        @if($item->description)
                                                            <p class="text-xs text-gray-500 mt-1 line-clamp-1">{{ $item->description }}</p>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-5 text-center font-medium">{{ $item->condition->getLabel() }}</td>
                                                    <td class="px-6 py-5 text-center font-medium">{{ number_format($item->qty, 1) }}</td>
                                                    <td class="px-6 py-5 text-center text-gray-600 dark:text-gray-400">
                                                        {{ number_format($item->price, 1) }}</td>
                                                    <td class="px-6 py-5 text-center text-red-500">
                                                        {{ number_format($item->sub_discount * $item->qty, 1) }}</td>
                                                    <td class="px-6 py-5 text-left font-bold text-gray-950 dark:text-white">
                                                        {{ number_format(($item->price - $item->sub_discount) * $item->qty, 1) }}
                                                    </td>
                                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Totals Section --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10 p-6 bg-gray-50 dark:bg-white/5 print:bg-transparent rounded-2xl">
                <div>
                    @if($this->getRecord()->notes)
                        <h4 class="text-xs font-bold uppercase text-gray-400 mb-2">
                            {{ trans('filament-invoices::messages.invoices.view.notes') }}</h4>
                        <div class="text-sm text-gray-600 dark:text-gray-400 prose dark:prose-invert max-w-none">
                            {!! $this->getRecord()->notes !!}
                        </div>
                    @endif
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">{{ trans('order.invoice.labels.subtotal') }}</span>
                        <span
                            class="font-semibold">{{ number_format($this->getRecord()->total + $this->getRecord()->discount - $this->getRecord()->shipping - $this->getRecord()->install, 1) }}
                            {{ $this->getRecord()->currency }}</span>
                    </div>

                    @if ($this->getRecord()->shipping > 0)
                        <div class="flex justify-between text-sm text-amber-600">
                            <span>{{ trans('order.fields.shipping.label') }} (+)</span>
                            <span>{{ number_format($this->getRecord()->shipping, 1) }}</span>
                        </div>
                    @endif

                    @if ($this->getRecord()->discount > 0)
                        <div class="flex justify-between text-sm text-red-500">
                            <span>{{ trans('filament-invoices::messages.invoices.view.discount') }} (-)</span>
                            <span>{{ number_format($this->getRecord()->discount, 1) }}</span>
                        </div>
                    @endif

                    <div class="flex justify-between pt-3 border-t border-gray-200 dark:border-gray-700">
                        <span
                            class="text-lg font-bold">{{ trans('filament-invoices::messages.invoices.view.total') }}</span>
                        <span class="text-2xl font-black text-primary-600 dark:text-primary-400">
                            {{ number_format($this->getRecord()->total, 1) }} <small
                                class="text-xs">{{ $this->getRecord()->currency }}</small>
                        </span>
                    </div>

                    @if ($this->getRecord()->paid > 0)
                        <div
                            class="flex justify-between text-sm text-green-600 bg-green-50 dark:bg-green-900/20 print:bg-transparent px-3 py-1 rounded-lg">
                            <span>{{ trans('filament-invoices::messages.invoices.view.paid') }}</span>
                            <span class="font-bold">{{ number_format($this->getRecord()->paid, 1) }}</span>
                        </div>
                    @endif

                    @if ($this->getRecord()->total - $this->getRecord()->paid > 0)
                        <div class="flex justify-between text-lg font-bold text-red-600 pt-2">
                            <span>{{ trans('filament-invoices::messages.invoices.view.balance_due') }}</span>
                            <span>{{ number_format($this->getRecord()->total - $this->getRecord()->paid, 1) }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </x-filament::section>

        {{-- Payments History Section --}}
        @if ($this->getRecord()->orderMetas()->count() > 0)
            <x-filament::section class="mt-8 border-dashed">
                <x-slot name="heading">
                    <div class="flex items-center gap-2">
                        <x-heroicon-o-credit-card class="w-5 h-5 text-gray-400" />
                        <span>سجل المدفوعات</span>
                    </div>
                </x-slot>

                <div class="overflow-x-auto">
                    <table class="w-full text-right">
                        <thead>
                            <tr class="text-gray-400 text-xs uppercase border-b border-gray-100 dark:border-gray-800">
                                <th class="px-6 py-3">التاريخ</th>
                                <th class="px-6 py-3">المبلغ</th>
                                <th class="px-6 py-3">طريقة الدفع</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-white/5">
                            @foreach ($this->getRecord()->orderMetas()->latest()->get() as $meta)
                                <tr>
                                    <td class="px-6 py-4 text-sm">{{ $meta->created_at->toFormattedDateString() }}</td>
                                    <td class="px-6 py-4 text-sm font-bold">{{ number_format($meta->value, 1) }} SDG</td>
                                    <td class="px-6 py-4">
                                        <x-filament::badge size="sm" color="gray">
                                            {{ \App\Enums\Payment::tryFrom($meta->group)?->getLabel() ?? $meta->group }}
                                        </x-filament::badge>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-filament::section>
        @endif
    </x-filament-panels::page>

    {{-- Print Optimized Styles --}}
    <style>
        @media print {
            * {
                background: transparent !important;
                background-color: transparent !important;
                color: black !important;
            }
            img{
                /* filter: brightness(0) !important; */
            }

            .fi-main-ctn {
                padding: 0 !important;
            }

            .fi-sidebar,
            .fi-topbar,
            .fi-header,
            .no-print {
                display: none !important;
            }

            .fi-section {
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
            }

            table {
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            .rounded-xl,
            .rounded-2xl {
                border-radius: 0 !important;
            }

            .bg-gray-50 {
                background-color: #f9fafb !important;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</div>