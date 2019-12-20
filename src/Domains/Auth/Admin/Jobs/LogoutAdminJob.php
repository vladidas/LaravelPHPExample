<?php

namespace App\Domains\Auth\Admin\Jobs;

use Illuminate\Support\Facades\Auth;
use Lucid\Foundation\Job;

/**
 * Class LogoutAdminJob
 * @package App\Domains\Auth\Admin\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class LogoutAdminJob extends Job
{
    /**
     * Log out current user
     */
    public function handle()
    {
        Auth::guard('admin')->logout();
    }
}
