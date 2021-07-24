<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e($general->sitename($page_title ?? '')); ?></title>
    <link rel="shortcut icon" type="image/png"
          href="<?php echo e(get_image(config('constants.logoIcon.path') .'/favicon.png')); ?>"/>
    <?php echo $__env->yieldPushContent('style-lib'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/dashboard.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/custom.css')); ?>">
    <!-- date picker css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/datepicker/css/datepicker.css')); ?>">
    <!-- date picker ends here -->
    <script src="<?php echo e(asset('assets/jquery/jquery.min.js')); ?>"></script>
       <!-- <link href='datepicker/css/datepicker.css' rel='stylesheet'> -->

    <?php echo $__env->yieldPushContent('style'); ?>
</head>
<body>
<?php echo $__env->yieldContent('content'); ?>

<script src="<?php echo e(asset('assets/admin/js/dashboard.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/main.js')); ?>"></script>
<?php echo $__env->yieldPushContent('script-lib'); ?>

<!-- Load toast -->
<?php echo $__env->make('admin.partials.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script src="<?php echo e(asset('assets/admin/js/nicEdit.js')); ?>"></script>

<script type="text/javascript">
    bkLib.onDomLoaded(function () {
        $(".nicEdit").each(function (index) {
            $(this).attr("id", "nicEditor" + index);
            new nicEditor({fullPanel: true}).panelInstance('nicEditor' + index, {hasPanel: true});
        });
    });
</script>

<script>$('[data-toggle=tooltip]').tooltip();</script>


<!-- date picker start here -->
<script src="<?php echo e(asset('assets/datepicker/js/bootstrap-datepicker2.js')); ?>"></script>
<script src="<?php echo e(asset('assets/print/print.js')); ?>"></script>
     <script type="text/javascript">
            $(document).ready(function (e) {
                // alert("done");
                //$('[data-toggle=confirmation]').confirmation();
                $.fn.datepicker.defaults.format = "yyyy-mm-dd";

                var today = new Date();

                var day = today.getDate();
                var month = today.getMonth() + 1;
                var year = today.getFullYear();

                if (day < 10) {
                    day = "0" + day;
                }

                if (month < 10) {
                    month = "0" + month;
                }

                var current_date = year + "-" + month + "-" + day;

                $("#current_date").val(current_date);

            });

            $(function () {
                $('#current_date').datepicker({

                    autoclose: true,

                });
            });


        </script>
<!-- date picker ends here -->


<?php echo $__env->yieldPushContent('script'); ?>
</body>
</html><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/admin/layouts/master.blade.php ENDPATH**/ ?>