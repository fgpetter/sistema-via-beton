<?php

namespace App\Providers;

use App\Models\User;
use App\View\Composers\AuthSwalComposer;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // Admin é o papel mais alto e tem acesso a todas as áreas do sistema
        Gate::before(function (User $user, string $ability) {
            if ($user->isAdmin()) {
                return true;
            }
        });

        Gate::define('prestador', function (User $user) {
            return $user->isPrestador();
        });

        View::composer([
            'auth.boxed-login',
            'auth.boxed-register',
            'auth.boxed-reset-password',
            'auth.boxed-create-password',
        ], AuthSwalComposer::class);
    }
}
