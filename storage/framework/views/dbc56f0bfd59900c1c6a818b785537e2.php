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
        $threshold = 10;

        // جلب المنتجات الجديدة ذات المخزون المنخفض
        $lowStockNew = \Illuminate\Support\Facades\DB::table('branch_product')
            ->join('products', 'branch_product.product_id', '=', 'products.id')
            ->join('branches', 'branch_product.branch_id', '=', 'branches.id')
            ->where('branch_product.new_quantity', '<', $threshold)
            ->where('branch_product.new_quantity', '>', 0)
            ->select([
                'products.id',
                'products.name as product_name',
                'branches.name as branch_name',
                'branch_product.new_quantity as quantity',
                \Illuminate\Support\Facades\DB::raw("'new' as product_status") // تم تغيير الاسم لتجنب خطأ SQL
            ])
            ->get();

        // جلب المنتجات المستعملة ذات المخزون المنخفض
        $lowStockUsed = \Illuminate\Support\Facades\DB::table('branch_product')
            ->join('products', 'branch_product.product_id', '=', 'products.id')
            ->join('branches', 'branch_product.branch_id', '=', 'branches.id')
            ->where('branch_product.used_quantity', '<', $threshold)
            ->where('branch_product.used_quantity', '>', 0)
            ->select([
                'products.id',
                'products.name as product_name',
                'branches.name as branch_name',
                'branch_product.used_quantity as quantity',
                \Illuminate\Support\Facades\DB::raw("'used' as product_status") // تم تغيير الاسم هنا أيضاً
            ])
            ->get();

        // دمج النتائج وحساب الإحصائيات
        $allLowStock = $lowStockNew->concat($lowStockUsed);
        $urgentCount = $allLowStock->where('quantity', '<', 5)->count();
        $mediumCount = $allLowStock->whereBetween('quantity', [5, 9])->count();
    ?>
    
    <div class="text-gray-800">
        <main class="w-full max-w-7xl mx-auto p-4 sm:p-6 md:p-8 m-4" id="report-content">
            <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
                <header class="border-b border-gray-200 p-6 bg-gray-50/50">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">تنبيهات المخزون المنخفض</h1>
                            <p class="text-sm text-gray-500 mt-1">المنتجات التي تحتاج إلى إعادة تخزين (جديد ومستعمل)</p>
                        </div>
                        <div class="text-sm text-gray-600 mt-4 sm:mt-0 text-left sm:text-right">
                            <p class="font-semibold">تاريخ التقرير:</p>
                            <p><?php echo e(now()->format('Y-m-d')); ?></p>
                        </div>
                    </div>
                </header>

                <div class="p-6">
                    <div class="grid gap-4 md:grid-cols-3 mb-6">
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                                <div class="mr-4">
                                    <p class="text-sm font-medium text-red-800">حالة حرجة (أقل من 5)</p>
                                    <p class="text-2xl font-bold text-red-900"><?php echo e($urgentCount); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="mr-4">
                                    <p class="text-sm font-medium text-yellow-800">متوسط (5-10)</p>
                                    <p class="text-2xl font-bold text-yellow-900"><?php echo e($mediumCount); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="mr-4">
                                    <p class="text-sm font-medium text-green-800">حالة الفروع</p>
                                    <p class="text-2xl font-bold text-green-900">مستقر</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">المنتج</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الفرع</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الحالة</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الكمية</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $allLowStock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo e($item->product_name); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($item->branch_name); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 py-1 rounded text-xs <?php echo e($item->product_status == 'new' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800'); ?>">
                                                <?php echo e($item->product_status == 'new' ? 'جديد' : 'مستعمل'); ?>

                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold <?php echo e($item->quantity < 5 ? 'text-red-600' : 'text-yellow-600'); ?>">
                                            <?php echo e($item->quantity); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <style>
        @media print {
            body * { visibility: hidden; }
            #report-content, #report-content * { visibility: visible; }
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
<?php endif; ?><?php /**PATH /Users/mac/Herd/MohamedHashim/resources/views/filament/resources/product-resource/pages/low-stock-alert-report.blade.php ENDPATH**/ ?>