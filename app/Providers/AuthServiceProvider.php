<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
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

        // Définir des gates pour les différents dashboards
        Gate::define('access-admin-dashboard', function (User $user) {
            return $user->hasRole('admin');
        });

        Gate::define('access-client-dashboard', function (User $user) {
            return $user->hasRole('client');
        });

        Gate::define('access-chauffeur-dashboard', function (User $user) {
            return $user->hasRole('chauffeur');
        });

        Gate::define('access-formateur-dashboard', function (User $user) {
            return $user->hasRole('formateur');
        });

        // Gate pour l'accès admin général
        Gate::define('admin', function (User $user) {
            return $user->hasRole('admin');
        });
    }
}
