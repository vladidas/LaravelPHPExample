<?php

namespace App\Domains\Auth\User\Jobs;

use Lucid\Foundation\Job;
use Illuminate\Support\Facades\Auth;
use App\Services\Frontend\Http\Requests\Auth\LoginRequest;

/**
 * Class LoginUserJob
 * @package App\Domains\Auth\User\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class LoginUserJob extends Job
{
    /**
     * @var LoginRequest
     */
    protected $request;

    /**
     * LoginUserJob constructor.
     * @param LoginRequest $request
     */
    public function __construct(LoginRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle()
    {
        return Auth::guard('user')->attempt(
            [
                'email'    => $this->request->get('email'),
                'password' => $this->request->get('password')
            ],
            $this->request->has('remember')
        );
    }
}
