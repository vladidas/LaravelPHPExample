<?php

namespace App\Domains\Admin\Jobs;

use Carbon\Carbon;
use Lucid\Foundation\Job;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/**
 * Class StoreAdminResetPasswordJob
 * @package App\Domains\Admin\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class StoreAdminResetPasswordJob extends Job
{
    /**
     * @var string
     */
    protected $adminEmail;

    /**
     * @var string
     */
    protected $passwordRecoveryTable;

    /**
     * StoreAdminResetPasswordJob constructor.
     * @param string $adminEmail
     */
    public function __construct(string $adminEmail)
    {
        $this->adminEmail = $adminEmail;
        $this->passwordRecoveryTable = config('auth.passwords.admin.table');
    }

    /**
     * Send invite letter.
     */
    public function handle()
    {
        if ($this->passwordRecoveryTable) {
            DB::table($this->passwordRecoveryTable)->insert([
                'email'      => $this->adminEmail,
                'token'      => Str::random(64),
                'created_at' => Carbon::now()
            ]);
        }
    }
}
