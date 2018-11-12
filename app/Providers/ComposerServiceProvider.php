<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['layouts.usermenu', 'layouts.usermenumobile', 'layouts.help', 'layouts.news'], 'App\Http\ViewComposers\UserMenuComposer');
        View::composer(['layouts.topbar','layouts.tableprice'], 'App\Http\ViewComposers\RatesComposer');
        View::composer('layouts.news', 'App\Http\ViewComposers\NewsComposer');
        View::composer(['dashboard.index', 'layouts.topbar'], 'App\Http\ViewComposers\DashboardComposer');
        View::composer(['layouts.usermenu','layouts.usermenumobile',], 'App\Http\ViewComposers\ProfileInfoComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
