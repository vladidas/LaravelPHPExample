<?php

namespace App\Services\Dashboard\Http\Controllers;

use Lucid\Foundation\Http\Controller;
use App\Services\Dashboard\Features\Auth\LoginPageFeature;
use App\Services\Dashboard\Features\Auth\LoginAdminFeature;
use App\Services\Dashboard\Features\Auth\LogoutAdminFeature;
use App\Services\Dashboard\Features\Auth\PasswordRecoveryPageFeature;
use App\Services\Dashboard\Features\Auth\AcceptPasswordRecoveryFeature;

/**
 * Class AuthController
 * @package App\Services\Dashboard\Http\Controllers
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class AuthController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return $this->serve(LoginPageFeature::class);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate()
    {
        return $this->serve(LoginAdminFeature::class);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        return $this->serve(LogoutAdminFeature::class);
    }

    /**
     * @param $token
     * @return \Illuminate\Http\Response
     */
    public function passwordRecovery($token)
    {
        return $this->serve(PasswordRecoveryPageFeature::class, [
            'token' => $token
        ]);
    }

    /**
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptPasswordRecovery($token)
    {
        return $this->serve(AcceptPasswordRecoveryFeature::class, [
            'token' => $token
        ]);
    }

}
