<?php

namespace App\Services\Dashboard\Features\Auth;

use Lucid\Foundation\Feature;
use App\Domains\Http\Jobs\RespondWithViewJob;
use \App\Domains\Auth\Admin\Jobs\GetEmailByTokenJob;

/**
 * Class PasswordRecoveryPageFeature
 * @package App\Services\Dashoboard\Features\Auth
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class PasswordRecoveryPageFeature extends Feature
{
    /**
     * @var string
     */
    protected $token;

    /**
     * PasswordRecoveryPageFeature constructor.
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function handle()
    {
        $email = $this->run(new GetEmailByTokenJob($this->token));

        if (!$email) {
            $data = [
                'validToken' => false,
                'message'    => __('messages.inspired_token')
            ];
        } else {
            $data = [
                'validToken' => true,
                'email'      => $email,
                'token'      => $this->token
            ];
        }

        return $this->run(new RespondWithViewJob('dashboard::auth.password-recovery', $data));
    }
}
