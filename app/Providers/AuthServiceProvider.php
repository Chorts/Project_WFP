<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Access\Response;
// use Gate;
use Illuminate\Support\Facades\Gate;


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
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Cara 1 (Gates Only)
        // Gate::define("delete-permission", function ($user) {
        //     return ($user->role == "admin") ?
        //         Response::allow() :
        //         Response::deny("Only admins are allowed to perform this operation");
        // });

        //Cara 2 (Gates with POLICY)
        Gate::define("delete-permission", "App\Policies\CategoryPolicy@delete");


        Gate::define("access-admin", function ($user) {
            return ($user->role == "admin") ?
                Response::allow() :
                Response::deny("Only admins are allowed to perform this operation");
        });

        Gate::define("access-doctor", function ($user) {
            return ($user->role == "doctor") ?
                Response::allow() :
                Response::deny("Only doctors are allowed to perform this operation");
        });

        Gate::define("access-member", function ($user) {
            return ($user->role == "member") ?
                Response::allow() :
                Response::deny("Only members are allowed to perform this operation");
        });
    }
}
