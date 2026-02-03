<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectAfterPasswordReset
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->isMethod('POST') && 
            $request->path() === 'reset-password' && 
            Auth::check() &&
            $response->isRedirect() &&
            $response->getTargetUrl() === url('/login')) {
            return redirect()->route('painel.dashboard');
        }

        return $response;
    }
}
