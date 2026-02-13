<div class="fi-wi-stats-overview-card relative rounded-xl bg-white p-2 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
    <div class="p-4 border-b border-gray-100 dark:border-gray-800">
        <div class="flex items-center gap-x-3">
            <div class="p-2 bg-red-50 dark:bg-red-950/30 rounded-lg">
                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-m-exclamation-triangle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-5 w-5 text-red-600 dark:text-red-400']); ?>
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
            </div>
            <div>
                <h3 class="text-base font-semibold leading-6 text-gray-950 dark:text-white">
                    تنبيهات المخزون المنخفض (إجمالي الكميات)
                </h3>
                <p class="text-xs text-gray-500 dark:text-gray-400">المنتجات التي تجاوزت حد الأمان المحدد لها</p>
            </div>
        </div>
    </div>

    <?php $products = $this->getLowStockProducts(); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($products) > 0): ?>
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
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php 
                            $item = (object) $item; 
                            // تحديد حالة الاستعجال إذا كانت الكمية أقل من نصف حد الأمان
                            $isUrgent = $item->total_quantity <= ($item->security_stock / 2);
                        ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                            <td class="px-4 py-3">
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                    <?php echo e($item->product_name); ?>

                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-sm text-gray-600 dark:text-gray-400">
                                    <?php echo e($item->branch_name); ?>

                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="text-sm font-medium text-gray-500">
                                    <?php echo e($item->security_stock); ?>

                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex flex-col items-center gap-1">
                                    <span class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                        'text-sm font-bold',
                                        'text-red-600 dark:text-red-400' => $isUrgent,
                                        'text-amber-600 dark:text-amber-400' => !$isUrgent,
                                    ]); ?>">
                                        <?php echo e($item->total_quantity); ?>

                                    </span>
                                    <span class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                        'text-[10px] px-1.5 py-0.5 rounded uppercase font-bold tracking-tighter',
                                        'bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-300' => $isUrgent,
                                        'bg-amber-100 text-amber-700 dark:bg-amber-900/50 dark:text-amber-300' => !$isUrgent,
                                    ]); ?>">
                                        <?php echo e($isUrgent ? 'حرج جدًا' : 'منخفض'); ?>

                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="text-xs text-gray-400">
                                    <?php echo e($item->low_stock_notified_at ? \Carbon\Carbon::parse($item->low_stock_notified_at)->diffForHumans() : '---'); ?>

                                </span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="flex flex-col items-center justify-center py-12">
            <div class="rounded-full bg-green-50 dark:bg-green-950/30 p-3 mb-4">
                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-check-circle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-8 w-8 text-green-600 dark:text-green-400']); ?>
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
            </div>
            <p class="text-sm font-medium text-gray-900 dark:text-white">المخزون ممتاز</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">جميع الكميات في الفروع فوق حد الأمان.</p>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div><?php /**PATH /Users/mac/Herd/MohamedHashim/resources/views/filament/resources/product-resource/widgets/low-stock-alerts.blade.php ENDPATH**/ ?>