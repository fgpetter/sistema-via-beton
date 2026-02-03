<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Se for super admin, permite acesso a todas as rotas
        Gate::before(function (User $user, string $ability) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });

        Gate::define('admin', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('coordenador', function (User $user) {
            return $user->isCoordenador();
        });

        Gate::define('admin-or-coordenador', function (User $user) {
            return $user->isAdmin() || $user->isCoordenador();
        });

        Gate::define('prestador', function (User $user) {
            return $user->isPrestador();
        });

    }
}
