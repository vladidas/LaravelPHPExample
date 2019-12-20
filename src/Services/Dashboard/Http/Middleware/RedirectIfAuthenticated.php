<?php

namespace App\Services\Dashboard\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class RedirectIfAuthenticated
 * @package App\Services\Dashboard\Http\Middleware
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            return redirect(route('dashboard.home'));
        }

        return $next($request);
    }
}
