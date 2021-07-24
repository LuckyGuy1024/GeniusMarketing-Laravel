<?php $__env->startSection('content'); ?>
    <?php echo $__env->make(activeTemplate() .'layouts.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="faq-section padding-bottom padding-top">
        <div class="container">
            <div class="faq-wrapper-two">
                <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="faq-item-two">
                    <div class="icon">
                        <i class="flaticon-discuss-issue"></i>
                    </div>
                    <div class="faq-content">
                        <h6 class="title"><?php echo app('translator')->get($data->value->title); ?></h6>
                        <p>
                            <?php echo $data->value->body; ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(activeTemplate() .'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/templates/tmp2/faq.blade.php ENDPATH**/ ?>