<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//halaman admin fixed
Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {

    Route::resource('admin/kriteria','App\Http\Controllers\AdminKriteriaController');

    Route::resource('admin/datawarga','App\Http\Controllers\AdminDatawargaController');

    Route::resource('admin/bantuan','App\Http\Controllers\AdminBantuanController');


    Route::resource('admin/settingrange','App\Http\Controllers\AdminSettingrangeController');

    Route::delete('admin/settingrange/{id}/{kriteriaid}', 'App\Http\Controllers\AdminSettingrangeController@destroy');


    Route::resource('admin/dataproses','App\Http\Controllers\AdminDataprosesController');

    Route::get('admin/dataproses/{id}/addwarga', 'App\Http\Controllers\AdminDataprosesController@addwarga');

    Route::post('admin/dataproses/addwarga/store', 'App\Http\Controllers\AdminDataprosesController@addwargastore');

    Route::post('admin/dataproses/isidata/add', 'App\Http\Controllers\AdminDataprosesController@addisidata');

    Route::delete('admin/dataproses/{nik}/{th_penerimaan_id}/hapusdatacalon', 'App\Http\Controllers\AdminDataprosesController@destroydatacalon');

    //hasil
    Route::get('admin/dataproses/{id}/addwarga', 'App\Http\Controllers\AdminDataprosesController@addwarga');

    //proses topsis 1
    Route::get('admin/dataproses/{id}/topsis', 'App\Http\Controllers\AdminDataprosesController@topsisshow');

    // Route::get('/kriteria', function () {
    //     return view('admin.kriteria.index');
    // })->name('admin_kriteria');
});

// Route::resource('admin/tagihansiswas','App\Http\Controllers\AdminTagihanSiswaController')->except([
//     'index'
// ]);

//hal admin sementara
Route::get('/dashboard2', function () {
    return view('admin.dashboard');
})->name('admin_dashboard');
