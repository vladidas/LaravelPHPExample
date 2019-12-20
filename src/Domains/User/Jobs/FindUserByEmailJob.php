<?php

namespace App\Domains\User\Jobs;

use Lucid\Foundation\Job;
use App\Data\Repositories\UserRepository;

/**
 * Class FindUserByEmailJob
 * @package App\Domains\User\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class FindUserByEmailJob extends Job
{
    /**
     * @var string
     */
    protected $userEmail;

    /**
     * FindUserByEmailJob constructor.
     * @param string $userEmail
     */
    public function __construct(string $userEmail)
    {
        $this->userEmail = $userEmail;
    }

    /**
     * @param UserRepository $userRepository
     * @return mixed
     */
    public function handle(UserRepository $userRepository)
    {
        return $userRepository->findBy('email', $this->userEmail);
    }
}
