<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::user()->role !== $role) {
            return redirect('/ServiceLogin')->with('error', 'Anda tidak punya akses ke halaman ini.');
        }

        return $next($request);
    }
}
