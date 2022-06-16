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
            return $user->isAdmin();
        });

        Gate::define('cmp-adt-cac', function ($user) {
            return $user->hasAnyRole(['Admin', 'Comptable', 'Auditeur']);
        });

        Gate::define('cac-adt', function ($user) {
            return $user->hasAnyRole(['Admin',  'Auditeur']);
        });

        Gate::define('cmp-adt', function ($user) {
            return $user->hasAnyRole(['Comptable',  'Auditeur']);
        });

        Gate::define('secretaire', function ($user) {
            return $user->isSecretaire();
        });
    }
}