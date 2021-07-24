<?php $__env->startSection('content'); ?>
    <div class="main-container">
        <div class="container-fluid main-body-wrapper">

            <?php echo $__env->make('admin.partials.sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="main-panel-wrapper">

                <?php echo $__env->make('admin.partials.topnav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php echo $__env->make('admin.partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="content-wrapper">
                    <div class="container-fluid p-0">

                        <?php echo $__env->yieldContent('panel'); ?>

                    </div>
                </div>
                <footer class="footer"></footer>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>