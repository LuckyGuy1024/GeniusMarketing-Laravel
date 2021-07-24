<?php if(!empty($seo)): ?> 
    <meta name="title" Content="<?php echo e($general->sitename($page_title)); ?>">
    <meta name="description" content="<?php echo e($seo->description); ?>">
    <meta name="keywords" content="<?php echo e(implode(',',$seo->keywords)); ?>">
    <!-- Apple Stuff -->
    <link rel="apple-touch-icon" href="<?php echo e(get_image(config('constants.logoIcon.path')) .'/logo.png'); ?>">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="<?php echo e($general->sitename($page_title)); ?>">
    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="<?php echo e($general->sitename($page_title)); ?>">
    <meta itemprop="description" content="<?php echo e($general->seo_description); ?>">
    <meta itemprop="image" content="<?php echo e(get_image(config('constants.seo.path')) .'/'. $seo->image); ?>">
    <!-- Facebook Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo e($seo->social_title); ?>">
    <meta property="og:description" content="<?php echo e($seo->social_description); ?>">
    <meta property="og:fbimage" content="<?php echo e(get_image(config('constants.seo.path')) .'/'. $seo->image); ?>"/>
    <meta property="og:image:type" content="image/<?php echo e(pathinfo(get_image(config('constants.seo.path')) .'/'. $seo->image)['extension']); ?>" />
    <?php $social_image_size = explode('x', config('constants.seo.size')) ?>
    <meta property="og:image:width" content="<?php echo e($social_image_size[0]); ?>" />
    <meta property="og:image:height" content="<?php echo e($social_image_size[1]); ?>" />
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
<?php endif; ?>

<?php echo $__env->yieldPushContent('image'); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/partials/seo.blade.php ENDPATH**/ ?>