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

 
Route::view('/','welcome'); 

//Auth Routes
Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('logout','Auth\LoginController@logout')->name('logout');	

Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');	
Route::post('password/reset','Auth\ResetPasswordController@reset');
Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm 
')->name('password.request');
Route::get(' password/reset/{token}','Auth\ResetPasswordController@showResetForm ')->name('password.reset');


//using our customizable login
Route::post('login','AuthController@login');


Route::group(['middleware' => ['auth']], function() {
 

Route::get('/home', 'HomeController@index')->name('home');
	
	Route::resource('users', 'UserController');
	
	
	Route::get('roles', ['as' => 'roles.index', 'uses' => 'RoleController@index', 'middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	Route::get('roles/create', ['as' => 'roles.create', 'uses' => 'RoleController@create', 'middleware' => ['permission:role-create']]);
	Route::post('roles/create', ['as' => 'roles.store', 'uses' => 'RoleController@store', 'middleware' => ['permission:role-create']]);
	Route::get('roles/{id}', ['as' => 'roles.show', 'uses' => 'RoleController@show']);
	Route::get('roles/{id}/edit', ['as' => 'roles.edit', 'uses' => 'RoleController@edit', 'middleware' => ['permission:role-edit']]);
	Route::patch('roles/{id}', ['as' => 'roles.update', 'uses' => 'RoleController@update', 'middleware' => ['permission:role-edit']]);
	Route::delete('roles/{id}', ['as' => 'roles.destroy', 'uses' => 'RoleController@destroy', 'middleware' => ['permission:role-delete']]);
	
		
	//places index
	Route::get('/places', ['as' => 'places.index', 'uses' => "PlacesController@index", 'middleware' => ['permission:create-place']]);
	//places new
	Route::get('/places/create', ['as' => 'places.create', 'uses' => "PlacesController@create", 'middleware' => ['permission:create-place']]);
	Route::post('/places/create', ['as' => 'places.store', 'uses' => "PlacesController@store", 'middleware' => ['permission:create-place']]);
	//places show
	Route::get('/places/{id}', ['as' => 'places.show', 'uses' => 'PlacesController@show', 'middleware' => 'permission:create-place']);
	//places update
	Route::get('/places/{id}/edit', ['as' => 'places.edit', 'uses' => 'PlacesController@edit', 'middleware' => 'permission:update-place']);
	
	Route::patch('/places/{id}', ['as' => 'places.update', 'uses' => 'PlacesController@update', 'middleware' => 'permission:update-place']);
	//places delete
	Route::delete('places/{id}', ['as' => 'places.destroy', 'uses' => 'PlacesController@destroy', 'middleware' => ['permission:delete-place']]);
	
	
	
	//seats index
	Route::get('/seats', ['as' => 'seats.index', 'uses' => "SeatsLevelsController@index", 'middleware' => ['permission:create-seat-level']]);
	//seats new
	Route::get('/seats/create', ['as' => 'seats.create', 'uses' => "SeatsLevelsController@create", 'middleware' => ['permission:create-seat-level']]);
	Route::post('/seats/create', ['as' => 'seats.store', 'uses' => "SeatsLevelsController@store", 'middleware' => ['permission:create-seat-level']]);
	//seats show
	Route::get('/seats/{id}', ['as' => 'seats.show', 'uses' => 'SeatsLevelsController@show', 'middleware' => 'permission:create-seat-level']);
	//seats update
	Route::get('/seats/{id}/edit', ['as' => 'seats.edit', 'uses' => 'SeatsLevelsController@edit', 'middleware' => 'permission:update-seat-level']);
	
	Route::patch('/seats/{id}', ['as' => 'seats.update', 'uses' => 'SeatsLevelsController@update', 'middleware' => 'permission:update-seat-level']);
	//seats delete
	Route::delete('seats/{id}', ['as' => 'seats.destroy', 'uses' => 'SeatsLevelsController@destroy', 'middleware' => ['permission:delete-seat-level']]);
	
	
	
});
 