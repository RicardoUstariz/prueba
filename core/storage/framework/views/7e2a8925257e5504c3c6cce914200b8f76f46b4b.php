<div class="card" style="min-height: 100vh;">
    <div class="card-body">
        <div class="card-title">Transacciones</div>
        <div class="card-list" wire:poll.500ms>

            <div class="card-title">Depositos</div>

            <?php $__currentLoopData = $deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <a href="<?php echo e(route('updatestatusdeposit', $deposit['deposit']['id'])); ?>">
                    <div class="item-list shadow-sm d-flex"
                        style="border: 2px solid #a3f3ff; border-radius: 5px; margin-bottom: 15px;">
                        <div class="info-user ml-3 text-decoration-none" style="display: flex; flex-direction: row;">
                            <?php if($deposit['deposit']['payment_mode'] == 'Bancolombia'): ?>

                                <img src="<?php echo e(asset('assets/img/bancolombialogo.png')); ?>"
                                    style="width: 60px; display: inline-block; margin-right: 10px; border: 2px solid #a3f3ff; border-radius: 5px;" />
                            <?php elseif($deposit['deposit']['payment_mode'] == 'Daviplata'): ?>

                                <img src="<?php echo e(asset('assets/img/logodaviplata.png')); ?>"
                                    style="width: 60px; display: inline-block; margin-right: 10px; border: 2px solid #a3f3ff; border-radius: 5px;" />
                            <?php elseif($deposit['deposit']['payment_mode'] == 'Nequi'): ?>

                                <img src="<?php echo e(asset('assets/img/nequilogo.png')); ?>"
                                    style="width: 60px; display: inline-block; margin-right: 10px; border: 2px solid #a3f3ff; border-radius: 5px;" />
                            <?php endif; ?>

                            <div>
                                <div class="username font-weight-bolder"><?php echo e($deposit['user']['name']); ?></div>
                                <div class="username">$<?php echo e($deposit['deposit']['amount']); ?></div>
                                <div class="status"><?php echo e($deposit['deposit']['status']); ?></div>
                            </div>
                        </div>
                        <div style="padding-right: 10px;">
                            <i class="fa fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
                <script>
                    playSound();
                </script>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <hr />

            <div class="card-title">Retiros</div>

            <?php $__currentLoopData = $withdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdrawal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <a href="<?php echo e(route('updatestatuswithdrawal', $withdrawal['withdrawal']['id'])); ?>">
                    <div class="item-list shadow-sm d-flex"
                        style="border: 2px solid #a3f3ff; border-radius: 5px; margin-bottom: 15px;">
                        <div class="info-user ml-3 text-decoration-none" style="display: flex; flex-direction: row;">

                            <?php if($withdrawal['withdrawal']['payment_mode'] == 'Bancolombia'): ?>

                                <img src="<?php echo e(asset('assets/img/bancolombialogo.png')); ?>"
                                    style="width: 60px; display: inline-block; margin-right: 10px; border: 2px solid #a3f3ff; border-radius: 5px;" />
                            <?php elseif($withdrawal['withdrawal']['payment_mode'] == 'Daviplata'): ?>

                                <img src="<?php echo e(asset('assets/img/logodaviplata.png')); ?>"
                                    style="width: 60px; display: inline-block; margin-right: 10px; border: 2px solid #a3f3ff; border-radius: 5px;" />
                            <?php elseif($withdrawal['withdrawal']['payment_mode'] == 'Nequi'): ?>

                                <img src="<?php echo e(asset('assets/img/nequilogo.png')); ?>"
                                    style="width: 60px; display: inline-block; margin-right: 10px; border: 2px solid #a3f3ff; border-radius: 5px;" />
                            <?php endif; ?>

                            <div>
                                <div class="username font-weight-bolder"><?php echo e($withdrawal['user']['name']); ?></div>
                                <div class="username">$<?php echo e($withdrawal['withdrawal']['amount']); ?></div>
                                <div class="status"><?php echo e($withdrawal['withdrawal']['status']); ?></div>
                            </div>
                        </div>
                        <div style="padding-right: 10px;">
                            <i class="fa fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
                <script>
                    playSound();
                </script>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
</div><?php /**PATH /home/nb9pvggwxcwi/public_html/ultra.multipagos.co/core/resources/views/livewire/notificaciones.blade.php ENDPATH**/ ?>