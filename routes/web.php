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
    return view('beranda');
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

    //hasilproses topsis
    Route::get('admin/dataproses/{id}/hasil', 'App\Http\Controllers\AdminDataprosesController@topsisshowhasil');
    //akhiri topsis
    Route::get('admin/dataproses/{id}/endtopsis', 'App\Http\Controllers\AdminDataprosesController@endtopsis');
    Route::get('admin/dataproses/{id}/cetak', 'App\Http\Controllers\AdminDataprosesController@cetak');

    //menu kades
    Route::resource('kades/laporan','App\Http\Controllers\KadesLaporanController');
    Route::get('kades/laporan/{id}/verif', 'App\Http\Controllers\KadesLaporanController@verif');
    Route::get('kades/laporan/{id}/verifikasi', 'App\Http\Controllers\KadesLaporanController@verifikasi');
    Route::get('kades/laporan/{id}/verifikasibatalkan', 'App\Http\Controllers\KadesLaporanController@verifikasibatalkan');

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

Route::get('/chartSample1', 'App\Http\Controllers\AdminDataprosesController@chartSample1')->name('chartSample1');
Route::get('/charttopsis/{id}', 'App\Http\Controllers\AdminDataprosesController@charttopsis')->name('charttopsis');
