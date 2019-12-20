<?php

namespace App\Domains\Admin\Jobs;

use Lucid\Foundation\Job;
use App\Data\Repositories\AdminRepository;

/**
 * Class PaginateAdminsJob
 * @package App\Domains\Admin\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class PaginateAdminsJob extends Job
{
    /**
     * @var int
     */
    protected $perPage;

    /**
     * @var array
     */
    protected $attributes;

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
     * PaginateAdminsJob constructor.
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
     * @param AdminRepository $adminRepository
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function handle(AdminRepository $adminRepository)
    {
        return $adminRepository->getPaginatorWithQueryParams(
            $this->perPage,
            $this->attributes,
            $this->relations,
            $this->orderBy,
            $this->sorting
        );
    }
}
