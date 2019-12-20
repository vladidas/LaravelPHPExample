<?php

namespace App\Services\Dashboard\Features\Admin;

use Lucid\Foundation\Feature;
use App\Domains\Admin\Jobs\UpdateAdminJob;
use App\Services\Dashboard\Http\Requests\Admin\UpdateAdminRequest;

/**
 * Class UpdateAdminFeature
 * @package App\Services\Dashboard\Features\Admin
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class UpdateAdminFeature extends Feature
{
    /**
     * @var int
     */
    protected $adminId;

    /**
     * UpdateAdminFeature constructor.
     * @param int $adminId
     */
    public function __construct(int $adminId)
    {
        $this->adminId = $adminId;
    }

    /**
     * @param UpdateAdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(UpdateAdminRequest $request)
    {
        $attributes = array_filter($request->except(
            '_token',
            'admin_id',
            'password_confirmation'
        ));

        $attributes['can_edit_admin']   = $request->has('can_edit_admin');
        $attributes['can_delete_admin'] = $request->has('can_delete_admin');
        $attributes['send_letters']     = $request->has('send_letters');

        $result = $this->run(new UpdateAdminJob($this->adminId, $attributes));

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
