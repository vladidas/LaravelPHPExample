<?php

namespace App\Domains\Auth\User\Jobs;

use App\Data\Models\Order;
use Carbon\Carbon;
use App\Data\Models\User;
use Lucid\Foundation\Job;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use \App\Services\Frontend\Http\Requests\Auth\PasswordRecoveryRequest;

/**
 * Class SendPasswordRecoveryLetterJob
 * @package App\Domains\Auth\User\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class SendPasswordRecoveryLetterJob extends Job
{
    /**
     * @var PasswordRecoveryRequest
     */
    protected $request;

    /**
     * @var User
     */
    protected $user;

    /**
     * SendPasswordRecoveryLetterJob constructor.
     * @param PasswordRecoveryRequest $request
     * @param User $user
     */
    public function __construct(PasswordRecoveryRequest $request, User $user)
    {
        $this->request = $request;
        $this->user = $user;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $token = Str::random(64);

        $passwordRecoveryTable = config('auth.passwords.user.table');

        try {

            DB::beginTransaction();

            /**
             * Delete old requests for password reseting
             */
            DB::table($passwordRecoveryTable)->where([
                'email' => $this->user->getEmail()
            ])->delete();

            /**
             * Create new password reset request
             */
            DB::table($passwordRecoveryTable)->insert([
                'email'      => $this->user->getEmail(),
                'token'      => $token,
                'created_at' => Carbon::now()
            ]);

            $data = [
                'name' => $this->user->getName(),
                'link' => route('frontend.auth.password-recovery', ['token' => $token]),
            ];

            Mail::send('frontend::emails.password-recovery', $data, function ($message) {
                $message->from(env('MAIL_SENDER_EMAIL'), config('app.name'));
                $message->to($this->user->getEmail());
            });

            DB::commit();
            return true;

        } catch (\PDOException $e) {

            logger('Error recovery password in the DB... ' . $e);
            DB::rollBack();

        }

        return false;
    }
}
