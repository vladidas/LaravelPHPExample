<?php

namespace App\Domains\Admin\Jobs;

use App\Data\Models\Admin;
use Illuminate\Support\Facades\DB;
use Lucid\Foundation\Job;
use Illuminate\Support\Facades\Hash;
use App\Data\Repositories\AdminRepository;

/**
 * Class UpdateAdminJob
 * @package App\Domains\Admin\Jobs
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class UpdateAdminJob extends Job
{
    /**
     * @var array
     */
    protected $attributes;

    /**
     * @var int
     */
    protected $adminId;

    /**
     * UpdateAdminJob constructor.
     * @param array $attributes
     * @param int $adminId
     */
    public function __construct(int $adminId, array $attributes)
    {
        $this->adminId = $adminId;
        $this->attributes = $attributes;
    }

    /**
     * @param AdminRepository $adminRepository
     * @return bool|\Illuminate\Database\Eloquent\Model
     */
    public function handle(AdminRepository $adminRepository)
    {
        if (array_key_exists('password', $this->attributes)) {
            $this->attributes['password'] = Hash::make($this->attributes['password']);
        }

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

            $admin = $adminRepository->update($this->adminId, $this->attributes);

            if ($outlets) {
                $admin->outlets()->detach();
                $admin->outlets()->attach($outlets);
            }

            DB::commit();
            return $admin;

        } catch (\PDOException $e) {

            logger('Error update admin in the DB... ' . $e);
            DB::rollBack();

        }

        return false;
    }
}
