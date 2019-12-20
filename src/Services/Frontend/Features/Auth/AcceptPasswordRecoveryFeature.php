<?php

namespace App\Services\Frontend\Features\Auth;

use Lucid\Foundation\Feature;
use App\Domains\User\Jobs\FindUserByEmailJob;
use App\Domains\Auth\User\Jobs\GetEmailByTokenJob;
use App\Domains\Auth\User\Jobs\RemoveResetTokenJob;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Domains\Auth\User\Jobs\ResetPasswordByRequestJob;
use App\Services\Frontend\Http\Requests\Auth\NewPasswordRequest;

/**
 * Class AcceptPasswordRecoveryFeature
 * @package App\Services\Frontend\Features\Auth
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class AcceptPasswordRecoveryFeature extends Feature
{
    /**
     * @var string
     */
    protected $token;

    /**
     * AcceptPasswordRecoveryFeature constructor.
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @param NewPasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(NewPasswordRequest $request)
    {
        $email = $this->run(new GetEmailByTokenJob($this->token));

        try {

            $user = $this->run(new FindUserByEmailJob($email));

        } catch (ModelNotFoundException $exception) {

            $this->run(new RemoveResetTokenJob($this->token));
            return redirect()->back()->with('no-user-found', __('messages.no_user_found'));

        }

        $this->run(new ResetPasswordByRequestJob($request, $user->getId()));

        $this->run(new RemoveResetTokenJob($this->token));

        return redirect()->route('frontend.auth.login')
            ->with('password-reset-successfully',
            __('messages.password_recovery_successful'));
    }
}
