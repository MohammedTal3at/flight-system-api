<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//you should comment this.
/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/



//For can signup and signin for clients. 
Route::post('/client',['uses'=>"UserController@signup"]);
Route::post('/client/signin',['uses'=>"UserController@signin"]);

//Show all trips
Route::get('/client/trips',['uses'=>"TripsController@getapiTrips"]);
//Show single trip
Route::get('/client/trips/{id}',['uses'=>"TripsController@getapiTripbyId"]);



//contact
Route::post('/contact',['uses'=>"ContactsController@insertAPI"]);

//get the user data
Route::get('/userdata',['uses'=>"UserController@getUserData"]);
