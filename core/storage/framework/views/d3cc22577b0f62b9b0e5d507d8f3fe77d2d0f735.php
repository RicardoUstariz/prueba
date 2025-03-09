<div>
    <?php if(Session::has('success')): ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-group alert-success alert-icon alert-dismissible fade show" role="alert">
                    <div class="alert-group-prepend">
                        <span class="alert-group-icon text-">
                            <i class="far fa-thumbs-up"></i>
                        </span>
                    </div>
                    <div class="alert-content">
                        <?php echo e(Session::get('success')); ?>

                    </div>
                    <?php if($settings->theme == 'millage'): ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    <?php else: ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH /home/nb9pvggwxcwi/public_html/ultra.multipagos.co/core/resources/views/components/success-alert.blade.php ENDPATH**/ ?>