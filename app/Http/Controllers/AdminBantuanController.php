<?php

namespace App\Http\Controllers;

use App\Models\th_penerimaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AdminBantuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=th_penerimaan::all();

        return view('admin.bantuan.index',compact('datas'));
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
            'tahun'=>'required|unique:th_penerimaan',
            'kuota'=>'required',
            'status'=>'required'

        ],
        [
            'tahun.required'=>'tahun harus diisi',
            'kuota.required'=>'kuota harus diisi',
            'tahun.unique'=>'tahun sudah digunakan',
            'status.required'=>'status harus diisi'

        ]);
            // dd($request);
        th_penerimaan::create($request->all());
        return redirect(URL::to('/').'/admin/bantuan')->with('status','Data berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\th_penerimaan  $th_penerimaan
     * @return \Illuminate\Http\Response
     */
    public function show(th_penerimaan $th_penerimaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\th_penerimaan  $th_penerimaan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $datas = DB::table('th_penerimaan')->where('id',$id)->get();
        return view('admin.bantuan.edit',compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\th_penerimaan  $th_penerimaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $request->validate([
            'tahun'=>'required',
            'kuota'=>'required',
            'status'=>'required'
        ],
        [
            'tahun.required'=>'tahun harus diisi',
            'kuota.required'=>'kuota harus diisi',
            'status.required'=>'status harus diisi'


        ]);
         //aksi update

        th_penerimaan::where('id',$id)
            ->update([
                'tahun'=>$request->tahun,
                'kuota'=>$request->kuota,
                'status'=>$request->status
            ]);
            return redirect('/admin/bantuan')->with('status','Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\th_penerimaan  $th_penerimaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        th_penerimaan::destroy($id);
        return redirect(URL::to('/').'/admin/bantuan')->with('status','Data berhasil dihapus!');
    }
}
