<?php

namespace App\Domains\Admin\Jobs;

use App\Data\Repositories\AdminRepository;
use Lucid\Foundation\Job;

/**
 * Class DeleteAdminJob
 * @package App\Domains\Admin\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class DeleteAdminJob extends Job
{
    /**
     * @var int
     */
    protected $adminId;

    /**
     * DeleteAdminJob constructor.
     * @param int $adminId
     */
    public function __construct(int $adminId)
    {
        $this->adminId = $adminId;
    }

    /**
     * @param AdminRepository $adminRepository
     * @return bool
     */
    public function handle(AdminRepository $adminRepository)
    {
        return $adminRepository->remove($this->adminId);
    }
}
