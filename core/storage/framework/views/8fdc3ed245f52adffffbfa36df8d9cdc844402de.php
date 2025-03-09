<!-- Stored in resources/views/child.blade.php -->

<!-- Sidebar -->
<div style="width: 280px;" class="sidebar sidebar-style-2" data-background-color="<?php echo e(Auth('admin')->User()->dashboard_style); ?>">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            <?php echo e(Auth('admin')->User()->firstName); ?> <?php echo e(Auth('admin')->User()->lastName); ?>

                            <span class="user-level"> Admin</span>
                            
                        </span>
                    </a>
                </div>
            </div>

            <ul class="nav nav-primary">
                <li class="nav-item <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('/admin/dashboard')); ?>">
                        <i class="fas fa-home"></i>
                        <p>Panel de Control</p>
                    </a>
                </li>
                <?php if(Auth('admin')->User()->type == 'Super Admin' || Auth('admin')->User()->type == 'Admin'): ?>
                    <?php if($mod['investment']): ?>
                        <li
                            class="nav-item <?php echo e(request()->routeIs('plans') ? 'active' : ''); ?> <?php echo e(request()->routeIs('newplan') ? 'active' : ''); ?> <?php echo e(request()->routeIs('editplan') ? 'active' : ''); ?> <?php echo e(request()->routeIs('activeinvestments') ? 'active' : ''); ?>">
                            <a data-toggle="collapse" href="#pln" style="display: none;">
                                <i class="fas fa-cubes "></i>
                                <p>Inversión</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="pln">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="<?php echo e(url('/admin/dashboard/plans')); ?>">
                                            <span class="sub-item">Planes de Inversión</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(url('/admin/dashboard/active-investments')); ?>">
                                            <span class="sub-item">Inversiones Activas</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                    <li
                        class="nav-item <?php echo e(request()->routeIs('manageusers') ? 'active' : ''); ?> <?php echo e(request()->routeIs('loginactivity') ? 'active' : ''); ?> <?php echo e(request()->routeIs('user.plans') ? 'active' : ''); ?> <?php echo e(request()->routeIs('viewuser') ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/admin/dashboard/manageusers')); ?>">
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                            <p>Gestionar Usuarios</p>
                        </a>
                    </li>

                    <li class="nav-item <?php echo e(request()->routeIs('mdeposits') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('mdeposits')); ?>">
                            <i class="fa fa-download" aria-hidden="true"></i>
                            <p>Gestionar Depósitos</p>
                        </a>
                    </li>

                    <li
                        class="nav-item <?php echo e(request()->routeIs('mwithdrawals') ? 'active' : ''); ?>   <?php echo e(request()->routeIs('processwithdraw') ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/admin/dashboard/mwithdrawals')); ?>">
                            <i class="fa fa-arrow-alt-circle-up" aria-hidden="true"></i>
                            <p>Gestionar Retiros</p>
                        </a>
                    </li>

                    <li style="display: none;"
                        class="nav-item <?php echo e(request()->routeIs('kyc') ? 'active' : ''); ?> <?php echo e(request()->routeIs('viewkyc') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('kyc')); ?>">
                            <i class="fa fa-user-check" aria-hidden="true"></i>
                            <p>Aplicaciones KYC</p>
                        </a>
                    </li>

                    <?php if($mod['subscription']): ?>
                        <li class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                            'nav-item ',
                            'active' =>
                                request()->routeIs('msubtrade') ||
                                request()->routeIs('tsettings') ||
                                request()->routeIs('subview') ||
                                request()->routeIs('symbolmaps') ||
                                request()->routeIs('admin.invoices'),
                        ]) ?>">
                            <a data-toggle="collapse" href="#mgacnt">
                                <i class="fa fa-sync-alt"></i>
                                <p>MAM - Copytrading</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="mgacnt">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="<?php echo e(route('tsettings')); ?>">
                                            <span class="sub-item">Cuentas de Proveedores</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(route('msubtrade')); ?>">
                                            <span class="sub-item">Cuentas de Seguidores</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?php echo e(route('symbolmaps')); ?>">
                                            <span class="sub-item">Mapas de Símbolos</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(route('subview')); ?>">
                                            <span class="sub-item">Configuraciones</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if($mod['signal']): ?>
                        <li
                            class="nav-item <?php echo e(request()->routeIs('signals') ? 'active' : ''); ?> <?php echo e(request()->routeIs('signal.settings') ? 'active' : ''); ?> <?php echo e(request()->routeIs('signal.subs') ? 'active' : ''); ?>">
                            <a data-toggle="collapse" href="#signals">
                                <i class="fa fa-signal"></i>
                                <p>Proveedor de Señales</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="signals">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="<?php echo e(route('signals')); ?>">
                                            <span class="sub-item">Señales de Trading</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(route('signal.subs')); ?>">
                                            <span class="sub-item">Suscriptores</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(route('signal.settings')); ?>">
                                            <span class="sub-item">Configuraciones</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if($mod['membership']): ?>
                        <li
                            class="nav-item <?php echo e(request()->routeIs('categories') ? 'active' : ''); ?> <?php echo e(request()->routeIs('courses') ? 'active' : ''); ?> <?php echo e(request()->routeIs('lessons') ? 'active' : ''); ?>">
                            <a data-toggle="collapse" href="#meme">
                                <i class="fa fa-book-reader"></i>
                                <p>Membresía</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="meme">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="<?php echo e(route('categories')); ?>">
                                            <span class="sub-item">Categorías</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(route('courses')); ?>">
                                            <span class="sub-item">Cursos</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(route('less.nocourse')); ?>">
                                            <span class="sub-item">Lecciones</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <li
                    class="nav-item <?php echo e(request()->routeIs('task') ? 'active' : ''); ?> <?php echo e(request()->routeIs('mtask') ? 'active' : ''); ?> <?php echo e(request()->routeIs('viewtask') ? 'active' : ''); ?>">
                    <a data-toggle="collapse" href="#task" style="display: none;">
                        <i class="fas fa-align-center"></i>
                        <p>CRM</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="task">
                        <ul class="nav nav-collapse">
                            <?php if(Auth('admin')->User()->type == 'Super Admin'): ?>
                                <li>
                                    <a href="<?php echo e(url('/admin/dashboard/task')); ?>">
                                        <span class="sub-item">Crear Tarea</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(url('/admin/dashboard/mtask')); ?>">
                                        <span class="sub-item">Gestionar Tareas</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if(Auth('admin')->User()->type != 'Super Admin'): ?>
                                <li>
                                    <a href="<?php echo e(url('/admin/dashboard/viewtask')); ?>">
                                        <span class="sub-item">Ver mis Tareas</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(Auth('admin')->User()->type == 'Super Admin' || Auth('admin')->User()->type == 'Admin'): ?>
                                <li class=" <?php echo e(request()->routeIs('leads') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('/admin/dashboard/leads')); ?>">
                                        <!-- <i class="fas fa-user-slash " aria-hidden="true"></i> -->
                                        <span class="sub-item">Centro de Soporte</span>
                                    </a>
                                </li>

                                <li class=" <?php echo e(request()->routeIs('emailservices') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('emailservices')); ?>">
                                        <!-- <i class="fa fa-envelope" aria-hidden="true"></i> -->
                                        <span class="sub-item">Servicios de correo electrónico</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(Auth('admin')->User()->type == 'Rentention Agent' || Auth('admin')->User()->type == 'Conversion Agent'): ?>
                                <li class="nav-item <?php echo e(request()->routeIs('leadsassign') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('/admin/dashboard/leadsassign')); ?>">
                                        <i class="fas fa-user-slash " aria-hidden="true"></i>
                                        <p>Mis clientes potenciales</p>
                                    </a>
                                </li>
                            <?php endif; ?>

                        </ul>
                    </div>
                </li>

                <?php if(Auth('admin')->User()->type == 'Super Admin'): ?>
                    <li
                        class="nav-item <?php echo e(request()->routeIs('addmanager') ? 'active' : ''); ?> <?php echo e(request()->routeIs('madmin') ? 'active' : ''); ?>">
                        <a data-toggle="collapse" href="#adm">
                            <i class="fa fa-user"></i>
                            <p>Administradores y vendedores</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="adm">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="<?php echo e(url('/admin/dashboard/addmanager')); ?>">
                                        <span class="sub-item">Agregar administrador o vendedor</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(url('/admin/dashboard/madmin')); ?>">
                                        <span class="sub-item">Administrar administradores y vendedores</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li
                        class="nav-item <?php echo e(request()->routeIs('appsettingshow') ? 'active' : ''); ?> <?php echo e(request()->routeIs('termspolicy') ? 'active' : ''); ?> <?php echo e(request()->routeIs('refsetshow') ? 'active' : ''); ?> <?php echo e(request()->routeIs('paymentview') ? 'active' : ''); ?> <?php echo e(request()->routeIs('frontpage') ? 'active' : ''); ?> <?php echo e(request()->routeIs('allipaddress') ? 'active' : ''); ?> <?php echo e(request()->routeIs('ipaddress') ? 'active' : ''); ?> <?php echo e(request()->routeIs('editpaymethod') ? 'active' : ''); ?> <?php echo e(request()->routeIs('managecryptoasset') ? 'active' : ''); ?>">
                        <a data-toggle="collapse" href="#settings" style="display: none;">
                            <i class="fa fa-cog"></i>
                            <p>Ajustes</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="settings">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="<?php echo e(route('appsettingshow')); ?>">
                                        <span class="sub-item">Configuración de la aplicación</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('refsetshow')); ?>">
                                        <span class="sub-item">Configuración de referencia/bonificación</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('paymentview')); ?>">
                                        <span class="sub-item">Configuración de pago</span>
                                    </a>
                                </li>
                                <?php if($mod['cryptoswap']): ?>
                                    <li>
                                        <a href="<?php echo e(route('managecryptoasset')); ?>">
                                            <span class="sub-item">Cambiar configuración</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <a href="<?php echo e(url('/admin/dashboard/frontpage')); ?>">
                                        <span class="sub-item">Configuración de interfaz</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('termspolicy')); ?>">
                                        <span class="sub-item">Términos y privacidad</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(url('/admin/dashboard/ipaddress')); ?>">
                                        <span class="sub-item">Lista negra de IP</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if(Auth('admin')->User()->type != 'Conversion Agent'): ?>
                    <li class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'nav-item',
                        'active' => request()->routeIs('aboutonlinetrade'),
                    ]) ?>">
                        <a href="<?php echo e(url('/admin/dashboard/platform')); ?>" style="display: none;">
                            <i class=" fa fa-info-circle" aria-hidden="true"></i>
                            <p>Plataforma</p>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
<?php /**PATH /home/nb9pvggwxcwi/public_html/ultra.multipagos.co/core/resources/views/admin/sidebar.blade.php ENDPATH**/ ?>