<div class="p-2 sm:p-4 lg:p-8">
    <?php if (isset($component)) { $__componentOriginal166a02a7c5ef5a9331faf66fa665c256 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal166a02a7c5ef5a9331faf66fa665c256 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.page.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::page'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <?php if (isset($component)) { $__componentOriginalee08b1367eba38734199cf7829b1d1e9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee08b1367eba38734199cf7829b1d1e9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.section.index','data' => ['class' => 'overflow-hidden border-none shadow-none bg-white dark:bg-gray-900 print:bg-transparent print:p-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'overflow-hidden border-none shadow-none bg-white dark:bg-gray-900 print:bg-transparent print:p-0']); ?>
            
            <div
                class="flex  md:flex-row justify-between items-start gap-8 border-b border-gray-100 dark:border-gray-800 pb-8">
                <div class="flex items-center gap-5">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(file_exists(public_path('asset/images/logo/gas 200.png'))): ?>
                        <img src="<?php echo e(asset('asset/images/logo/gas 200.png')); ?>" class="w-20 h-20 object-contain print:w-16"
                            alt="Logo">
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <div>
                        <h1 class="text-2xl font-black tracking-tight text-gray-950 dark:text-white uppercase">
                            <?php echo e(__('app.name')); ?>

                        </h1>
                        <p class="text-lg font-bold text-primary-600 dark:text-primary-400">
                            <?php echo e($this->getRecord()->branch->name); ?>

                        </p>
                    </div>
                </div>

                <div class="text-right flex flex-col items-end">
                    <h2
                        class="text-4xl font-light text-gray-300 dark:text-gray-700 uppercase tracking-widest mb-2 print:text-gray-400">
                        <?php echo e(trans('filament-invoices::messages.invoices.view.invoice')); ?>

                    </h2>
                    <span
                        class="text-xl font-mono font-bold text-gray-950 dark:text-white bg-gray-100 dark:bg-gray-800 px-3 py-1 rounded">
                        #<?php echo e($this->getRecord()->number); ?>

                    </span>
                </div>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mt-10">
                <div class="space-y-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        <?php echo e(trans('filament-invoices::messages.invoices.view.bill_to')); ?>

                    </h3>
                    <div
                        class="bg-gray-50 dark:bg-gray-800/50 p-2 m-2 rounded-xl print:bg-transparent border border-gray-100 dark:border-gray-700">
                        <p class="text-lg font-bold text-gray-900 dark:text-white">
                            <?php echo e($this->getRecord()->customer?->name ?? 'عميل'); ?></p>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->getRecord()->customer?->phone): ?>
                            <p class="text-gray-600 dark:text-gray-400 flex items-center gap-2 mt-1">
                                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-m-phone'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                                <?php echo e($this->getRecord()->customer?->phone); ?>

                            </p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->getRecord()->customer?->address): ?>
                            <p class="text-gray-600 dark:text-gray-400 flex items-center gap-2 mt-1">
                                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-m-map-pin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                                <?php echo e($this->getRecord()->customer?->address); ?>

                            </p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <div class="flex flex-col md:items-end justify-end space-y-2 m-2">
                    <div class="flex justify-between w-full md:w-64 border-b border-gray-50 dark:border-gray-800 pb-1">
                        <span class="text-gray-500 text-bold"><?php echo e(trans('order.invoice.labels.today')); ?>:</span>
                        <span class="font-medium"><?php echo e(now()->toDateString()); ?></span>
                    </div>
                    <div class="flex justify-between w-full md:w-64 border-b border-gray-50 dark:border-gray-800 pb-1">
                        <span
                            class="text-gray-500 text-bold"><?php echo e(trans('filament-invoices::messages.invoices.view.issue_date')); ?>:</span>
                        <span class="font-medium"><?php echo e($this->getRecord()->created_at->toDateString()); ?></span>
                    </div>
                    <div class="flex justify-between w-full md:w-64">
                        <span
                            class="text-gray-500 text-bold"><?php echo e(trans('filament-invoices::messages.invoices.view.status')); ?>:</span>
                        <?php if (isset($component)) { $__componentOriginal986dce9114ddce94a270ab00ce6c273d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal986dce9114ddce94a270ab00ce6c273d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.badge','data' => ['color' => $this->getRecord()->status->getColor()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->getRecord()->status->getColor())]); ?>
                            <?php echo e($this->getRecord()->status->getLabel()); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal986dce9114ddce94a270ab00ce6c273d)): ?>
