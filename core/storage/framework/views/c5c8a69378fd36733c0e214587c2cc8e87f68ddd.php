<?php $__env->startSection('content'); ?>
    <div class="mt-2 mb-4">
        <h1 class="title1 ">Agregar nuevo administrador</h1>
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
        <div class="col-lg-8 offset-lg-2 card p-3  shadow">
            <form method="POST" action="<?php echo e(url('admin/dashboard/saveadmin')); ?>">
                <?php echo e(csrf_field()); ?>


                <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                    <h4 class="">Nombre</h4>
                    <div>
                        <input id="name" type="text" class="form-control  " name="fname" value="<?php echo e(old('fname')); ?>"
                            required>
                        <?php if($errors->has('fname')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('fname')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group<?php echo e($errors->has('l_name') ? ' has-error' : ''); ?>">
                    <h4 class="">Apellido</h4>
                    <div>
                        <input id="name" type="text" class="form-control  " name="l_name"
                            value="<?php echo e(old('l_name')); ?>" required>
                        <?php if($errors->has('l_name')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('l_name')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                    <h4 class="">Dirección de correo electrónico</h4>

                    <div>
                        <input id="email" type="email" class="form-control  " name="email"
                            value="<?php echo e(old('email')); ?>" required>

                        <?php if($errors->has('email')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('email')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                    <h4 class="">Número de teléfono</h4>
                    <div>
                        <input id="phone" type="number" class="form-control  " name="phone"
                            value="<?php echo e(old('phone')); ?>" required>

                        <?php if($errors->has('phone')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('phone')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <h4 class="">Tipo</h4>
                    <select class="form-control  " onchange="ponerRolAdmin()" id="elRol">
                        <option>Super Admin</option>
                        <option>Central</option>
                        <option>Comercio</option>
                    </select><br>
                </div>

                <input type="hidden" name="type" id="typeRol" value="Super Admin">

                <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">

                    <h4 class="">Contraseña</h4>
                    <div>
                        <input id="password" type="password" class="form-control  " name="password" required>

                        <?php if($errors->has('password')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('password')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
                    <h4 class="">Confirmar Conttraseña</h4>
                    <div>
                        <input id="password-confirm" type="password" class="form-control  " name="password_confirmation"
                            required>

                        <?php if($errors->has('password_confirmation')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <button type="submit" class="px-3 btn btn-primary btn-lg">
                            <i class="fa fa-plus"></i> Guardar usuario
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        async function ponerRolAdmin(){

            let elRol = document.getElementById('elRol').value;

            if(elRol == 'Super Admin'){

                document.getElementById('typeRol').value = 'Super Admin';
            }else if(elRol == 'Central'){

                document.getElementById('typeRol').value = 'Admin';
            }else if(elRol == 'Comercio'){

                document.getElementById('typeRol').value = 'Conversion Agent';
            }
        }
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nb9pvggwxcwi/public_html/ultra.multipagos.co/core/resources/views/admin/addadmin.blade.php ENDPATH**/ ?>