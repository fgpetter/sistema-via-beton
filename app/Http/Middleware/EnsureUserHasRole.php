<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! $request->user()) {
            abort(403, 'Acesso não autorizado.');
        }

        $allowedRoles = collect($roles)->map(fn (string $role) => UserRole::tryFrom($role));

        if (! $allowedRoles->contains($request->user()->role)) {
            abort(403, 'Você não tem permissão para acessar esta página.');
        }

        return $next($request);
    }
}
