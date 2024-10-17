<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if the authenticated user has one of the specified roles
        if ($request->user() && in_array($request->user()->role, $roles)) {
            return $next($request);
        }

        // Redirect or abort if the user doesn't have the required role
        return redirect('/')->with('error', 'Unauthorized.');
    }
}
