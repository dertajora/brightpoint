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
    Route::post('/list_spbu', 'API\GasStationController@list_spbu');
    Route::post('/detail_spbu', 'API\GasStationController@detail_spbu');
});