
<?php $__env->startSection('content'); ?>

<div class="container my-5">
    <div class="row">
        <!-- Tarjeta Datos del Depósito -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header text-white">
                    <h5 class="card-title mb-0">Datos del depósito</h5>
                </div>
                <div class="card-body">
                    <p><strong>Monto del depósito:</strong> $<?php echo e($deposit->amount); ?></p>
                    <p><strong>Fecha:</strong> <?php echo e($deposit->expires_at); ?></p>
                    <p><strong>Estado:</strong> <?php echo e($deposit->status); ?></p>
                    <p><strong>Nombre del usuario:</strong> <?php echo e($user->name); ?></p>
                </div>
            </div>
        </div>

        <!-- Tarjeta Datos Bancarios -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header text-white">
                    <h5 class="card-title mb-0">Datos bancarios</h5>
                </div>
                <div class="card-body">
                    <p><strong>Tipo de cuenta:</strong> <?php echo e($datos_bancarios->tipo_cuenta); ?></p>
                    <p><strong>Número de cuenta:</strong> <?php echo e($datos_bancarios->numero_cuenta); ?></p>
                    <p><strong>ID del usuario:</strong> <?php echo e($datos_bancarios->cedula); ?></p>
                    <p><strong>Teléfono:</strong> <?php echo e($datos_bancarios->celular_cliente); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm">

            <button onclick="eliminarDeposito('<?php echo e($deposit->id); ?>')" class="m-1 btn btn-danger btn-sm">
                Eliminar
            </button>

        </div>
        <div class="col-sm">

            <button onclick="confirmarDeposito('<?php echo e($deposit->id); ?>')" class="btn btn-primary btn-sm">
                Confirmar
            </button>

        </div>
    </div>
</div>

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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nb9pvggwxcwi/public_html/ultra.multipagos.co/core/resources/views/admin/deposits/datosdeposito.blade.php ENDPATH**/ ?>