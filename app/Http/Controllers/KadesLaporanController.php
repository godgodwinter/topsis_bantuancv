<?php

namespace App\Http\Controllers;

use App\Models\data_warga;
use App\Models\Kriteria;
use App\Models\th_penerimaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class KadesLaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $datas=th_penerimaan::all();
        $datas = DB::table('th_penerimaan')->where('status','Selesai')->orderBy('tahun', 'desc')->get();

        return view('kades.laporan',compact('datas'));
    }


//hasil proses topsis
public function verif($id)
{
    //
    $th_penerimaans = DB::table('th_penerimaan')
    ->where('id',$id)->get();
    $data_prosess = DB::table('data_proses')
    ->where('th_penerimaan_id',$id)->get();

    $kriterias=Kriteria::all();
    $data_wargas=data_warga::all();

    // // dd($kriterias);
    // $TopsisChart = new SampleChart;
    // $TopsisChart->labels(['Jan', 'Feb', 'Mar']);
    // $TopsisChart->dataset('Users by trimester', 'line', [10, 25, 13]);

    // $TopsisChart = TopsisChart::new('line', 'highcharts')
    //         ->setTitle('My nice chart')
    //         ->setLabels(['First', 'Second', 'Third'])
    //         ->setValues([5,10,20])
    //         ->setDimensions(1000,500)
    //         ->setResponsive(false);
// dd($TopsisChart);
    return view('kades.verif',compact('kriterias','th_penerimaans','data_wargas','data_prosess'));
}


//proses verifikasi kades
public function verifikasi($id)
{
    $updatedatatopsis = DB::table('th_penerimaan')
    ->where('id', '=', $id)->update([
       'verif'=>'Terverifikasi']);

       return redirect(URL::to('/').'/kades/laporan')->with('status','Data berhasil di verifikasi!');
}
//batalkan proses verifikasi kades
public function verifikasibatalkan($id)
{
    $updatedatatopsis = DB::table('th_penerimaan')
    ->where('id', '=', $id)->update([
       'verif'=>'']);

       return redirect(URL::to('/').'/kades/laporan')->with('status','Verikasi berhasil di batalkan!');
}
}
