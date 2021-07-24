<?php $__env->startSection('content'); ?>

<div class="slider-banner">
    <div class="swiper-wrapper">
        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide">

            <section class="banner-section gradient-bg-two bg_img"
            data-background="<?php echo e(get_image(config('constants.frontend.banner.path') .'/'. $slider->value->image)); ?>">
            <div class="banner-shape shape01"></div>
            <div class="banner-shape shape02"></div>
            <div class="banner-shape shape03"></div>
            <div class="banner-shape shape04"></div>
            <div class="container">
                <div class="banner-content text-center" style="margin: auto;">
                    <span class="banner-cate"><?php echo app('translator')->get($slider->value->subtitle); ?></span>
                    <h1 class="title"><?php echo app('translator')->get($slider->value->title); ?></h1>
                    <p><?php echo app('translator')->get($slider->value->details); ?></p>
                    <div class="banner-button justify-content-center">
                        <a href="<?php echo e(route('user.register')); ?>" class="custom-button"><?php echo app('translator')->get('Sign Up'); ?></a>
                        <a href="<?php echo e(route('user.login')); ?>" class="custom-button white"><?php echo app('translator')->get('Sign In'); ?></a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>


<section id="about" class="about-section padding-bottom padding-top bg_img"
data-background="./assets/images/shape/shape01.png"
data-paroller-factor=".5" data-paroller-type="background" data-paroller-direction="vertical">
<div class="container">
    <div class="about-wrapper">
        <div class="about-thumb">
            <div class="c-thumb">
                <img src="<?php echo e(get_image(config('constants.frontend.about.title.path') .'/'. $about->value->image)); ?>" alt="about">
            </div>
        </div>
        <div class="about-content">
            <div class="section-header left-style mw-620">
                <div class="left-side">
                    <h2 class="title"><?php echo app('translator')->get($about->value->title); ?></h2>
                </div>
                <div class="right-side">
                    <p><?php echo $about->value->detail; ?></p>
                </div>
            </div>

        </div>
    </div>
</div>
</section>

<section id="how-it-works" class="service-section padding-top padding-bottom bg-f8">
    <div class="container">
        <div class="section-header">
            <div class="left-side">
                <h2 class="title"><?php echo app('translator')->get($how_it_work_title->value->title); ?></h2>
            </div>
            <div class="right-side">
                <p><?php echo app('translator')->get($how_it_work_title->value->subtitle); ?></p>
            </div>
        </div>
        <div class="row justify-content-center mb-30-none">
            <?php $__currentLoopData = $how_it_work; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6 col-sm-10">
                <div class="service-item wow slideInUp">
                    <div class="service-thumb">
                        <?php echo $data->value->icon; ?>
                    </div>
                    <div class="service-content">
                        <h6 class="title"><?php echo app('translator')->get($data->value->title); ?></h6>
                        <p><?php echo app('translator')->get($data->value->sub_title); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
