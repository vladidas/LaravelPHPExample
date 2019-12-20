<?php

namespace App\Services\Frontend\Features\User;

use App\Data\Models\Product;
use App\Data\Models\User;
use App\Domains\Product\Jobs\PaginateProductsJob;
use Lucid\Foundation\Feature;
use App\Domains\Http\Jobs\RespondWithViewJob;
use App\Domains\User\Jobs\PaginateUserHistoriesJob;
use App\Services\Frontend\Http\Requests\User\SearchHistoryRequest;

/**
 * Class GetUserHistoriesListFeature
 * @package App\Services\Frontend\Features\User
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class GetUserHistoriesListFeature extends Feature
{
    /**
     * @var User
     */
    protected $user;

    /**
     * GetUserHistoriesListFeature constructor.
     */
    public function __construct()
    {
        $this->user = auth()->guard('user')->user();
    }

    /**
     * @param SearchHistoryRequest $request
     * @return mixed
     */
    public function handle(SearchHistoryRequest $request)
    {
        /** @var array $attributes */
        $attributes = array_filter($request->only([
            'date_start',
            'date_end',
            'transaction',
        ]));

        /** Sorting. */
        User::getHistorySort(
            $request->get('sort_id'),
            $orderBy,
            $sorting
        );

        /** Get items. */
        $histories = $this->run(new PaginateUserHistoriesJob(
            $this->user->getId(),
            20,
            $attributes,
            [],
            $orderBy,
            $sorting
        ));

        return $this->run(new RespondWithViewJob('frontend::history.index',
            [
                'items' => $histories
            ]
        ));
    }
}
