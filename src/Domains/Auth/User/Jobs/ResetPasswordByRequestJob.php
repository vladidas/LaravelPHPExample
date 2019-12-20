<?php

namespace App\Domains\Auth\User\Jobs;

use Lucid\Foundation\Job;
use Illuminate\Support\Facades\Hash;
use App\Data\Repositories\UserRepository;
use App\Services\Frontend\Http\Requests\Auth\NewPasswordRequest;

/**
 * Class ResetPasswordByRequestJob
 * @package App\Domains\Auth\User\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class ResetPasswordByRequestJob extends Job
{
    /**
     * @var NewPasswordRequest
     */
    protected $request;

    /**
     * @var int
     */
    protected $userId;

    /**
     * ResetPasswordByRequestJob constructor.
     * @param NewPasswordRequest $request
     * @param int $userId
     */
    public function __construct(NewPasswordRequest $request, int $userId)
    {
        $this->request = $request;
        $this->userId = $userId;
    }

    /**
     * @param UserRepository $userRepository
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function handle(UserRepository $userRepository)
    {
        $attributes = [
            'password' => Hash::make($this->request->get('password'))
        ];

        return $userRepository->update($this->userId, $attributes);
    }
}
