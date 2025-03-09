<div>
    <?php if (isset($component)) { $__componentOriginal85f966f1b5de8551aa930b6f61c6100ede97428e = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\PageTitle::class, []); ?>
<?php $component->withName('page-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
        <?php echo e($settings->site_name); ?> users list
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal85f966f1b5de8551aa930b6f61c6100ede97428e)): ?>
<?php $component = $__componentOriginal85f966f1b5de8551aa930b6f61c6100ede97428e; ?>
<?php unset($__componentOriginal85f966f1b5de8551aa930b6f61c6100ede97428e); ?>
<?php endif; ?>
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
        <div class="col-md-12 ">
            <div class="card shadow p-4 ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 d-flex pe-0">
                            <div>
                                <form>
                                    <div class="input-group">
                                        <input wire:model.debounce.500ms='searchvalue'
                                            class="form-control form-control-sm shadow-none search  themes/purposeTheme/assets/"
                                            type="search" placeholder="name, username or email" aria-label="search" />
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-6">
                            <?php if($checkrecord): ?>
                                <div>
                                    <div class="d-flex">
                                        <div>
                                            <select wire:model='action'
                                                class="form-control  themes/purposeTheme/assets/ form-select form-select-sm"
                                                aria-label="Bulk actions">
                                                <option value="Delete">Delete</option>
                                                <option value="Clear">Clear Account</option>
                                            </select>
                                        </div>
                                        <div>
                                            <button class="btn btn-danger btn-sm ms-2" wire:click='delsystemuser'
                                                type="button">Apply</button>
                                        </div>
                                        &nbsp;&nbsp;
                                        <div>
                                            <button class="btn btn-info btn-sm " data-toggle="modal"
                                                data-target="#TradingModal" type="button">
                                                <span class="fas fa-coins" data-fa-transform="shrink-3 down-2"></span>
                                                <span class="d-none d-sm-inline-block ms-1">Add ROI</span>
                                            </button>
                                        </div>
                                        &nbsp;&nbsp;
                                        <div>
                                            <button data-toggle="modal" data-target="#topupModal"
                                                class="btn btn-info btn-sm " type="button">
                                                <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span>
                                                <span class="d-none d-sm-inline-block ms-1">Topup</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div>
                                    <button class="float-right btn btn-primary btn-sm" type="button"
                                        data-toggle="modal" data-target="#adduser">
                                        <span class="fas fa-user-plus" data-fa-transform="shrink-3 down-2"></span>
                                        <span class="d-none d-sm-inline-block ms-1">New User</span>
                                    </button>

                                    <a class="btn btn-info btn-sm " href="<?php echo e(route('emailservices')); ?>">
                                        <span class="fas fa-envelope" data-fa-transform="shrink-3 down-2"></span>
                                        <span class="d-none d-sm-inline-block ms-1">Send Message</span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive" data-example-id="hoverable-table">
                        <table class="table table-hover themes/purposeTheme/assets/">
                            <thead>
                                <tr>
                                    <th class="white-space-nowrap">
                                        <input type="checkbox" wire:model='selectPage' />
                                    </th>
                                    <th>Fullname</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Account Balance</th>
                                    <th>Country</th>
                                    <th>Status</th>
                                    <th>Registered</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="userslisttbl">

                                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="align-middle">
                                            <input type="checkbox" wire:model='checkrecord'
                                                value="<?php echo e($user->id); ?>" />
                                        </td>
                                        <td><?php echo e($user->name); ?></td>
                                        <td><?php echo e($user->username); ?></td>
                                        <td><?php echo e($user->email); ?></td>
                                        <td><?php echo e($user->phone); ?></td>
                                        <td><?php echo e($settings->currency); ?><?php echo e(number_format($user->account_bal, 2, '.', ',')); ?>

                                        </td>
                                        <td><?php echo e($user->country); ?></td>
                                        <td>
                                            <?php if($user->status == 'active'): ?>
                                                <span class='badge badge-success'><?php echo e($user->status); ?></span>
                                            <?php else: ?>
                                                <span class='badge badge-danger'><?php echo e($user->status); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo e($user->created_at->diffForHumans()); ?>

                                        </td>
                                        <td>
                                            <a class='btn btn-secondary btn-sm'
                                                href="<?php echo e(route('viewuser', $user->id)); ?>" role='button'>
                                                Manage
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <td colspan="9">
                                        No Data Available
                                    </td>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer  py-2">
                    <div class="row flex-between-center">
                        <div class="col-auto">
                            <select wire:model='pagenum' class="form-control  themes/purposeTheme/assets/">
                                <option>10</option>
                                <option>20</option>
                                <option>50</option>
                                <option>100</option>
                                <option>200</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <select wire:model='orderby' class="form-control  themes/purposeTheme/assets/">
                                <option value="id">id</option>
                                <option value="name">Name</option>
                                <option value="email">Email</option>
                                <option value="created_at">Sign up date</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <select wire:model='orderdirection' class="form-control  themes/purposeTheme/assets/">
                                <option value="desc">Descending</option>
                                <option value="asc">Ascending</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <?php echo $users->links(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" tabindex="-1" id="adduser" aria-h6ledby="exampleModalh6" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <h3 class="mb-2 d-inline themes/purposeTheme/assets/">Add User</h3>
                    <button type="button" class="close themes/purposeTheme/assets/" data-dismiss="modal"
                        aria-h6="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div>
                        <form method="POST" wire:submit.prevent='saveUser'>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <h6 class="themes/purposeTheme/assets/">Username</h6>
                                    <input type="text" id="usernameinput"
                                        class="form-control  themes/purposeTheme/assets/" name="username"
                                        wire:model.defer='username' required>
                                </div>
                                <div class="form-group col-md-12">
                                    <h6 class="themes/purposeTheme/assets/">Fullname</h6>
                                    <input type="text" class="form-control  themes/purposeTheme/assets/"
                                        name="name" wire:model.defer='fullname' required>
                                </div>
                                <div class="form-group col-md-12">
                                    <h6 class="themes/purposeTheme/assets/">Email</h6>
                                    <input type="email" class="form-control  themes/purposeTheme/assets/"
                                        name="email" wire:model.defer='email' required>
                                </div>
                                <div class="form-group col-md-12">
                                    <h6 class="themes/purposeTheme/assets/">Password</h6>
                                    <input type="text" class="form-control  themes/purposeTheme/assets/"
                                        name="password" wire:model.defer='password' required>
                                </div>
                            </div>
                            <button type="submit" class="px-4 btn btn-primary">Add User</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    

    <!-- /Trading History Modal -->

    <div id="TradingModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header ">
                    <h4 class="modal-title themes/purposeTheme/assets/">Add ROI to selected users
                    </h4>
                    <button type="button" class="close themes/purposeTheme/assets/"
                        data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body ">
                    <form role="form" method="post" wire:submit.prevent='addRoi'>
                        <div class="form-group">
                            <h5 class=" themes/purposeTheme/assets/">Select Investment Plan</h5>
                            <select class="form-control  themes/purposeTheme/assets/" name="plan"
                                wire:model.defer='plan' required>
                                <option></option>
                                <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($plan->id); ?>"><?php echo e($plan->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <h5 class=" themes/purposeTheme/assets/">Date</h5>
                            <input type="date" wire:model.defer='datecreated'
                                class="form-control  themes/purposeTheme/assets/" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn " value="Add History">
                        </div>
                        <div class="form-group">
                            <small class="themes/purposeTheme/assets/">The system will calculate the ROI base on users
                                invested amount and topup amount specified in this selected plan settings <br>
                                <strong>Also Note the plan must be using % as it's topup-type else the calculations will
                                    be wrong.</strong> </small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /send a single user email Modal -->

    <!-- Top Up Modal -->
    <div id="topupModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header ">
                    <h4 class="modal-title themes/purposeTheme/assets/">Credit/Debit Accounts.</strong></h4>
                    <button type="button" class="close themes/purposeTheme/assets/"
                        data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body ">
                    <form method="post" wire:submit.prevent='topup'>
                        <div class="form-group">
                            <input class="form-control  themes/purposeTheme/assets/" placeholder="Enter amount"
                                type="number" step="any" name="amount" wire:model.defer='topamount' required>
                            <small><?php echo e($topamount); ?></small>
                        </div>
                        <div class="form-group">
                            <h5 class="themes/purposeTheme/assets/">Select where to Credit/Debit</h5>
                            <select class="form-control  themes/purposeTheme/assets/" wire:model.defer='topcolumn'
                                name="type" required>
                                <option value="" selected disabled>Select Column</option>
                                <option value="Bonus">Bonus</option>
                                <option value="balance">Account Balance</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <h5 class="themes/purposeTheme/assets/">Select credit to add, debit to subtract.</h5>
                            <select class="form-control  themes/purposeTheme/assets/" wire:model.defer='toptype'
                                name="t_type" required>
                                <option value="">Select type</option>
                                <option value="Credit">Credit</option>
                                <option value="Debit">Debit</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <div class="spinner-border spinner-border-sm" role="status" wire:loading
                                    wire:target="topup">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /deposit for a plan Modal -->
</div>
<?php /**PATH /home/nb9pvggwxcwi/public_html/ultra.multipagos.co/core/resources/views/livewire/admin/manage-users.blade.php ENDPATH**/ ?>