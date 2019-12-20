<?php

namespace App\Services\Frontend\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

/**
 * Class Authenticate
 * @package App\Services\Frontend\Http\Middleware
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class Authenticate
{
    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        if (!$this->authenticate()) {
            return redirect(route('frontend.auth.login'));
        }

        return $next($request);
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @return bool|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate()
    {
        try {

            return $this->auth->guard('user')->authenticate();

        } catch (\Exception $e) {

            return false;

        }
    }
}
