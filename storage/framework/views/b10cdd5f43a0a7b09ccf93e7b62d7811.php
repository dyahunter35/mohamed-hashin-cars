<div>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.section.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
            <div>
                <div class="flex flex-col justify-between gap-4 xl:gap-60 lg:gap-48 md:gap-16 sm:gap-8 sm:flex-row">
                    <div class="w-full ">

                        
                        <div class="flex flex-row items-start gap-4">
                            <img alt="" src="<?php echo e(asset('asset/images/logo/gas 200.png')); ?>" class="w-16" />

                            <div>
                                <div class="text-2xl font-bold">
                                    <?php echo e(__('app.name')); ?>

                                </div>
                                <div class="text-lg font-bold">
                                    <?php echo e($this->getRecord()->branch->name); ?>

                                </div>
                            </div>
                        </div>


                        <div class="mt-6">
                            <div class="mt-4">
                                <div class="text-sm text-gray-400">
                                    <?php echo e(trans('filament-invoices::messages.invoices.view.bill_to')); ?>:
                                </div>
                                <div class="text-lg font-bold">
                                    <?php echo e($this->getRecord()->customer?->name); ?>

                                </div>
                                
                                <div class="text-sm">
                                    <?php echo e($this->getRecord()->customer?->phone); ?>

                                </div>
                                

                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col w-full">
                        <div class="flex justify-end font-bold">
                            <div>
                                <div>
                                    <h1 class="text-3xl uppercase">
                                        <?php echo e(trans('filament-invoices::messages.invoices.view.invoice')); ?></h1>
                                </div>
                                <div>
                                    #<?php echo e($this->getRecord()->number); ?>

                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end h-full">
                            <div class="flex flex-col justify-end">
                                <div>
                                    <div class="flex justify-between gap-4">
                                        <div class="text-gray-400">
                                            <?php echo e(trans('order.invoice.labels.today')); ?>

                                            : </div>
                                        <div><?php echo e(now()->toDateString()); ?></div>
                                    </div>
                                    <div class="flex justify-between gap-4">
                                        <div class="text-gray-400">
                                            <?php echo e(trans('filament-invoices::messages.invoices.view.issue_date')); ?> :
                                        </div>
                                        <div><?php echo e($this->getRecord()->created_at->toDateString()); ?></div>
                                    </div>
                                    
                                    <div class="flex justify-between gap-4">
                                        <div class="text-gray-400">
                                            <?php echo e(trans('filament-invoices::messages.invoices.view.status')); ?> : </div>
                                        <div><?php echo e($this->getRecord()->status->getLabel()); ?></div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="px-2 my-4 border border-gray-200 rounded-lg dark:border-gray-700">
                        <div class="flex flex-col">
                            <div
                                class="flex justify-between px-4 py-2 font-bold text-center border-b border-gray-200 dark:border-gray-700">
                                <div class="w-full p-2">
                                    <?php echo e(trans('filament-invoices::messages.invoices.view.item')); ?>

                                </div>
                                <div class="w-full p-2">
                                    <?php echo e(trans('filament-invoices::messages.invoices.view.qty')); ?>

                                </div>
                                <div class="w-full p-2">
                                    <?php echo e(trans('filament-invoices::messages.invoices.view.price')); ?>

                                </div>
                                <div class="w-full p-2">
                                    <?php echo e(trans('filament-invoices::messages.invoices.view.discount')); ?>

                                </div>
                                <div class="w-full p-2">
                                    <?php echo e(trans('filament-invoices::messages.invoices.view.total')); ?>

                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-4 divide-y divide-gray-100 dark:divide-white/5">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $this->getRecord()->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex justify-between px-4 py-2">
                                    <div class="flex flex-col w-full">
                                        <div class="flex items-center justify-center">
                                            <div>
                                                <div class="text-lg font-bold">
                                                    <?php echo e($item->product?->name); ?>

                                                </div>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->description): ?>
                                                    <div class="text-gray-400">
                                                        <?php echo e($item->description); ?>

                                                    </div>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->options): ?>
                                                    <div class="text-gray-400">
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $item->options ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $options): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <span><?php echo e(str($label)->ucfirst()); ?></span> :
                                                            <?php echo e($options); ?> <br>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    </div>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col w-full">
                                        <div class="flex justify-center">
                                            <div>
                                                <div class="font-medium">
                                                    (1)
                                                </div>
                                                <div class="font-bold">
                                                    <?php echo e(number_format($item->qty, 1)); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col w-full">
                                        <div class="flex justify-center">
                                            <div>
                                                <div class="font-medium">
                                                    <?php echo e(number_format($item->price, 1)); ?>

                                                </div>
                                                <div class="font-bold">
                                                    <?php echo e(number_format($item->price * $item->qty, 1)); ?>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col w-full">
                                        <div class="flex justify-center">
                                            <div>
                                                <div class="font-medium">
                                                    <?php echo e(number_format($item->sub_discount, 1)); ?>

                                                </div>
                                                <div class="font-bold">
                                                    <?php echo e(number_format($item->sub_discount * $item->qty, 1)); ?>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col w-full">
                                        <div class="flex justify-center">
                                            <div>
                                                <div class="font-medium">
                                                    <?php echo e(number_format($item->price - $item->sub_discount, 1)); ?>

                                                </div>
                                                <div class="font-bold">
                                                    <?php echo e(number_format(($item->price - $item->sub_discount) * $item->qty, 1)); ?>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>


                    <div class="flex justify-between mt-6">
                        <div class="flex flex-col justify-end w-full gap-4">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->getRecord()->is_bank_transfer): ?>
                                <div>
                                    <div class="mb-2 text-xl">
                                        <?php echo e(trans('filament-invoices::messages.invoices.view.bank_account')); ?>

                                    </div>
                                    <div class="flex flex-col text-sm">
                                        <div>
                                            <span
                                                clas="text-gray-400"><?php echo e(trans('filament-invoices::messages.invoices.view.name')); ?></span>
                                            : <span class="font-bold"></span>
                                        </div>
                                        <div>
                                            <span
                                                clas="text-gray-400"><?php echo e(trans('filament-invoices::messages.invoices.view.address')); ?></span>
                                            : <span class="font-bold">,,</span>
                                        </div>
                                        <div>
                                            <span
                                                clas="text-gray-400"><?php echo e(trans('filament-invoices::messages.invoices.view.branch')); ?></span>
                                            : <span class="font-bold"></span>
                                        </div>
                                        <div>
                                            <span
                                                clas="text-gray-400"><?php echo e(trans('filament-invoices::messages.invoices.view.swift')); ?></span>
                                            : <span class="font-bold"></span>
                                        </div>
                                        <div>
                                            <span
                                                clas="text-gray-400"><?php echo e(trans('filament-invoices::messages.invoices.view.account')); ?></span>
                                            : <span class="font-bold"></span>
                                        </div>
                                        <div>
                                            <span
                                                clas="text-gray-400"><?php echo e(trans('filament-invoices::messages.invoices.view.owner')); ?></span>
                                            : <span class="font-bold"></span>
                                        </div>
                                        <div>
                                            <span
                                                clas="text-gray-400"><?php echo e(trans('filament-invoices::messages.invoices.view.iban')); ?></span>
                                            : <span class="font-bold"></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <div>
                                <div class="mb-2 text-xl">
                                    <?php echo e(trans('filament-invoices::messages.invoices.view.signature')); ?>

                                </div>
                                <div class="text-sm text-gray-400">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col w-full gap-2 mt-4">
                            <div class="flex justify-between">
                                <div class="font-bold">
                                    <?php echo e(trans('order.invoice.labels.subtotal')); ?>

                                </div>
                                <div>
                                    <?php echo e(number_format($this->getRecord()->total + $this->getRecord()->discount - $this->getRecord()->shipping - $this->getRecord()->install, 1)); ?>

                                    <small class="font-normal text-md"><?php echo e($this->getRecord()->currency); ?></small>
                                </div>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->getRecord()->install > 0): ?>
                                <div class="flex justify-between">
                                    <div class="font-bold">
                                        <?php echo e(trans('order.fields.shipping.label')); ?>

                                    </div>
                                    <div>
                                        <?php echo e(number_format($this->getRecord()->shipping, 1)); ?> <small
                                            class="font-normal text-md"><?php echo e($this->getRecord()->currency); ?></small>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->getRecord()->install > 0): ?>
                                <div class="flex justify-between">
                                    <div class="font-bold">
                                        <?php echo e(trans('order.fields.installation.label')); ?>

                                    </div>
                                    <div>
                                        <?php echo e(number_format($this->getRecord()->install, 1)); ?> <small
                                            class="font-normal text-md"><?php echo e($this->getRecord()->currency); ?></small>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->getRecord()->discount > 0): ?>
                                <div class="flex justify-between">
                                    <div class="font-bold">
                                        <?php echo e(trans('filament-invoices::messages.invoices.view.discount')); ?>

                                    </div>
                                    <div>
                                        <?php echo e(number_format($this->getRecord()->discount, 1)); ?> <small
                                            class="font-normal text-md"><?php echo e($this->getRecord()->currency); ?></small>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <div class="flex justify-between pb-4 border-b border-gray-200 dark:border-gray-700">
                                <div class="font-bold">
                                    <?php echo e(trans('filament-invoices::messages.invoices.view.total')); ?>

                                </div>
                                <div>
                                    <?php echo e(number_format($this->getRecord()->total, 1)); ?> <small
                                        class="font-normal text-md"><?php echo e($this->getRecord()->currency); ?></small>
                                </div>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->getRecord()->paid > 0): ?>
                                <div class="flex justify-between pb-4 border-b border-gray-200 dark:border-gray-700">
                                    <div class="font-bold">
                                        <?php echo e(trans('filament-invoices::messages.invoices.view.paid')); ?>

                                    </div>
                                    <div>
                                        <?php echo e(number_format($this->getRecord()->paid, 1)); ?> <small
                                            class="font-normal text-md"><?php echo e($this->getRecord()->currency); ?></small>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->getRecord()->total - $this->getRecord()->paid > 0): ?>
                                <div class="flex justify-between text-xl font-bold">
                                    <div>
                                        <?php echo e(trans('filament-invoices::messages.invoices.view.balance_due')); ?>

                                    </div>
                                    <div>
                                        <?php echo e(number_format($this->getRecord()->total - $this->getRecord()->paid, 1)); ?>

                                        <small class="font-normal text-md"><?php echo e($this->getRecord()->currency); ?></small>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->getRecord()->notes): ?>
                        <div class="my-4 border-b border-gray-200 dark:border-gray-700"></div>
                        <div>
                            <div class="mb-2 text-xl">
                                <?php echo e(trans('filament-invoices::messages.invoices.view.notes')); ?>

                            </div>
                            <div class="text-sm text-gray-400">
                                <?php echo $this->getRecord()->notes; ?>

                            </div>
                            </div`>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.section.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>


                <!-- Header Section -->
                <header class="border-b border-gray-200 ">
                    <div class="flex flex-col items-start justify-between sm:flex-row sm:items-center">
                        <div>
                            <h1 class="p-3 font-bold text-gray-900 text-l">المدفوعات</h1>
                        </div>

                    </div>
                </header>

                <!-- Table Container for Responsiveness -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-right text-gray-600">
                        <!-- Table Head -->
                        <thead class="text-gray-700 uppercase bg-white border-b border-gray-200 text-l">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-semibold text-center">التاريخ</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-center">
                                    المبلغ
                                </th>
                                <th scope="col" class="px-6 py-4 font-semibold text-center">
                                    طريقة الدفع
                                </th>
                            </tr>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $this->getRecord()->orderMetas()->latest()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                <tr
                                    class="transition-colors duration-200 bg-white border-b border-gray-200 hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-center text-gray-900 whitespace-nowrap">
                                        <?php echo e($meta->created_at->toDateString()); ?>

                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <?php echo e(number_format($meta->value, 1)); ?> <small
                                            class="font-normal text-md">SDG</small>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <?php echo e(\App\Enums\Payment::tryFrom($meta->group)->getLabel()); ?>

                                    </td>

                                    
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


    <style type="text/css" media="print">
        @page {
            margin: 0;
            size: auto;
        }

        body {
            margin: 1cm;
        }

        .fi-section-content-ctn {
            padding: 0 !important;
            border: none !important;
        }

        .fi-section {
            border: none !important;
            box-shadow: none !important;
            page-break-inside: avoid;
        }

        .fi-section-content {
            border: none !important;
            box-shadow: none !important;
        }

        .fi-main {
            margin: 0 !important;
            padding: 0 !important;
            background-color: white !important;
            color: black !important;
        }

        img {
            display: block !important;
            page-break-inside: avoid;
        }

        .no-print {
            display: none !important;
        }

        .fi-header {
            display: none !important;
        }

        .fi-topbar {
            display: none !important;
        }

        .fi-sidebar {
            display: none !important;
        }

        .fi-sidebar-close-overlay {
            display: none !important;
        }
    </style>

</div>
<?php /**PATH /Users/mac/Herd/MohamedHashim/resources/views/filament/resources/order-resource/print-order.blade.php ENDPATH**/ ?>