<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="shortcut icon" href="<?php echo e(get_image(config('constants.logoIcon.path') .'/favicon.png')); ?>"
          type="image/x-icon">

    <title><?php echo e($general->sitename(__($page_title))); ?> </title>


    <link rel="stylesheet" href="<?php echo e(asset(activeTemplate(true) .'front/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset(activeTemplate(true) .'front/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset(activeTemplate(true) .'front/css/animate.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset(activeTemplate(true) .'front/css/flaticon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset(activeTemplate(true) .'front/css/lightcase.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset(activeTemplate(true) .'front/css/odometer.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset(activeTemplate(true) .'front/css/swiper.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset(activeTemplate(true) .'front/css/nice-select.css')); ?>">


    <link rel="stylesheet" href="<?php echo e(asset(activeTemplate(true) .'front/css/iziToast.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset(activeTemplate(true) .'front/css/main.css')); ?>">


    <?php echo $__env->yieldContent('style'); ?>

    <?php echo $__env->make('partials.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('css'); ?>

    <?php echo $general->chat_script; ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"/>

    <link rel="stylesheet"
          href='<?php echo e(asset(activeTemplate(true) . "front/css/color.php?color=$general->bclr&color2=$general->sclr")); ?>'>


</head>


<body>

<div class="preloader">
    <div class="preloader-inner">
        <div class="preloader-icon">
            <span></span>
            <span></span>
        </div>
    </div>
</div>

<div class="overlay"></div>
<a href="#0" class="scrollToTop">
    <i class="fas fa-angle-up"></i>
</a>

<header>
    <div class="header-section">
        <div class="container">
            <div class="header-area">
                <div class="logo">
                    <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(get_image(config('constants.logoIcon.path') .'/logo.png')); ?>"
                                                alt="logo"></a>
                </div>
                <ul class="menu">

                    <li>
                        <a href="<?php echo e(url('/')); ?>"><?php echo app('translator')->get('Home'); ?></a>
                    </li>

                    <li><a <?php if(request()->path() == '/'): ?> href="#about"
                           <?php else: ?> href="<?php echo e(url('/')); ?>#about" <?php endif; ?>><?php echo app('translator')->get('About'); ?></a></li>

                    <li><a <?php if(request()->path() == '/'): ?> href="#how-it-works"
                           <?php else: ?> href="<?php echo e(url('/')); ?>#how-it-works" <?php endif; ?>><?php echo app('translator')->get('How It Works'); ?></a></li>

                    <li><a <?php if(request()->path() == '/'): ?> href="#plan"
                           <?php else: ?> href="<?php echo e(url('/')); ?>#plan" <?php endif; ?>><?php echo app('translator')->get('Plan'); ?></a></li>
                    <li>
                        <a href="<?php echo e(route('faq')); ?>"><?php echo app('translator')->get('Faq'); ?></a>
                    </li>

                    <li>
                        <a href="<?php echo e(route('blog')); ?>"><?php echo app('translator')->get('News'); ?></a>
                    </li>

                    <li>
                        <a href="<?php echo e(route('contact')); ?>"><?php echo app('translator')->get('Contact'); ?></a>
                    </li>

                    <select id="langSel" class="select-bar">
                        <option style="color: black" value="en"><?php echo app('translator')->get('English'); ?></option>
                        <?php $__currentLoopData = $lang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e(strtolower($data->code)); ?>"
                                    <?php if(Session::get('lang') == strtolower($data->code)): ?> selected="selected"
                                    <?php endif; ?> style="color: black"> <?php echo e(strtoupper($data->name)); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <li>
                        <a href="<?php echo e(route('user.login')); ?>" class="header-button custom-button white"><?php echo app('translator')->get('Sign In'); ?></a>
                    </li>
                </ul>
                <div class="header-bar d-lg-none">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <form class="search-form">
                    <div class="form-group m-0">
                        <input type="text" placeholder="Search Here">
                        <button type="submit">
                            <i class="flaticon-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="header-fix w-100"></div>

</header>



    <?php echo $__env->yieldContent('content'); ?>



<footer class="dark-bg bg_img" data-paroller-factor="0.5" data-paroller-type="background"
        data-paroller-direction="vertical" data-background="./assets/images/shape/shape04.png">
    <div class="footer-top padding-top padding-bottom">
        <div class="container">
            <div class="row mb-50-none justify-content-center">
                <div class="col-sm-6 col-lg-8 ">
                    <div class="footer-widget widget-about ">
                        <div class="logo">
                            <a href="<?php echo e(url('/')); ?>"><img
                                        src="<?php echo e(get_image(config('constants.logoIcon.path') .'/logo.png')); ?>" alt="logo">
                            </a>
                        </div>
                        <div class="content text-center">
                            <p><?php echo e(__($footer->subtitle)); ?></p>
                            <ul class="social-icons-area">
                                <?php $__currentLoopData = $social; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li>
                                            <a href="<?php echo e($item->value->url); ?>"
                                               title="<?php echo e($item->value->title); ?>"><?php echo $item->value->icon; ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="footer-bottom text-center">
        <div class="container">
            <p class="m-0"> <?php echo e(__($footer->title)); ?></p>
        </div>
    </div>
    <div class="right banner-shape shape04"></div>
</footer>


<script src="<?php echo e(asset(activeTemplate(true) .'front/js/jquery-3.3.1.min.js')); ?>"></script>
<script src="<?php echo e(asset(activeTemplate(true) .'front/js/modernizr-3.6.0.min.js')); ?>"></script>
<script src="<?php echo e(asset(activeTemplate(true) .'front/js/plugins.js')); ?>"></script>
<script src="<?php echo e(asset(activeTemplate(true) .'front/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset(activeTemplate(true) .'front/js/isotope.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset(activeTemplate(true) .'front/js/lightcase.js')); ?>"></script>
<script src="<?php echo e(asset(activeTemplate(true) .'front/js/swiper.min.js')); ?>"></script>
<script src="<?php echo e(asset(activeTemplate(true) .'front/js/wow.min.js')); ?>"></script>
<script src="<?php echo e(asset(activeTemplate(true) .'front/js/odometer.min.js')); ?>"></script>
<script src="<?php echo e(asset(activeTemplate(true) .'front/js/viewport.jquery.js')); ?>"></script>
<script src="<?php echo e(asset(activeTemplate(true) .'front/js/nice-select.js')); ?>"></script>
<script src="<?php echo e(asset(activeTemplate(true) .'front/js/paroller.js')); ?>"></script>
<script src="<?php echo e(asset(activeTemplate(true) .'front/js/main.js')); ?>"></script>


<script src="<?php echo e(asset(activeTemplate(true) .'front/js/iziToast.min.js')); ?>"></script>


<script src="<?php echo e(asset(activeTemplate(true) .'front/vue/vue-handle-error.js')); ?>"></script>
<script src="<?php echo e(asset(activeTemplate(true) .'front/vue/vue.js')); ?>"></script>
<script src="<?php echo e(asset(activeTemplate(true) .'front/vue/axios.js')); ?>"></script>


<?php echo $__env->make('partials.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldContent('js'); ?>

<?php echo $__env->yieldPushContent('js'); ?>

<?php echo $__env->yieldContent('script'); ?>

<script>
    $(document).on('change', '#langSel', function () {
        var code = $(this).val();
        window.location.href = "<?php echo e(url('/')); ?>/change-lang/" + code;
    });
</script>

</body>
</html>


<?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/templates/tmp2/layouts/master.blade.php ENDPATH**/ ?>