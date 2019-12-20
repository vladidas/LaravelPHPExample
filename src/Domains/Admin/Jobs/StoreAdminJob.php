<?php

namespace App\Domains\Admin\Jobs;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Lucid\Foundation\Job;
use App\Data\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Data\Repositories\AdminRepository;

/**
 * Class StoreAdminJob
 * @package App\Domains\Admin\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class StoreAdminJob extends Job
{
    /**
     * @var array
     */
    protected $attributes;

    /**
     * @var string|null
     */
    protected $passwordRecoveryTable;

    /**
     * StoreAdminJob constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
        $this->passwordRecoveryTable = config('auth.passwords.admin.table');
    }

    /**
     * Execute the job.
     * @param AdminRepository $adminRepository
     * @return mixed
     */
    public function handle(AdminRepository $adminRepository)
    {
        $this->attributes['password'] = Hash::make($this->attributes['password']);

        try {

            /** Set outlets. */
            $outlets = [];
            if (array_key_exists('outlet_ids', $this->attributes)) {
                foreach ($this->attributes['outlet_ids'] as $outletId) {
                    $outlets[] = [
                        'outlet_id' => $outletId,
                        'role_id'   => $this->attributes['role_id'],
                    ];
                }
                unset($this->attributes['outlet_ids']);
            }

            DB::beginTransaction();

            /** @var Admin $admin */
            $admin = $adminRepository->fillAndSave($this->attributes);

            if ($outlets) {
                $admin->outlets()->attach($outlets);
            }

            DB::commit();
            return $admin;

        } catch (\PDOException $e) {

            logger('Error store admin in the DB... ' . $e);
            DB::rollBack();

        }

        return false;
    }
}
