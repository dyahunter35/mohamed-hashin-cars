@php
    $isRtl = app()->getLocale() === 'ar';
    $sideClass = $isRtl ? 'left-6' : 'right-6';
    $tooltipPlacement = $isRtl ? 'right' : 'left';
@endphp

<div class="fixed bottom-6 {{ $sideClass }} no-print flex flex-col-reverse gap-3 z-[100] transition-all"
    style="direction: {{ $isRtl ? 'rtl' : 'ltr' }};">
    <!-- Print Action Button -->
    <div class="group relative">
        <x-filament::button color="success" icon="heroicon-o-printer" size="xl"
            class="!rounded-full shadow-2xl hover:scale-105 active:scale-95 transition-all duration-300"
            onclick="window.print()" x-tooltip="{
                content: 'طباعة التقرير (Ctrl+P)',
                placement: '{{ $tooltipPlacement }}'
            }">
        </x-filament::button>
    </div>

    <!-- Scroll Actions Group -->
    <div class="flex flex-col gap-2 scale-90 opacity-80 hover:opacity-100 transition-opacity">
        {{-- زر العودة للأعلى --}}
        <x-filament::button color="gray" icon="heroicon-o-chevron-double-up" size="sm"
            class="!rounded-full shadow-lg backdrop-blur-md bg-white/70 dark:bg-gray-800/70 hover:scale-110 transition-transform"
            onclick="window.scrollTo({ top: 0, behavior: 'smooth' })" x-tooltip="{
                content: 'العودة للأعلى',
                placement: '{{ $tooltipPlacement }}'
            }">
        </x-filament::button>

        {{-- زر التمرير للأسفل --}}
        <x-filament::button color="gray" icon="heroicon-o-chevron-double-down" size="sm"
            class="!rounded-full shadow-lg backdrop-blur-md bg-white/70 dark:bg-gray-800/70 hover:scale-110 transition-transform"
            onclick="window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' })" x-tooltip="{
                content: 'إلى أسفل التقرير',
                placement: '{{ $tooltipPlacement }}'
            }">
        </x-filament::button>
    </div>
</div>

<style>
    @media print {
        .no-print {
            display: none !important;
        }
    }
</style>