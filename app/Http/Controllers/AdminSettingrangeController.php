<?php

namespace App\Http\Controllers;

use App\Models\setting_range;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AdminSettingrangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // dd($id);
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
        // dd($request);
        $request->validate([
            // 'tanda'=>'required',
            'kriteria_id'=>'required',
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
        setting_range::create($request->all());
        return redirect(URL::to('/').'/admin/settingrange/'.$request->kriteria_id)->with('status','Data berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\setting_range  $setting_range
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // dd($id);
        $kriterias = DB::table('kriteria')->where('id',$id)->get();

        $setting_ranges = DB::table('setting_range')->where('kriteria_id',$id)->get();

        // dd($kriterias);
        return view('admin.settingrange.index',compact('kriterias','setting_ranges'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\setting_range  $setting_range
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $datas = DB::table('setting_range')->where('id',$id)->get();
        return view('admin.settingrange.edit',compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\setting_range  $setting_range
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $request->validate([
            // 'tanda'=>'required',
            'kriteria_id'=>'required',
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
         //aksi update

        setting_range::where('id',$id)
            ->update([
                'nilai1'=>$request->nilai1,
                'nilai2'=>$request->nilai2,
                'tanda'=>$request->tanda,
                'bobot'=>$request->bobot
            ]);
            return redirect('/admin/settingrange/'.$request->kriteria_id)->with('status','Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\setting_range  $setting_range
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$kriteria_id)
    {
        //
         //
        //  dd($kriteria_id);
         setting_range::destroy($id);
         return redirect(URL::to('/').'/admin/settingrange/'.$kriteria_id)->with('status','Data berhasil dihapus!');
    }
}
