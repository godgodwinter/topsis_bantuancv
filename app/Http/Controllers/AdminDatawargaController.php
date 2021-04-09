<?php

namespace App\Http\Controllers;

use App\Models\data_warga;
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

        return view('admin.data_warga.index',compact('datas'));
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
            'hp'=>'required'

        ],
        [
            'nik.required'=>'nik harus diisi',
            'nik.unique'=>'nik sudah digunakan',
            'nama.required'=>'Nama harus diisi',
            'alamat.required'=>'alamat harus diisi',
            'jk.required'=>'Jenis Kelamin harus diisi',
            'hp.required'=>'No Telp harus diisi'

        ]);
            // dd($request);
        data_warga::create($request->all());
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
        return view('admin.data_warga.edit',compact('datas'));
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

        data_warga::where('id',$id)
            ->update([
                'nik'=>$request->nik,
                'nama'=>$request->nama,
                'alamat'=>$request->alamat,
                'jk'=>$request->jk,
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
