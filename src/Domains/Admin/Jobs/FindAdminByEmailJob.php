<?php

namespace App\Domains\Admin\Jobs;

use App\Data\Repositories\AdminRepository;
use Lucid\Foundation\Job;

class FindAdminByEmailJob extends Job
{
    /**
     * @var
     */
    protected $adminEmail;

    /**
     * Create a new job instance.
     * @param $adminEmail
     */
    public function __construct($adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }

    /**
     * Execute the job.
     * @param AdminRepository $adminRepository
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function handle(AdminRepository $adminRepository)
    {
        return $adminRepository->findBy('email', $this->adminEmail);
    }
}
