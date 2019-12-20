<?php

namespace App\Services\Dashboard\Features\Auth;

use Lucid\Foundation\Feature;
use App\Domains\Admin\Jobs\FindAdminByEmailJob;
use App\Domains\Auth\Admin\Jobs\GetEmailByTokenJob;
use App\Domains\Auth\Admin\Jobs\RemoveResetTokenJob;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Domains\Auth\Admin\Jobs\ResetPasswordByRequestJob;
use App\Services\Dashboard\Http\Requests\Auth\NewPasswordRequest;

/**
 * Class AcceptPasswordRecoveryFeature
 * @package App\Services\Dashboard\Features\Auth
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

            $admin = $this->run(new FindAdminByEmailJob($email));

        } catch (ModelNotFoundException $exception) {

            $this->run(new RemoveResetTokenJob($this->token));
            return redirect()->back()->with('no-admin-found', __('messages.no_admin_found'));

        }

        $this->run(new ResetPasswordByRequestJob($request, $admin->id));

        $this->run(new RemoveResetTokenJob($this->token));

        return redirect()->route('dashboard.auth.login')
            ->with('password-reset-successfully',
            __('messages.password_recovery_successful'));
    }
}
