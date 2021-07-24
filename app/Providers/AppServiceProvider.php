<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->share(['general' => \App\GeneralSetting::first()]);
        view()->share(['lang' => \App\Language::all()]);

        view()->composer('partials.seo', function ($view) {
            $seo = \App\Frontend::where('key', 'seo')->first();
            $view->with([
                'seo' => $seo ? $seo->value : $seo,
            ]);
        });


        view()->composer(activeTemplate().'layouts.master',  function ($view) {
            $footer = \App\Frontend::where('key', 'footer.title')->first();
            $social = \App\Frontend::where('key', 'social.item')->get();

            $view->with([
                'footer' => $footer->value ,
                'social' => $social,
            ]);

        });

        view()->composer('admin.partials.sidenav', function ($view) {
            $view->with([
                'banned_users_count'           => \App\User::banned()->count(),
                'email_unverified_users_count' => \App\User::emailUnverified()->count(),
                'sms_unverified_users_count'   => \App\User::smsUnverified()->count(),
                'pending_withdrawals_count'    => \App\Withdrawal::pending()->count(),
            ]);
        });
    }
}
