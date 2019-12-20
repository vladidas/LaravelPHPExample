<?php

namespace App\Services\Dashboard\Features\User;

use Lucid\Foundation\Feature;
use App\Domains\User\Jobs\FindUserByIdJob;
use App\Domains\Http\Jobs\RespondWithViewJob;

/**
 * Class EditUserFeature
 * @package App\Services\Dashboard\Features\User
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class EditUserFeature extends Feature
{
    /**
     * @var int
     */
    protected $userId;

    /**
     * EditUserFeature constructor.
     * @param int $userId
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        $user = $this->run(new FindUserByIdJob($this->userId));

        return $this->run(new RespondWithViewJob('dashboard::user.edit',
            [
                'item' => $user
            ]
        ));
    }
}
