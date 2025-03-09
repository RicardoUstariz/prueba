<?php $__env->startSection('content'); ?>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.withdrawal.manage-withdrawal', [])->html();
} elseif ($_instance->childHasBeenRendered('w7YB2Jg')) {
    $componentId = $_instance->getRenderedChildComponentId('w7YB2Jg');
    $componentTag = $_instance->getRenderedChildComponentTagName('w7YB2Jg');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('w7YB2Jg');
} else {
    $response = \Livewire\Livewire::mount('admin.withdrawal.manage-withdrawal', []);
    $html = $response->html();
    $_instance->logRenderedChild('w7YB2Jg', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nb9pvggwxcwi/public_html/ultra.multipagos.co/core/resources/views/admin/withdrawals/mwithdrawals.blade.php ENDPATH**/ ?>