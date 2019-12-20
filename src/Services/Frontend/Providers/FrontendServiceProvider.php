<?php
namespace App\Services\Frontend\Providers;

use View;
use Lang;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Translation\TranslationServiceProvider;
use App\Domains\Auth\User\Jobs\GetSumBonusesByUserJob;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

/**
 * Class FrontendServiceProvider
 * @package App\Services\Frontend\Providers
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class FrontendServiceProvider extends ServiceProvider
{
    use DispatchesJobs;

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
        $this->loadMigrationsFrom([realpath(__DIR__ . '/../database/migrations')]);

        $this->app->make(EloquentFactory::class)->load(realpath(__DIR__ . '/../database/factories'));

        $this->sendUserBalanceToLayout();
    }

    /**
    * Register the Dashboard service provider.
    *
    * @return void
    */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->registerResources();
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

        Lang::addNamespace('frontend', realpath(__DIR__.'/../resources/lang'));
        View::addNamespace('frontend', base_path('resources/views/vendor/frontend'));
        View::addNamespace('frontend', realpath(__DIR__.'/../resources/views'));
    }

    protected function sendUserBalanceToLayout()
    {
        $this->app->singleton('userUsedBonuses', function () {
            return $this->dispatch(new GetSumBonusesByUserJob());
        });
    }
}
