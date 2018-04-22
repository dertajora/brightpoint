<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes for End User App
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['log_api']], function () {
	Route::post('/register', 'API\UserController@register');
	Route::post('/login', 'API\UserController@login');
});

Route::group(['middleware' => ['check_param','log_api']], function () {
    Route::post('/user_information', 'API\UserController@user_information');
    Route::post('/nearest_spbu', 'API\GasStationController@nearest_spbu');
    Route::post('/detail_spbu', 'API\GasStationController@detail_spbu');
    Route::post('/find_brightwash', 'API\BrightwashController@find_brightwash');
    Route::post('/detail_brightwash', 'API\BrightwashController@detail_brightwash');
    Route::post('/confirm_queue', 'API\BrightwashController@book_wash');
    Route::post('/wash_schedule', 'API\BrightwashController@wash_schedule');
});