<?php

namespace App\Services\Dashboard\Features\Admin;

use App\Data\Models\Admin;
use Lucid\Foundation\Feature;
use App\Domains\Http\Jobs\RespondWithViewJob;
use App\Domains\Admin\Jobs\PaginateAdminsJob;
use App\Services\Dashboard\Http\Requests\Admin\SearchAdminRequest;

/**
 * Class AdminsListFeature
 * @package App\Services\Dashboard\Features\Admin
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class AdminsListFeature extends Feature
{
    /**
     * @param SearchAdminRequest $request
     * @return mixed
     */
    public function handle(SearchAdminRequest $request)
    {
        /** @var array $attributes */
        $attributes = array_filter($request->only([
            'name',
            'role_id',
            'surname',
        ]));

        /** Attach outletsId if admin role is Admin or Seller. */
        if (auth()->user()->isAdmin() || auth()->user()->isSeller() ) {
            $outletIds = auth()->user()->outlets->pluck('id');
            $attributes['outlet_ids'] = $outletIds;
        }

        /** Sorting. */
        Admin::getSort(
            $request->get('sort_id'),
            $orderBy,
            $sorting
        );

        /** Get items. */
        $admins = $this->run(new PaginateAdminsJob(
            20,
            $attributes,
            [],
            $orderBy,
            $sorting
        ));

        return $this->run(new RespondWithViewJob('dashboard::admin.index',
            [
                'items' => $admins
            ]
        ));
    }
}
