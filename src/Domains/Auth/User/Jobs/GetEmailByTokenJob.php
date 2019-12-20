<?php

namespace App\Domains\Auth\User\Jobs;

use Illuminate\Support\Facades\DB;
use Lucid\Foundation\Job;

/**
 * Class GetEmailByTokenJob
 * @package App\Domains\Auth\User\Jobs
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
        $passwordRecoveryTable = config('auth.passwords.user.table');

        $record = DB::table($passwordRecoveryTable)->where([
            'token' => $this->token
        ])->first();

        if ($record) {
            return $record->email;
        }

        return null;
    }
}
