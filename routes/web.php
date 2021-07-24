<?php

// Route::fallback(function () {
//     return view('errors.404');
// });

Route::get('clear', function () {
    \Artisan::call('view:clear');
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    \Artisan::call('cache:clear');
});

Route::get('storage', function () {
    \Artisan::call('storage:link');
  
});

Route::get('roi/test', function () {
    \Artisan::call('schedule:run');
  
});

Route::post('ipn/g101', 'Gateway\g101\ProcessController@ipn')->name('ipn.g101'); // paypal
Route::post('ipn/g102', 'Gateway\g102\ProcessController@ipn')->name('ipn.g102'); // Perfect Money
Route::post('ipn/g103', 'Gateway\g103\ProcessController@ipn')->name('ipn.g103'); // Stripe
Route::post('ipn/g104', 'Gateway\g104\ProcessController@ipn')->name('ipn.g104'); // Skrill
Route::post('ipn/g105', 'Gateway\g105\ProcessController@ipn')->name('ipn.g105'); // PayTM
Route::post('ipn/g106', 'Gateway\g106\ProcessController@ipn')->name('ipn.g106'); // Payeer
Route::post('ipn/g107', 'Gateway\g107\ProcessController@ipn')->name('ipn.g107'); // PayStack
Route::post('ipn/g108', 'Gateway\g108\ProcessController@ipn')->name('ipn.g108'); // VoguePay
Route::get('ipn/g109/{trx}/{type}', 'Gateway\g109\ProcessController@ipn')->name('ipn.g109'); //flutterwave

Route::post('ipn/g110', 'Gateway\g110\ProcessController@ipn')->name('ipn.g110'); // RazorPay
Route::post('ipn/g111', 'Gateway\g111\ProcessController@ipn')->name('ipn.g111'); // stripeJs
Route::post('ipn/g112', 'Gateway\g112\ProcessController@ipn')->name('ipn.g112'); //instamojo

Route::get('ipn/g501', 'Gateway\g501\ProcessController@ipn')->name('ipn.g501'); // Blockchain
Route::get('ipn/g502', 'Gateway\g502\ProcessController@ipn')->name('ipn.g502'); // Block.io
Route::post('ipn/g503', 'Gateway\g503\ProcessController@ipn')->name('ipn.g503'); // CoinPayment
Route::post('ipn/g504', 'Gateway\g504\ProcessController@ipn')->name('ipn.g504'); // CoinPayment ALL
Route::post('ipn/g505', 'Gateway\g505\ProcessController@ipn')->name('ipn.g505'); // Coingate
Route::post('ipn/g506', 'Gateway\g506\ProcessController@ipn')->name('ipn.g506'); // Coinbase commerce


Route::get('/', 'SiteController@home')->name('home');
Route::get('/faq', 'SiteController@faq')->name('faq');
Route::get('/contact', 'SiteController@contact')->name('contact');
Route::post('/contact', 'SiteController@sendEmailContact')->name('send.mail.contact');
Route::get('/change-lang/{lang}', 'SiteController@changeLang')->name('lang');

Route::get('/latest-news/details/{slug}/{id}', 'SiteController@singleBlog')->name('singleBlog');
Route::get('/latest-news', 'SiteController@blog')->name('blog');



Route::post('subscriber', 'SiteController@subscriberStore')->name('subscriber.store');




