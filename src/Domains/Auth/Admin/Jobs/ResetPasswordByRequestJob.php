<?php

namespace App\Domains\Auth\Admin\Jobs;

use Lucid\Foundation\Job;
use Illuminate\Support\Facades\Hash;
use App\Data\Repositories\AdminRepository;
use App\Services\Dashboard\Http\Requests\Auth\NewPasswordRequest;

/**
 * Class ResetPasswordByRequestJob
 * @package App\Domains\Auth\User\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class ResetPasswordByRequestJob extends Job
{
    /**
     * @var NewPasswordRequest
     */
    protected $request;

    /**
     * @var int
     */
    protected $adminId;

    /**
     * ResetPasswordByRequestJob constructor.
     * @param NewPasswordRequest $request
     * @param int $adminId
     */
    public function __construct(NewPasswordRequest $request, int $adminId)
    {
        $this->request = $request;
        $this->adminId = $adminId;
    }

    /**
     * @param AdminRepository $adminRepository
     * @return mixed
     */
    public function handle(AdminRepository $adminRepository)
    {
        $attributes = [
            'password' => Hash::make($this->request->get('password'))
        ];

        return $adminRepository->update($this->adminId, $attributes);
    }
}
