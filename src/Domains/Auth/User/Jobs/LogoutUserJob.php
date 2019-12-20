<?php

namespace App\Domains\Auth\User\Jobs;

use Illuminate\Support\Facades\Auth;
use Lucid\Foundation\Job;

/**
 * Class LogoutUserJob
 * @package App\Domains\Auth\User\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class LogoutUserJob extends Job
{
    /**
     * Log out current user
     */
    public function handle()
    {
        Auth::guard('user')->logout();
    }
}
