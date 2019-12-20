<?php
namespace App\Foundation;

use App\Services\Frontend\Providers\FrontendServiceProvider;
use App\Services\Dashboard\Providers\DashboardServiceProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class ServiceProvider
 * @package App\Foundation
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->app->register(DashboardServiceProvider::class);
        $this->app->register(FrontendServiceProvider::class);
    }
}
