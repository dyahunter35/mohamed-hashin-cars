  <?php
      use App\Enums\StockCase;
  ?>

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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.section.index','data' => ['class' => 'mb-4 shadow-sm no-print border-slate-200']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-4 shadow-sm no-print border-slate-200']); ?>
        <div class="flex flex-col gap-4 md:flex-row md:items-end">
            <div class="flex-1"><?php echo e($this->form); ?></div>
            <?php if (isset($component)) { $__componentOriginal6330f08526bbb3ce2a0da37da512a11f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button.index','data' => ['wire:click' => 'updateQty','color' => 'gray','icon' => 'heroicon-m-arrow-path']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'updateQty','color' => 'gray','icon' => 'heroicon-m-arrow-path']); ?>تحديث الكميات <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $attributes = $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $component = $__componentOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
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
      <div class="text-gray-800">

          <!-- Main Container -->
          <main class="w-full  mx-auto p-4 sm:p-6 md:p-8 m-4" id="report-content">
              <?php if (isset($component)) { $__componentOriginalba70b7059b726609ea102a7adde151ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalba70b7059b726609ea102a7adde151ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.report-header','data' => ['label' => 'تقرير المنتجات للفروع','value' => $branch->name]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('report-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'تقرير المنتجات للفروع','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($branch->name)]); ?>
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
              <!-- Report Card -->
              <div class="bg-white shadow-lg rounded-xl overflow-hidden">

                  <!-- Header Section -->
                  <header class="border-b border-gray-200 p-6">
                      <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                          <div>
                              <h1 class="text-2xl font-bold text-gray-900">تقرير المنتجات للفروع </h1>
                              <p class="text-md text-gray-500 mt-1"><?php echo e($branch->name); ?></p>
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
                                  <th scope="col" class="px-6 py-4 font-semibold">المنتج</th>
                                  <th scope="col" class="px-6 py-4 font-semibold text-center">
                                      اول كمية
                                  </th>
                                  <th scope="col" class="px-6 py-4 font-semibold text-center">
                                      التوريدات
                                  </th>
                                  <th scope="col" class="px-6 py-4 font-semibold text-center">
                                      المبيعات
                                  </th>
                                  <th scope="col" class="px-6 py-4 font-semibold text-center">
                                      المجموع الكلي
                                  </th>
                              </tr>
                          </thead>

                          <!-- Table Body -->
                          <tbody>
                              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                  <?php
                                      $p = $product->history->where('branch_id', $branch->id);
                                  ?>
                                  <tr
                                      class="bg-white border-b border-gray-200 hover:bg-gray-50 transition-colors duration-200">
                                      <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                          <?php echo e($product->name); ?>

                                      </td>

                                      <td class="px-6 py-4 text-center">
                                          <?php echo e($p->where('type', StockCase::Initial)->sum('quantity_change')); ?>

                                      </td>
                                      <td class="px-6 py-4 text-center">
                                          <?php echo e($p->where('type', StockCase::Increase)->sum('quantity_change')); ?>

                                      </td>
                                      <td class="px-6 py-4 text-center">
                                          <?php echo e($p->where('type', StockCase::Decrease)->sum('quantity_change')); ?>

                                      </td>
                                      <td class="px-6 py-4 text-center font-semibold text-gray-900">
                                          <?php echo e(number_format($product->stock_for_current_branch ?? 0)); ?></td>
                                      
                                  </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                          </tbody>

                          <!-- Table Footer -->
                          
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
<?php endif; ?>
<?php /**PATH /Users/mac/Herd/MohamedHashim/resources/views/filament/resources/product-resource/pages/branch-report.blade.php ENDPATH**/ ?>