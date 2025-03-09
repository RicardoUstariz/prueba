<style>
    .container {
        text-align: center;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 20px;
        margin-bottom: 20px;
    }

    .progress-bar {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        flex-direction: row;
        background: transparent;
    }

    .step {
        /*width: 100px;*/
        padding: 10px;
        text-align: center;
        border: 2px solid black;
        border-radius: 10px;
        font-weight: bold;
        color: #000;
    }

    .active1 {
        background-color: limegreen;
        color: white;
    }

    .loading-spinner {
        border: 8px solid #f3f3f3;
        border-top: 8px solid #888888;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        margin: 20px auto;
    }

    @keyframes  spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    h2 {
        margin: 20px 0;
    }

    button {
        background-color: #3f007f;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #29005a;
    }
</style>
<div>
    <div class="mt-2 mb-4">
        <h1 class="title1 " style="margin-left: 20px;">Gestionar depósitos de clientes</h1>
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php if($deposits->count() > 0): ?>
                        <div class="d-lg-flex mb-3">
                            <div>
                                <label for="">search</label>
                                <input type="text" class="form-control" placeholder="Search by user name"
                                    wire:model='search'>
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
                                        <th>Client</th>
                                        <th>Amount Deposited</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo e(route('viewuser', ['id' => $deposit->duser->id])); ?>"
                                                    class="text-info"><?php echo e($deposit->duser->name); ?>

                                                </a>
                                            </td>
                                            <td><?php echo e($settings->currency); ?><?php echo e(number_format($deposit->amount)); ?>

                                            </td>
                                            <td><?php echo e($deposit->payment_mode); ?></td>
                                            <td>
                                                <?php if($deposit->status == 'Processed'): ?>
                                                    <span class="badge badge-success"><?php echo e($deposit->status); ?></span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger"><?php echo e($deposit->status); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($deposit->created_at->format('d M Y')); ?>

                                            </td>
                                            <td>
                                                <a href="data-deposit/<?php echo e($deposit->id); ?>"
                                                    class="btn btn-info btn-sm m-1" title="View payment screenshot">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <button onclick="eliminarDeposito('<?php echo e($deposit->id); ?>')" data-toggle="modal"
                                                    data-target="#exampleModal" class="m-1 btn btn-danger btn-sm">
                                                    Delete
                                                </button>

                                                <?php if($deposit->status != 'Processed'): ?>
                                                    <button class="btn btn-primary btn-sm" wire:loading.attr="disabled"
                                                        onclick="confirmarDeposito('<?php echo e($deposit->id); ?>')">
                                                        <div class="spinner-border spinner-border-sm" role="status" wire:loading
                                                            wire:target="confirmDeposit(<?php echo e($deposit->id); ?>)">
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                        Confirm
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirm Delete
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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

                            <?php echo e($deposits->links()); ?>

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

                        <div class="container">
                            <h1>DEPÓSITO BANCOLOMBIA</h1>

                            <div class="progress-bar">
                                <div class="step active1">PENDIENTE</div>
                                <div class="step">PROCESADO</div>
                                <div class="step">COMPLETO</div>
                            </div>

                            <div class="loading-spinner"></div>

                            <h2>ESTADO: <span id="estado">PENDIENTE</span></h2>

                            <button id="actualizarBtn">ACTUALIZAR</button>
                        </div>

                        <!--<div class="text-center py-5">
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
                                                    You do not have any deposit record. <br> When your users deposit into
                                                    their
                                                    account, it will appear here.
                                                </p>
                                            <?php endif; ?>
                                        </div>-->
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('actualizarBtn').addEventListener('click', function () {
        const estado = document.getElementById('estado');
        const steps = document.querySelectorAll('.step');
        const current = estado.textContent;

        if (current === 'PENDIENTE') {
            estado.textContent = 'PROCESADO';
            steps[0].classList.remove('active1');
            steps[1].classList.add('active1');
        } else if (current === 'PROCESADO') {
            estado.textContent = 'COMPLETO';
            steps[1].classList.remove('active1');
            steps[2].classList.add('active1');
        } else {
            estado.textContent = 'PENDIENTE';
            steps[2].classList.remove('active1');
            steps[0].classList.add('active1');
        }
    });
</script>

<script>
    function eliminarDeposito(id) {
        var r = confirm("¿Está seguro de eliminar este depósito?");
        if (r) {
            window.location.href = "<?php echo e(route('deldeposit', ':id')); ?>".replace(':id', id);
        }
    }

    function confirmarDeposito(id) {
        
        window.location.href = "<?php echo e(route('pdeposit', ':id')); ?>".replace(':id', id);
    }
</script><?php /**PATH /home/nb9pvggwxcwi/public_html/ultra.multipagos.co/core/resources/views/livewire/admin/deposit/manage-deposit.blade.php ENDPATH**/ ?>