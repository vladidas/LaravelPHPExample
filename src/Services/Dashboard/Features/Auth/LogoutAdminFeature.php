<?php

namespace App\Services\Dashboard\Features\Auth;

use Lucid\Foundation\Feature;
use App\Domains\Auth\Admin\Jobs\LogoutAdminJob;

/**
 * Class LogoutAdminFeature
 * @package App\Services\Dashboard\Features\Auth
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class LogoutAdminFeature extends Feature
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle()
    {
        $this->run(new LogoutAdminJob());

        return redirect()->route('dashboard.auth.login');
    }
}
