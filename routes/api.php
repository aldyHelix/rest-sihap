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

//absen masuk
Route::post('absenmasuk/store', 'API\AbsenMasukController@store');
Route::get('/listabsenmasuk', 'API\AbsenMasukController@index');
Route::get('/absenmasuk/{id}', 'API\AbsenMasukController@show');
//absen pulang

Route::post('absenpulang/store', 'API\AbsenPulangController@store');
Route::get('/listabsenpulang', 'API\AbsenPulangController@index');
Route::get('/absenpulang/{id}', 'API\AbsenPulangController@show');

//CRUD Golongan
Route::get('/listgol', 'API\GolonganController@indexlist');
Route::get('/gol/{id}', 'API\GolonganController@show');
Route::post('/gol/store', 'API\GolonganController@store');
Route::post('/gol/update/{id}', 'API\GolonganController@update');
Route::post('/gol/delete/{id}', 'API\GolonganController@destroy');

//CRUD Jabatan
Route::get('/listjab', 'API\JabatanController@indexlist');
Route::get('/jab/{id}', 'API\JabatanController@show');
Route::post('/jab/store', 'API\JabatanController@store');
Route::post('/jab/update/{id}', 'API\JabatanController@update');
Route::post('/jab/delete/{id}', 'API\JabatanController@destroy');

//CRUD Unitkerja
Route::get('/listunit', 'API\UnitkerjaController@indexlist');
Route::get('/unit/{id}', 'API\UnitkerjaController@show');
Route::post('/unit/store', 'API\UnitkerjaController@store');
Route::post('/unit/update/{id}', 'API\UnitkerjaController@update');
Route::post('/unit/delete/{id}', 'API\UnitkerjaController@destroy');

//CRUD Ruangan
Route::get('/listruang', 'API\RuanganController@indexlist');
Route::get('/ruang/{id}', 'API\RuanganController@show');
Route::post('/ruang/store', 'API\RuanganController@store');
Route::post('/ruang/update/{id}', 'API\RuanganController@update');
Route::post('/ruang/delete/{id}', 'API\RuanganController@destroy');

//CRUD Catatanharian
Route::get('/listallcatatan', 'API\CatatanController@index');
Route::get('/catatan/{nip}', 'API\CatatanController@show');
Route::post('/catatan/store', 'API\CatatanController@store');
Route::post('/catatan/update/{id}', 'API\CatatanController@update');
Route::post('/catatan/delete/{id}', 'API\CatatanController@destroy');
//need rules for manage this route, this route for kepegawaian and master admins
//need login for access this
//Pegawai CRUD
Route::get('/listpeg', 'API\PegawaiController@indexlist');
Route::get('/pegawai/{nip}', 'API\PegawaiController@show');
Route::post('/pegawai/store', 'API\PegawaiController@store');
Route::post('/pegawai/update/{id}', 'API\PegawaiController@update');
Route::post('/pegawai/delete/{nip}', 'API\PegawaiController@destroy');
//
//Kegiatan CRUD
Route::get('/listkeg', 'API\KegiatanController@index');
Route::get('/kegiatan/{id}', 'API\KegiatanController@show');
Route::post('/kegiatan/store', 'API\KegiatanController@store');
Route::post('/kegiatan/update/{id}', 'API\KegiatanController@update');
Route::post('/kegiatan/delete/{id}', 'API\KegiatanController@destroy');

//Rapat CRUD
Route::get('/listrapat', 'API\RapatController@index');
Route::get('/rapat/{id}', 'API\RapatController@show');
Route::post('/rapat/store', 'API\RapatController@store');
Route::post('/rapat/update/{id}', 'API\RapatController@update');
Route::post('/rapat/delete/{id}', 'API\RapatController@destroy');

//this route managed by auth current login and show user details


Route::middleware('auth:api')->group( function() {
    Route::post('details', 'API\UserController@details');
    Route::get('logout', 'API\UserController@logout');
    Route::get('details', 'API\UserController@details');
});
//
