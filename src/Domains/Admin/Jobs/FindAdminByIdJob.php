<?php

namespace App\Domains\Admin\Jobs;

use Lucid\Foundation\Job;
use App\Data\Repositories\AdminRepository;

/**
 * Class FindAdminByIdJob
 * @package App\Domains\Admin\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class FindAdminByIdJob extends Job
{
    /**
     * @var int
     */
    protected $adminId;

    /**
     * FindAdminByIdJob constructor.
     * @param int $adminId
     */
    public function __construct(int $adminId)
    {
        $this->adminId = $adminId;
    }

    /**
     * @param AdminRepository $adminRepository
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function handle(AdminRepository $adminRepository)
    {
        return $adminRepository->findByAdminIdWithOutletsList($this->adminId);
    }
}
