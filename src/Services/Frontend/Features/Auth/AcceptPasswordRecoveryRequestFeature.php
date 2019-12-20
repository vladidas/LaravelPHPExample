<?php

namespace App\Services\Frontend\Features\Auth;

use Lucid\Foundation\Feature;
use App\Domains\User\Jobs\FindUserByEmailJob;
use App\Domains\Auth\User\Jobs\SendPasswordRecoveryLetterJob;
use App\Services\Frontend\Http\Requests\Auth\PasswordRecoveryRequest;

/**
 * Class AcceptPasswordRecoveryRequestFeature
 * @package App\Services\Frontend\Features\Auth
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class AcceptPasswordRecoveryRequestFeature extends Feature
{
    /**
     * @param PasswordRecoveryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(PasswordRecoveryRequest $request)
    {
        $user = $this->run(new FindUserByEmailJob($request->get('email')));

        $this->run(new SendPasswordRecoveryLetterJob($request, $user));

        return redirect()->back()->with(
            'recovery-letter-sent',
            __('messages.we_sent_forget_password_letter')
        );
    }
}
