<?php

namespace App\Http\Controllers;

use App\Models\data_proses;
use App\Models\data_warga;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

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
        //
        $th_penerimaans = DB::table('th_penerimaan')->where('id',$id)->get();
        $data_prosess = DB::table('data_proses')->where('th_penerimaan_id',$id)->get();

        $kriterias=Kriteria::all();
        $data_wargas=data_warga::all();

        // dd($kriterias);
        return view('admin.dataproses.index',compact('kriterias','th_penerimaans','data_wargas','data_prosess'));
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
}
