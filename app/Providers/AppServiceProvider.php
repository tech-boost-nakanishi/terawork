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
        if (\App::environment('production')) {
            \URL::forceScheme('https');
        }
        
        Blade::if('auth', function($status){
            return Auth::guard($status)->check();
        });

        Blade::if('guest', function(){
            return !Auth::guard('corporate')->check() && !Auth::guard('user')->check();
        });

        View::composer('*', function($view){
            $languages = Language::all();

            if(request()->input('pref_name')){
                $s_pref_name = request()->input('pref_name');
            }else{
                $s_pref_name = "";
            }

            if(request()->input('monthly_income')){
                $s_monthly_income = request()->input('monthly_income');
            }else{
                $s_monthly_income = "";
            }

            if(request()->input('language')){
                $s_language = request()->input('language');
            }else{
                $s_language = "";
            }

            if(request()->input('keyword')){
                $s_keyword = request()->input('keyword');
            }else{
                $s_keyword = "";
            }

            $view->with([
                'languages' => $languages,
                's_pref_name' => $s_pref_name,
                's_monthly_income' => $s_monthly_income,
                's_language' => $s_language,
                's_keyword' => $s_keyword,
            ]);
        });
    }
}
