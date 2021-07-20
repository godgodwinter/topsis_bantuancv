<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

Route::get('/hasil/{id}/', 'App\Http\Controllers\berandaluarController@index')->name('berandaluar');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//halaman admin fixed
Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {

    Route::resource('admin/kriteria','App\Http\Controllers\AdminKriteriaController');

    Route::get('admin/dataproses/{id}/kriteria', 'App\Http\Controllers\AdminDataprosesController@kriteriaindex');
    Route::post('admin/dataproses/{id}/kriteria', 'App\Http\Controllers\AdminDataprosesController@kriteriastore');
    Route::delete('admin/dataproses/{th}/kriteria/{id}', 'App\Http\Controllers\AdminDataprosesController@kriteriadestroy');
    Route::get('admin/dataproses/{th}/kriteria/{id}/edit', 'App\Http\Controllers\AdminDataprosesController@kriteriaedit');
    Route::put('admin/dataproses/{th}/kriteria/{id}', 'App\Http\Controllers\AdminDataprosesController@kriteriaupdate');


    Route::get('admin/dataproses/{id}/kuota', 'App\Http\Controllers\AdminDataprosesController@kuotaindex');
    Route::get('admin/dataproses/{th}/kuota/{id}/edit', 'App\Http\Controllers\AdminDataprosesController@kuotaedit');
    Route::put('admin/dataproses/{th}/kuota/{id}/update', 'App\Http\Controllers\AdminDataprosesController@kuotaupdate');


    Route::get('admin/dataproses/{th}/settingrange/{kriteria}', 'App\Http\Controllers\AdminDataprosesController@srindex');
    Route::post('admin/dataproses/{th}/settingrange/{kriteria}', 'App\Http\Controllers\AdminDataprosesController@srstore');
    Route::delete('admin/dataproses/{th}/settingrange/{kriteria}/{id}', 'App\Http\Controllers\AdminDataprosesController@srdestroy');
    Route::get('admin/dataproses/{th}/settingrange/{kriteria}/edit/{id}', 'App\Http\Controllers\AdminDataprosesController@sredit');
    Route::put('admin/dataproses/{th}/settingrange/{kriteria}/update/{id}', 'App\Http\Controllers\AdminDataprosesController@srupdate');
    



    Route::resource('admin/datawarga','App\Http\Controllers\AdminDatawargaController');

    Route::resource('admin/datawilayah','App\Http\Controllers\AdmindatawilayahController');
    Route::get('admin/datawilayah/detail/{id}', 'App\Http\Controllers\AdmindatawilayahController@detail');
    Route::post('admin/datawilayah/detail/{id}', 'App\Http\Controllers\AdmindatawilayahController@rwstore');
    Route::delete('admin/datawilayah/detail/{dusun_id}/{id}', 'App\Http\Controllers\AdmindatawilayahController@rwdestroy');
    Route::get('admin/datawilayah/detail/{dusun_id}/{id}/edit', 'App\Http\Controllers\AdmindatawilayahController@rwedit');
    Route::put('admin/datawilayah/detail/{dusun_id}/{id}', 'App\Http\Controllers\AdmindatawilayahController@rwupdate');

    Route::post('admin/datawilayah/user', 'App\Http\Controllers\AdmindatawilayahController@dusunuserstore');
    Route::delete('admin/datawilayah/user/{dusun_id}/{id}', 'App\Http\Controllers\AdmindatawilayahController@dusunuserdestroy');
    Route::get('admin/datawilayah/user/{dusun_id}/{id}/edit', 'App\Http\Controllers\AdmindatawilayahController@dusunuseredit');
    Route::put('admin/datawilayah/user/{dusun_id}/{id}', 'App\Http\Controllers\AdmindatawilayahController@dusunuserupdate');


    Route::post('admin/datawilayah/rwuser', 'App\Http\Controllers\AdmindatawilayahController@rwuserstore');
    Route::get('admin/datawilayah/detailrw/{dusun_id}/{id}', 'App\Http\Controllers\AdmindatawilayahController@detailrw');
    Route::delete('admin/datawilayah/userrw/{dusun_id}/{rw_id}/{id}', 'App\Http\Controllers\AdmindatawilayahController@rwuserdestroy');
    Route::get('admin/datawilayah/userrw/{dusun_id}/{rw_id}/{id}/edit', 'App\Http\Controllers\AdmindatawilayahController@rwuseredit');
    Route::put('admin/datawilayah/userrw/{dusun_id}/{rw_id}/{id}', 'App\Http\Controllers\AdmindatawilayahController@rwuserupdate');

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

    // $datas = DB::select('select * from users where current_team_id = 1');
    // $jmldata = DB::table('users')
    // ->where('current_team_id', '=', 1)
    // ->count();

    // if((Auth::user()->current_team_id)==1){

        // dd(\Auth::id());

    //menu kades
    Route::resource('kades/laporan','App\Http\Controllers\KadesLaporanController');
    Route::get('kades/laporan/{id}/verif', 'App\Http\Controllers\KadesLaporanController@verif');
    Route::get('kades/laporan/{id}/verifikasi', 'App\Http\Controllers\KadesLaporanController@verifikasi');
    Route::get('kades/laporan/{id}/verifikasibatalkan', 'App\Http\Controllers\KadesLaporanController@verifikasibatalkan');

    //menu rw
    Route::resource('rw/datawarga','App\Http\Controllers\rwdatawargacontroller');
    Route::resource('rw/bantuan','App\Http\Controllers\rwbantuancontroller');

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
