<?php

namespace App\Services\Dashboard\Features\Auth;

use App\Data\Models\Admin;
use Lucid\Foundation\Feature;
use App\Domains\Http\Jobs\RespondWithViewJob;

/**
 * Class LoginPageFeature
 * @package App\Services\Dashboard\Features\Auth
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class LoginPageFeature extends Feature
{
    /**
     * @param Admin $admin
     * @return mixed
     */
    public function handle(Admin $admin)
    {
        return $this->run(new RespondWithViewJob('dashboard::auth.login', [
            'item' => $admin
        ]));
    }
}
