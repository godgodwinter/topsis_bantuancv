<?php

namespace App\Http\Controllers;

use App\Models\data_proses;
use App\Models\data_warga;
use App\Models\Kriteria;
use App\Models\kuota_dusun;
use App\Models\kuota_rw;
use App\Models\th_penerimaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class dusundataprosescontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $dusunid_user=Auth::user()->dusunid;
    //cek apakah data lebih dari 2
        $jmldata = DB::table('data_proses')
         ->where('th_penerimaan_id', '=', $id)
         ->count();

        // dd($jmldata);


        //
        $th_penerimaans = DB::table('th_penerimaan')->where('id',$id)->get();
        $data_prosess = DB::table('data_proses')->where('th_penerimaan_id',$id)->get();

        $kriterias = DB::table('kriteria')->where('th_penerimaan_id',$id)->get();
        // $kriterias=Kriteria::all();
        $data_wargas=data_warga::all();

        // dd($kriterias);
        return view('dusun.dataproses.index',compact('kriterias','th_penerimaans','data_wargas','data_prosess','jmldata','dusunid_user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

public function kuotaindex($id)
{
    //foreach dusun
        $dusun = DB::table('dusun')
        ->get();
    // cek apakah dusunid sudahada jika belum insert
        foreach ($dusun as $ds) {
            $cekdusundikuota = DB::table('kuota_dusun')
            ->where('dusun_id', '=', $ds->id)
            ->where('th_penerimaan_id', '=', $id)
            ->count();
            // dd($cekdusundikuota);
            if($cekdusundikuota===0){
                //insert
                DB::table('kuota_dusun')->insert(
                    array(
                        'th_penerimaan_id'     =>   $id,
                        'dusun_id'     =>   $ds->id,
                        'total'     =>   '0',
                        'created_at'=>date("Y-m-d H:i:s"),
                        'updated_at'=>date("Y-m-d H:i:s")
                    ));

            }else{

            }
        }

        //foreach rw
            $rws = DB::table('rw')
            ->get();
        // cek apakah rwid sudahada jika belum insert
            foreach ($rws as $rw) {
                $cekrwid = DB::table('kuota_rw')
                ->where('rw_id', '=', $rw->id)
                ->where('th_penerimaan_id', '=', $id)
                ->count();
                // dd($cekrwid);
            if($cekrwid===0){
                // dd('blm');
                    //insert
                    DB::table('kuota_rw')->insert(
                        array(
                            'th_penerimaan_id'     =>   $id,
                            'dusun_id'     =>   $rw->dusun_id,
                            'rw_id'     =>   $rw->id,
                            'total'     =>   '0',
                            'created_at'=>date("Y-m-d H:i:s"),
                            'updated_at'=>date("Y-m-d H:i:s")
                        ));
    
                }else{
                    // dd('sdh');
                }
            }

            $dusun_id=Auth::user()->dusunid;
    $th_penerimaans = DB::table('th_penerimaan')->where('id',$id)->get();
    $kuota_dusun = DB::table('kuota_dusun')->where('th_penerimaan_id',$id)->get();
    $kuota_rw = DB::table('kuota_rw')
    ->where('th_penerimaan_id',$id)
    ->where('dusun_id',$dusun_id)
    ->get();
//    $kriterias=Kriteria::all();

    return view('dusun.dataproses.kuotaindex',compact('th_penerimaans','kuota_dusun','kuota_rw'));
}

public function kuotaedit($th,$id)
{
    //
    // dd($id);
    // $kriteria=product_unit::all();
    $th_penerimaans = DB::table('th_penerimaan')->where('id',$th)->get();
    $kuota_dusun = DB::table('kuota_dusun')->where('th_penerimaan_id',$th)->get();
    $kuota_rw = DB::table('kuota_rw')->where('id',$id)->get();
    return view('dusun.dataproses.kuotaedit',compact('kuota_rw','th_penerimaans','kuota_dusun'));
}

public function kuotaupdate(Request $request, $th, $id)
{
    // dd($id);
    //

    $request->validate([
        'total'=>'required',
    ],
    [
        'total.required'=>'kuota harus diisi',


    ]);
     //aksi update

    kuota_rw::where('id',$id)
        ->update([
            'total'=>$request->total
        ]);

    //update total dusun
    $ambildusunid = DB::table('kuota_rw')
    ->where('id', '=', $id)
    ->get();

    foreach ($ambildusunid as $ad) {
       $dusun_id=$ad->dusun_id;
        // dd($ad->dusun_id);
    }

    $totalperdusun = DB::table('kuota_rw')
    ->where('dusun_id', '=', $dusun_id)->sum('total');
    // dd($dusun_id,$totalperdusun);


    kuota_dusun::where('dusun_id',$dusun_id)
        ->update([
            'total'=>$totalperdusun
        ]);
        

    $totalsemua = DB::table('kuota_rw')
    ->where('th_penerimaan_id', '=', $th)->sum('total');
    // dd($totalsemua);

    th_penerimaan::where('id',$th)
        ->update([
            'kuota'=>$totalsemua
        ]);

        return redirect('/dusun/dataproses/'.$th.'/kuota')->with('status','Data berhasil diupdate!');
}
public function addwarga($id)
{
    //
    $th_penerimaans = DB::table('th_penerimaan')->where('id',$id)->get();

    $kriterias=Kriteria::all();

    $dusun_id=Auth::user()->dusunid;
        
    $datas = DB::table('data_warga')
    ->where('dusun_id', '=', $dusun_id)
    ->get();
    // $datas=data_warga::all();

    // dd($kriterias);
    return view('dusun.dataproses.addwarga',compact('kriterias','th_penerimaans','datas'));
}

public function addwargastore(Request $request)
{
    //
    // dd($request);

    //cek apakah data warwga sudah ada di tahun tersebut
    $warga_count = DB::table('data_proses')
 ->where('nik', '=', $request->nik)
 ->where('th_penerimaan_id', '=', $request->th_penerimaan_id)
 ->count();

    // dd($warga_count);
   if($warga_count<1){
    data_proses::create($request->all());
        return redirect(URL::to('/').'/dusun/dataproses/'.$request->th_penerimaan_id)->with('status','Data berhasil di tambahkan!');
    }else{
        return redirect(URL::to('/').'/dusun/dataproses/'.$request->th_penerimaan_id)->with('status','Gagal !! Data Warga pernah di tambahkan! ');
    }
}
}
