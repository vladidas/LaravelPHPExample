<?php

namespace App\Services\Frontend\Features\Auth;

use Lucid\Foundation\Feature;
use App\Domains\Auth\User\Jobs\LoginUserJob;
use App\Services\Frontend\Http\Requests\Auth\LoginRequest;

/**
 * Class LoginUserFeature
 * @package App\Services\Frontend\Features\Auth
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class LoginUserFeature extends Feature
{
    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handle(LoginRequest $request)
    {
        $result = $this->run(new LoginUserJob($request));

        if (!$result) {
            return redirect()
                ->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'password' => __('app.wrong_password')
                ]);
        }

        return redirect(url('/frontend'));
    }
}
