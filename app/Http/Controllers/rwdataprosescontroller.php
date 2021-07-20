<?php

namespace App\Http\Controllers;

use App\Models\data_proses;
use App\Models\data_proses_detail;
use App\Models\data_warga;
use App\Models\Kriteria;
use App\Models\kuota_dusun;
use App\Models\kuota_rw;
use App\Models\th_penerimaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class rwdataprosescontroller extends Controller
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

        $rwid_user=Auth::user()->rwid;
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
        return view('rw.dataproses.index',compact('kriterias','th_penerimaans','data_wargas','data_prosess','jmldata','rwid_user'));
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

public function addisidata (Request $request)
{
    //
    // dd($request);

    $datasettingrange = DB::select('select * from setting_range where id = ?', array($request->setting_range_id));
    foreach ($datasettingrange as $ambil) {
        $bobot_sr=$ambil->bobot;
    }
// dd($bobot_sr);
    //cek apakah data proses detail sudah ada di tahun tersebut
    $cari = DB::table('data_proses_detail')
 ->where('nik', '=', $request->nik)
 ->where('th_penerimaan_id', '=', $request->th_penerimaan_id)
 ->where('kriteria_id', '=', $request->kriteria_id)
 ->count();

    // dd($warga_count);
   if($cari<1){
    // data_proses_detail::create($request->all());

    // dd($request->tipekriteria);
    if($request->tipekriteria==='Fixed'){

//jalankan simpan
    data_proses_detail::create([
        'nik' => $request->nik,
        'th_penerimaan_id' => $request->th_penerimaan_id,
        'kriteria_id' => $request->kriteria_id,
        'setting_range_id' => $request->setting_range_id,
        'bobot_sr' => $bobot_sr
    ]);


    }else{
        $datareal=$request->datareal;
        $bobot_sr=0;
        $setting_range_id=0;
        
        //ambil kriteriaid
        //looping setting range
        $ambildatasettingrange = DB::select('select * from setting_range where kriteria_id = ?', array($request->kriteria_id));
        foreach ($ambildatasettingrange as $ambilsr) {
            // $bobot_sr=$ambilsr->bobot;
            // dd($bobot_sr);
            if($ambilsr->tanda==='Lebih dari sama dengan'){
                    if($datareal>=$ambilsr->nilai1){
                            $bobot_sr=$ambilsr->bobot;
                            $setting_range_id=$ambilsr->id;
                    }
                    
            }elseif($ambilsr->tanda==='Diantara'){
                if(($datareal>$ambilsr->nilai1&&($datareal<$ambilsr->nilai2))){
                        $bobot_sr=$ambilsr->bobot;
                        $setting_range_id=$ambilsr->id;
                }
            }elseif($ambilsr->tanda==='Kurang dari sama dengan'){
                if($datareal<=$ambilsr->nilai1){
                        $bobot_sr=$ambilsr->bobot;
                        $setting_range_id=$ambilsr->id;
                }
            }
        }

        // dd($bobot_sr,$datareal,$request->kriteria_id,$setting_range_id);
        //if tanda 'Lebih Dari Sama Dengan' === '$datareal>=$nilai1'    bobot_sr=bobot
        //if tanda 'Diantara' === '$datareal>=$nilai1'                  bobot_sr=bobot
        //if tanda 'Kurang Dari Sama Dengan' === '$datareal<=$nilai1'   bobot_sr=bobot
        data_proses_detail::create([
            'nik' => $request->nik,
            'th_penerimaan_id' => $request->th_penerimaan_id,
            'kriteria_id' => $request->kriteria_id,
            'datareal' => $request->datareal,
            'setting_range_id' => $setting_range_id,
            'bobot_sr' => $bobot_sr
        ]);

    }
        return redirect(URL::to('/').'/admin/dataproses/'.$request->th_penerimaan_id)->with('status','Data berhasil di tambahkan!');
    }else{

//jalankan update

if($request->tipekriteria==='Fixed'){
data_proses_detail::where('id',$request->data_proses_detail_id)
->update([
    'setting_range_id'=>$request->setting_range_id,
    'bobot_sr'=>$bobot_sr
]);
}else{

    $datareal=$request->datareal;
    $bobot_sr=0;
    $setting_range_id=0;
    
    //ambil kriteriaid
    //looping setting range
    $ambildatasettingrange = DB::select('select * from setting_range where kriteria_id = ?', array($request->kriteria_id));
    foreach ($ambildatasettingrange as $ambilsr) {
        // $bobot_sr=$ambilsr->bobot;
        // dd($bobot_sr);
        if($ambilsr->tanda==='Lebih dari sama dengan'){
                if($datareal>=$ambilsr->nilai1){
                        $bobot_sr=$ambilsr->bobot;
                        $setting_range_id=$ambilsr->id;
                }
                
        }elseif($ambilsr->tanda==='Diantara'){
            if(($datareal>$ambilsr->nilai1&&($datareal<$ambilsr->nilai2))){
                    $bobot_sr=$ambilsr->bobot;
                    $setting_range_id=$ambilsr->id;
            }
        }elseif($ambilsr->tanda==='Kurang dari sama dengan'){
            if($datareal<=$ambilsr->nilai1){
                    $bobot_sr=$ambilsr->bobot;
                    $setting_range_id=$ambilsr->id;
            }
        }
    }

    // dd($bobot_sr,$datareal,$request->kriteria_id,$setting_range_id);
    //if tanda 'Lebih Dari Sama Dengan' === '$datareal>=$nilai1'    bobot_sr=bobot
    //if tanda 'Diantara' === '$datareal>=$nilai1'                  bobot_sr=bobot
    //if tanda 'Kurang Dari Sama Dengan' === '$datareal<=$nilai1'   bobot_sr=bobot

        data_proses_detail::where('id',$request->data_proses_detail_id)
        ->update([
            'setting_range_id'=>$setting_range_id,
            'datareal' => $request->datareal,
            'bobot_sr'=>$bobot_sr
        ]);


}
        return redirect(URL::to('/').'/rw/dataproses/'.$request->th_penerimaan_id)->with('status','DataSudah di ubah! ');
    }
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

            $rwid_user=Auth::user()->rwid;
    $th_penerimaans = DB::table('th_penerimaan')->where('id',$id)->get();
    $kuota_dusun = DB::table('kuota_dusun')->where('th_penerimaan_id',$id)->get();
    $kuota_rw = DB::table('kuota_rw')
    ->where('th_penerimaan_id',$id)
    ->where('rw_id',$rwid_user)
    ->get();
//    $kriterias=Kriteria::all();

    return view('rw.dataproses.kuotaindex',compact('th_penerimaans','kuota_dusun','kuota_rw'));
}

