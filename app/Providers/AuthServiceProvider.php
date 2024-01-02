<?php

namespace App\Providers;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function ($user) {
            return $user->rule == 'RULE_SUPPORT' ? FALSE : TRUE;
        });
        
        Gate::define('is_admin',function($user){
            return $user->rule == 'RULE_ADMIN' ? TRUE : FALSE;
        });

        Gate::define('is_admin1',function($user){
            return $user->rule == 'RULE_ADMIN' ? TRUE : FALSE;
        });

        Gate::define('is_admin2',function($user){
            return $user->rule == 'RULE_ADMIN' ? TRUE : FALSE;
        });

        Gate::define('is_admin3',function($user){
            return $user->rule == 'RULE_ADMIN' ? TRUE : FALSE;
        });

        Gate::define('is_admin4',function($user){
            return $user->rule == 'RULE_ADMIN' ? TRUE : FALSE;
        });

        Gate::define('is_admin5',function($user){
            return $user->rule == 'RULE_ADMIN' ? TRUE : FALSE;
        });
       

    
        //
    }
}
