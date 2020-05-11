<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use Blade;
use View;
use App\Language;

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

        View::composer('*', function($view){
            $languages = Language::all();
            $view->with([
                'languages' => $languages,
            ]);
        });
    }
}
