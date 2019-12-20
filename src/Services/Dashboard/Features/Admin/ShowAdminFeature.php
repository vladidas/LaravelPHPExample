<?php

namespace App\Services\Dashboard\Features\Admin;

use Lucid\Foundation\Feature;
use App\Domains\Admin\Jobs\FindAdminByIdJob;
use App\Domains\Http\Jobs\RespondWithViewJob;

/**
 * Class ShowAdminFeature
 * @package App\Services\Dashboard\Features\Admin
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class ShowAdminFeature extends Feature
{
    /**
     * @var int
     */
    protected $adminId;

    /**
     * ShowAdminFeature constructor.
     * @param int $adminId
     */
    public function __construct(int $adminId)
    {
        $this->adminId = $adminId;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        $admin = $this->run(new FindAdminByIdJob($this->adminId));

        return $this->run(new RespondWithViewJob('dashboard::admin.show',
            [
                'item' => $admin,
            ]
        ));
    }
}
