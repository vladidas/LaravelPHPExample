<?php

namespace App\Services\Dashboard\Features\Admin;

use Lucid\Foundation\Feature;
use App\Domains\Admin\Jobs\DeleteAdminJob;
use App\Services\Dashboard\Http\Requests\Admin\DeleteAdminRequest;

/**
 * Class DeleteAdminFeature
 * @package App\Services\Dashboard\Features\Admin
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class DeleteAdminFeature extends Feature
{
    /**
     * @var int
     */
    protected $adminId;

    /**
     * DeleteAdminFeature constructor.
     * @param int $adminId
     */
    public function __construct(int $adminId)
    {
        $this->adminId = $adminId;
    }

    /**
     * @param DeleteAdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(DeleteAdminRequest $request)
    {
        $result = $this->run(new DeleteAdminJob($this->adminId));

        if (!$result) {
            return redirect()
                ->back()
                ->with('ntf-danger', __('messages.wrong_saving'));
        }

        return redirect()
            ->route('dashboard.admins.index')
            ->with('ntf-success', __('messages.successful_save'));
    }
}
