<!--Start sidebar-wrapper-->
<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
      <a href="<?php echo e(route('user.home')); ?>">
        <span class="logo-one"><img src="<?php echo e(get_image(config('constants.logoIcon.path') .'/logo.png')); ?>"
          alt="logo-image"/></span>
      </a>
    </div>
  <ul class="sidebar-menu do-nicescrol">
     <li class="nav-item <?php echo e(sidenav_active('user.home')); ?>">
       <a href="<?php echo e(route('user.home')); ?>">
         <i class="fa fa-th-large text-facebook"></i> <span><?php echo app('translator')->get('Dashboard'); ?></span>
       </a>
     </li>

     <li class="nav-item <?php echo e(sidenav_active('user.kyc')); ?>">
       <a href="<?php echo e(route('user.kyc')); ?>">
         <i class="fa fa-book text-facebook"></i> <span><?php echo app('translator')->get('KYC'); ?></span>
       </a>
     </li>

     <li class="nav-item <?php echo e(sidenav_active('user.roi')); ?>">
       <a href="<?php echo e(route('user.roi')); ?>">
         <i class="fa fa-book text-facebook"></i> <span><?php echo app('translator')->get('ROI'); ?></span>
       </a>
     </li>

     <li class="nav-item deposit-withdraw <?php echo e(sidenav_active('user.deposit*')); ?>" id="deposit" >
          <a href="javascript:void();" class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" >
              <span class="menu-icon"><i class="fa fa-credit-card text-primary"></i></span>
              <span class="menu-title"><?php echo app('translator')->get('Deposit'); ?></span>
              <span class="menu-arrow"><i class="fa fa-chevron-right"></i></span>
          </a>
          <ul class="deposit-menu">
              <li class="dropdown-item <?php echo e(sidenav_active('user.deposit')); ?>">
                  <a class="nav-link" href="<?php echo e(route('user.deposit')); ?>">
                      <span class="menu-title"><?php echo app('translator')->get('Deposit Now'); ?></span>
                  </a>
              </li>
              <li class="dropdown-item <?php echo e(sidenav_active('user.deposit.history')); ?>">
                  <a class="nav-link" href="<?php echo e(route('user.deposit.history')); ?>">
                      <span class="menu-title"><?php echo app('translator')->get('Deposit History'); ?></span>
                  </a>
              </li>
          </ul>
      </li>

      <!-- if(auth()->user()->plan_id == 0) -->

     <li class="nav-item <?php echo e(sidenav_active('user.plan.index')); ?>">
       <a href="<?php echo e(route('user.plan.index')); ?>" class="nav-link">
         <i class="fa fa-lightbulb-o text-facebook"></i> <span><?php echo app('translator')->get('Subscribe Plan'); ?></span>
       </a>
     </li>

     <!-- endif -->

      <li class="nav-item deposit-withdraw <?php echo e(sidenav_active('user.withdraw*')); ?>" id="withdraw">
          <a href="javascript:void();" class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" >
              <span class="menu-icon"><i class="fa fa-credit-card text-primary"></i></span>
              <span class="menu-title"><?php echo app('translator')->get('Withdraw'); ?></span>
              <span class="menu-arrow"><i class="fa fa-chevron-right"></i></span>
          </a>
          <ul class="withdraw-menu">
              <li class="dropdown-item <?php echo e(sidenav_active('user.withdraw')); ?>">
                  <a class="nav-link" href="<?php echo e(route('user.withdraw')); ?>">
                      <span class="menu-title"><?php echo app('translator')->get('Withdraw Now'); ?></span>
                  </a>
              </li>
              <li class="dropdown-item <?php echo e(sidenav_active('user.withdraw.history')); ?>">
                  <a class="nav-link" href="<?php echo e(route('user.withdraw.history')); ?>">
                      <span class="menu-title"><?php echo app('translator')->get('Withdraw History'); ?></span>
                  </a>
              </li>
          </ul>
      </li>

      <li class="nav-item <?php echo e(sidenav_active('user.pin.recharge')); ?>">
        <a href="<?php echo e(route('user.pin.recharge')); ?>" class="nav-link">
            <span class="menu-icon"><i class="fa fa-credit-card text-facebook"></i></span>
            <span class="menu-title"><?php echo app('translator')->get('E-Pin Recharge'); ?></span>
        </a>
    </li>


    <li class="nav-item <?php echo e(sidenav_active('user.balance.transfer')); ?>">
        <a href="<?php echo e(route('user.balance.transfer')); ?>" class="nav-link">
            <span class="menu-icon"><i class="fa fa-exchange text-facebook"></i></span>
            <span class="menu-title"><?php echo app('translator')->get('Transfer Balance'); ?></span>
        </a>
    </li>
    <li class="nav-item <?php echo e(sidenav_active('user.matrix*')); ?>">
        <a href="<?php echo e(route('user.matrix.index',['lv_no' => 1])); ?>" class="nav-link">
            <span class="menu-icon"><i class="fa fa-sitemap text-facebook"></i></span>
            <span class="menu-title"><?php echo app('translator')->get('My Matrix'); ?></span>
        </a>
    </li>
    <li class="nav-item <?php echo e(sidenav_active('user.ref.index')); ?>">
        <a href="<?php echo e(route('user.ref.index')); ?>" class="nav-link">
            <span class="menu-icon"><i class="fa fa-users text-facebook"></i></span>
            <span class="menu-title"><?php echo app('translator')->get('My Referral'); ?></span>
        </a>
    </li>
    <li class="nav-item <?php echo e(sidenav_active('user.transaction.index')); ?>">
        <a href="<?php echo e(route('user.transaction.index')); ?>" class="nav-link">
            <span class="menu-icon"><i class="fa fa-money text-facebook"></i></span>
            <span class="menu-title"><?php echo app('translator')->get('Transactions'); ?></span>
        </a>
    </li>
    <li class="nav-item <?php echo e(sidenav_active('user.go2fa')); ?>">
        <a href="<?php echo e(route('user.go2fa')); ?>" class="nav-link">
            <span class="menu-icon"><i class="fa fa-shield text-facebook"></i></span>
            <span class="menu-title"><?php echo app('translator')->get('2FA Security'); ?></span>
        </a>
    </li>

    <li class="nav-item <?php echo e(sidenav_active('user.ticket*')); ?>">
        <a href="<?php echo e(route('user.ticket')); ?>" class="nav-link">
            <span class="menu-icon"><i class="fa fa-ticket text-facebook"></i></span>
            <span class="menu-title"><?php echo app('translator')->get('Support'); ?></span>
        </a>
    </li>

    <li class="nav-item <?php echo e(sidenav_active('user.profile')); ?>">
        <a href="<?php echo e(route('user.profile')); ?>" class="nav-link">
            <span class="menu-icon"><i class="fa fa-cog text-facebook"></i></span>
            <span class="menu-title"><?php echo app('translator')->get('Account settings'); ?></span>
        </a>
    </li>
    <li class="nav-item <?php echo e(sidenav_active('user.login.history')); ?>">
        <a href="<?php echo e(route('user.login.history')); ?>" class="nav-link">
            <span class="menu-icon"><i class="fa fa-history text-facebook"></i></span>
            <span class="menu-title"><?php echo app('translator')->get('Login History'); ?></span>
        </a>
    </li>
   </ul>
  
  </div>
  <script>
        let deposit = document.getElementById("deposit");
        let withdraw = document.getElementById("withdraw");

        deposit.addEventListener("click", function() {
            let depositMenu = document.getElementsByClassName("deposit-menu");
            if (depositMenu[0].style.display === "block") {
                depositMenu[0].style.display = "none";
            } else {
                depositMenu[0].style.display = "block";
            }
        })

        withdraw.addEventListener("click", function() {
            let withdrawtMenu = document.getElementsByClassName("withdraw-menu");
            if (withdrawtMenu[0].style.display === "block") {
                withdrawtMenu[0].style.display = "none";
            } else {
                withdrawtMenu[0].style.display = "block";
            }
        })
    </script>
<?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/templates/tmp2/partials/sidenav.blade.php ENDPATH**/ ?>