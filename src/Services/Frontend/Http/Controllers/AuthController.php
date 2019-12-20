<?php

namespace App\Services\Frontend\Http\Controllers;

use Lucid\Foundation\Http\Controller;
use App\Services\Frontend\Features\Auth\LoginPageFeature;
use App\Services\Frontend\Features\Auth\LoginUserFeature;
use App\Services\Frontend\Features\Auth\LogoutUserFeature;
use App\Services\Frontend\Features\Auth\RegisterUserFeature;
use App\Services\Frontend\Features\Auth\RegisterPageFeature;
use App\Services\Frontend\Features\Auth\PasswordRecoveryPageFeature;
use App\Services\Frontend\Features\Auth\AcceptPasswordRecoveryFeature;
use App\Services\Frontend\Features\Auth\PasswordRecoveryRequestPageFeature;
use App\Services\Frontend\Features\Auth\AcceptPasswordRecoveryRequestFeature;

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
        return $this->serve(LoginUserFeature::class);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        return $this->serve(LogoutUserFeature::class);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function passwordRecoveryRequest()
    {
        return $this->serve(PasswordRecoveryRequestPageFeature::class);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptPasswordRecoveryRequest()
    {
        return $this->serve(AcceptPasswordRecoveryRequestFeature::class);
    }

    /**
     * @param string $token
     * @return mixed
     */
    public function passwordRecovery(string $token)
    {
        return $this->serve(PasswordRecoveryPageFeature::class, [
            'token' => $token
        ]);
    }

    /**
     * @param string $token
     * @return mixed
     */
    public function acceptPasswordRecovery(string $token)
    {
        return $this->serve(AcceptPasswordRecoveryFeature::class, [
            'token' => $token
        ]);
    }

    /**
     * @return mixed
     */
    public function register()
    {
        return $this->serve(RegisterPageFeature::class);
    }

    /**
     * @return mixed
     */
    public function registration()
    {
        return $this->serve(RegisterUserFeature::class);
    }
}
