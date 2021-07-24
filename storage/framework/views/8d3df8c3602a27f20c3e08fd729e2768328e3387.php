<?php $__env->startSection('panel'); ?>
<div id="wrapper">
  <?php echo $__env->make(activeTemplate().'partials.sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make(activeTemplate().'partials.topnav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="clearfix"></div>
  <div class="content-wrapper">
  <div class="container-fluid">
          
  <?php echo $__env->yieldContent('content'); ?>
  <!--start overlay-->
  <div class="overlay toggle-menu"></div>
  <!--end overlay-->
  </div>
  <!-- End container-fluid-->

  </div><!--End content-wrapper-->
  <!--Start Back To Top Button-->
  <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
  <!--End Back To Top Button-->

  <!--Start footer-->
  <footer class="footer"></footer>
  <!--End footer-->
            
</div><!--End wrapper-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make(activeTemplate().'layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/templates/tmp2/layouts/app.blade.php ENDPATH**/ ?>