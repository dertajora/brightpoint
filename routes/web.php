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
   	Route::get('/', 'Dashboard\DashboardController@home');

   	Route::get('/users', 'Dashboard\UserController@index');
   	Route::get('/users/add', 'Dashboard\UserController@add');
   	Route::post('/users/save', 'Dashboard\UserController@save');

   	Route::get('/manage_spbu', 'Dashboard\SPBUController@index');
   	Route::get('/manage_spbu/add', 'Dashboard\SPBUController@add');
      Route::post('/manage_spbu/save', 'Dashboard\SPBUController@save');

      Route::get('/manage_products', 'Dashboard\ProductController@index');
      Route::get('/manage_products/add', 'Dashboard\ProductController@add');
      Route::post('/manage_products/save', 'Dashboard\ProductController@save');
      Route::get('/manage_products/edit/{id}', 'Dashboard\ProductController@edit');
      Route::post('/manage_products/update', 'Dashboard\ProductController@update');

      Route::get('/config_carwash', 'Dashboard\CarwashController@config');
      Route::get('/config_carwash/edit/{id}', 'Dashboard\CarwashController@edit');
      Route::post('/config_carwash/update', 'Dashboard\CarwashController@update');

      Route::get('/manage_queue', 'Dashboard\QueueController@index');
      Route::get('/manage_queue/add', 'Dashboard\QueueController@add');
      Route::post('/manage_queue/save', 'Dashboard\QueueController@save');
      Route::get('/manage_queue/finish/{id}', 'Dashboard\QueueController@finish');

});