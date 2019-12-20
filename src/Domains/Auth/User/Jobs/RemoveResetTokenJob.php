<?php

namespace App\Domains\Auth\User\Jobs;

use Lucid\Foundation\Job;
use Illuminate\Support\Facades\DB;

/**
 * Class RemoveResetTokenJob
 * @package App\Domains\Auth\User\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class RemoveResetTokenJob extends Job
{
    /**
     * @var string
     */
    protected $token;

    /**
     * RemoveResetTokenJob constructor.
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Execute the jobs
     */
    public function handle()
    {
        $passwordRecoveryTable = config('auth.passwords.user.table');

        /**
         * Delete old requests for password reset
         */
        DB::table($passwordRecoveryTable)->where([
            'token' => $this->token
        ])->delete();
    }
}
