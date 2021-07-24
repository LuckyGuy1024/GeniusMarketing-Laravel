<?php $__env->startSection('content'); ?>
<div class="signin-section pt-5" style="background-image: url('./assets/images/login.png');">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
        <div class="col-xl-4 col-md-6 col-sm-8">
            <div class="login-area">
                <div class="login-header-wrapper text-center">
                   <a href="<?php echo e(url('/')); ?>"> <img class="logo" src="<?php echo e(get_image(config('constants.logoIcon.path') .'/logo.png')); ?>" alt="image"> </a>
                    <p class="text-center admin-brand-text">Admin Pannel</p>
                </div>
                <form action="<?php echo e(route('admin.login')); ?>" method="POST" class="login-form">
                    <?php echo csrf_field(); ?>
                    <div class="login-inner-block">
                        <div class="frm-grp">
                            <label>Username</label>
                            <input type="text" name="username" value="<?php echo e(old('username')); ?>" placeholder="Enter your username">
                        </div>
                        <div class="frm-grp">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Enter your password">
                        </div>
                    </div>
                    <div class="d-flex mt-3 justify-content-between">
                        <div class="frm-group">
                            <input type="checkbox" name="remember" id="checkbox">
                            <label for="checkbox">Remember Me</label>
                        </div>
                        <a href="<?php echo e(route('admin.password.reset')); ?>" class="forget-pass">Forget password?</a>
                    </div>
                    <div class="btn-area text-center">
                    <button type="submit" class="submit-btn">Login now</button>
                    </div>
                </form>
            </div>
        </div>
        
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style-lib'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/signin.css')); ?>">
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/admin/auth/login.blade.php ENDPATH**/ ?>