public function kuotaedit($th,$id)
{
    //
    // dd($id);
    // $kriteria=product_unit::all();
    $th_penerimaans = DB::table('th_penerimaan')->where('id',$th)->get();
    $kuota_dusun = DB::table('kuota_dusun')->where('th_penerimaan_id',$th)->get();
    $kuota_rw = DB::table('kuota_rw')->where('id',$id)->get();
    return view('rw.dataproses.kuotaedit',compact('kuota_rw','th_penerimaans','kuota_dusun'));
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

        return redirect('/rw/dataproses/'.$th.'/kuota')->with('status','Data berhasil diupdate!');
}

public function addwarga($id)
{
    //
    $th_penerimaans = DB::table('th_penerimaan')->where('id',$id)->get();

    $kriterias=Kriteria::all();

    $rwid_user=Auth::user()->rwid;
        
    $datas = DB::table('data_warga')
    ->where('rw_id', '=', $rwid_user)
    ->get();
    // $datas=data_warga::all();

    // dd($kriterias);
    return view('rw.dataproses.addwarga',compact('kriterias','th_penerimaans','datas'));
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
        return redirect(URL::to('/').'/rw/dataproses/'.$request->th_penerimaan_id)->with('status','Data berhasil di tambahkan!');
    }else{
        return redirect(URL::to('/').'/rw/dataproses/'.$request->th_penerimaan_id)->with('status','Gagal !! Data Warga pernah di tambahkan! ');
    }
}

}
