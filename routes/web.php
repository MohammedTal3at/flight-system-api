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

Route::get('/', function () {
    return view('welcome');
});

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

	Route::resource('users','UserController');
	

	Route::get('roles',['as'=>'roles.index','uses'=>'RoleController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	Route::get('roles/create',['as'=>'roles.create','uses'=>'RoleController@create','middleware' => ['permission:role-create']]);
	Route::post('roles/create',['as'=>'roles.store','uses'=>'RoleController@store','middleware' => ['permission:role-create']]);
	Route::get('roles/{id}',['as'=>'roles.show','uses'=>'RoleController@show']);
	Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit','middleware' => ['permission:role-edit']]);
	Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'RoleController@update','middleware' => ['permission:role-edit']]);
	Route::delete('roles/{id}',['as'=>'roles.destroy','uses'=>'RoleController@destroy','middleware' => ['permission:role-delete']]);

});

//tests 

Route::get('test/{id}', function($id) {
   	   return App\Trip::find(1)->bookings;
   	 
});

