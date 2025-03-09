<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.danger-alert','data' => []]); ?>
<?php $component->withName('danger-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.success-alert','data' => []]); ?>
<?php $component->withName('success-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.error-alert','data' => []]); ?>
<?php $component->withName('error-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-5 row">
                        <div class="col-lg-8 offset-lg-2 col-sm-12">
                            <div class="p-3 text-center">
                                <h2 class="">Begin your ID-Verification</h2>
                                <p>To comply with regulation each participant will have to go through indentity verification
                                    (KYC/AML) to prevent fraud causes.</p>
                            </div>
                            <div class="p-2 shadow-lg">
                                <div class="p-4 row">
                                    <form action="<?php echo e(route('kycsubmit')); ?>" method="POST" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="col-12 border-bottom">
                                            <h5>Personal Details</h5>
                                            <p>Your simple personal information required for identification</p>
                                        </div>
                                        <div class="col-12">
                                            <small>Please type carefully and fill out the form with your personal details.
                                                Your
                                                can’t edit these details once you submitted the form.</small>
                                        </div>
                                        <div class="mt-4 col-12">
                                            <div class="row">
                                                <div class="mb-2 col-md-6">
                                                    <label for="firstname">First name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="first_name" class="form-control" required>
                                                </div>
                                                <div class="mb-2 col-md-6">
                                                    <label for="lastname">Last name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="last_name" class="form-control" required>
                                                </div>
                                                <div class="mb-2 col-md-6">
                                                    <label for="email">Email <span class="text-danger">*</span></label>
                                                    <input type="email" name="email" class="form-control" required>
                                                </div>
                                                <div class="mb-2 col-md-6">
                                                    <label for="phone_number">Phone Number <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="phone_number" class="form-control" required>
                                                </div>
                                                <div class="mb-2 col-md-6">
                                                    <label for="dob">Date of birth <span
                                                            class="text-danger">*</span></label>
                                                    <input type="date" name="dob" class="form-control"
                                                        data-toggle="date" placeholder="Select date" required>
                                                </div>
                                                <div class="mb-2 col-md-6">
                                                    <label for="social_media">Twitter or Facebook username</label>
                                                    <input type="text" name="social_media" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pt-3 mt-3 col-12 border-bottom border-top">
                                            <h5>Your Address</h5>
                                            <p>Your simple location information required for identification</p>
                                        </div>
                                        <div class="mt-4 col-12">
                                            <div class="row">
                                                <div class="mb-2 col-md-6">
                                                    <label for="address">Address line<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="address" class="form-control" required>
                                                </div>
                                                <div class="mb-2 col-md-6">
                                                    <label for="city">City<span class="text-danger">*</span></label>
                                                    <input type="text" name="city" class="form-control" required>
                                                </div>
                                                <div class="mb-2 col-md-6">
                                                    <label for="state">State<span class="text-danger">*</span></label>
                                                    <input type="text" name="state" class="form-control" required>
                                                </div>
                                                <div class="mb-2 col-md-6">
                                                    <label for="country">Nationality <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="country" class="form-control" required>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="pt-3 mt-3 col-12 border-bottom border-top">
                                            <h5>Document Upload</h5>
                                            <p>Your simple personal document required for identification</p>
                                        </div>
                                        <div class="mt-4 col-12">
                                            <div class="row">
                                                <div class="mb-2 col-md-12">
                                                    <div class="flex-wrap btn-group-toggle d-flex justify-content-around"
                                                        data-toggle="buttons">
                                                        <label class="mb-2 shadow-sm btn btn-primary active">
                                                            <i class="fas fa-atlas"></i>
                                                            <input type="radio" name="document_type"
                                                                value="Int'l Passport" autocomplete="off" checked> Int'l
                                                            Passport
                                                        </label>
                                                        <label class="mb-2 shadow-sm btn btn-primary">
                                                            <i class="fas fa-flag"></i>
                                                            <input type="radio" name="document_type" value="National ID"
                                                                autocomplete="off"> National ID
                                                        </label>
                                                        <label class="mb-2 shadow-sm btn btn-primary">
                                                            <i class="fas fa-address-card"></i>
                                                            <input type="radio" name="document_type"
                                                                value="Drivers License" autocomplete="off"> Drivers
                                                            License
                                                        </label>
                                                    </div>
                                                    <div class="mt-4">
                                                        <h6 class=" font-weight-bold">To avoid delays when verifying
                                                            account, Please make sure your document meets the criteria
                                                            below:</h6>
                                                        <ul class=" list-group">
                                                            <li>
                                                                <i class="fas fa-check-square text-primary"></i>
                                                                Chosen credential must not have expired.
                                                            </li>
                                                            <li>
                                                                <i class="fas fa-check-square text-primary"></i>
                                                                Document should be in good condition and clearly visible.
                                                            </li>
                                                            <li>
                                                                <i class="fas fa-check-square text-primary"></i>
                                                                Make sure that there is no light glare on the document.
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <p class="mt-3 text-black h6">Upload front side <span
                                                            class="text-danger">*</span></p>
                                                    <div class="mt-3 align-items-center justify-content-around d-md-flex">
                                                        <div class="p-2 border p-md-5 ">
                                                            <div class="custom-file">
                                                                <input type="file" name="frontimg"
                                                                    class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="text-center">
                                                            <i class="fas fa-id-card fa-6x"></i>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <p class="mt-3 text-black h6">Upload back side <span
                                                            class="text-danger">*</span></p>
                                                    <div class="mt-3 align-items-center justify-content-around d-md-flex">
                                                        <div class="p-2 border p-md-5 ">
                                                            <div class="custom-file">
                                                                <input type="file" name="backimg" class="form-control"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="text-center">
                                                            <i class="fas fa-credit-card-blank fa-6x"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3 col-12">
                                            <div class="mb-2 form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="defaultCheck1" required>
                                                <label class="form-check-label" for="defaultCheck1">
                                                    All The Information I Have Entered Is Correct.
                                                </label>
                                            </div>
                                            <?php if(Auth::user()->account_verify == 'Under review'): ?>
                                                <button type="submit" class="px-4 btn btn-primary d-block"
                                                    disabled>Submit Application</button>
                                                <small class="text-success">Your previous application is under review,
                                                    please wait</small>
                                            <?php else: ?>
                                                <button type="submit" class="px-4 btn btn-primary">Submit
                                                    Application</button>
                                            <?php endif; ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nb9pvggwxcwi/public_html/ultra.multipagos.co/core/resources/views/purpose/user/verification.blade.php ENDPATH**/ ?>