<?php $attributes = $__attributesOriginal986dce9114ddce94a270ab00ce6c273d; ?>
<?php unset($__attributesOriginal986dce9114ddce94a270ab00ce6c273d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal986dce9114ddce94a270ab00ce6c273d)): ?>
<?php $component = $__componentOriginal986dce9114ddce94a270ab00ce6c273d; ?>
<?php unset($__componentOriginal986dce9114ddce94a270ab00ce6c273d); ?>
<?php endif; ?>
                    </div>
                </div>
            </div>

            
            <div class="mt-12 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm">
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr
                            class="bg-gray-50 dark:bg-white/5 text-gray-500 dark:text-gray-400 print:bg-transparent text-xs uppercase font-bold">
                            <th class="px-6 py-4"><?php echo e(trans('filament-invoices::messages.invoices.view.item')); ?></th>
                            <th class="px-6 py-4 text-center"><?php echo e(trans('order.fields.condition.label')); ?></th>
                            <th class="px-6 py-4 text-center">
                                <?php echo e(trans('filament-invoices::messages.invoices.view.qty')); ?></th>
                            <th class="px-6 py-4 text-center">
                                <?php echo e(trans('filament-invoices::messages.invoices.view.price')); ?></th>
                            <th class="px-6 py-4 text-center">
                                <?php echo e(trans('filament-invoices::messages.invoices.view.discount')); ?></th>
                            <th class="px-6 py-4 text-left">
                                <?php echo e(trans('filament-invoices::messages.invoices.view.total')); ?></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $this->getRecord()->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 print:bg-transparent transition-colors">
                                                    <td class="px-6 py-5">
                                                        <p class="font-bold text-gray-950 dark:text-white">
                                                            <?php echo e(sprintf(
                                '%s - %s (%s)',
                                $item->product?->name,
                                $item->product?->category?->name,
                                $item->product?->brand?->name,
                            )); ?>

                                                        </p>
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->description): ?>
                                                            <p class="text-xs text-gray-500 mt-1 line-clamp-1"><?php echo e($item->description); ?></p>
                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    </td>
                                                    <td class="px-6 py-5 text-center font-medium"><?php echo e($item->condition->getLabel()); ?></td>
                                                    <td class="px-6 py-5 text-center font-medium"><?php echo e(number_format($item->qty, 1)); ?></td>
                                                    <td class="px-6 py-5 text-center text-gray-600 dark:text-gray-400">
                                                        <?php echo e(number_format($item->price, 1)); ?></td>
                                                    <td class="px-6 py-5 text-center text-red-500">
                                                        <?php echo e(number_format($item->sub_discount * $item->qty, 1)); ?></td>
                                                    <td class="px-6 py-5 text-left font-bold text-gray-950 dark:text-white">
                                                        <?php echo e(number_format(($item->price - $item->sub_discount) * $item->qty, 1)); ?>

                                                    </td>
                                                </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10 p-6 bg-gray-50 dark:bg-white/5 print:bg-transparent rounded-2xl">
                <div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->getRecord()->notes): ?>
                        <h4 class="text-xs font-bold uppercase text-gray-400 mb-2">
                            <?php echo e(trans('filament-invoices::messages.invoices.view.notes')); ?></h4>
                        <div class="text-sm text-gray-600 dark:text-gray-400 prose dark:prose-invert max-w-none">
                            <?php echo $this->getRecord()->notes; ?>

                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500"><?php echo e(trans('order.invoice.labels.subtotal')); ?></span>
                        <span
                            class="font-semibold"><?php echo e(number_format($this->getRecord()->total + $this->getRecord()->discount - $this->getRecord()->shipping - $this->getRecord()->install, 1)); ?>

                            <?php echo e($this->getRecord()->currency); ?></span>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->getRecord()->shipping > 0): ?>
                        <div class="flex justify-between text-sm text-amber-600">
                            <span><?php echo e(trans('order.fields.shipping.label')); ?> (+)</span>
                            <span><?php echo e(number_format($this->getRecord()->shipping, 1)); ?></span>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->getRecord()->discount > 0): ?>
                        <div class="flex justify-between text-sm text-red-500">
                            <span><?php echo e(trans('filament-invoices::messages.invoices.view.discount')); ?> (-)</span>
                            <span><?php echo e(number_format($this->getRecord()->discount, 1)); ?></span>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="flex justify-between pt-3 border-t border-gray-200 dark:border-gray-700">
                        <span
                            class="text-lg font-bold"><?php echo e(trans('filament-invoices::messages.invoices.view.total')); ?></span>
                        <span class="text-2xl font-black text-primary-600 dark:text-primary-400">
                            <?php echo e(number_format($this->getRecord()->total, 1)); ?> <small
                                class="text-xs"><?php echo e($this->getRecord()->currency); ?></small>
                        </span>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->getRecord()->paid > 0): ?>
                        <div
                            class="flex justify-between text-sm text-green-600 bg-green-50 dark:bg-green-900/20 print:bg-transparent px-3 py-1 rounded-lg">
                            <span><?php echo e(trans('filament-invoices::messages.invoices.view.paid')); ?></span>
                            <span class="font-bold"><?php echo e(number_format($this->getRecord()->paid, 1)); ?></span>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->getRecord()->total - $this->getRecord()->paid > 0): ?>
                        <div class="flex justify-between text-lg font-bold text-red-600 pt-2">
                            <span><?php echo e(trans('filament-invoices::messages.invoices.view.balance_due')); ?></span>
                            <span><?php echo e(number_format($this->getRecord()->total - $this->getRecord()->paid, 1)); ?></span>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalee08b1367eba38734199cf7829b1d1e9)): ?>
