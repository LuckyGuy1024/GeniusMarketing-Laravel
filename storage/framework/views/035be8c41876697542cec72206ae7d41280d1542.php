<?php if($general->alert == 1): ?> 
    <!-- iziToast -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/iziToast.min.css')); ?>">
    <script src="<?php echo e(asset('assets/admin/js/iziToast.min.js')); ?>"></script>

    <?php if(session()->has('notify')): ?>
      <?php $__currentLoopData = session('notify'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script type="text/javascript">  iziToast.<?php echo e($msg[0]); ?>({message:"<?php echo e($msg[1]); ?>", position: "topRight"}); </script>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <script>

        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            iziToast.error({
                message: '<?php echo e($error); ?>',
            position: "topRight"
            });
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>

    <?php endif; ?>
  

<?php elseif($general->alert == 2): ?>
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/toastr.min.css')); ?>">
    <script src="<?php echo e(asset('assets/admin/js/toastr.min.js')); ?>"></script>
    <?php if(session()->has('notify')): ?>
    <?php $__currentLoopData = session('notify'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <script type="text/javascript">  toastr.<?php echo e($msg[0]); ?>("<?php echo e($msg[1]); ?>"); </script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    
    <?php if($errors->any()): ?>
        <script>

        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        toastr.error('<?php echo e($error); ?>');
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>

    <?php endif; ?>
    
<?php endif; ?>
<?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/partials/notify.blade.php ENDPATH**/ ?>