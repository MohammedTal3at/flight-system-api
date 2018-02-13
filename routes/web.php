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


Route::get('/home', 'HomeController@index')->name('home');


//Route::prefix('admin')->group(function () {
	
	Route::get('/', function () {
		return view('welcome');
	});
	
	Auth::routes();
	
	//Route::resource('users', 'UserController');
	
	Route::get('users', ['as' => 'users.index', 'uses' => 'UserController@index', 'middleware' => ['permission:list-users']]);
	Route::get('users/create', ['as' => 'users.create', 'uses' => 'UserController@create', 'middleware' => ['permission:create-user']]);
	Route::post('users/create', ['as' => 'users.store', 'uses' => 'UserController@store', 'middleware' => ['permission:create-user']]);
	Route::get('users/{id}', ['as' => 'users.show', 'uses' => 'UserController@show']);
	Route::get('users/{id}/edit', ['as' => 'users.edit', 'uses' => 'UserController@edit', 'middleware' => ['permission:update-user']]);
	Route::patch('users/{id}', ['as' => 'users.update', 'uses' => 'UserController@update', 'middleware' => ['permission:update-user']]);
	Route::delete('users/{id}', ['as' => 'users.destroy', 'uses' => 'UserController@destroy', 'middleware' => ['permission:delete-user']]);
	
	
	
	
	
	
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
	
	
	//trips index
	Route::get('/trips', ['as' => 'trips.index', 'uses' => "TripsController@index", 'middleware' => ['permission:list-trip']]);
	//trips new
	Route::get('/trips/create', ['as' => 'trips.create', 'uses' => "TripsController@create", 'middleware' => ['permission:create-trip']]);
	Route::post('/trips/create', ['as' => 'trips.store', 'uses' => "TripsController@store", 'middleware' => ['permission:create-trip']]);
	//trips show
	Route::get('/trips/{id}', ['as' => 'trips.show', 'uses' => 'TripsController@show', 'middleware' => 'permission:create-trip']);
	//trips update
	Route::get('/trips/{id}/edit', ['as' => 'trips.edit', 'uses' => 'TripsController@edit', 'middleware' => 'permission:edit-trip']);
	
	Route::patch('/trips/{id}', ['as' => 'trips.update', 'uses' => 'TripsController@update', 'middleware' => 'permission:edit-trip']);
	//trips delete
	Route::delete('trips/{id}', ['as' => 'trips.destroy', 'uses' => 'TripsController@destroy', 'middleware' => ['permission:delete-trip']]);


