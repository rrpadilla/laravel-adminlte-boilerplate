<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->isAdmin()) {
                return $next($request);
            }
        }

        flash()->error('Access Denied');

        return ($request->ajax() || $request->wantsJson()) ? response('Unauthorized.', 401) : redirect(route('dashboard::index'));
    }
}
