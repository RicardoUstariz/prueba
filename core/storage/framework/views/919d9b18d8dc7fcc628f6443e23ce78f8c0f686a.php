<!-- Main nav -->
<nav class="navbar navbar-main navbar-expand-lg navbar-dark bg-primary navbar-border" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand + Toggler (for mobile devices) -->
        <div class="pl-4 d-block d-md-none">
            <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>">
                <img src="<?php echo e(asset('assets/img/logoblanco.png')); ?>" class="navbar-brand-img" alt="..." >
            </a>
        </div>

        <!-- User's navbar -->
        <div class="ml-auto navbar-user d-lg-none">
            <ul class="flex-row navbar-nav align-items-center">
                <li class="nav-item">
                    <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin"
                        data-target="#sidenav-main"><i class="far fa-bars"></i></a>
                </li>

                <?php if($settings->enable_kyc == 'yes'): ?>
                    <li class="nav-item dropdown dropdown-animate">
                        <?php if(Auth::user()->account_verify == 'Verified'): ?>
                            <a class="nav-link nav-link-icon" href="#">
                                <i class="fas fa-user-check"></i>
                                <strong style="font-size:8px;">Verified</strong>
                            </a>
                        <?php else: ?>
                            <a class="nav-link nav-link-icon" data-toggle="dropdown" href="#"
                                aria-expanded="false">
                                <i class="fas fa-layer-group"></i>
                                <strong style="font-size:8px;">KYC</strong>
                            </a>
                            <div class="p-0 dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow">
                                <div class="p-2">
                                    <h5 class="mb-0 heading h6">KYC Verification</h5>
                                </div>
                                <div class="pb-2 mt-0 text-center list-group list-group-flush">
                                    <?php if(Auth::user()->account_verify == 'Under review'): ?>
                                        Your Submission is under review
                                    <?php else: ?>
                                        <div class="">
                                            <a href="<?php echo e(route('account.verify')); ?>"
                                                class="btn btn-primary btn-sm">Verify
                                                Account </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>

                <li class="nav-item dropdown dropdown-animate">
                    <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="avatar avatar-sm rounded-circle">
                            <i class="fas fa-user-circle fa-2x"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                        <h6 class="px-0 dropdown-header">Hola, <?php echo e(Auth::user()->name); ?>!</h6>
                        <a href="<?php echo e(route('profile')); ?>" class="dropdown-item">
                            <i class="far fa-user"></i>
                            <span>Mi Perfil</span>
                        </a>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item text-danger" href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="far fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Navbar nav -->
        <div class="collapse navbar-collapse navbar-collapse-fade" id="navbar-main-collapse">

            <!-- Right menu -->
            <ul class="navbar-nav ml-lg-auto align-items-center d-none d-lg-flex">
                <li class="nav-item">
                    <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin"
                        data-target="#sidenav-main"><i class="far fa-bars"></i></a>
                </li>

                <?php if($settings->enable_kyc == 'yes'): ?>
                    <li class="nav-item dropdown dropdown-animate">
                        <?php if(Auth::user()->account_verify == 'Verified'): ?>
                            <a class="nav-link nav-link-icon" href="#">
                                <i class="fas fa-user-check"></i>
                                <strong style="font-size:8px;">Verified</strong>
                            </a>
                        <?php else: ?>
                            <a class="nav-link nav-link-icon" data-toggle="dropdown" href="#"
                                aria-expanded="false">
                                <i class="fas fa-layer-group"></i>
                                <strong style="font-size:8px;">KYC</strong>
                            </a>
                            <div class="p-0 dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow">
                                <div class="p-2">
                                    <h5 class="mb-0 heading h6">KYC Verification</h5>
                                </div>
                                <div class="pb-2 mt-0 text-center list-group list-group-flush">
                                    <?php if(Auth::user()->account_verify == 'Under review'): ?>
                                        Your Submission is under review
                                    <?php else: ?>
                                        <div class="">
                                            <a href="<?php echo e(route('account.verify')); ?>"
                                                class="btn btn-primary btn-sm">Verify
                                                Account </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>

                <li class="nav-item dropdown dropdown-animate">
                    <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <div class="media media-pill align-items-center">
                            <span class="avatar rounded-circle">
                                <i class="fas fa-user-circle fa-2x"></i>
                            </span>
                            <div class="ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm font-weight-bold"><?php echo e(Auth::user()->name); ?></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                        <h6 class="px-0 dropdown-header">Hi, <?php echo e(Auth::user()->name); ?>!</h6>
                        <a href="<?php echo e(route('profile')); ?>" class="dropdown-item">
                            <i class="far fa-user"></i>
                            <span>Mi perfil</span>
                        </a>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item text-danger" href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="far fa-sign-out-alt"></i>
                            <span>Salir</span>
                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                            style="display: none;">
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH /home/nb9pvggwxcwi/public_html/ultra.multipagos.co/core/resources/views/purpose/user/topmenu.blade.php ENDPATH**/ ?>