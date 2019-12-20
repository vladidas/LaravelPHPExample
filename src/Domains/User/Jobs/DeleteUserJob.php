<?php

namespace App\Domains\User\Jobs;

use App\Data\Repositories\UserRepository;
use Lucid\Foundation\Job;

/**
 * Class DeleteUserJob
 * @package App\Domains\User\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class DeleteUserJob extends Job
{
    /**
     * @var int
     */
    protected $userId;

    /**
     * DeleteUserJob constructor.
     * @param int $userId
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param UserRepository $userRepository
     * @return bool
     */
    public function handle(UserRepository $userRepository)
    {
        return $userRepository->remove($this->userId);
    }
}
