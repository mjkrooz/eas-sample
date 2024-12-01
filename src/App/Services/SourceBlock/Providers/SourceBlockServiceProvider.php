<?php

namespace App\Services\SourceBlock\Providers;

use Lang;
use View;
use Illuminate\Support\ServiceProvider;
use app\Services\Home\Providers\RouteServiceProvider;
use app\Services\Home\Providers\BroadcastServiceProvider;
use Illuminate\Translation\TranslationServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class SourceBlockServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap migrations and factories for:
     * - `php artisan migrate` command.
     * - factory() helper.
     *
     * Previous usage:
     * php artisan migrate --path=src/Services/Home/database/migrations
     * Now:
     * php artisan migrate
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
    * Register the Home service provider.
    *
    * @return void
    */
    public function register()
    {
        $this->registerResources();
    }

    /**
     * Register the Home service resource namespaces.
     *
     * @return void
     */
    protected function registerResources()
    {
        // Translation must be registered ahead of adding lang namespaces
        $this->app->register(TranslationServiceProvider::class);

        Lang::addNamespace('sourceblock', realpath(__DIR__.'/../resources/lang'));

        View::addNamespace('sourceblock', base_path('resources/views/vendor/home'));
        View::addNamespace('sourceblock', realpath(__DIR__.'/../resources/views'));
    }
}
