<?php
namespace App\Services\Dashboard\Providers;

use View;
use Lang;
use Blade;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Translation\TranslationServiceProvider;

/**
 * Class DashboardServiceProvider
 * @package App\Services\Dashboard\Providers
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class DashboardServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap migrations and factories for:
     * - `php artisan migrate` command.
     * - factory() helper.
     *
     * Previous usage:
     * php artisan migrate --path=src/Services/Dashboard/database/migrations
     * Now:
     * php artisan migrate
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom([
            realpath(__DIR__ . '/../database/migrations')
        ]);

        $this->app->make(EloquentFactory::class)
            ->load(realpath(__DIR__ . '/../database/factories'));
    }

    /**
    * Register the Dashboard service provider.
    *
    * @return void
    */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);

        $this->registerResources();

        $this->registerBladeDirectives();
    }

    protected function registerBladeDirectives()
    {
        Blade::if('permissions', function ($roles) {
            return auth()->guard('admin')->user()->havePermissions($roles);
        });
    }

    /**
     * Register the Dashboard service resource namespaces.
     *
     * @return void
     */
    protected function registerResources()
    {
        // Translation must be registered ahead of adding lang namespaces
        $this->app->register(TranslationServiceProvider::class);

        Lang::addNamespace('dashboard', realpath(__DIR__.'/../resources/lang'));

        View::addNamespace('dashboard', base_path('resources/views/vendor/dashboard'));
        View::addNamespace('dashboard', realpath(__DIR__.'/../resources/views'));
    }
}
