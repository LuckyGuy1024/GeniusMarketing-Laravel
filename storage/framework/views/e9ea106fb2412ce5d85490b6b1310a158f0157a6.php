<?php $__env->startSection('content'); ?>
<section class="error-section">
    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-8 content text-center">
        <img src="<?php echo e(asset('assets/images/error-404.png')); ?>" alt="error-image">
        <h2 class="font-large title">404</h2>
        <span class="sub-title">Page not found</span>
        <a href="<?php echo e(url('/')); ?>" class="btn btn-primary btn-lg mt-3">Got back to home</a>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/errors/404.blade.php ENDPATH**/ ?>