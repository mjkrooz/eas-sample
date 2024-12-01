<?php

namespace App\Services\Tools\Providers;

use App\Domains\Minecraft\Tools\Tools;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;
use App\Services\Tools\Providers\RouteServiceProvider;
use App\Services\Tools\Providers\BroadcastServiceProvider;
use Illuminate\Translation\TranslationServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class ToolsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap migrations and factories for:
     * - `php artisan migrate` command.
     * - factory() helper.
     *
     * Previous usage:
     * php artisan migrate --path=src/Services/Tools/database/migrations
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
    * Register the Tools service provider.
    *
    * @return void
    */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(BroadcastServiceProvider::class);

        $this->registerResources();
        Tools::registerTools();
    }

    /**
     * Register the Tools service resource namespaces.
     *
     * @return void
     */
    protected function registerResources()
    {
        // Translation must be registered ahead of adding lang namespaces
        $this->app->register(TranslationServiceProvider::class);

        Lang::addNamespace('tools', realpath(__DIR__.'/../resources/lang'));

        View::addNamespace('tools', base_path('resources/views/vendor/tools'));
        View::addNamespace('tools', realpath(__DIR__.'/../resources/views'));
    }
}
