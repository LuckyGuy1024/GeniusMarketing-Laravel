<?php $__env->startSection('content'); ?>
    <?php echo $__env->make(activeTemplate() .'layouts.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



    <section class="contact-section padding-bottom padding-top">
        <div class="container">
            <div class="contact-wrapper padding-bottom padding-top">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-info bg_img" >
                            <h4 class="title"><?php echo app('translator')->get('Contact Info'); ?></h4>
                            <div class="item-info">
                                <div class="icon">
                                    <i class="flaticon-pin"></i>
                                </div>
                                <div class="content">
                                    <h6 class="sub-title"><?php echo app('translator')->get('address'); ?></h6>
                                    <ul>
                                        <li><?php echo e($general->contact_address); ?></li>

                                    </ul>
                                </div>
                            </div>
                            <div class="item-info">
                                <div class="icon">
                                    <i class="flaticon-mail"></i>
                                </div>
                                <div class="content">
                                    <h6 class="sub-title"><?php echo app('translator')->get('email address'); ?></h6>
                                    <ul>

                                        <li>
                                            <a href="<?php echo e($general->contact_email); ?>"><?php echo e($general->contact_email); ?></a>
                                        </li>


                                    </ul>
                                </div>
                            </div>
                            <div class="item-info">
                                <div class="icon">
                                    <i class="flaticon-telephone"></i>
                                </div>
                                <div class="content">
                                    <h6 class="sub-title"><?php echo app('translator')->get('phone number'); ?></h6>
                                    <ul>
                                        <li>
                                            <a href="Tel:<?php echo e($general->contact_phone); ?>"><?php echo e($general->contact_phone); ?></a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-area">
                            <h2 class="title"><?php echo app('translator')->get('Get In Touch'); ?></h2>

                                <form class="contact-form-dynamic" action="<?php echo e(route('send.mail.contact')); ?>" method="post">
                                    <?php echo csrf_field(); ?>


                                <div class="form-group">
                                    <input type="text" placeholder="<?php echo app('translator')->get('Your Name'); ?>" value="<?php echo e(old('name')); ?>" name="name" id="name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" placeholder="<?php echo app('translator')->get('Your Email'); ?>" value="<?php echo e(old('email')); ?>" name="email" id="email" required>
                                </div>



                                <div class="form-group">
                                    <textarea placeholder="<?php echo app('translator')->get('Type Message'); ?>" name="message"  id="message" required><?php echo e(old('message')); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="<?php echo app('translator')->get('send message'); ?>">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





<?php $__env->stopSection(); ?>
<?php echo $__env->make(activeTemplate() .'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/templates/tmp2/contact.blade.php ENDPATH**/ ?>