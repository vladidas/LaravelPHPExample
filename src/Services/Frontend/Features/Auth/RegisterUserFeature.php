<?php

namespace App\Services\Frontend\Features\Auth;

use Lucid\Foundation\Feature;
use App\Domains\Auth\User\Jobs\RegisterUserJob;
use App\Services\Frontend\Http\Requests\Auth\LoginRequest;
use App\Services\Frontend\Http\Requests\Auth\RegisterRequest;

/**
 * Class RegisterUserFeature
 * @package App\Services\Frontend\Features\Auth
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class RegisterUserFeature extends Feature
{
    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handle(RegisterRequest $request)
    {
        $attributes = $request->only([
            'name',
            'surname',
            'phone',
            'email',
            'password'
        ]);

        $result = $this->run(new RegisterUserJob($attributes));

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
