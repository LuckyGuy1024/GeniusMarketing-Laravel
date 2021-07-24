<div class="navbar-menu-wrapper d-flex flex-row align-items-center bg-primary">
    <button class="navbar-toggler" type="button"> <i class="fa fa-ellipsis-v"></i></button>
    <div class="navbar-search ml-lg-4">
        <form class="navbar-search-form" onsubmit="return false;">
        <div class="input-group align-items-center">
            <div class="search-icon"><span class="fa fa-search"></span></div>
            <input type="search" name="navbar_search" id="navbar_search" placeholder="Search any settings" autocomplete="off">
        </div>
        <div id="navbar_search_result_area">
            <ul class="navbar_search_result"></ul>
        </div>
        </form>
    </div>

    <ul class="navbar-nav ml-auto flex-row">
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="userProfileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                
                
                <?php 
                
                $image="";
                /**
                <!--if(auth()->guard('admin')->user()->image) {-->
                <!--$image=auth()->guard('admin')->user()->image;-->
                
                <!--}-->
                **/
                ?>

                <img src="<?php echo e(get_image(config('constants.admin.profile.path') .'/'. $image)); ?>" alt="user-image">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userProfileDropdown">
                <a class="dropdown-item" href="<?php echo e(route('admin.profile')); ?>"><i class="fa fa-user"></i> Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(route('admin.logout')); ?>"><i class="fa fa-sign-out"></i>Logout</a>
            </div>
        </li>
    </ul>
</div><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/admin/partials/topnav.blade.php ENDPATH**/ ?>