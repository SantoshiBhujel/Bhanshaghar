<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        Gate::define('view-post',function($user,$post){
            return $user->id == $post->users_id;
        });
        
        Gate::define('update-post', function($user, $post)
        {
            return $user->id == $post->users_id;
        });

        Gate::define('update-profile',function($user)
        {
            return $user->id == $post->users_id;
        });



        //
    }
}
