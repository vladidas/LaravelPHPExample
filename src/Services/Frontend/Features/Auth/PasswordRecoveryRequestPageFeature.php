<?php

namespace App\Services\Frontend\Features\Auth;

use Lucid\Foundation\Feature;
use App\Domains\Http\Jobs\RespondWithViewJob;

/**
 * Class PasswordRecoveryRequestPageFeature
 * @package App\Services\Frontend\Features\Auth
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class PasswordRecoveryRequestPageFeature extends Feature
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function handle()
    {
        return $this->run(new RespondWithViewJob('frontend::auth.password-recovery-request'));
    }
}
