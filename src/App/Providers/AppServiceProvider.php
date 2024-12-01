<?php

namespace App\Providers;

use Illuminate\Translation\TranslationServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->register(TranslationServiceProvider::class);

        //\Lang::addNamespace('sourceblock', base_path('resources/lang'));
        //\View::addNamespace('sourceblock', base_path('resources/views'));
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->app->bind('path.public', function() {
            return base_path() . '/../html/beta/assets';
        });
    }
}
