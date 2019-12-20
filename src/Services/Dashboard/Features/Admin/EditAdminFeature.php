<?php

namespace App\Services\Dashboard\Features\Admin;

use Lucid\Foundation\Feature;
use App\Data\Repositories\OutletRepository;
use App\Domains\Admin\Jobs\FindAdminByIdJob;
use App\Domains\Http\Jobs\RespondWithViewJob;
use App\Services\Dashboard\Http\Requests\Admin\EditAdminRequest;

/**
 * Class EditAdminFeature
 * @package App\Services\Dashboard\Features\Admin
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class EditAdminFeature extends Feature
{
    /**
     * @var int
     */
    protected $adminId;

    /**
     * EditAdminFeature constructor.
     * @param int $adminId
     */
    public function __construct(int $adminId)
    {
        $this->adminId = $adminId;
    }

    /**
     * @param EditAdminRequest $request
     * @param OutletRepository $outletRepository
     * @return mixed
     */
    public function handle(
        EditAdminRequest $request,
        OutletRepository $outletRepository
    ) {
        $admin = $this->run(new FindAdminByIdJob($this->adminId));

        if (auth()->user()->isAdmin()) {
            $outlets = $outletRepository->getOutletsByAdminId($admin->getId())->pluck('name', 'id');
        } else {
            $outlets = $outletRepository->all()->pluck('name', 'id');
        }

        /** @var Get all roles. $roles */
        $roles = $admin->getRoles();
        unset($roles[$admin::ROLE_SUPER_ADMIN]);
        if (auth()->user()->isAdmin()) {
            unset($roles[$admin::ROLE_ADMIN]);
        }

        return $this->run(new RespondWithViewJob('dashboard::admin.edit',
            [
                'item'    => $admin,
                'roles'   => $roles,
                'outlets' => $outlets,
            ]
        ));
    }
}
