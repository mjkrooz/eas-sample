<?php

namespace App\Services\Home\Providers;

use Illuminate\Routing\Router;
use Lucid\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Read the routes from the "api.php" and "web.php" files of this Service
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        $namespace = 'app\Services\Home\Http\Controllers';
        $pathApi = __DIR__.'/../routes/api.php';
        $pathWeb = __DIR__.'/../routes/web.php';

        $this->loadRoutesFiles($router, $namespace, $pathApi, $pathWeb);
    }
}