</section>
<section id="plan" class="pricing-section padding-bottom padding-top">
    <div class="container">
        <div class="section-header">
            <div class="left-side">
                <h2 class="title"><?php echo app('translator')->get($plan_title->value->title); ?></h2>
            </div>
            <div class="right-side">
                <p><?php echo app('translator')->get($plan_title->value->subtitle); ?></p>
            </div>
        </div>
        <div class="pricing-wrapper">
            <div class="row justify-content-center mb-30-none">
                <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 col-sm-10 col-lg-4">
                    <div class="ticket-item-three">
                        <div class="ticket-header">
                            <i class="flaticon-pig"></i>
                            <h5 class="subtitle"><?php echo app('translator')->get($data->name); ?></h5>
                            <h2 class="title"><?php echo e(__($data->price)); ?> <?php echo e($general->cur_text); ?></h2>
                        </div>
                        <div class="ticket-body">
                            <ul class="ticket-info">
                                <li>
                                 <h5 class="pt-2 choto"> <?php echo app('translator')->get('Direct Referral Bonus'); ?> :  <?php echo e($general->cur_sym); ?><?php echo e($data->ref_bonus); ?> </h5>
                                </li>
                                <?php $total = 0; ?>
                                <?php $__currentLoopData = $data->plan_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($key+1 <= $general->matrix_height): ?>
                                <li class="level-com">
                                    <strong>  <?php echo app('translator')->get('L'.$lv->level.''); ?>
                                        : <?php echo e($general->cur_sym); ?><?php echo e($lv->amount); ?>

                                        X <?php echo e(pow($general->matrix_width,$key+1)); ?>  <i class="fa fa-users"></i>
                                        =<span class="sec-colorsss"> <?php echo e($general->cur_sym); ?><?php echo e($lv->amount*pow($general->matrix_width,$key+1)); ?></span></strong>
                                    </li>
                                    <?php $total += $lv->amount*pow($general->matrix_width,$key+1); ?>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <li class="bgcolor">
                                        <h6 class="pt-2 pb-3 choto"> <?php echo app('translator')->get('Total Level Commission'); ?> : <?php echo e($total); ?> <?php echo e($general->cur_text); ?></h6>
                                    
                                        <?php
                                        $per = intval($total/$data->price*100);
                                        ?>

                                        <strong style="font-size: 14px;"><?php echo app('translator')->get('Returns'); ?>  <span class="sec-color"><?php echo e($per); ?>%</span> <?php echo app('translator')->get('of Invest'); ?></strong>
                                    </li>
                                </ul>
                                <div class="t-b-group d-flex justify-content-center">
                                    <a href="<?php echo e(route('user.plan.index')); ?>"
                                    class="custom-button transparent"><?php echo app('translator')->get('Subscribe Now'); ?></a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>
    <section class="service-section padding-top padding-bottom bg-f8">
        <div class="container">
            <div class="section-header">
                <div class="left-side">
                    <h2 class="title"><?php echo app('translator')->get($service_titles->value->title); ?></h2>
                </div>
                <div class="right-side">
                    <p><?php echo app('translator')->get($service_titles->value->subtitle); ?></p>
                </div>
            </div>
            <div class="row justify-content-center mb-30-none">
                <?php $__currentLoopData = $service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="service-item wow slideInUp">
                        <div class="service-thumb">
                            <?php echo $data->value->icon; ?>
                        </div>
                        <div class="service-content">
                            <h6 class="title"><?php echo app('translator')->get($data->value->title); ?></h6>
                            <p><?php echo app('translator')->get($data->value->sub_title); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
 <section class="testimonial-section padding-bottom padding-top ">
        <div class="container">
            <div class="section-header">
                <div class="left-side">
                    <h2 class="title"><?php echo app('translator')->get($testimonial_title->value->title); ?></h2>
                </div>
                <div class="right-side">
                    <p><?php echo app('translator')->get($testimonial_title->value->subtitle); ?> </p>
                </div>
            </div>
            <div class="client-slider-area-wrapper wow slideInUp">
                <div class="client-slider-area">
                    <div class="swiper-wrapper">
                        <?php $__currentLoopData = $testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="swiper-slide">
                            <div class="client-item">
                                <div class="client-quote">
                                    <i class="flaticon-left-quote-sketch"></i>
                                </div>
                                <p><?php echo app('translator')->get($data->value->quote); ?></p>
                                <div class="client">
                                    <div class="thumb">
                                        <a>
                                            <img src="<?php echo e(get_image(config('constants.frontend.testimonial.path') .'/'. $data->value->image)); ?>"
                                            alt="client">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h6 class="sub-title">
                                            <a><?php echo app('translator')->get($data->value->author); ?></a>
                                        </h6>
                                        <span><?php echo app('translator')->get($data->value->designation); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="consulting-section bg-theme">
        <div class="bg_img padding-top padding-bottom" data-paroller-factor=".5" data-paroller-type="background"
        data-paroller-direction="vertical"
        data-background="./assets/images/shape/shape03.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="c-thumb consult-thumb">
                        <img src="<?php echo e(get_image(config('constants.frontend.vid.post.path') .'/'. $video_section->value->image)); ?>"
                        alt="consult">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-header left-style">
                        <div class="left-side">
                            <h2 class="title"><?php echo app('translator')->get($video_section->value->title); ?></h2>
                        </div>
                        <div class="right-side">
                            <p><?php echo app('translator')->get($video_section->value->detail); ?></p>
                        </div>
                    </div>
                    <div class="video-group">
                        <a href="<?php echo e($video_section->value->link); ?>" data-rel="lightcase:myCollection"
                         class="video-button">
                         <i class="flaticon-play-button-1"></i>
                     </a>
                 </div>
             </div>
         </div>
     </div>
 </div>
</section>

<section class="blog-section padding-bottom padding-top">
    <div class="container">
        <div class="section-header">
            <div class="left-side">
                <h2 class="title"><?php echo e(__($blog_title->value->title)); ?></h2>
            </div>
            <div class="right-side">
                <p><?php echo e(__($blog_title->value->subtitle)); ?></p>
            </div>
        </div>
        <div class="row justify-content-center mb-30-none">
            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 col-xl-4 ">

                <div class="post-item  wow slideInUp">
                    <div class="post-thumb c-thumb">
                        <a href="<?php echo e(route('singleBlog', [slug($blog->value->title) , $blog->id])); ?>">
                            <img src="<?php echo e(get_image(config('constants.frontend.blog.post.path') .'/'. $blog->value->image)); ?>"
                            alt="blog">
                        </a>
                    </div>
                    <div class="post-content">
                        <div class="blog-header">
                            <h6 class="title">
                                <a href="<?php echo e(route('singleBlog', [slug($blog->value->title) , $blog->id])); ?>"><?php echo e(__($blog->value->title)); ?></a>
                            </h6>
                        </div>
                        <div class="meta-post">
                            <div class="date">
                                <a>
                                    <i class="flaticon-calendar"></i>
                                    <?php echo e(\Carbon\Carbon::parse($blog->created_at)->diffForHumans()); ?>

                                </a>
                            </div>
                        </div>
                        <div class="entry-content">
                            <p><?php echo e(\Illuminate\Support\Str::limit(strip_tags($blog->value->body), 160, '...')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(activeTemplate() .'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/templates/tmp2/home.blade.php ENDPATH**/ ?>