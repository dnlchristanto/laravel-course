<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('isAdministrator',function($user){
            return $user->role->id==1;
        });
        Gate::define('isAdmin',function($user){
            return $user->role->id==2;
        });
        Gate::define('isUserBiasa',function($user){
            return $user->role->id==3;
        });
    }
}
