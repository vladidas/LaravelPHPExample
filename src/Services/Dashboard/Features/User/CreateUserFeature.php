<?php

namespace App\Services\Dashboard\Features\User;

use App\Data\Models\User;
use Lucid\Foundation\Feature;
use App\Domains\Http\Jobs\RespondWithViewJob;

/**
 * Class CreateUserFeature
 * @package App\Services\Dashboard\Features\User
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class CreateUserFeature extends Feature
{
    /**
     * @param User $user
     * @return mixed
     */
    public function handle(User $user)
    {
        return $this->run(new RespondWithViewJob('dashboard::user.create',
            [
                'item' => $user
            ]
        ));
    }
}
