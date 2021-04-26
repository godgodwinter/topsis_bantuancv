<?php

namespace App\Http\Controllers;

use App\Models\data_warga;
use App\Models\Kriteria;
use App\Models\th_penerimaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    if((Auth::user()->current_team_id)==1){
        //halaman kades
        $datas = DB::table('th_penerimaan')->where('status','Selesai')->orderBy('tahun', 'desc')->get();
        // if((Auth::user()->current_team_id)==1){
            return view('kades.laporan',compact('datas'));
    }else{
        return redirect(URL::to('/').'/404')->with('status','Data berhasil dihapus!');
    }


        // }else{
        //     return redirect(URL::to('/').'/404')->with('status','Data berhasil dihapus!');
        // }
    }


//hasil proses topsis
public function verif($id)
{


    if((Auth::user()->current_team_id)==1){
        //halaman kades

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
    }else{
        return redirect(URL::to('/').'/404')->with('status','Data berhasil dihapus!');
    }

}


//proses verifikasi kades
public function verifikasi($id)
{

    if((Auth::user()->current_team_id)==1){
        //halaman kades
        $updatedatatopsis = DB::table('th_penerimaan')
        ->where('id', '=', $id)->update([
           'verif'=>'Terverifikasi']);

           return redirect(URL::to('/').'/kades/laporan')->with('status','Data berhasil di verifikasi!');
    }else{
        return redirect(URL::to('/').'/404')->with('status','Data berhasil dihapus!');
    }


}
//batalkan proses verifikasi kades
public function verifikasibatalkan($id)
{

    if((Auth::user()->current_team_id)==1){
        //halaman kades

    $updatedatatopsis = DB::table('th_penerimaan')
    ->where('id', '=', $id)->update([
       'verif'=>'']);

       return redirect(URL::to('/').'/kades/laporan')->with('status','Verikasi berhasil di batalkan!');

    }else{
        return redirect(URL::to('/').'/404')->with('status','Data berhasil dihapus!');
    }

}
}
