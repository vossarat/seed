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
        View::composer('layouts.usermenu', 'App\Http\ViewComposers\UserMenuComposer');
        View::composer('layouts.usermenumobile', 'App\Http\ViewComposers\UserMenuComposer');
        //View::composer('layouts.topbar', 'App\Http\ViewComposers\RatesComposer');
        View::composer('layouts.topbar', 'App\Http\ViewComposers\HeaderInfoComposer');
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
