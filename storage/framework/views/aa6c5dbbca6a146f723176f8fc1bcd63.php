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

    <div class="text-gray-800">

        <!-- Main Container -->
        <main class="w-full max-w-7xl mx-auto p-4 sm:p-6 md:p-8 m-4" id="report-content">

            <!-- Report Card -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">

                <!-- Header Section -->
                <header class="border-b border-gray-200 p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">تقرير المخزون حسب الحالة</h1>
                            <p class="text-sm text-gray-500 mt-1">تفاصيل المخزون الجديد والمستعمل لكل منتج</p>
                        </div>
                        <div class="text-sm text-gray-600 mt-4 sm:mt-0 text-left sm:text-right">
                            <p class="font-semibold">تاريخ التقرير:</p>
                            <p><?php echo e(now()->format('Y-m-d')); ?></p>
                        </div>
                    </div>
                </header>

                <!-- Table Container for Responsiveness -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-right text-gray-600">
                        <!-- Table Head -->
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-semibold" rowspan="2">المنتج</th>
                                <th scope="col" class="px-6 py-4 font-semibold" rowspan="2">الفئة</th>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th scope="col" class="px-4 py-2 font-semibold text-center border-l border-gray-300"
                                        colspan="3">
                                        <?php echo e($branch->name); ?>

                                    </th>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <th scope="col" class="px-4 py-2 font-semibold text-center bg-blue-50" colspan="3">
                                    الإجمالي</th>
                            </tr>
                            <tr class="bg-gray-100">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th class="px-2 py-2 text-xs text-center border-l border-gray-200">جديد</th>
                                    <th class="px-2 py-2 text-xs text-center">مستعمل</th>
                                    <th class="px-2 py-2 text-xs text-center border-r border-gray-300">المجموع</th>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <th class="px-2 py-2 text-xs text-center bg-blue-100">جديد</th>
                                <th class="px-2 py-2 text-xs text-center bg-blue-100">مستعمل</th>
                                <th class="px-2 py-2 text-xs text-center bg-blue-100">المجموع</th>
                            </tr>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr
                                    class="bg-white border-b border-gray-200 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <?php echo e($product['name']); ?>

                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        <?php echo e($product['category'] ?? '-'); ?>

                                    </td>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $branchData = $product['branches'][$branch->id] ?? ['new' => 0, 'used' => 0, 'total' => 0];
                                        ?>
                                        <td class="px-2 py-4 text-center border-l border-gray-200">
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                <?php echo e(number_format($branchData['new'])); ?>

                                            </span>
                                        </td>
                                        <td class="px-2 py-4 text-center">
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-orange-100 text-orange-800">
                                                <?php echo e(number_format($branchData['used'])); ?>

                                            </span>
                                        </td>
                                        <td class="px-2 py-4 text-center font-semibold border-r border-gray-300">
                                            <?php echo e(number_format($branchData['total'])); ?>

                                        </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <td class="px-2 py-4 text-center bg-blue-50">
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded text-xs font-bold bg-blue-200 text-blue-900">
                                            <?php echo e(number_format($product['total_new'])); ?>

                                        </span>
                                    </td>
                                    <td class="px-2 py-4 text-center bg-blue-50">
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded text-xs font-bold bg-orange-200 text-orange-900">
                                            <?php echo e(number_format($product['total_used'])); ?>

                                        </span>
                                    </td>
                                    <td class="px-2 py-4 text-center font-bold text-gray-900 bg-blue-50">
                                        <?php echo e(number_format($product['total_stock'])); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="<?php echo e(count($branches) * 3 + 5); ?>"
                                        class="px-6 py-8 text-center text-gray-500">
                                        لا توجد منتجات
                                    </td>
                                </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>

                        <!-- Table Footer with Totals -->
                        <tfoot class="bg-gray-100 font-bold">
                            <tr>
                                <td class="px-6 py-4 text-base" colspan="2">الإجمالي الكلي</td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $branchTotalNew = $products->sum(fn($p) => $p['branches'][$branch->id]['new'] ?? 0);
                                        $branchTotalUsed = $products->sum(fn($p) => $p['branches'][$branch->id]['used'] ?? 0);
                                        $branchTotal = $branchTotalNew + $branchTotalUsed;
                                    ?>
                                    <td class="px-2 py-4 text-center border-l border-gray-300 bg-blue-100 text-blue-900">
                                        <?php echo e(number_format($branchTotalNew)); ?>

                                    </td>
                                    <td class="px-2 py-4 text-center bg-orange-100 text-orange-900">
                                        <?php echo e(number_format($branchTotalUsed)); ?>

                                    </td>
                                    <td class="px-2 py-4 text-center border-r border-gray-400">
                                        <?php echo e(number_format($branchTotal)); ?>

                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <td class="px-2 py-4 text-center bg-blue-200 text-blue-900">
                                    <?php echo e(number_format($products->sum('total_new'))); ?>

                                </td>
                                <td class="px-2 py-4 text-center bg-orange-200 text-orange-900">
                                    <?php echo e(number_format($products->sum('total_used'))); ?>

                                </td>
                                <td class="px-2 py-4 text-center bg-gray-200 text-gray-900">
                                    <?php echo e(number_format($products->sum('total_stock'))); ?>

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

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal166a02a7c5ef5a9331faf66fa665c256)): ?>
<?php $attributes = $__attributesOriginal166a02a7c5ef5a9331faf66fa665c256; ?>
<?php unset($__attributesOriginal166a02a7c5ef5a9331faf66fa665c256); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal166a02a7c5ef5a9331faf66fa665c256)): ?>
<?php $component = $__componentOriginal166a02a7c5ef5a9331faf66fa665c256; ?>
<?php unset($__componentOriginal166a02a7c5ef5a9331faf66fa665c256); ?>
<?php endif; ?><?php /**PATH /Users/mac/Herd/MohamedHashim/resources/views/filament/resources/product-resource/pages/stock-condition-report.blade.php ENDPATH**/ ?>