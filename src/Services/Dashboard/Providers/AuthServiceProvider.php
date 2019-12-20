<?php

namespace App\Services\Dashboard\Providers;

use View;
use Lang;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Class AuthServiceProvider
 * @package App\Services\Dashboard\Providers
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //
    ];

    /**
     *
     */
    public function boot()
    {
        $this->registerPolicies();
    }

    /**
    * Register the Dashboard service provider.
    *
    * @return void
    */
    public function register()
    {
        //
    }
}
