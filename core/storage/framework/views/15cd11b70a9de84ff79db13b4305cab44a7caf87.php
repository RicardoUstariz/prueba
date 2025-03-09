
<?php $__env->startSection('title', 'Procesando deposito'); ?>
<?php $__env->startSection('content'); ?>
<!-- Page title -->
<div class="page-title">
    <div class="row justify-content-between align-items-center">
        <div class="mb-3 col-md-6 mb-md-0">
            <h5 class="mb-0 text-white h3 font-weight-400">Procesando deposito</h5>
        </div>
    </div>
</div>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.danger-alert','data' => []]); ?>
<?php $component->withName('danger-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.success-alert','data' => []]); ?>
<?php $component->withName('success-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-body">

            <div class="card-title" id="enCola">En cola: <?php echo e($deposits->count()); ?></div>

                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('proceso-deposito', ['depositId' => $deposit->id])->html();
} elseif ($_instance->childHasBeenRendered('7HLS9Mj')) {
    $componentId = $_instance->getRenderedChildComponentId('7HLS9Mj');
    $componentTag = $_instance->getRenderedChildComponentTagName('7HLS9Mj');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('7HLS9Mj');
} else {
    $response = \Livewire\Livewire::mount('proceso-deposito', ['depositId' => $deposit->id]);
    $html = $response->html();
    $_instance->logRenderedChild('7HLS9Mj', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>    

            </div>
        </div>
    </div>
</div>
<?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>

<?php echo $__env->make('purpose.user.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nb9pvggwxcwi/public_html/ultra.multipagos.co/core/resources/views/purpose/user/datosdeposito.blade.php ENDPATH**/ ?>