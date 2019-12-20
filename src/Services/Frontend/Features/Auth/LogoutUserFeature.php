<?php

namespace App\Services\Frontend\Features\Auth;

use Lucid\Foundation\Feature;
use App\Domains\Auth\User\Jobs\LogoutUserJob;

/**
 * Class LogoutUserFeature
 * @package App\Services\Frontend\Features\Auth
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class LogoutUserFeature extends Feature
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle()
    {
        $this->run(new LogoutUserJob());

        return redirect()->route('frontend.auth.login');
    }
}
