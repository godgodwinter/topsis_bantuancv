<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AdminKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $kriterias=Kriteria::all();

        return view('admin.kriteria.index',compact('kriterias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // dd
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
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
        Kriteria::create($request->all());
        return redirect(URL::to('/').'/admin/kriteria')->with('status','Data berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
             dd($id);

             $kriterias=Kriteria::all();

            $result  = DB::select('select * from kriteria where id = ?', [$id]);
        // dd($result);
             return view('admin.kriteria.edit',compact('kriteria','result'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Kriteria $kriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kriteria $kriteria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // dd($id);
        Kriteria::destroy($id);
        return redirect(URL::to('/').'/admin/kriteria')->with('status','Data berhasil dihapus!');
    }
}