<?php $attributes = $__attributesOriginalee08b1367eba38734199cf7829b1d1e9; ?>
<?php unset($__attributesOriginalee08b1367eba38734199cf7829b1d1e9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalee08b1367eba38734199cf7829b1d1e9)): ?>
<?php $component = $__componentOriginalee08b1367eba38734199cf7829b1d1e9; ?>
<?php unset($__componentOriginalee08b1367eba38734199cf7829b1d1e9); ?>
<?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->getRecord()->orderMetas()->count() > 0): ?>
            <?php if (isset($component)) { $__componentOriginalee08b1367eba38734199cf7829b1d1e9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee08b1367eba38734199cf7829b1d1e9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.section.index','data' => ['class' => 'mt-8 border-dashed']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-8 border-dashed']); ?>
                 <?php $__env->slot('heading', null, []); ?> 
                    <div class="flex items-center gap-2">
                        <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-credit-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 text-gray-400']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                        <span>سجل المدفوعات</span>
                    </div>
                 <?php $__env->endSlot(); ?>

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
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $this->getRecord()->orderMetas()->latest()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="px-6 py-4 text-sm"><?php echo e($meta->created_at->toFormattedDateString()); ?></td>
                                    <td class="px-6 py-4 text-sm font-bold"><?php echo e(number_format($meta->value, 1)); ?> SDG</td>
                                    <td class="px-6 py-4">
                                        <?php if (isset($component)) { $__componentOriginal986dce9114ddce94a270ab00ce6c273d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal986dce9114ddce94a270ab00ce6c273d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.badge','data' => ['size' => 'sm','color' => 'gray']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'sm','color' => 'gray']); ?>
                                            <?php echo e(\App\Enums\Payment::tryFrom($meta->group)?->getLabel() ?? $meta->group); ?>

                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal986dce9114ddce94a270ab00ce6c273d)): ?>
<?php $attributes = $__attributesOriginal986dce9114ddce94a270ab00ce6c273d; ?>
<?php unset($__attributesOriginal986dce9114ddce94a270ab00ce6c273d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal986dce9114ddce94a270ab00ce6c273d)): ?>
<?php $component = $__componentOriginal986dce9114ddce94a270ab00ce6c273d; ?>
<?php unset($__componentOriginal986dce9114ddce94a270ab00ce6c273d); ?>
<?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalee08b1367eba38734199cf7829b1d1e9)): ?>
<?php $attributes = $__attributesOriginalee08b1367eba38734199cf7829b1d1e9; ?>
<?php unset($__attributesOriginalee08b1367eba38734199cf7829b1d1e9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalee08b1367eba38734199cf7829b1d1e9)): ?>
<?php $component = $__componentOriginalee08b1367eba38734199cf7829b1d1e9; ?>
<?php unset($__componentOriginalee08b1367eba38734199cf7829b1d1e9); ?>
<?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal166a02a7c5ef5a9331faf66fa665c256)): ?>
<?php $attributes = $__attributesOriginal166a02a7c5ef5a9331faf66fa665c256; ?>
<?php unset($__attributesOriginal166a02a7c5ef5a9331faf66fa665c256); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal166a02a7c5ef5a9331faf66fa665c256)): ?>
<?php $component = $__componentOriginal166a02a7c5ef5a9331faf66fa665c256; ?>
<?php unset($__componentOriginal166a02a7c5ef5a9331faf66fa665c256); ?>
<?php endif; ?>

    
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
</div><?php /**PATH /Users/mac/Herd/MohamedHashim/resources/views/filament/resources/order-resource/print-order.blade.php ENDPATH**/ ?>