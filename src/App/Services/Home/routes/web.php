<?php

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
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localize']
], function()
{
    Route::get('/', function() {
        return view('home::pages/home');
    })->name('home');

    Route::get('/about', function () {
        return view('home::pages/about');
    })->name('home:about');
});
