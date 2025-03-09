<!-- Stored in resources/views/child.blade.php -->

<!-- Sidebar -->
<div style="width: 280px;" class="sidebar sidebar-style-2" data-background-color="{{ Auth('admin')->User()->dashboard_style }}">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth('admin')->User()->firstName }} {{ Auth('admin')->User()->lastName }}
                            <span class="user-level"> Admin</span>
                            {{-- <span class="caret"></span> --}}
                        </span>
                    </a>
                </div>
            </div>

            <ul class="nav nav-primary">
                <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ url('/admin/dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Panel de Control</p>
                    </a>
                </li>
                @if (Auth('admin')->User()->type == 'Super Admin' || Auth('admin')->User()->type == 'Admin')
                    @if ($mod['investment'])
                        <li
                            class="nav-item {{ request()->routeIs('plans') ? 'active' : '' }} {{ request()->routeIs('newplan') ? 'active' : '' }} {{ request()->routeIs('editplan') ? 'active' : '' }} {{ request()->routeIs('activeinvestments') ? 'active' : '' }}">
                            <a data-toggle="collapse" href="#pln" style="display: none;">
                                <i class="fas fa-cubes "></i>
                                <p>Inversión</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="pln">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ url('/admin/dashboard/plans') }}">
                                            <span class="sub-item">Planes de Inversión</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/admin/dashboard/active-investments') }}">
                                            <span class="sub-item">Inversiones Activas</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                    <li
                        class="nav-item {{ request()->routeIs('manageusers') ? 'active' : '' }} {{ request()->routeIs('loginactivity') ? 'active' : '' }} {{ request()->routeIs('user.plans') ? 'active' : '' }} {{ request()->routeIs('viewuser') ? 'active' : '' }}">
                        <a href="{{ url('/admin/dashboard/manageusers') }}">
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                            <p>Gestionar Usuarios</p>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('mdeposits') ? 'active' : '' }}">
                        <a href="{{ route('mdeposits') }}">
                            <i class="fa fa-download" aria-hidden="true"></i>
                            <p>Gestionar Depósitos</p>
                        </a>
                    </li>

                    <li
                        class="nav-item {{ request()->routeIs('mwithdrawals') ? 'active' : '' }}   {{ request()->routeIs('processwithdraw') ? 'active' : '' }}">
                        <a href="{{ url('/admin/dashboard/mwithdrawals') }}">
                            <i class="fa fa-arrow-alt-circle-up" aria-hidden="true"></i>
                            <p>Gestionar Retiros</p>
                        </a>
                    </li>

                    <li style="display: none;"
                        class="nav-item {{ request()->routeIs('kyc') ? 'active' : '' }} {{ request()->routeIs('viewkyc') ? 'active' : '' }}">
                        <a href="{{ route('kyc') }}">
                            <i class="fa fa-user-check" aria-hidden="true"></i>
                            <p>Aplicaciones KYC</p>
                        </a>
                    </li>

                    @if ($mod['subscription'])
                        <li @class([
                            'nav-item ',
                            'active' =>
                                request()->routeIs('msubtrade') ||
                                request()->routeIs('tsettings') ||
                                request()->routeIs('subview') ||
                                request()->routeIs('symbolmaps') ||
                                request()->routeIs('admin.invoices'),
                        ])>
                            <a data-toggle="collapse" href="#mgacnt">
                                <i class="fa fa-sync-alt"></i>
                                <p>MAM - Copytrading</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="mgacnt">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ route('tsettings') }}">
                                            <span class="sub-item">Cuentas de Proveedores</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('msubtrade') }}">
                                            <span class="sub-item">Cuentas de Seguidores</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('symbolmaps') }}">
                                            <span class="sub-item">Mapas de Símbolos</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('subview') }}">
                                            <span class="sub-item">Configuraciones</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                    @if ($mod['signal'])
                        <li
                            class="nav-item {{ request()->routeIs('signals') ? 'active' : '' }} {{ request()->routeIs('signal.settings') ? 'active' : '' }} {{ request()->routeIs('signal.subs') ? 'active' : '' }}">
                            <a data-toggle="collapse" href="#signals">
                                <i class="fa fa-signal"></i>
                                <p>Proveedor de Señales</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="signals">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ route('signals') }}">
                                            <span class="sub-item">Señales de Trading</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('signal.subs') }}">
                                            <span class="sub-item">Suscriptores</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('signal.settings') }}">
                                            <span class="sub-item">Configuraciones</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                    @if ($mod['membership'])
                        <li
                            class="nav-item {{ request()->routeIs('categories') ? 'active' : '' }} {{ request()->routeIs('courses') ? 'active' : '' }} {{ request()->routeIs('lessons') ? 'active' : '' }}">
                            <a data-toggle="collapse" href="#meme">
                                <i class="fa fa-book-reader"></i>
                                <p>Membresía</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="meme">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ route('categories') }}">
                                            <span class="sub-item">Categorías</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('courses') }}">
                                            <span class="sub-item">Cursos</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('less.nocourse') }}">
                                            <span class="sub-item">Lecciones</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                @endif
                <li
                    class="nav-item {{ request()->routeIs('task') ? 'active' : '' }} {{ request()->routeIs('mtask') ? 'active' : '' }} {{ request()->routeIs('viewtask') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#task" style="display: none;">
                        <i class="fas fa-align-center"></i>
                        <p>CRM</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="task">
                        <ul class="nav nav-collapse">
                            @if (Auth('admin')->User()->type == 'Super Admin')
                                <li>
                                    <a href="{{ url('/admin/dashboard/task') }}">
                                        <span class="sub-item">Crear Tarea</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/admin/dashboard/mtask') }}">
                                        <span class="sub-item">Gestionar Tareas</span>
                                    </a>
                                </li>
                            @endif
                            @if (Auth('admin')->User()->type != 'Super Admin')
                                <li>
                                    <a href="{{ url('/admin/dashboard/viewtask') }}">
                                        <span class="sub-item">Ver mis Tareas</span>
                                    </a>
                                </li>
                            @endif

                            @if (Auth('admin')->User()->type == 'Super Admin' || Auth('admin')->User()->type == 'Admin')
                                <li class=" {{ request()->routeIs('leads') ? 'active' : '' }}">
                                    <a href="{{ url('/admin/dashboard/leads') }}">
                                        <!-- <i class="fas fa-user-slash " aria-hidden="true"></i> -->
                                        <span class="sub-item">Centro de Soporte</span>
                                    </a>
                                </li>

                                <li class=" {{ request()->routeIs('emailservices') ? 'active' : '' }}">
                                    <a href="{{ route('emailservices') }}">
                                        <!-- <i class="fa fa-envelope" aria-hidden="true"></i> -->
                                        <span class="sub-item">Servicios de correo electrónico</span>
                                    </a>
                                </li>
                            @endif

                            @if (Auth('admin')->User()->type == 'Rentention Agent' || Auth('admin')->User()->type == 'Conversion Agent')
                                <li class="nav-item {{ request()->routeIs('leadsassign') ? 'active' : '' }}">
                                    <a href="{{ url('/admin/dashboard/leadsassign') }}">
                                        <i class="fas fa-user-slash " aria-hidden="true"></i>
                                        <p>Mis clientes potenciales</p>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </li>

                @if (Auth('admin')->User()->type == 'Super Admin')
                    <li
                        class="nav-item {{ request()->routeIs('addmanager') ? 'active' : '' }} {{ request()->routeIs('madmin') ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#adm">
                            <i class="fa fa-user"></i>
                            <p>Administradores y vendedores</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="adm">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ url('/admin/dashboard/addmanager') }}">
                                        <span class="sub-item">Agregar administrador o vendedor</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/admin/dashboard/madmin') }}">
                                        <span class="sub-item">Administrar administradores y vendedores</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li
                        class="nav-item {{ request()->routeIs('appsettingshow') ? 'active' : '' }} {{ request()->routeIs('termspolicy') ? 'active' : '' }} {{ request()->routeIs('refsetshow') ? 'active' : '' }} {{ request()->routeIs('paymentview') ? 'active' : '' }} {{ request()->routeIs('frontpage') ? 'active' : '' }} {{ request()->routeIs('allipaddress') ? 'active' : '' }} {{ request()->routeIs('ipaddress') ? 'active' : '' }} {{ request()->routeIs('editpaymethod') ? 'active' : '' }} {{ request()->routeIs('managecryptoasset') ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#settings" style="display: none;">
                            <i class="fa fa-cog"></i>
                            <p>Ajustes</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="settings">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('appsettingshow') }}">
                                        <span class="sub-item">Configuración de la aplicación</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('refsetshow') }}">
                                        <span class="sub-item">Configuración de referencia/bonificación</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('paymentview') }}">
                                        <span class="sub-item">Configuración de pago</span>
                                    </a>
                                </li>
                                @if ($mod['cryptoswap'])
                                    <li>
                                        <a href="{{ route('managecryptoasset') }}">
                                            <span class="sub-item">Cambiar configuración</span>
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ url('/admin/dashboard/frontpage') }}">
                                        <span class="sub-item">Configuración de interfaz</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('termspolicy') }}">
                                        <span class="sub-item">Términos y privacidad</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/admin/dashboard/ipaddress') }}">
                                        <span class="sub-item">Lista negra de IP</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                @if (Auth('admin')->User()->type != 'Conversion Agent')
                    <li @class([
                        'nav-item',
                        'active' => request()->routeIs('aboutonlinetrade'),
                    ])>
                        <a href="{{ url('/admin/dashboard/platform') }}" style="display: none;">
                            <i class=" fa fa-info-circle" aria-hidden="true"></i>
                            <p>Plataforma</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
