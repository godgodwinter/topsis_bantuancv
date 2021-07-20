<?php

namespace App\Http\Controllers;

use App\Models\data_warga;
use App\Models\rw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AdminDatawargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=data_warga::all();
        $rws=rw::all();

        return view('admin.data_warga.index',compact('datas','rws'));
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
        $request->validate([
            'nik'=>'required|unique:data_warga',
            'nama'=>'required',
            'alamat'=>'required',
            'jk'=>'required',
            'rw_id'=>'required',
            'hp'=>'required'

        ],
        [
            'nik.required'=>'nik harus diisi',
            'nik.unique'=>'nik sudah digunakan',
            'nama.required'=>'Nama harus diisi',
            'alamat.required'=>'alamat harus diisi',
            'jk.required'=>'Jenis Kelamin harus diisi',
            'rw_id.required'=>'Data wilayah harus diisi',
            'hp.required'=>'No Telp harus diisi'

        ]);


        $dusun_id='0';
        $dusun_nama='0';
        //ambil dusun_id dari rw
        $caridusun_id = DB::table('rw')
        ->where('id', '=', $request->rw_id)
        ->get();

        foreach ($caridusun_id as $dsid) {
            $dusun_id=$dsid->dusun_id;
        }

        //ambil data dusun dari rw_id

        $caridusuns = $caridusun = DB::table('dusun')
        ->where('id', '=', $dusun_id)
        ->get();
        foreach ($caridusuns as $ds) {
            $dusun_nama=$ds->nama;
        }
            // dd($request);
       DB::table('data_warga')->insert(
        array(
               'nik'     =>   $request->nik,
               'nama'     =>   $request->nama,
               'alamat'     =>   $request->alamat,
               'jk'     =>   $request->jk,
               'rw_id'     =>   $request->rw_id,
               'dusun_id'     =>   $dusun_id,
               'dusun_nama'     =>   $dusun_nama,
               'hp'     =>   $request->hp,
               'created_at'=>date("Y-m-d H:i:s"),
               'updated_at'=>date("Y-m-d H:i:s")
        ));
        return redirect(URL::to('/').'/admin/datawarga')->with('status','Data berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\data_warga  $data_warga
     * @return \Illuminate\Http\Response
     */
    public function show(data_warga $data_warga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\data_warga  $data_warga
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $datas = DB::table('data_warga')->where('id',$id)->get();
        $rws=rw::all();
        return view('admin.data_warga.edit',compact('datas','rws'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\data_warga  $data_warga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $request->validate([
            'nik'=>'required',
            'nama'=>'required',
            'alamat'=>'required',
            'jk'=>'required',
            'hp'=>'required'
        ],
        [
            'nik.required'=>'nik harus diisi',
            'nama.required'=>'Nama harus diisi',
            'alamat.required'=>'alamat harus diisi',
            'jk.required'=>'Jenis Kelamin harus diisi',
            'hp.required'=>'No Telp harus diisi'


        ]);
         //aksi update

        $dusun_id='0';
        $dusun_nama='0';
        //ambil dusun_id dari rw
        $caridusun_id = DB::table('rw')
        ->where('id', '=', $request->rw_id)
        ->get();

        foreach ($caridusun_id as $dsid) {
            $dusun_id=$dsid->dusun_id;
        }

        //ambil data dusun dari rw_id

        $caridusuns = $caridusun = DB::table('dusun')
        ->where('id', '=', $dusun_id)
        ->get();
        foreach ($caridusuns as $ds) {
            $dusun_nama=$ds->nama;
        }

        data_warga::where('id',$id)
            ->update([
                'nik'=>$request->nik,
                'nama'=>$request->nama,
                'alamat'=>$request->alamat,
                'jk'=>$request->jk,
                'rw_id'=>$request->rw_id,
                'dusun_id'=>$dusun_id,
                'dusun_nama'=>$dusun_nama,
                'hp'=>$request->hp
            ]);
            return redirect('/admin/datawarga')->with('status','Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\data_warga  $data_warga
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        data_warga::destroy($id);
        return redirect(URL::to('/').'/admin/datawarga')->with('status','Data berhasil dihapus!');
    }
}
