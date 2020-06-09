<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('userprofile',function($user, $id){
            return $user->id == $id;
        });

        Gate::define('corporateprofile',function($corporate, $id){
            return $corporate->id == $id;
        });

        Gate::define('update-recruit',function($corporate, $recruit){
            return $corporate->id == $recruit->corporate_id;
        });

        Gate::define('view',function($user, $id){
            return $user->id == $id;
        });

        Gate::define('changepassword',function(){
            return Auth::guard('corporate')->check();
        });
    }
}
