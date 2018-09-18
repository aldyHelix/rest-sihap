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

//get data without passport or login or access token
//this route for public
Route::post('register', 'API\UserController@register');
Route::post('login', 'API\UserController@login');
Route::get('/listuser', 'API\UserController@list');

//need rules for manage this route, this route for kepegawaian and master admins
//need login for access this
//Pegawai CRUD
Route::get('/listpeg', 'API\PegawaiController@indexlist');
Route::get('/pegawai/{nip}', 'API\PegawaiController@show');
Route::post('/pegawai/store', 'API\PegawaiController@store');
Route::post('/pegawai/update/{id}', 'API\PegawaiController@update');
Route::post('/pegawai/delete/{nip}', 'API\PegawaiController@destroy');
//

//this route managed by auth current login and show user details
Route::middleware('auth:api')->group( function() {
    Route::post('details', 'API\UserController@details');
    Route::get('logout', 'API\UserController@logout');
    Route::get('details', 'API\UserController@details');
});
//
