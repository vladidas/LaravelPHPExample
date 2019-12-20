<?php

namespace App\Services\Dashboard\Features\User;

use Lucid\Foundation\Feature;
use App\Domains\User\Jobs\UpdateUserJob;
use App\Services\Dashboard\Http\Requests\User\UpdateUserRequest;

/**
 * Class UpdateUserFeature
 * @package App\Services\Dashboard\Features\User
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class UpdateUserFeature extends Feature
{
    /**
     * @var int
     */
    protected $userId;

    /**
     * UpdateUserFeature constructor.
     * @param int $userId
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param UpdateUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(UpdateUserRequest $request)
    {
        $result = $this->run(new UpdateUserJob($request, $this->userId));

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
