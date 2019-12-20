<?php

namespace App\Services\Dashboard\Features\Auth;

use App\Domains\Auth\Admin\Jobs\LoginAdminJob;
use App\Services\Dashboard\Http\Requests\Auth\LoginRequest;
use Lucid\Foundation\Feature;

/**
 * Class LoginAdminFeature
 * @package App\Services\Dashboard\Features\Auth
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class LoginAdminFeature extends Feature
{
    /**
     * @param LoginRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handle(LoginRequest $request)
    {
        if (!$this->run(new LoginAdminJob($request))) {
            return redirect()
                ->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'password' => __('app.wrong_password')
                ]);
        }

        return redirect(url('/dashboard'));
    }
}
