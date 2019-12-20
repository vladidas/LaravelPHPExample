<?php

namespace App\Services\Frontend\Features\Auth;

use App\Data\Models\User;
use Lucid\Foundation\Feature;
use App\Domains\Http\Jobs\RespondWithViewJob;

/**
 * Class RegisterPageFeature
 * @package App\Services\Frontend\Features\Auth
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class RegisterPageFeature extends Feature
{
    /**
     * @param User $user
     * @return mixed
     */
    public function handle(User $user)
    {
        return $this->run(new RespondWithViewJob('frontend::auth.register', [
            'item' => $user
        ]));
    }
}
