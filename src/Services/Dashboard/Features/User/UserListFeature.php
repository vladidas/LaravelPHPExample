<?php

namespace App\Services\Dashboard\Features\User;

use App\Data\Models\User;
use Lucid\Foundation\Feature;
use App\Domains\User\Jobs\PaginateUsersJob;
use App\Domains\Http\Jobs\RespondWithViewJob;
use App\Services\Dashboard\Http\Requests\User\SearchUserRequest;

/**
 * Class UserListFeature
 * @package App\Services\Dashboard\Features\User
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class UserListFeature extends Feature
{
    /**
     * @param SearchUserRequest $request
     * @return mixed
     */
    public function handle(SearchUserRequest $request)
    {
        /** @var array $attributes */
        $attributes = array_filter($request->only([
            'name',
            'role_id',
            'surname',
        ]));

        /** Sorting. */
        User::getSort(
            $request->get('sort_id'),
            $orderBy,
            $sorting
        );

        /** Attach outletsId if admin role is Admin or Seller. */
        if (auth()->user()->isAdmin() || auth()->user()->isSeller() ) {
            $outletsId = auth()->user()->outlets->pluck('id');
            $attributes['outlet_ids'] = $outletsId;
        }

        /** Get items. */
        $users = $this->run(new PaginateUsersJob(
            20,
            $attributes,
            [],
            $orderBy,
            $sorting
        ));

        return $this->run(new RespondWithViewJob('dashboard::user.index',
            [
                'items' => $users,
            ]
        ));
    }
}
