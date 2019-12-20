<?php

namespace App\Services\Dashboard\Features\Admin;

use App\Data\Models\Admin;
use Illuminate\Support\Str;
use Lucid\Foundation\Feature;
use App\Domains\Admin\Jobs\StoreAdminJob;
use App\Domains\Admin\Jobs\StoreAdminResetPasswordJob;
use App\Domains\Admin\Jobs\SendInviteLetterToAdminJob;
use App\Services\Dashboard\Http\Requests\Admin\StoreAdminRequest;

/**
 * Class StoreAdminFeature
 * @package App\Services\Dashboard\Features\Admin
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class StoreAdminFeature extends Feature
{
    /**
     * @param StoreAdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(StoreAdminRequest $request)
    {
        $attributes = array_filter($request->except(
            '_token',
            'admin_id',
            'password_confirmation'
        ));

        if (!$request->get('password')) {
            $attributes['password'] = Str::random(6);
        }

        /** @var Admin $admin */
        $admin = $this->run(new StoreAdminJob($attributes));

        if (!$admin) {
            return redirect()
                ->back()
                ->with('ntf-danger', __('messages.wrong_saving'));
        }

        $this->run(new StoreAdminResetPasswordJob($admin->getEmail()));

        $this->runInQueue(SendInviteLetterToAdminJob::class, [
            'admin'      => $admin,
            'attributes' => $attributes,
        ]);

        return redirect()
            ->route('dashboard.admins.index')
            ->with('ntf-success', __('messages.successful_save'));
    }
}
