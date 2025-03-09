<div>
    <div class="mt-2 mb-4">
        <h1 class="title1 ">Retiros</h1>
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php if($withdrawals->count() > 0): ?>
                        <div class="d-lg-flex mb-3">
                            <div>
                                <label for="">search</label>
                                <input type="text" class="form-control" placeholder="Search" wire:model='search'>
                            </div>
                            &nbsp; &nbsp;
                            <div class="d-flex">
                                <div>
                                    <label for="">status</label>
                                    <select class="form-control" wire:model='status'>
                                        <option>All</option>
                                        <option>Processed</option>
                                        <option>Pending</option>
                                    </select>
                                </div>
                                &nbsp; &nbsp;
                                <div>
                                    <label for="">page</label>
                                    <select class="form-control" wire:model='perPage'>
                                        <option>10</option>
                                        <option>20</option>
                                    </select>
                                </div>
                                &nbsp; &nbsp;
                                <div>
                                    <label for="">order</label>
                                    <select class="form-control" wire:model='order'>
                                        <option value="desc">Descending</option>
                                        <option value="asc">Ascending</option>
                                    </select>
                                </div>
                                &nbsp; &nbsp;
                            </div>
                            <div class="d-none d-lg-flex">
                                <div>
                                    <label for="">from</label>
                                    <input type="date" wire:model="fromDate" class="form-control" id="">
                                </div>
                                &nbsp; &nbsp;
                                <div>
                                    <label for="">to</label>
                                    <input type="date" wire:model="toDate" class="form-control" id="">
                                </div>
                                <?php if($fromDate != '' && $toDate != ''): ?>
                                    <div class="d-none d-lg-flex">
                                        <div>
                                            <button class="btn btn-sm btn-primary" wire:click='resetFilter'>reset
                                                date</button>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>Client name</th>
                                        <th>Amount requested</th>
                                        <th>Amount + charges</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                        <th>Date created</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $withdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <a class=" text-underline text-info"
                                                    href="<?php echo e(route('viewuser', ['id' => $item->duser->id])); ?>"><?php echo e($item->duser->name); ?>

                                                </a>
                                            </td>
                                            <td><?php echo e($settings->currency); ?><?php echo e(number_format($item->amount)); ?>

                                            </td>
                                            <td><?php echo e($settings->currency); ?><?php echo e(number_format($item->to_deduct)); ?>

                                            </td>
                                            <td><?php echo e($item->payment_mode); ?></td>
                                            <td>
                                                <?php if($item->status == 'Processed'): ?>
                                                    <span class="badge badge-success"><?php echo e($item->status); ?></span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger"><?php echo e($item->status); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e(\Carbon\Carbon::parse($item->created_at)->toDayDateTimeString()); ?>

                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('datawithdrawal', $item->id)); ?>"
                                                    class="m-1 btn btn-info btn-sm">
                                                    <i class="fa fa-eye"></i> View
                                                </a>
                                                <button wire:click="deleteId(<?php echo e($item->id); ?>)" data-toggle="modal"
                                                    data-target="#exampleModal" class="m-1 btn btn-danger btn-sm">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <!-- Modal -->
                            <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirm Delete
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true close-btn">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>Are you sure want to delete?</h4>
                                            <div class="float-right text-right">
                                                <button type="button" class="btn btn-secondary close-btn"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" wire:click.prevent="delete()"
                                                    class="btn btn-danger close-modal" data-dismiss="modal">Yes,
                                                    Delete</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo e($withdrawals->links()); ?>

                        </div>
                        <div class="d-flex d-lg-none">
                            <div>
                                <label for="">from</label>
                                <input type="date" wire:model="fromDate" class="form-control">
                            </div>
                            &nbsp; &nbsp;
                            <div>
                                <label for="">to</label>
                                <input type="date" wire:model="toDate" class="form-control">
                            </div>
                            <?php if($fromDate != '' && $toDate != ''): ?>
                                <div class="d-block d-lg-none">
                                    <div>
                                        <button class="btn btn-sm btn-primary" wire:click='resetFilter'>reset
                                            date</button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <img src="<?php echo e(asset('dash/images/cloud-database-svgrepo-com.svg')); ?>" alt="no record found"
                                class="img-fluid">

                            <?php if($search != '' || $status != 'All' || ($fromDate != '' && $toDate != '')): ?>
                                <h1 class="mt-3 font-weight-bolder text-info">No Result found</h1>
                                <p>We couldn't find what you are looking for. Try again.</p>
                                <button type="button" class="btn btn-primary" wire:click='resetFilter'>
                                    Try again
                                </button>
                            <?php else: ?>
                                <h1 class="mt-3 font-weight-bolder text-info">No Data found</h1>
                                <p>
                                    You do not have any withdrawal record. <br> When your users place a
                                    withdrawal request, it will appear here.
                                </p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/nb9pvggwxcwi/public_html/ultra.multipagos.co/core/resources/views/livewire/admin/withdrawal/manage-withdrawal.blade.php ENDPATH**/ ?>