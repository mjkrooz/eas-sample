<?php

use App\Services\Tools\Http\Controllers\RaycastingGeneratorController;
use App\Services\Tools\Http\Controllers\TextComponentToolsController;
use App\Services\Tools\Http\Controllers\ToolsController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Service - Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for this service.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group([
    'prefix' => LaravelLocalization::setLocale() . '/tools',
    'middleware' => ['localeSessionRedirect', 'localize']
], function()
{
    Route::get('/', function() {

        return view('tools::pages/home');
    })->name('tools:home');
    Route::get('/', [ToolsController::class, 'home'])->name('tools:home');
    Route::get('/test', function () {
        return view('tools::pages/auger');
    });
    Route::get('featured', [ToolsController::class, 'home'])->name('tools:featured');
    Route::get('data-packs', [ToolsController::class, 'home'])->name('tools:data-packs');
    Route::get('resource-packs', [ToolsController::class, 'home'])->name('tools:resource-packs');
    Route::get('other', [ToolsController::class, 'home'])->name('tools:other');

    Route::get('data-packs/loot-table-evaluator', [ToolsController::class, 'home'])->name('tools:data-packs/loot-table-evaluator');
    Route::get('data-packs/packmcmeta-evaluator', [ToolsController::class, 'home'])->name('tools:data-packs/packmcmeta-evaluator');
    Route::get('data-packs/recipe-evaluator', [ToolsController::class, 'home'])->name('tools:data-packs/recipe-evaluator');
    Route::get('data-packs/tag-evaluator', [ToolsController::class, 'home'])->name('tools:data-packs/tag-evaluator');
    Route::get('data-packs/advancement-evaluator', [ToolsController::class, 'home'])->name('tools:data-packs/advancement-evaluator');

    Route::get('data-packs/text-component-evaluator', [TextComponentToolsController::class, 'viewEvaluator'])->name('tools:data-packs/text-component-evaluator');
    Route::post('data-packs/text-component-evaluator', [TextComponentToolsController::class, 'evaluate']);

    Route::get('data-packs/raycasting-generator', [RaycastingGeneratorController::class, 'viewGenerator'])->name('tools:data-packs/raycasting-generator');
    Route::post('data-packs/raycasting-generator', [RaycastingGeneratorController::class, 'generate']);
});
