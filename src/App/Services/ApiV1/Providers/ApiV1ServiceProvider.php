<?php

namespace App\Services\ApiV1\Providers;

use App\Domains\Minecraft\Registries\Registries;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Translation\TranslationServiceProvider;

class ApiV1ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap migrations and factories for:
     * - `php artisan migrate` command.
     * - factory() helper.
     *
     * Previous usage:
     * php artisan migrate --path=src/Services/ApiV1/database/migrations
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
    }

    /**
    * Register the ApiV1 service provider.
    *
    * @return void
    */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(BroadcastServiceProvider::class);

        $this->registerResources();

        // TODO: move this somewhere sensible.

        Registries::populateRegistries();
    }

    /**
     * Register the ApiV1 service resource namespaces.
     *
     * @return void
     */
    protected function registerResources()
    {
        // Translation must be registered ahead of adding lang namespaces
        $this->app->register(TranslationServiceProvider::class);

        Lang::addNamespace('api_v1', realpath(__DIR__.'/../resources/lang'));

        View::addNamespace('api_v1', base_path('resources/views/vendor/api_v1'));
        View::addNamespace('api_v1', realpath(__DIR__.'/../resources/views'));
    }
}
