<?php $__env->startSection('content'); ?>
    <div class="mt-2 mb-4">
        <h1 class="title1  d-inline"> <?php echo e($user->name); ?> Investment Plans</h1>
        <div class="d-inline">
            <div class="float-right btn-group">
                <a class="btn btn-primary btn-sm" href="<?php echo e(route('viewuser', $user->id)); ?>"> <i class="fa fa-arrow-left"></i>
                    back</a>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginal431821226313d25f12c6b9e5d4f97b7033ed596e = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Admin\Alert::class, []); ?>
<?php $component->withName('admin.alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal431821226313d25f12c6b9e5d4f97b7033ed596e)): ?>
<?php $component = $__componentOriginal431821226313d25f12c6b9e5d4f97b7033ed596e; ?>
<?php unset($__componentOriginal431821226313d25f12c6b9e5d4f97b7033ed596e); ?>
<?php endif; ?>
    <div class="mb-5 row">
        <div class="col card p-3 shadow ">
            <div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table">
                <span style="margin:3px;">
                    <table id="ShipTable" class="table table-hover ">
                        <thead>
                            <tr>
                                
                                <th>Plan</th>
                                <th>Amount</th>
                                <th>Active</th>
                                <th>Duration</th>
                                <th>Created on</th>
                                <th>Expire At</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    
                                    <td><?php echo e($plan->dplan->name); ?></td>
                                    <td><?php echo e($settings->currency); ?><?php echo e(number_format($plan->amount)); ?></td>
                                    <td>
                                        <?php if($plan->active == 'yes'): ?>
                                            <span class="badge badge-success"><?php echo e($plan->active); ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-danger"><?php echo e($plan->active); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($plan->inv_duration); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($plan->created_at)->toDayDateTimeString()); ?>

                                    </td>
                                    <td><?php echo e(\Carbon\Carbon::parse($plan->expire_date)->toDayDateTimeString()); ?>

                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('deleteplan', $plan->id)); ?>" class="m-1 btn btn-info btn-sm">
                                            Delete Plan</a>
                                        <?php if($plan->active == 'yes'): ?>
                                            <a href="<?php echo e(route('markas', ['id' => $plan->id, 'status' => 'expired'])); ?>"
                                                class="m-1 btn btn-danger btn-sm">Mark as expired</a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('markas', ['id' => $plan->id, 'status' => 'yes'])); ?>"
                                                class="m-1 btn btn-success btn-sm">Mark as active</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nb9pvggwxcwi/public_html/ultra.multipagos.co/core/resources/views/admin/Users/user_plans.blade.php ENDPATH**/ ?>