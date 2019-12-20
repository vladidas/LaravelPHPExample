<?php

namespace App\Services\Dashboard\Features\User;

use Lucid\Foundation\Feature;
use App\Domains\User\Jobs\DeleteUserJob;

/**
 * Class DeleteUserFeature
 * @package App\Services\Dashboard\Features\User
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class DeleteUserFeature extends Feature
{
    /**
     * @var int
     */
    protected $userId;

    /**
     * DeleteUserFeature constructor.
     * @param int $userId
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle()
    {
        $result = $this->run(new DeleteUserJob($this->userId));

        if (!$result) {
            return redirect()
                ->back()
                ->with('ntf-danger', __('messages.wrong_saving'));
        }

        return redirect()
            ->route('dashboard.users.index')
            ->with('ntf-success', __('messages.successful_save'));
    }
}
