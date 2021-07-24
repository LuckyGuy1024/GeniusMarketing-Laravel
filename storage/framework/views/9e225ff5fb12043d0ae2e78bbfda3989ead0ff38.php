<nav class="main-sidebar bg-default">
    <button class="sidebar-close"><i class="fa fa-times"></i></button>
    <div class="navbar-brand-wrapper d-flex justify-content-start align-items-center">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="navbar-brand">
            <span class="logo-one"><img src="<?php echo e(get_image(config('constants.logoIcon.path') .'/logo.png')); ?>" alt="logo-image" /></span>
            <span class="logo-two"><img src="<?php echo e(get_image(config('constants.logoIcon.path') .'/favicon.png')); ?>" alt="logo-image" /></span>
        </a>
    </div>
    <div id="main-sidebar">
        <ul class="nav">

            <li class="nav-item <?php echo e(sidenav_active('admin.dashboard')); ?>">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-th-large text-facebook"></i></span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>


            <li class="nav-item <?php echo e(sidenav_active('admin.plan*')); ?>">
                <a href="<?php echo e(route('admin.plan.index')); ?>" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-lightbulb-o text-facebook"></i></span>
                    <span class="menu-title">Plan</span>
                </a>
            </li>

  
            <li class="nav-item <?php echo e(sidenav_active('admin.roi')); ?>">
                <a href="<?php echo e(route('admin.roi')); ?>" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-dollar text-facebook"></i></span>
                    <span class="menu-title">ROI</span>
                </a>
            </li>

  
         




            <li class="nav-item <?php echo e(sidenav_active('admin.manage-pin')); ?><?php echo e(sidenav_active('admin.used-pin')); ?>">
                <a data-default-url="<?php echo e(route('admin.report.transaction')); ?>" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-clipboard text-facebook"></i></span>
                    <span class="menu-title">Manage-pin</span>
                    <span class="menu-arrow"><i class="fa fa-chevron-right"></i></span>
                </a>

                <ul class="sub-menu">
                    <li class="nav-item <?php echo e(sidenav_active('admin.manage-pin')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.manage-pin')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Generate E-PIN</span>
                        </a>
                    </li>

                       <li class="nav-item <?php echo e(sidenav_active('admin.manage-pin')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.all-used-pin')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Used E-PIN</span>
                        </a>
                    </li>



       

                </ul>
            </li>







            <li class="nav-item <?php echo e(sidenav_active('admin.users*')); ?>">
                <a data-default-url="<?php echo e(route('admin.users.all')); ?>" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-users text-facebook"></i></span>
                    <span class="menu-title">Manage Users</span>
                    <?php if($email_unverified_users_count > 0 || $sms_unverified_users_count > 0): ?>
                        <span class="badge bg-orange border-radius-10"><i class="fa px-1 fa-exclamation"></i></span>
                    <?php endif; ?>
                    <span class="menu-arrow"><i class="fa fa-chevron-right"></i></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?php echo e(sidenav_active('admin.users.all')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.users.all')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">All Users &amp; KYCs</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active('admin.users.active')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.users.active')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Active Users</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active('admin.users.banned')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.users.banned')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Banned Users</span>
                            <?php if($banned_users_count): ?> <span class="badge bg-blue border-radius-10"><?php echo e($banned_users_count); ?></span> <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active('admin.users.emailUnverified')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.users.emailUnverified')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Email Unverified</span>
                            <?php if($email_unverified_users_count): ?> <span class="badge bg-blue border-radius-10"><?php echo e($email_unverified_users_count); ?></span> <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active('admin.users.smsUnverified')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.users.smsUnverified')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">SMS Unverified</span>
                            <?php if($sms_unverified_users_count): ?> <span class="badge bg-blue border-radius-10"><?php echo e($sms_unverified_users_count); ?></span> <?php endif; ?>
                        </a>
                    </li>

                    <li class="nav-item <?php echo e(sidenav_active(['admin.users.login.history','admin.users.login.search'])); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.users.login.history')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Login History</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active('admin.users.email.all')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.users.email.all')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Send Email</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?php echo e(sidenav_active('admin.withdraw*')); ?>">
                <a data-default-url="<?php echo e(route('admin.withdraw.method.methods')); ?>" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-bank text-facebook"></i></span>
                    <span class="menu-title">Withdraw System</span>
                    <?php if($pending_withdrawals_count > 0): ?>
                        <span class="badge bg-orange border-radius-10"><i class="fa px-1 fa-exclamation"></i></span>
                    <?php endif; ?>
                    <span class="menu-arrow"><i class="fa fa-chevron-right"></i></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?php echo e(sidenav_active('admin.withdraw.method*')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.withdraw.method.methods')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Withdraw Methods</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active('admin.withdraw.pending')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.withdraw.pending')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Pending Withdrawals</span>
                            <?php if($pending_withdrawals_count): ?> <span class="badge bg-blue border-radius-10"><?php echo e($pending_withdrawals_count); ?></span> <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active('admin.withdraw.approved')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.withdraw.approved')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Approved Withdrawals</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active('admin.withdraw.rejected')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.withdraw.rejected')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Rejected Withdrawals</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active('admin.withdraw.log')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.withdraw.log')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">All Withdrawals</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item <?php echo e(sidenav_active('admin.deposit*')); ?>">
                <a data-default-url="<?php echo e(route('admin.deposit.gateway.index')); ?>" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-credit-card-alt text-facebook"></i></span>
                    <span class="menu-title">Deposit System</span>
                    <span class="menu-arrow"><i class="fa fa-chevron-right"></i></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?php echo e(sidenav_active('admin.deposit.gateway*')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.deposit.gateway.index')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Automatic Gateways</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active('admin.deposit.manual*')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.deposit.manual.index')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Manual Methods</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active('admin.deposit.pending')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.deposit.pending')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Pending Deposits</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active('admin.deposit.approved')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.deposit.approved')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Approved Deposits</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active('admin.deposit.rejected')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.deposit.rejected')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Rejected Deposits</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active('admin.deposit.list')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.deposit.list')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">All Deposits</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item <?php echo e(sidenav_active('admin.supportTicket*')); ?>">
                <a href="<?php echo e(route('admin.supportTicket.index')); ?>" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-ticket text-facebook"></i></span>
                    <span class="menu-title">Support Ticket</span>
                </a>
            </li>

            <li class="nav-item <?php echo e(sidenav_active('admin.subscriber*')); ?>">
                <a href="<?php echo e(route('admin.subscriber.index')); ?>" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-rss-square text-facebook"></i></span>
                    <span class="menu-title">Subscribers</span>
                </a>
            </li>

            <li class="nav-item <?php echo e(sidenav_active('admin.report*')); ?>">
                <a data-default-url="<?php echo e(route('admin.report.transaction')); ?>" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-clipboard text-facebook"></i></span>
                    <span class="menu-title">Reports</span>
                    <span class="menu-arrow"><i class="fa fa-chevron-right"></i></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?php echo e(sidenav_active('admin.report.transaction*')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.report.transaction')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Transaction Log</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <hr class="nk-hr" />
        <h6 class="nav-header text-facebook">Settings</h6>
        <ul class="nav">

            <li class="nav-item <?php echo e(sidenav_active('admin.plugin*')); ?>">
                <a href="<?php echo e(route('admin.plugin.index')); ?>" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-cogs text-facebook"></i></span>
                    <span class="menu-title">Plugin & Extensions</span>
                </a>
            </li>

            <li class="nav-item <?php echo e(sidenav_active('admin.frontend*')); ?>">
                <a data-default-url="<?php echo e(route('admin.frontend.blog.index')); ?>" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-diamond text-facebook"></i></span>
                    <span class="menu-title">Frontend Manager</span>
                    <span class="menu-arrow"><i class="fa fa-chevron-right"></i></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?php echo e(sidenav_active('admin.frontend.banner*')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.frontend.banner.index')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Banner/Slider</span>
                        </a>
                    </li>

                    <li class="nav-item <?php echo e(sidenav_active('admin.frontend.about*')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.frontend.about.index')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">About</span>
                        </a>
                    </li>

                    <li class="nav-item <?php echo e(sidenav_active('admin.frontend.howWork*')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.frontend.howWork.index')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">How it Works</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active('admin.frontend.plan*')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.frontend.plan.index')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Plan Section</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active('admin.frontend.service*')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.frontend.service.index')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Services</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active('admin.frontend.testimonial*')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.frontend.testimonial.index')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Testimonial</span>
                        </a>
                    </li>

                    <li class="nav-item <?php echo e(sidenav_active('admin.frontend.video*')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.frontend.video.index')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Video Section</span>
                        </a>
                    </li>

                    <li class="nav-item <?php echo e(sidenav_active('admin.frontend.blog*')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.frontend.blog.index')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Blog Manager</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active('admin.frontend.faq*')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.frontend.faq.index')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Faq Manager</span>
                        </a>
                    </li>


                    <li class="nav-item <?php echo e(sidenav_active('admin.frontend.social*')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.frontend.social.index')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Social Icons</span>
                        </a>
                    </li>




                    <li class="nav-item <?php echo e(sidenav_active('admin.frontend.footer*')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.frontend.footer.index')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Footer</span>
                        </a>
                    </li>


                    <li class="nav-item <?php echo e(sidenav_active('admin.frontend.seo*')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.frontend.seo.edit')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">SEO Manager</span>
                        </a>
                    </li>


                </ul>
            </li>

            <li class="nav-item <?php echo e(sidenav_active('admin.setting*')); ?>">
                <a data-default-url="<?php echo e(route('admin.setting.index')); ?>" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-cog text-facebook"></i></span>
                    <span class="menu-title">General Settings</span>
                    <span class="menu-arrow"><i class="fa fa-chevron-right"></i></span>
                </a>
                <ul class="sub-menu">

                    <li class="nav-item <?php echo e(sidenav_active('admin.setting.index')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.setting.index')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Basic</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active('admin.setting.contact')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.setting.contact')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Contact Settings</span>
                        </a>
                    </li>


                    <li class="nav-item <?php echo e(sidenav_active('admin.setting.logo-icon')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.setting.logo-icon')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Logo & Icons</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active('admin.setting.language*')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.setting.language-manage')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Language Manager</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item <?php echo e(sidenav_active('admin.email-template*')); ?>">
                <a data-default-url="<?php echo e(route('admin.email-template.global')); ?>" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-envelope-o text-facebook"></i></span>
                    <span class="menu-title">Email Manager</span>
                    <span class="menu-arrow"><i class="fa fa-chevron-right"></i></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?php echo e(sidenav_active('admin.email-template.global')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.email-template.global')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Global Template</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active(['admin.email-template.index','admin.email-template.edit'])); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.email-template.index')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Email Templates</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active('admin.email-template.setting')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.email-template.setting')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Email Configure</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item <?php echo e(sidenav_active('admin.sms-template*')); ?>">
                <a data-default-url="<?php echo e(route('admin.sms-template.global')); ?>" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-mobile text-facebook"></i></span>
                    <span class="menu-title">SMS Manager</span>
                    <span class="menu-arrow"><i class="fa fa-chevron-right"></i></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?php echo e(sidenav_active('admin.sms-template.global')); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.sms-template.global')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Global Template</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(sidenav_active(['admin.sms-template.index','admin.sms-template.edit'])); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.sms-template.index')); ?>">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">SMS Templates</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>
<?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/admin/partials/sidenav.blade.php ENDPATH**/ ?>