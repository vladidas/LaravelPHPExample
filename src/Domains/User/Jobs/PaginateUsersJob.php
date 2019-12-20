<?php

namespace App\Domains\User\Jobs;

use Lucid\Foundation\Job;
use App\Data\Repositories\UserRepository;

/**
 * Class PaginateUsersJob
 * @package App\Domains\User\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class PaginateUsersJob extends Job
{
    /**
     * @var int
     */
    protected $perPage;

    /**
     * @var array
     */
    protected $relations;

    /**
     * @var string
     */
    protected $orderBy;

    /**
     * @var string
     */
    protected $sorting;

    /**
     * @var array
     */
    protected $attributes;

    /**
     * PaginateUsersJob constructor.
     * @param int $perPage
     * @param array $attributes
     * @param array $relations
     * @param string $orderBy
     * @param string $sorting
     */
    public function __construct(
        int $perPage,
        array $attributes,
        array $relations = [],
        string $orderBy  = 'created_at',
        string $sorting  = 'desc'
    ) {
        $this->perPage    = $perPage;
        $this->attributes = $attributes;
        $this->relations  = $relations;
        $this->orderBy    = $orderBy;
        $this->sorting    = $sorting;
    }

    /**
     * @param UserRepository $userRepository
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function handle(UserRepository $userRepository)
    {
        return $userRepository->getPaginatorWithQueryParams(
            $this->perPage,
            $this->attributes,
            $this->relations,
            $this->orderBy,
            $this->sorting
        );
    }
}
