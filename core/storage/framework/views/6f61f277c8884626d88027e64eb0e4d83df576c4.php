<?php $__env->startSection('content'); ?>
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
    <div class="row">
        <div class="col-md-12">
            <div class="p-3 card ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 ">
                            <h1 class="d-inline text-primary"><?php echo e($user->name); ?></h1><span></span>
                            <div class="d-inline">
                                <div class="float-right btn-group">
                                    <a class="btn btn-primary btn-sm" href="<?php echo e(route('manageusers')); ?>"> <i
                                            class="fa fa-arrow-left"></i> back</a> &nbsp;
                                    <button type="button" class="btn btn-secondary dropdown-toggle btn-sm"
                                        data-toggle="dropdown" data-display="static" aria-haspopup="true"
                                        aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-lg-right">
                                        <a class="dropdown-item" href="<?php echo e(route('loginactivity', $user->id)); ?>">Login
                                            Activity</a>
                                        <?php if($user->status == null || $user->status == 'blocked'): ?>
                                            <a class="dropdown-item"
                                                href="<?php echo e(url('admin/dashboard/uunblock')); ?>/<?php echo e($user->id); ?>">Unblock</a>
                                        <?php else: ?>
                                            <a class="dropdown-item"
                                                href="<?php echo e(url('admin/dashboard/uublock')); ?>/<?php echo e($user->id); ?>">Block</a>
                                        <?php endif; ?>
                                        <?php if($user->trade_mode == 'on'): ?>
                                            <?php if($mod['investment']): ?>
                                            <a class="dropdown-item"
                                                href="<?php echo e(url('admin/dashboard/usertrademode')); ?>/<?php echo e($user->id); ?>/off">Turn
                                                off auto ROI
                                            </a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if($mod['investment']): ?>
                                            <a class="dropdown-item"
                                                href="<?php echo e(url('admin/dashboard/usertrademode')); ?>/<?php echo e($user->id); ?>/on">Turn
                                                on auto ROI
                                            </a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if($user->email_verified_at): ?>
                                        <?php else: ?>
                                            <a href="<?php echo e(url('admin/dashboard/email-verify')); ?>/<?php echo e($user->id); ?>"
                                                class="dropdown-item">Verify Email</a>
                                        <?php endif; ?>
                                        <a href="#" data-toggle="modal" data-target="#topupModal"
                                            class="dropdown-item">Credit/Debit</a>
                                        <a href="#" data-toggle="modal" data-target="#resetpswdModal"
                                            class="dropdown-item">Reset Password</a>
                                        <a href="#" data-toggle="modal" data-target="#clearacctModal"
                                            class="dropdown-item">Clear Account</a>
                                        <?php if($mod['investment']): ?>
                                        <a href="#" data-toggle="modal" data-target="#TradingModal"
                                            class="dropdown-item">Add ROI History
                                        </a>
                                        <?php endif; ?>
                                        <a href="#" data-toggle="modal" data-target="#edituser"
                                            class="dropdown-item">Edit</a>
                                        <a href="<?php echo e(route('showusers', $user->id)); ?>" class="dropdown-item">Add
                                            Referral</a>
                                        <a href="#" data-toggle="modal" data-target="#sendmailtooneuserModal"
                                            class="dropdown-item">Send
                                            Email</a>
                                        <a href="#" data-toggle="modal" data-target="#switchuserModal"
                                            class="dropdown-item text-success">Login as <?php echo e($user->name); ?></a>
                                        <a href="#" data-toggle="modal" data-target="#deleteModal"
                                            class="dropdown-item text-danger">Delete <?php echo e($user->name); ?></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 mt-4 border rounded row ">
                        <div class="col-md-3">
                            <h5 class="font-weight-bold ">Account Balance</h5>
                            <p><?php echo e($settings->currency); ?><?php echo e(number_format($user->account_bal, 2, '.', ',')); ?>

                            </p>
                        </div>
                        <div class="col-md-3">
                            <h5 class="font-weight-bold ">Profit</h5>
                            <p><?php echo e($settings->currency); ?><?php echo e(number_format($user->roi, 2, '.', ',')); ?> </p>
                        </div>
                        <div class="col-md-3">
                            <h5 class="font-weight-bold ">Referral Bonus</h5>
                            <p><?php echo e($settings->currency); ?><?php echo e(number_format($user->ref_bonus, 2, '.', ',')); ?></p>
                        </div>
                        <div class="col-md-3">
                            <h5 class="font-weight-bold ">Bonus</h5>
                            <p><?php echo e($settings->currency); ?><?php echo e(number_format($user->bonus, 2, '.', ',')); ?></p>
                        </div>
                        <div class="col-md-3">
                            <h5 class="font-weight-bold ">User Account Status</h5>
                            <?php if($user->status == 'blocked'): ?>
                                <span class="badge badge-danger">Blocked</span>
                            <?php else: ?>
                                <span class="badge badge-success">Active</span>
                            <?php endif; ?>
                        </div>
                        <?php if($mod['investment']): ?>
                        <div class="col-md-3">
                            <h5 class="font-weight-bold ">Inv. Plans</h5>
                            <a class="btn btn-sm btn-primary d-inline" href="<?php echo e(route('user.plans', $user->id)); ?>">View
                                Plans</a>
                        </div>
                        <?php endif; ?>
                        <div class="col-md-3">
                            <h5 class="font-weight-bold ">KYC</h5>
                            <?php if($user->account_verify == 'Verified'): ?>
                                <span class="badge badge-success">Verified</span>
                            <?php else: ?>
                                <span class="badge badge-danger">Not Verified</span>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-3">
                            <h5 class="font-weight-bold ">ROI Mode</h5>
                            <?php if($mod['investment']): ?>
                            <?php if($user->trade_mode == 'off' || $user->trade_mode == null): ?>
                                <span class="badge badge-danger">Off</span>
                            <?php else: ?>
                                <span class="badge badge-success">On</span>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="mt-3 row ">
                        <div class="col-md-12">
                            <h5>USER INFORMATION</h5>
                        </div>
                    </div>
                    <div class="p-3 border row ">
                        <div class="col-md-4 border-right">
                            <h5>Fullname</h5>
                        </div>
                        <div class="col-md-8">
                            <h5><?php echo e($user->name); ?></h5>
                        </div>
                    </div>
                    <div class="p-3 border row ">
                        <div class="col-md-4 border-right">
                            <h5>Email Address</h5>
                        </div>
                        <div class="col-md-8">
                            <h5><?php echo e($user->email); ?></h5>
                        </div>
                    </div>
                    <div class="p-3 border row ">
                        <div class="col-md-4 border-right">
                            <h5>Mobile Number</h5>
                        </div>
                        <div class="col-md-8">
                            <h5><?php echo e($user->phone); ?></h5>
                        </div>
                    </div>
                    <div class="p-3 border row ">
                        <div class="col-md-4 border-right">
                            <h5>Date of birth</h5>
                        </div>
                        <div class="col-md-8">
                            <h5><?php echo e($user->dob); ?></h5>
                        </div>
                    </div>
                    <div class="p-3 border row ">
                        <div class="col-md-4 border-right">
                            <h5>Nationality</h5>
                        </div>
                        <div class="col-md-8">
                            <h5><?php echo e($user->country); ?></h5>
                        </div>
                    </div>
                    <div class="p-3 border row ">
                        <div class="col-md-4 border-right">
                            <h5>Registered</h5>
                        </div>
                        <div class="col-md-8">
                            <h5><?php echo e(\Carbon\Carbon::parse($user->created_at)->toDayDateTimeString()); ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('admin.Users.users_actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nb9pvggwxcwi/public_html/ultra.multipagos.co/core/resources/views/admin/Users/userdetails.blade.php ENDPATH**/ ?>