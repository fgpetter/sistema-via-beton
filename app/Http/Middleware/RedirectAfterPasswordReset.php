<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectAfterPasswordReset
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->isMethod('POST') &&
            $request->path() === 'reset-password' &&
            Auth::check() &&
            $response->isRedirect() &&
            $response->getTargetUrl() === url('/login')) {
            /** @var User $user */
            $user = Auth::user();

            $redirectRoute = $user->isPrestador()
                ? 'prestador.atendimentos'
                : 'painel.dashboard';

            return redirect()->route($redirectRoute);
        }

        return $response;
    }
}
