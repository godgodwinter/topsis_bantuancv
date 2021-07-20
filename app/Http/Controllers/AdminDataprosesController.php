<?php

namespace App\Http\Controllers;

use App\Charts\SampleChart;
use App\Models\data_proses;
use App\Models\data_proses_detail;
use App\Models\data_warga;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Charts\TopsisChart;
use App\Models\setting_range;
// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade as PDF;

class AdminDataprosesController extends Controller
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
     * @param  \App\Models\data_proses  $data_proses
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        return view('admin.dataproses.index',compact('kriterias','th_penerimaans','data_wargas','data_prosess','jmldata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\data_proses  $data_proses
     * @return \Illuminate\Http\Response
     */
    public function edit(data_proses $data_proses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\data_proses  $data_proses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, data_proses $data_proses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\data_proses  $data_proses
     * @return \Illuminate\Http\Response
     */
    public function destroy(data_proses $data_proses)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\data_proses  $setting_range
     * @return \Illuminate\Http\Response
     */
    public function destroydatacalon($nik,$th_penerimaan_id)
    {
        //
         //
        //  dd($kriteria_id);
        // data_proses::where('data_proses',$nik)
        // where('th_penerimaan_id',$th_penerimaan_id)
        // ->delete();
        // $whereArray=array('nik' => $nik,'th_penerimaan_id' => $th_penerimaan_id);
        // data_proses::where('nik',$nik && 'th_penerimaan_id',$th_penerimaan_id)->delete();
        DB::table('data_proses')
        ->where('nik', $nik)
        ->where('th_penerimaan_id', $th_penerimaan_id)
        ->delete();

        DB::table('data_proses_detail')
        ->where('nik', $nik)
        ->where('th_penerimaan_id', $th_penerimaan_id)
        ->delete();
        //  data_proses::destroy($id);
         return redirect(URL::to('/').'/admin/dataproses/'.$th_penerimaan_id)->with('status','Data berhasil dihapus!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\data_proses  $data_proses
     * @return \Illuminate\Http\Response
     */
    public function addwarga($id)
    {
        //
        $th_penerimaans = DB::table('th_penerimaan')->where('id',$id)->get();

        $kriterias=Kriteria::all();
        $datas=data_warga::all();

        // dd($kriterias);
        return view('admin.dataproses.addwarga',compact('kriterias','th_penerimaans','datas'));
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
            return redirect(URL::to('/').'/admin/dataproses/'.$request->th_penerimaan_id)->with('status','Data berhasil di tambahkan!');
        }else{
            return redirect(URL::to('/').'/admin/dataproses/'.$request->th_penerimaan_id)->with('status','Gagal !! Data Warga pernah di tambahkan! ');
        }
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
        return redirect(URL::to('/').'/admin/dataproses/'.$request->th_penerimaan_id)->with('status','DataSudah di ubah! ');
    }
}

//proses topsis
public function topsisshow($id)
{


    //
    $th_penerimaans = DB::table('th_penerimaan')->where('id',$id)->get();
    $data_prosess = DB::table('data_proses')->where('th_penerimaan_id',$id)->get();

    $kriterias = DB::table('kriteria')->where('th_penerimaan_id',$id)->get();
    // $kriterias=Kriteria::all();
    $data_wargas=data_warga::all();

    // dd($kriterias);
    return view('admin.dataproses.topsisshow',compact('kriterias','th_penerimaans','data_wargas','data_prosess'));
}

public function chartSample1()
{
    $data = array(
        "chart" => array(
            "labels" => ["First123", "Second123", "Third213"]
        ),
        "datasets" => array(
            array("name" => "Sample 1", "values" => array(10, 3, 7)),
            array("name" => "Sample 2", "values" => array(1, 6, 2)),
        )
    );

    return $data;
}
public function charttopsis($id)
{
    // $data = array(
    //     "chart" => array(
    //         "labels" => ["Orang1"]
    //     ),
    //     "datasets" => array(
    //         array("name" => "Hasil", "values" => array(1))
    //     )
    // );

    // array push ke chart label
    // $newdata='Paijo';
    // $data["chart"]["labels"][] = $newdata;


        // dd($data);

        $i=0;

        $data_prosess = DB::table('data_proses')->where('th_penerimaan_id',$id)->orderBy('hasil_topsis', 'desc')->get();


        foreach($data_prosess as $dp){
            // dd($dp->nik);
        $newdata=$dp->nik;

        $datawarga = DB::table('data_warga')->where('nik',$dp->nik)->get();
        foreach($datawarga as $dw){
            $namawarga=$dw->nama;
            $namawargalimit=mb_strimwidth($namawarga, 0, 10, "");
        }
        // $newdata_hasil=$dp->hasil_topsis;
        $data["chart"]["labels"][] = $namawargalimit;
        // $data["datasets"][0]["values"] = $newdata_hasil;
    $i++;
        }


        $data["datasets"][0]["name"] = "hasil";
    foreach($data_prosess as $dp){
        // dd($dp->nik);
    // $newdata=$dp->nik;
    $newdata_hasil=$dp->hasil_topsis;
    // $data["chart"]["labels"][] = $newdata;
    $data["datasets"][0]["values"][] = $newdata_hasil;
$i++;
    }
    // dd($data);


    return $data;
}
//hasil proses topsis
public function topsisshowhasil($id)
{
    //
    $th_penerimaans = DB::table('th_penerimaan')
    ->where('id',$id)->get();
    $data_prosess = DB::table('data_proses')
    ->where('th_penerimaan_id',$id)->get();

    $kriterias = DB::table('kriteria')->where('th_penerimaan_id',$id)->get();
    // $kriterias=Kriteria::all();
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
    return view('admin.dataproses.topsisshowhasil',compact('kriterias','th_penerimaans','data_wargas','data_prosess'));
}


public function cetak($id)
{
    //
    $th_penerimaans = DB::table('th_penerimaan')
    ->where('id',$id)->get();
    $data_prosess = DB::table('data_proses')
    ->where('th_penerimaan_id',$id)->get();

    $kriterias=Kriteria::all();
    $data_wargas=data_warga::all();

    $pdf = PDF::loadview('admin.dataproses.rekap_hasil',['data_prosess'=>$data_prosess],compact('th_penerimaans'));
    return $pdf->download('laporan-proses-pdf');
}

//proses topsis
public function endtopsis($id)
{
    // //cek apakah
    // $users_count = DB::table('users')
    //  ->where('username', '=', $username)
    //  ->where('password', '=', $password)
    //  ->count();
    $updatedatatopsis = DB::table('th_penerimaan')
    ->where('id', '=', $id)->update([
       'status'=>'Selesai']);

    $th_penerimaans = DB::table('th_penerimaan')
    ->where('id',$id)->get();
    $data_prosess = DB::table('data_proses')
    ->where('th_penerimaan_id',$id)->get();

    $kriterias=Kriteria::all();
    $data_wargas=data_warga::all();

    // dd($kriterias);
    return view('admin.dataproses.topsisshowhasil',compact('kriterias','th_penerimaans','data_wargas','data_prosess'));
}

public function kriteriaindex($id)
{
    // dd($id);

    $th_penerimaans = DB::table('th_penerimaan')->where('id',$id)->get();
    $kriterias = DB::table('kriteria')->where('th_penerimaan_id',$id)->get();
//    $kriterias=Kriteria::all();

    return view('admin.kriteriabaru.index',compact('kriterias','th_penerimaans'));
}

public function kriteriastore(Request $request,$id)
{
    // dd($id);
    //
     //
     $request->validate([
        'nama'=>'required',
        'nilai'=>'required'

    ],
    [
        'nama.required'=>'Nama harus diisi',
        'nilai.required'=>'nilai harus diisi'

    ]);
        // dd($request);
       DB::table('kriteria')->insert(
        array(
               'nama'     =>   $request->nama,
               'nilai'     =>   $request->nilai,
               'th_penerimaan_id'     =>   $id,
               'tipekriteria'     =>   $request->tipekriteria,
               'created_at'=>date("Y-m-d H:i:s"),
               'updated_at'=>date("Y-m-d H:i:s")
        ));

    return redirect(URL::to('/').'/admin/dataproses/'.$id.'/kriteria')->with('status','Data berhasil di tambahkan!');
}
public function kriteriadestroy($th,$id)
{
    //
    // dd($id);
    Kriteria::destroy($id);
    return redirect(URL::to('/').'/admin/dataproses/'.$th.'/kriteria')->with('status','Data berhasil dihapus!');
}
public function kriteriaedit($th,$id)
{
    //
    // dd($id);
    // $kriteria=product_unit::all();
    $th_penerimaans = DB::table('th_penerimaan')->where('id',$th)->get();
    $kriterias = DB::table('kriteria')->where('id',$id)->get();
    return view('admin.kriteriabaru.edit',compact('kriterias','th_penerimaans'));
}

public function kriteriaupdate(Request $request, $th, $id)
{
    // dd($id);
    //

    $request->validate([
        'nama'=>'required',
        'nilai'=>'required'
    ],
    [
        'nama.required'=>'Nama harus diisi',
        'nilai.required'=>'nilai harus diisi'


    ]);
     //aksi update

    Kriteria::where('id',$id)
        ->update([
            'nama'=>$request->nama,
            'tipekriteria'=>$request->tipekriteria,
            'nilai'=>$request->nilai
        ]);
        return redirect('/admin/dataproses/'.$th.'/kriteria')->with('status','Data berhasil diupdate!');
}


public function srindex($th,$kriteria)
{
    // dd($id);

    $th_penerimaans = DB::table('th_penerimaan')->where('id',$th)->get();
    $kriterias = DB::table('kriteria')->where('id',$kriteria)->get();
    $datas = DB::table('setting_range')->where('kriteria_id',$kriteria)->get();
//    $kriterias=Kriteria::all();

    return view('admin.kriteriabaru.srindex',compact('kriterias','th_penerimaans','datas'));
}

public function srstore(Request $request,$th,$kriteria)
{
    //
    // dd($request);
    $request->validate([
        // 'tanda'=>'required',
        'nilai1'=>'required',
        'bobot'=>'required'

    ],
    [
        // 'tanda.required'=>'tanda harus diisi',
        'nik.unique'=>'nik sudah digunakan',
        'kriteria_id.unique'=>'kriteria_id sudah digunakan',
        'nilai1.required'=>'nilai1 harus diisi',
        'bobot.required'=>'bobot harus diisi'

    ]);
        // dd($request);
        // dd($request);
       DB::table('setting_range')->insert(
        array(
               'nilai1'     =>   $request->nilai1,
               'nilai2'     =>   $request->nilai2,
               'kriteria_id'     =>   $kriteria,
               'bobot'     =>   $request->bobot,
               'tanda'     =>   $request->tanda,
               'created_at'=>date("Y-m-d H:i:s"),
               'updated_at'=>date("Y-m-d H:i:s")
        ));

    return redirect(URL::to('/').'/admin/dataproses/'.$th.'/settingrange/'.$kriteria)->with('status','Data berhasil di tambahkan!');
}
public function srdestroy($th,$kriteria,$id)
{
    //
    // dd($th,$kriteria,$id);
    setting_range::destroy($id);
    return redirect(URL::to('/').'/admin/dataproses/'.$th.'/settingrange/'.$kriteria)->with('status','Data berhasil dihapus!');
}
public function sredit($th,$kriteria,$id)
{
    //
    // dd($id);
    // $kriteria=product_unit::all();
    $th_penerimaans = DB::table('th_penerimaan')->where('id',$th)->get();
    $kriterias = DB::table('kriteria')->where('id',$kriteria)->get();
    $datas = DB::table('setting_range')->where('id',$id)->get();
    return view('admin.kriteriabaru.sredit',compact('kriterias','th_penerimaans','datas'));
}
public function srupdate(Request $request, $th, $kriteria,$id)
{
    // dd($id);
    //

    $request->validate([
        'nilai1'=>'required',
        'bobot'=>'required'
    ],
    [
        'nilai1.required'=>'nilai1 harus diisi',
        'bobot.required'=>'bobot harus diisi'


    ]);
     //aksi update

    setting_range::where('id',$id)
        ->update([
            'nilai1'=>$request->nilai1,
            'nilai2'=>$request->nilai2,
            'tanda'=>$request->tanda,
            'bobot'=>$request->bobot
        ]);
        return redirect(URL::to('/').'/admin/dataproses/'.$th.'/settingrange/'.$kriteria)->with('status','Data berhasil diupdate!');
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
            ->get();
            
            // if($cekdusundikuota<1){
            //     //insert
            //     DB::table('kuota_dusun')->insert(
            //         array(
            //             'nik'     =>   $request->id,
            //             'dusun_id'     =>   $ds->id,
            //             'total'     =>   '0',
            //             'created_at'=>date("Y-m-d H:i:s"),
            //             'updated_at'=>date("Y-m-d H:i:s")
            //         ));

            // }
        }

    $th_penerimaans = DB::table('th_penerimaan')->where('id',$id)->get();
    $kriterias = DB::table('kriteria')->where('th_penerimaan_id',$id)->get();
//    $kriterias=Kriteria::all();

    return view('admin.kriteriabaru.index',compact('kriterias','th_penerimaans'));
}

}
