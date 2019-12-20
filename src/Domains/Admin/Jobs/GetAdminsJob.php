<?php

namespace App\Domains\Admin\Jobs;

use App\Data\Repositories\AdminRepository;
use Lucid\Foundation\Job;

/**
 * Class GetAdminsJob
 * @package App\Domains\Admin\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class GetAdminsJob extends Job
{
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
     * GetAdminsJob constructor.
     * @param array $relations
     * @param string $orderBy
     * @param string $sorting
     */
    public function __construct(array $relations = [], string $orderBy = 'created_at', string $sorting = 'desc')
    {
        $this->relations = $relations;
        $this->orderBy = $orderBy;
        $this->sorting = $sorting;
    }

    /**
     * @param AdminRepository $adminRepository
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function handle(AdminRepository $adminRepository)
    {
        return $adminRepository->all($this->relations, $this->orderBy, $this->sorting);
    }
}
