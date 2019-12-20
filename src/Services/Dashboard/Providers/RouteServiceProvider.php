<?php

namespace App\Services\Dashboard\Providers;

use Illuminate\Routing\Router;
use Lucid\Foundation\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class RouteServiceProvider
 * @package App\Services\Dashboard\Providers
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * Read the routes from the "api.php" and "web.php" files of this Service
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function map(Router $router)
    {
        $namespace = 'App\Services\Dashboard\Http\Controllers';
        $pathApi = __DIR__.'/../routes/api.php';
        $pathWeb = __DIR__.'/../routes/web.php';

        $this->loadRoutesFiles($router, $namespace, $pathApi, $pathWeb);
    }
}
