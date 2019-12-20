<?php

namespace App\Domains\Admin\Jobs;

use Lucid\Foundation\Job;
use App\Data\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class SendInviteLetterToAdminJob
 * @package App\Domains\Admin\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class SendInviteLetterToAdminJob extends Job implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Admin
     */
    protected $admin;

    /**
     * @var array
     */
    protected $attributes;

    /**
     * @var string
     */
    protected $passwordRecoveryTable;

    /**
     * SendInviteLetterToAdminJob constructor.
     * @param Admin $admin
     * @param array $attributes
     */
    public function __construct(Admin $admin, array $attributes)
    {
        $this->admin = $admin;
        $this->attributes = $attributes;
        $this->passwordRecoveryTable = config('auth.passwords.admin.table');
    }

    /**
     * Send invite letter.
     */
    public function handle()
    {
        $passwordRecovery = DB::table($this->passwordRecoveryTable)->where([
            'email' => $this->admin->getEmail(),
        ])->first();

        $data = [
            'name' => $this->admin->getName(),
            'password' => $this->attributes['password'],
            'link' => route('dashboard.auth.password-recovery', ['token' => $passwordRecovery->token]),
        ];

        $admin = $this->admin;
        Mail::send('dashboard::emails.admin-invite', $data, function ($message) use ($admin) {
            $message->from(env('MAIL_SENDER_EMAIL'), config('app.name'));
            $message->to($admin->getEmail());
        });
    }
}
