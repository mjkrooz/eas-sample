<?php

/*
|--------------------------------------------------------------------------
| Service - API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for this service.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Prefix: /api/api_v1
use App\Services\ApiV1\Http\Controllers\ToolsController;


Route::group(
    [
        'prefix' => 'v1',
        'middleware' => 'json_request'
    ], function() {

    /**
     * Tools
     */

    //Route::post('tools/data-packs/advancement-evaluator', [ToolsController::class, 'evaluateAdvancements']);
    Route::post('tools/data-packs/text-component-evaluator', [ToolsController::class, 'evaluateTextComponents']);
    Route::post('tools/other/target-selector-evaluator', [ToolsController::class, 'evaluateTargetSelectors']);
    Route::post('tools/data-packs/raycasting-generator', [ToolsController::class, 'generateRaycastDataPack']);
});
