<?php

namespace Framework\Http\Middleware;

use Closure;
use App\Data\Models\Admin;

class Gate
{
    /**
     * @param $request
     * @param Closure $next
     * @param mixed ...$roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!auth()->user()->havePermissions($roles)) {
            abort(403);
        }

        return $next($request);
    }
}
