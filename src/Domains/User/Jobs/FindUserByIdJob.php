<?php

namespace App\Domains\User\Jobs;

use App\Data\Repositories\UserRepository;
use Lucid\Foundation\Job;

/**
 * Class FindUserByIdJob
 * @package App\Domains\User\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class FindUserByIdJob extends Job
{
    /**
     * @var int
     */
    protected $userId;

    /**
     * FindUserByIdJob constructor.
     * @param int $userId
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param UserRepository $userRepository
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function handle(UserRepository $userRepository)
    {
        return $userRepository->find($this->userId);
    }
}