Route::get('user/register/{username}', 'Auth\RegisterController@showRegistrationFormRef');
Route::name('user.')->prefix('user')->group(function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logoutGet')->name('logout');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.updates');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/verify-code', 'Auth\ForgotPasswordController@verifyCode')->name('password.verify-code');

    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register')->middleware('regStatus');

    Route::middleware('auth')->group(function () {
        Route::get('authorization', 'AuthorizationController@authorizeForm')->name('authorization');
        Route::get('resend-verify', 'AuthorizationController@sendVerifyCode')->name('send_verify_code');
        Route::post('verify-email', 'AuthorizationController@emailVerification')->name('verify_email');
        Route::post('verify-sms', 'AuthorizationController@smsVerification')->name('verify_sms');
        Route::post('verify-g2fa', 'AuthorizationController@g2faVerification')->name('go2fa.verify');

        // Support ticket
        Route::get('ticket', 'TicketController@index')->name('ticket');
        Route::post('ticket/new', 'TicketController@new')->name('ticket.new');
        Route::get('ticket/{id}/{slug}', 'TicketController@detail')->name('ticket.detail');
        Route::post('ticket/comment/{id}', 'TicketController@comment')->name('ticket.comment');
        Route::post('ticket/close/{id}', 'TicketController@close')->name('ticket.close');

        Route::middleware('ckstatus')->group(function () {
            Route::get('dashboard', 'UserController@home')->name('home');

            //2FA
            Route::get('g2fa', 'UserController@show2faForm')->name('go2fa');
            Route::post('g2fa', 'UserController@create2fa')->name('go2fa');
            Route::post('g2fa-disable', 'UserController@disable2fa')->name('go2fa.disable');

            // Deposit
            Route::get('deposit', 'Gateway\PaymentController@deposit')->name('deposit');
            Route::post('deposit', 'Gateway\PaymentController@deposit')->name('deposit');
            Route::post('deposit-insert', 'Gateway\PaymentController@depositInsert')->name('deposit.insert');
            Route::get('deposit-preview', 'Gateway\PaymentController@depositPreview')->name('deposit.preview');

            Route::get('manual-deposit-confirm', 'Gateway\PaymentController@manualDepositConfirm')->name('manualDeposit.confirm');
            Route::post('manual-deposit-update', 'Gateway\PaymentController@manualDepositUpdate')->name('manualDeposit.update');
            Route::get('deposit-confirm', 'Gateway\PaymentController@depositConfirm')->name('deposit.confirm');

            Route::get('deposit/history', 'UserController@depositHistory')->name('deposit.history');
            Route::post('deposit/history-date', 'UserController@depositHistoryDate')->name('deposit.history.date');

            // Withdraw
            Route::get('withdraw', 'UserController@withdraw')->name('withdraw');
            Route::post('withdraw/insert', 'UserController@withdrawInsert')->name('withdraw.insert');
            Route::get('withdraw/preview', 'UserController@withdrawPreview')->name('withdraw.preview');
            Route::post('withdraw', 'UserController@withdrawStore')->name('withdraw');
            Route::get('withdraw/history', 'UserController@withdrawHistory')->name('withdraw.history');
            Route::post('withdraw/history-date', 'UserController@withdrawHistoryDate')->name('withdraw.history.date');

            // Transaction
            Route::get('transaction-log', 'UserController@transactions')->name('transaction.index');

            Route::get('referral-commission-log', 'UserController@ref_com_Log')->name('referral.com');

            Route::get('level-commission-log', 'UserController@level_com_log')->name('level.com');
           Route::get('level-promo', 'UserController@level_promo')->name('level.promo');

            Route::post('level-commission-log-date', 'UserController@level_com_log_date')->name('level.com.date');
       Route::post('level-promo-date', 'UserController@level_promo_date')->name('level.promo.date');

            Route::get('balance-transfer-log', 'UserController@balance_tf_log')->name('balance.tf.log');

            // Support ticket
            Route::get('ticket', 'TicketController@index')->name('ticket');
            Route::post('ticket/new', 'TicketController@new')->name('ticket.new');
            Route::get('ticket/{id}/{slug}', 'TicketController@detail')->name('ticket.detail');
            Route::post('ticket/comment/{id}', 'TicketController@comment')->name('ticket.comment');
            Route::post('ticket/close/{id}', 'TicketController@close')->name('ticket.close');

            //user profile
            Route::get('/profile', 'UserController@profileIndex')->name('profile');
            Route::put('/profile', 'UserController@profileUpdate')->name('profile.update');
            Route::put('/password', 'UserController@passwordUpdate')->name('password.update');
            Route::get('/login/history', 'UserController@loginHistory')->name('login.history');

            // user kyc
            Route::get('/kyc', 'KYCController@KYCIndex')->name('kyc');;
            Route::post('/kyc/add', 'KYCController@KYCAdd')->name('kyc.add');
            Route::post('/kyc/update', 'KYCController@KYCUpdate')->name('kyc.update');
// roi ROI
         Route::get('/roi', 'HomeController@roi')->name('roi');
         Route::post('/roi-date', 'HomeController@roiDate')->name('roi-date');
            //pin-recharge
            Route::get('/pin-recharge', 'HomeController@pinRecharge')->name('pin.recharge');
            Route::post('/pin-recharge-date', 'HomeController@pinRechargeDate')->name('pin.recharge.date');
            Route::post('/pin-recharge', 'HomeController@pinRechargePost')->name('pin.recharge.post');
            Route::post('/pin-generate', 'HomeController@pinGenerate')->name('pin.generate');

            Route::get('/pin-recharged', 'HomeController@EPinRecharge')->name('e_pin.recharge');
            Route::get('/pin-generated', 'HomeController@EPinGenerated')->name('e_pin.generated');




            //referral
            Route::get('/matrix/{lv_no}', 'HomeController@matrixIndex')->name('matrix.index');
            Route::post('/matrix-date', 'HomeController@matrixIndexDate')->name('matrix.index.date');

            Route::get('/referrals', 'HomeController@referralIndex')->name('ref.index');
            Route::post('/referrals-date', 'HomeController@referralIndexDate')->name('ref.index.date');

            //plan
            Route::get('/plan', 'HomeController@planIndex')->name('plan.index');
            Route::post('/plan', 'HomeController@planStore')->name('plan.purchase');

            //balance transfer
            Route::get('/transfer', 'HomeController@indexTransfer')->name('balance.transfer');
            Route::post('/transfer', 'HomeController@balTransfer')->name('balance.transfer.post');

            Route::post('/search-user', 'HomeController@searchUser')->name('search.user');


        });
    });
});


Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::get('/', 'LoginController@showLoginForm')->name('login');
        Route::post('/', 'LoginController@login')->name('login');
        Route::get('logout', 'LoginController@logout')->name('logout');


        // Admin Password Reset
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
        Route::post('password/reset', 'ForgotPasswordController@sendResetLinkEmail');
        Route::post('password/verify-code', 'ForgotPasswordController@verifyCode')->name('password.verify-code');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.change-link');
        Route::post('password/reset/change', 'ResetPasswordController@reset')->name('password.change');
    });

    Route::middleware('admin')->group(function () {
        Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::get('profile', 'AdminController@profile')->name('profile');
        Route::post('profile', 'AdminController@profileUpdate')->name('profile.update');
        Route::post('password', 'AdminController@passwordUpdate')->name('password.update');
        Route::post('password', 'AdminController@passwordUpdate')->name('password.update');
        Route::post('password', 'AdminController@passwordUpdate')->name('password.update');

        // General Setting
        Route::get('setting', 'GeneralSettingController@index')->name('setting.index');
        Route::post('setting', 'GeneralSettingController@update')->name('setting.update');
        Route::post('contact/setting/update', 'GeneralSettingController@contactUpdate')->name('contact.setting.update');

        Route::post('matrix', 'GeneralSettingController@matrix')->name('matrix.update');


        // Language Manager
        Route::get('setting/language/manager', 'LanguageController@langManage')->name('setting.language-manage');
        Route::post('setting/language/manager', 'LanguageController@langStore')->name('setting.language-manage-store');
        Route::delete('setting/language-manage/{id}', 'LanguageController@langDel')->name('setting.language-manage-del');
        Route::get('setting/language-key/{id}', 'LanguageController@langEdit')->name('setting.language-key');
        Route::put('setting/key-update/{id}', 'LanguageController@langUpdate')->name('setting.key-update');
        Route::post('setting/language-manage-update/{id}', 'LanguageController@langUpdatepp')->name('setting.language-manage-update');
        Route::post('setting/language-import', 'LanguageController@langImport')->name('setting.import_lang');

        // Logo-Icon
        Route::get('setting/logo-icon', 'GeneralSettingController@logoIcon')->name('setting.logo-icon');
        Route::post('setting/logo-icon', 'GeneralSettingController@logoIconUpdate')->name('setting.logo-icon');

        // contact
        Route::get('contact', 'GeneralSettingController@contact')->name('setting.contact');


        // Email Setting
        Route::get('email-template/global', 'EmailTemplateController@emailTemplate')->name('email-template.global');
        Route::post('email-template/global', 'EmailTemplateController@emailTemplateUpdate')->name('email-template.global');
        Route::get('email-template/setting', 'EmailTemplateController@emailSetting')->name('email-template.setting');
        Route::post('email-template/setting', 'EmailTemplateController@emailSettingUpdate')->name('email-template.setting');
        Route::get('email-template/index', 'EmailTemplateController@index')->name('email-template.index');
        Route::get('email-template/{id}/edit', 'EmailTemplateController@edit')->name('email-template.edit');
        Route::post('email-template/{id}/update', 'EmailTemplateController@update')->name('email-template.update');
        Route::post('email-template/send-test-mail', 'EmailTemplateController@sendTestMail')->name('email-template.sendTestMail');

        // SMS Setting
        Route::get('sms-template/global', 'SmsTemplateController@smsSetting')->name('sms-template.global');
        Route::post('sms-template/global', 'SmsTemplateController@smsSettingUpdate')->name('sms-template.global');
        Route::get('sms-template/index', 'SmsTemplateController@index')->name('sms-template.index');
        Route::get('sms-template/edit/{id}', 'SmsTemplateController@edit')->name('sms-template.edit');
        Route::post('sms-template/update/{id}', 'SmsTemplateController@update')->name('sms-template.update');
        Route::post('email-template/send-test-sms', 'SmsTemplateController@sendTestSMS')->name('email-template.sendTestSMS');

        // Plugin
        Route::get('plugin', 'PluginController@index')->name('plugin.index');
        Route::post('plugin/update/{id}', 'PluginController@update')->name('plugin.update');
        Route::post('plugin/activate', 'PluginController@activate')->name('plugin.activate');
        Route::post('plugin/deactivate', 'PluginController@deactivate')->name('plugin.deactivate');

         // all kyc
           // Route::get('kycs', 'ManageUsersController@allKYCs')->name('kycs.all');

        // Users Manager
        Route::get('users', 'ManageUsersController@allUsers')->name('users.all');
        Route::get('users/active', 'ManageUsersController@activeUsers')->name('users.active');
        Route::get('users/banned', 'ManageUsersController@bannedUsers')->name('users.banned');
        Route::get('users/email-unverified', 'ManageUsersController@emailUnverifiedUsers')->name('users.emailUnverified');
        Route::get('users/sms-unverified', 'ManageUsersController@smsUnverifiedUsers')->name('users.smsUnverified');
        Route::get('user/detail/{id}', 'ManageUsersController@detail')->name('users.detail');
        Route::post('user/update/{id}', 'ManageUsersController@update')->name('users.update');
        Route::get('users/{scope}/search', 'ManageUsersController@search')->name('users.search');
        Route::post('user/add-sub-balance/{id}', 'ManageUsersController@addSubBalance')->name('users.addSubBalance');
        Route::get('users/send-email', 'ManageUsersController@showEmailAllForm')->name('users.email.all');
        Route::post('users/send-email', 'ManageUsersController@sendEmailAll')->name('users.email.all');
        Route::get('user/send-email/{id}', 'ManageUsersController@showEmailSingleForm')->name('users.email.single');
        Route::post('user/send-email/{id}', 'ManageUsersController@sendEmailSingle')->name('users.email.single');
        Route::get('user/withdrawals/{id}', 'ManageUsersController@withdrawals')->name('users.withdrawals');
        Route::get('user/deposits/{id}', 'ManageUsersController@deposits')->name('users.deposits');
        Route::get('user/transactions/{id}', 'ManageUsersController@transactions')->name('users.transactions');

        Route::get('user/referral/{id}', 'ManageUsersController@refSingle')->name('users.ref.single');
        Route::get('user/matrix/{lv_no}/{id}', 'ManageUsersController@matrixSingle')->name('users.matrix.single');





        // Login History
        Route::get('users/login/history/{id}', 'ManageUsersController@userLoginHistory')->name('users.login.history.single');
        Route::get('users/login/history', 'ManageUsersController@loginHistory')->name('users.login.history');

        // Subscriber
        Route::get('subscriber', 'SubscriberController@index')->name('subscriber.index');
        Route::get('subscriber/send-email', 'SubscriberController@sendEmailForm')->name('subscriber.sendEmail');
        Route::post('subscriber/remove', 'SubscriberController@remove')->name('subscriber.remove');
        Route::post('subscriber/send-email', 'SubscriberController@sendEmail')->name('subscriber.sendEmail');

        // WITHDRAW SYSTEM
        Route::get('withdraw/pending', 'WithdrawalController@pending')->name('withdraw.pending');
        Route::get('withdraw/approved', 'WithdrawalController@approved')->name('withdraw.approved');
        Route::get('withdraw/rejected', 'WithdrawalController@rejected')->name('withdraw.rejected');
        Route::get('withdraw/log', 'WithdrawalController@log')->name('withdraw.log');
        Route::get('withdraw/{scope}/search', 'WithdrawalController@search')->name('withdraw.search');
        Route::post('withdraw/withdrawals-date', 'WithdrawalController@withdrawalsDate')->name('withdraw.date');
        Route::post('withdraw/approve', 'WithdrawalController@approve')->name('withdraw.approve');
        Route::post('withdraw/reject', 'WithdrawalController@reject')->name('withdraw.reject');

        // Withdraw Method
        Route::get('withdraw/method/', 'WithdrawMethodController@methods')->name('withdraw.method.methods');
        Route::get('withdraw/method/new', 'WithdrawMethodController@create')->name('withdraw.method.create');
        Route::post('withdraw/method/store', 'WithdrawMethodController@store')->name('withdraw.method.store');
        Route::get('withdraw/method/edit/{id}', 'WithdrawMethodController@edit')->name('withdraw.method.edit');
        Route::post('withdraw/method/edit/{id}', 'WithdrawMethodController@update')->name('withdraw.method.update');
        Route::post('withdraw/method/activate', 'WithdrawMethodController@activate')->name('withdraw.method.activate');
        Route::post('withdraw/method/deactivate', 'WithdrawMethodController@deactivate')->name('withdraw.method.deactivate');

        // DEPOSIT SYSTEM
        Route::get('deposit', 'DepositController@deposit')->name('deposit.list');
        Route::post('deposit-date', 'DepositController@depositDate')->name('deposit.list.date');
        Route::get('deposit/pending', 'DepositController@pending')->name('deposit.pending');
        Route::get('deposit/rejected', 'DepositController@rejected')->name('deposit.rejected');
        Route::get('deposit/approved', 'DepositController@approved')->name('deposit.approved');
        Route::post('deposit/reject', 'DepositController@reject')->name('deposit.reject');
        Route::post('deposit/approve', 'DepositController@approve')->name('deposit.approve');
        Route::get('deposit/{scope}/search', 'DepositController@search')->name('deposit.search');

        // Manual Methods
        Route::get('deposit/manual-methods', 'ManualGatewayController@index')->name('deposit.manual.index');
        Route::get('deposit/manual-methods/new', 'ManualGatewayController@create')->name('deposit.manual.create');
        Route::post('deposit/manual-methods/new', 'ManualGatewayController@store')->name('deposit.manual.store');
        Route::get('deposit/manual-methods/edit/{id}', 'ManualGatewayController@edit')->name('deposit.manual.edit');
        Route::post('deposit/manual-methods/update/{id}', 'ManualGatewayController@update')->name('deposit.manual.update');
        Route::post('deposit/manual-methods/activate', 'ManualGatewayController@activate')->name('deposit.manual.activate');
        Route::post('deposit/manual-methods/deactivate', 'ManualGatewayController@deactivate')->name('deposit.manual.deactivate');

        // Deposit Gateway
        Route::get('deposit/gateway', 'GatewayController@index')->name('deposit.gateway.index');
        Route::get('deposit/gateway/edit/{code}', 'GatewayController@edit')->name('deposit.gateway.edit');
        Route::post('deposit/gateway/update/{code}', 'GatewayController@update')->name('deposit.gateway.update');
        Route::post('deposit/gateway/remove/{code}', 'GatewayController@remove')->name('deposit.gateway.remove');
        Route::post('deposit/gateway/activate', 'GatewayController@activate')->name('deposit.gateway.activate');
        Route::post('deposit/gateway/deactivate', 'GatewayController@deactivate')->name('deposit.gateway.deactivate');

        // Report
        Route::get('report/transaction', 'ReportController@transaction')->name('report.transaction');
        Route::get('report/transaction/search', 'ReportController@transactionSearch')->name('report.transaction.search');

        Route::get('report/purchased-plan', 'ReportController@purchasedPlan')->name('report.purchased.plan');
        Route::get('report/referral-commission', 'ReportController@RefCom')->name('report.refcom');
        Route::get('report/e-pin-recharge', 'ReportController@e_pinRecharge')->name('report.e_pin.recharge');
        Route::get('report/referral-bonus', 'ReportController@Ref_bonus')->name('report.ref_bonus');

        // Support Ticket
        Route::get('support-ticket', 'SupportTicketController@index')->name('supportTicket.index');
        Route::get('support-ticket/{id}/{slug}', 'SupportTicketController@reply')->name('supportTicket.reply');
        Route::post('ticket/comment/{id}', 'SupportTicketController@comment')->name('ticket.comment');

        // Frontend
        Route::name('frontend.')->prefix('frontend')->group(function () {
            Route::post('store', 'FrontendController@store')->name('store');
            Route::post('remove', 'FrontendController@remove')->name('remove');
            Route::post('{id}/update', 'FrontendController@update')->name('update');

            // Blog
            Route::get('blog/', 'FrontendController@blogIndex')->name('blog.index');
            Route::get('blog/edit/{id}/{slug}', 'FrontendController@blogEdit')->name('blog.edit');
            Route::get('blog/new', 'FrontendController@blogNew')->name('blog.new');

            // faq
            Route::get('faq/', 'FrontendController@faqIndex')->name('faq.index');
            Route::get('faq/edit/{id}/{slug}', 'FrontendController@faqEdit')->name('faq.edit');
            Route::get('faq/new', 'FrontendController@faqNew')->name('faq.new');

            // SEO
            Route::get('seo', 'FrontendController@seoEdit')->name('seo.edit');

            // Social
            Route::get('social', 'FrontendController@socialIndex')->name('social.index');

            // Service
            Route::get('service', 'FrontendController@serviceIndex')->name('service.index');

            Route::get('plan', 'FrontendController@planIndex')->name('plan.index');
            // how-it-work
            Route::get('how-it-work', 'FrontendController@howWorkIndex')->name('howWork.index');

            Route::get('footer', 'FrontendController@footerSection')->name('footer.index');

            Route::get('about', 'FrontendController@aboutSection')->name('about.index');

            Route::get('video-section', 'FrontendController@videoSection')->name('video.index');

            Route::get('video-section/new', 'FrontendController@videoSectionNew');

            // Testimonial
            Route::get('testimonial', 'FrontendController@testimonialIndex')->name('testimonial.index');
            Route::get('testimonial/new', 'FrontendController@testimonialNew')->name('testimonial.new');
            Route::get('testimonial/edit/{id}', 'FrontendController@testimonialEdit')->name('testimonial.edit');

            // banner
            Route::get('banner', 'FrontendController@bannerIndex')->name('banner.index');
            Route::get('banner/new', 'FrontendController@bannerNew')->name('banner.new');
            Route::get('banner/edit/{id}', 'FrontendController@bannerEdit')->name('banner.edit');


            Route::get('video/section', 'FrontendController@breadcrumbIndex')->name('breadcrumb.index');


        });


        //e-pin
        Route::get('/manage-pin', 'AdminController@managePin')->name('manage-pin');
        Route::post('/manage-pin-date', 'AdminController@managePinDate')->name('manage-pin-date');
        Route::get('/all-used-pin', 'AdminController@UsedPin')->name('all-used-pin');
// roi ROI
         Route::get('/roi', 'AdminController@roi')->name('roi');
         Route::post('/roi-date', 'AdminController@roiDate')->name('roi-date');

        // Route::get('/used-pin', 'AdminController@UsedPin')->name('used-pin');
        Route::post('/manage-pin', 'AdminController@storePin')->name('storePin');

        Route::resources([

            //plan
            'plan' => 'PlanController',


        ], ['except' => ['show']]);

    });
});


 //        <li class="nav-item {{ sidenav_active('admin.used-pin') }}">
 //                        <a class="nav-link" href="{{ route('admin.used-pin') }}">
 //                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
 //                            <span class="menu-title">Used E-PIN</span>
 //                        </a>
 //                    </li>
 // 