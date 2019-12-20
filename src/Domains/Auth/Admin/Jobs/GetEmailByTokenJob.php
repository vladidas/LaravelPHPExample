<?php

namespace App\Domains\Auth\Admin\Jobs;

use Lucid\Foundation\Job;
use Illuminate\Support\Facades\DB;

/**
 * Class GetEmailByTokenJob
 * @package App\Domains\Auth\Admin\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class GetEmailByTokenJob extends Job
{
    /**
     * @var string
     */
    protected $token;

    /**
     * GetEmailByTokenJob constructor.
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed|null
     */
    public function handle()
    {
        $passwordRecoveryTable = config('auth.passwords.admin.table');

        $record = DB::table($passwordRecoveryTable)->where([
            'token' => $this->token
        ])->first();

        if ($record) {
            return $record->email;
        }

        return null;
    }
}
