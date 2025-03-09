<?php $__env->startSection('content'); ?>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.deposit.manage-deposit', [])->html();
} elseif ($_instance->childHasBeenRendered('ti53mAX')) {
    $componentId = $_instance->getRenderedChildComponentId('ti53mAX');
    $componentTag = $_instance->getRenderedChildComponentTagName('ti53mAX');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('ti53mAX');
} else {
    $response = \Livewire\Livewire::mount('admin.deposit.manage-deposit', []);
    $html = $response->html();
    $_instance->logRenderedChild('ti53mAX', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nb9pvggwxcwi/public_html/ultra.multipagos.co/core/resources/views/admin/deposits/mdeposits.blade.php ENDPATH**/ ?>