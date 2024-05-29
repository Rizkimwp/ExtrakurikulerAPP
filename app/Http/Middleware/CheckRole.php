<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next ,  ...$roles): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Check if the user has any of the required roles
        foreach ($roles as $role) {
            if (Auth::user()->hasRole($role)) {
                return $next($request);
            }
        }

        // If the user doesn't have any of the required roles, redirect or abort
        abort(403, 'Unauthorized');
    }
}