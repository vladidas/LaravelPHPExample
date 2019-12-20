<?php

namespace App\Services\Dashboard\Features\User;

use Lucid\Foundation\Feature;
use App\Domains\User\Jobs\FindUserByIdJob;
use App\Domains\Http\Jobs\RespondWithViewJob;

/**
 * Class ShowUserFeature
 * @package App\Services\Dashboard\Features\User
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class ShowUserFeature extends Feature
{
    /**
     * @var int
     */
    protected $userId;

    /**
     * ShowUserFeature constructor.
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

        return $this->run(new RespondWithViewJob('dashboard::user.show',
            [
                'item' => $user
            ]
        ));
    }
}
