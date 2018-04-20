<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// URL testing
Route::group(['middleware' => ['log_web']], function () {
   	Route::get('/laboratorium', 'WebsiteController@laboratorium');
	// alias in route login should be defined, so auth middleware could detect which login page user should be redirected when not logged in but trying to force dashboard
	Route::get('/login',  [ 'as' => 'login', 'uses' => 'WebsiteController@login_page']);
	Route::get('/home', 'WebsiteController@landing_page');
	Route::post('/login', 'WebsiteController@login_handle');
	Route::get('/logout', 'Dashboard\DashboardController@logout');
	

});


Route::group(['middleware' => ['auth', 'log_web']], function () {
   	Route::get('/dashboard', 'Dashboard\DashboardController@home');

});