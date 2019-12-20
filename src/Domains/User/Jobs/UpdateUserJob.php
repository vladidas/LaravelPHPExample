<?php

namespace App\Domains\User\Jobs;

use Lucid\Foundation\Job;
use Illuminate\Support\Facades\Hash;
use App\Data\Repositories\UserRepository;
use App\Services\Dashboard\Http\Requests\User\UpdateUserRequest;

/**
 * Class UpdateUserJob
 * @package App\Domains\User\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class UpdateUserJob extends Job
{
    /**
     * @var UpdateUserRequest
     */
    protected $request;

    /**
     * @var int
     */
    protected $userId;

    /**
     * UpdateUserJob constructor.
     * @param UpdateUserRequest $request
     * @param int $userId
     */
    public function __construct(UpdateUserRequest $request, int $userId)
    {
        $this->request = $request;
        $this->userId  = $userId;
    }

    /**
     * @param UserRepository $userRepository
     * @return bool|\Illuminate\Database\Eloquent\Model
     */
    public function handle(UserRepository $userRepository)
    {
        $attributes = $this->request->only([
            'name',
            'surname',
            'email',
            'phone',
        ]);

        if (null !== $this->request->get('password')) {
            $attributes['password'] = Hash::make($this->request->get('password'));
        }

        return $userRepository->update($this->userId, $attributes);
    }
}
