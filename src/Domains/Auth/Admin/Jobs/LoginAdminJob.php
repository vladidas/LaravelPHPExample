<?php

namespace App\Domains\Auth\Admin\Jobs;

use Lucid\Foundation\Job;
use Illuminate\Support\Facades\Auth;
use App\Services\Dashboard\Http\Requests\Auth\LoginRequest;

/**
 * Class LoginAdminJob
 * @package App\Domains\Auth\Admin\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class LoginAdminJob extends Job
{
    /**
     * @var LoginRequest
     */
    protected $request;

    /**
     * LoginAdminJob constructor.
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
        return Auth::guard('admin')->attempt(
            [
                'email'    => $this->request->get('email'),
                'password' => $this->request->get('password')
            ],
            $this->request->has('remember')
        );
    }
}
