<?php

namespace App\Domains\Auth\User\Jobs;

use Illuminate\Support\Facades\Hash;
use Lucid\Foundation\Job;
use Illuminate\Support\Facades\Auth;
use App\Data\Repositories\UserRepository;

/**
 * Class RegisterUserJob
 * @package App\Domains\Auth\User\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class RegisterUserJob extends Job
{
    /**
     * @var array
     */
    protected $attributes;

    /**
     * RegisterUserJob constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @param UserRepository $userRepository
     * @return mixed
     */
    public function handle(UserRepository $userRepository)
    {
        $this->attributes['password'] = Hash::make($this->attributes['password']);
        $user = $userRepository->fillAndSave($this->attributes);

        return Auth::guard('user')->login($user);
    }
}
