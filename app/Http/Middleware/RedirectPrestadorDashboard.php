<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectPrestadorDashboard
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()?->isPrestador()) {
            return redirect()->route('prestador.atendimentos');
        }

        return $next($request);
    }
}
