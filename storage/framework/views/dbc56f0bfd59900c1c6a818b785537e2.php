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
    <?php
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
    ?>
    
    <div class="text-gray-800">
        <main class="w-full max-w-7xl mx-auto p-4" id="report-content">
            <?php if (isset($component)) { $__componentOriginalba70b7059b726609ea102a7adde151ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalba70b7059b726609ea102a7adde151ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.report-header','data' => ['title' => 'تقرير المخزون المنخفض']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('report-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'تقرير المخزون المنخفض']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalba70b7059b726609ea102a7adde151ac)): ?>
<?php $attributes = $__attributesOriginalba70b7059b726609ea102a7adde151ac; ?>
<?php unset($__attributesOriginalba70b7059b726609ea102a7adde151ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalba70b7059b726609ea102a7adde151ac)): ?>
<?php $component = $__componentOriginalba70b7059b726609ea102a7adde151ac; ?>
<?php unset($__componentOriginalba70b7059b726609ea102a7adde151ac); ?>
<?php endif; ?>
            <div class="bg-white shadow-sm rounded-xl border border-gray-200 dark:bg-gray-900 dark:border-white/10">
                <div class="grid gap-4 md:grid-cols-2 p-6">
                    <div class="bg-red-50 p-4 rounded-lg border border-red-100 dark:bg-red-950/20 dark:border-red-900/50">
                        <p class="text-sm font-medium text-red-800 dark:text-red-300">حالات حرجة (أقل من نصف حد الأمان)</p>
                        <p class="text-3xl font-bold text-red-900 dark:text-white"><?php echo e($urgentCount); ?></p>
                    </div>
                    <div class="bg-amber-50 p-4 rounded-lg border border-amber-100 dark:bg-amber-950/20 dark:border-amber-900/50">
                        <p class="text-sm font-medium text-amber-800 dark:text-amber-300">إجمالي المنتجات المنخفضة</p>
                        <p class="text-3xl font-bold text-amber-900 dark:text-white"><?php echo e($totalAlerts); ?></p>
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
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $allLowStock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $isUrgent = $item->total_quantity <= ($item->security_stock / 2); ?>
                                <tr class="hover:bg-gray-50 dark:hover:bg-white/5">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white"><?php echo e($item->product_name); ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400"><?php echo e($item->branch_name); ?></td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-400"><?php echo e($item->security_stock); ?></td>
                                    <td class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                        'px-6 py-4 text-center text-sm font-bold',
                                        'text-red-600 dark:text-red-400' => $isUrgent,
                                        'text-amber-600 dark:text-amber-400' => !$isUrgent,
                                    ]); ?>">
                                        <?php echo e($item->total_quantity); ?>

                                        <span class="text-[10px] block font-normal opacity-70">
                                            <?php echo e($isUrgent ? '(حرج)' : '(منخفض)'); ?>

                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal166a02a7c5ef5a9331faf66fa665c256)): ?>
<?php $attributes = $__attributesOriginal166a02a7c5ef5a9331faf66fa665c256; ?>
<?php unset($__attributesOriginal166a02a7c5ef5a9331faf66fa665c256); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal166a02a7c5ef5a9331faf66fa665c256)): ?>
<?php $component = $__componentOriginal166a02a7c5ef5a9331faf66fa665c256; ?>
<?php unset($__componentOriginal166a02a7c5ef5a9331faf66fa665c256); ?>
<?php endif; ?><?php /**PATH /Users/mac/Herd/MohamedHashim/resources/views/filament/resources/product-resource/pages/low-stock-alert-report.blade.php ENDPATH**/ ?>