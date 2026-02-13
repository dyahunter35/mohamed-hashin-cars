<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['label' => null, 'value' => null]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['label' => null, 'value' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($label)): ?>
<?php $__env->startSection('title', $label . ' ' . $value); ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<header class="container mx-auto mb-2 print:mb-4">
    
    <div class="flex flex-row gap-2 items-center justify-center mb-2 space-y-1 text-center print:space-y-0">
        <div class="p-2 mb-1">
            <img src="<?php echo e(asset('asset/images/logo-sm.png')); ?>" width="90" alt="logo" class="h-auto" />
        </div>

        <div class="space-y-1">
            <h1 class="text-xl font-black tracking-tighter uppercase text-slate-800 print:text-xl">
                <?php echo e(__('app.name')); ?>

            </h1>

            <div
                class="flex flex-row mt-2 items-center justify-center gap-4 text-l font-medium text-slate-500 print:text-[10px]">
                
                <p class="flex items-center gap-1">
                    <svg class="w-4 h-4 print:w-3 print:h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <?php echo e(__('app.address')); ?>

                </p>

                
                <p class="flex items-center gap-2">
                    <svg class="w-4 h-4 print:w-3 print:h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <?php echo e(__('app.phone')); ?>

                </p>
            </div>
        </div>
    </div>

    
    <div
        class="relative px-4 overflow-hidden border-2 border-dashed rounded-xl border-slate-300 bg-slate-50/50 print:p-1 print:rounded-lg">
        <div class="flex flex-row items-center justify-between">

            
            <div class="flex items-center gap-2">
                <div class="p-2 rounded-lg print:p-1">
                    <svg class="w-5 h-5 print:w-4 print:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-lg font-bold leading-tight text-slate-700 print:text-sm">
                        <?php echo e($label ?? 'تقرير عام'); ?>

                        <span class="text-blue-700"><?php echo e($value); ?></span>
                    </h4>
                </div>
            </div>

            
            <div class="flex items-center gap-2">
                <div class="p-2 mx-2 rounded-lg text-slate-600 print:hidden">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="text-left md:text-right">
                    <span class="block text-[10px] font-bold tracking-wider uppercase text-slate-400 print:hidden">تاريخ
                        الإصدار</span>
                    <time class="text-lg font-bold text-slate-700 tabular-nums print:text-sm">
                        <?php echo e(now()->format('Y/m/d')); ?>

                    </time>
                </div>

            </div>

        </div>
    </div>
</header><?php /**PATH /Users/mac/Herd/MohamedHashim/resources/views/components/report-header.blade.php ENDPATH**/ ?>