<?php

namespace App\Services\Dashboard\Features\Admin;

use App\Data\Models\Admin;
use Lucid\Foundation\Feature;
use App\Data\Repositories\OutletRepository;
use App\Domains\Http\Jobs\RespondWithViewJob;

/**
 * Class CreateAdminFeature
 * @package App\Services\Dashboard\Features\Admin
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class CreateAdminFeature extends Feature
{
    /**
     * @param OutletRepository $outletRepository
     * @return mixed
     */
    public function handle(OutletRepository $outletRepository)
    {
        /** @var Admin $admin */
        $admin = auth()->user();

        if (auth()->user()->isAdmin()) {
            $outlets = $outletRepository->getOutletsByAdminId($admin->getId())->pluck('name', 'id');
        } else {
            $outlets = $outletRepository->all()->pluck('name', 'id');
        }

        /** @var Get roles. $roles */
        $roles = $admin->getRoles();
        unset($roles[$admin::ROLE_SUPER_ADMIN]);
        if (auth()->user()->isAdmin()) {
            unset($roles[$admin::ROLE_ADMIN]);
        }

        return $this->run(new RespondWithViewJob('dashboard::admin.create',
            [
                'item'    => new Admin(),
                'outlets' => $outlets,
                'roles'   => $roles
            ]
        ));
    }
}
