<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use Blade;

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
        Blade::if('auth', function($status){
            return Auth::guard($status)->check();
        });

        Blade::if('guest', function(){
            return !Auth::guard('corporate')->check();
        });
    }
}
