<?php

namespace App\Http\Controllers;

use App\Models\dusun;
use App\Models\rw;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class AdmindatawilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=dusun::all();

        return view('admin.datawilayah.index',compact('datas')); 
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
        $request->validate([
            'nama'=>'required'

        ],
        [
            'nama.required'=>'Nama harus diisi'

        ]);
            // dd($request);
        dusun::create($request->all());
        return redirect(URL::to('/').'/admin/datawilayah')->with('status','Data berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\dusun  $dusun
     * @return \Illuminate\Http\Response
     */
    public function show(dusun $dusun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dusun  $dusun
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datas = DB::table('dusun')->where('id',$id)->get();
        return view('admin.datawilayah.edit',compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\dusun  $dusun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'=>'required'
        ],
        [
            'nama.required'=>'Nama harus diisi'


        ]);
         //aksi update

        dusun::where('id',$id)
            ->update([
                'nama'=>$request->nama
            ]);
            return redirect('/admin/datawilayah')->with('status','Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dusun  $dusun
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dusun::destroy($id);
        return redirect(URL::to('/').'/admin/datawilayah')->with('status','Data berhasil dihapus!');
    }
    public function detail($id)
    {
        $dusun = DB::table('dusun')->where('id',$id)->get();
        $users = DB::table('users')->where('dusunid',$id)->get()->where('tipeuser','dusun');
        $datas = DB::table('rw')->where('dusun_id',$id)->get();
        return view('admin.datawilayah.detail',compact('datas','dusun','users'));
    }

    public function rwstore(Request $request,$id)
    {
        // dd($request);
        $request->validate([
            'nama'=>'required'

        ],
        [
            'nama.required'=>'Nama harus diisi'

        ]);
            // dd($request);
        rw::create($request->all());
        return redirect(URL::to('/').'/admin/datawilayah/detail/'.$id)->with('status','Data berhasil di tambahkan!');
    }

    public function rwdestroy($dusun_id,$id)
    {
        // dd($id);
        rw::destroy($id);
        return redirect(URL::to('/').'/admin/datawilayah/detail/'.$dusun_id)->with('status','Data berhasil dihapus!');
    }
    public function rwedit($dusun_id,$id)
    {
        $dusun = DB::table('dusun')->where('id',$dusun_id)->get();
        $datas = DB::table('rw')->where('id',$id)->get();
        return view('admin.datawilayah.rwedit',compact('datas','dusun'));
    }

    public function rwupdate(Request $request, $dusun_id,$id)
    {
        // dd($id);
        $request->validate([
            'nama'=>'required'
        ],
        [
            'nama.required'=>'Nama harus diisi'


        ]);
         //aksi update

        rw::where('id',$id)
            ->update([
                'nama'=>$request->nama,
                'dusun_id'=>$request->dusun_id,
                'dusun_nama'=>$request->dusun_nama
            ]);
            return redirect('/admin/datawilayah/detail/'.$dusun_id)->with('status','Data berhasil diupdate!');
    }

    public function dusunuserstore(Request $request)
    {
        // dd($request);
        $request->validate([
            'nama'=>'required',
            'email'=>'required',
            'password'=>'required',
            'password2'=>'required|same:password'

        ],
        [
            'nama.required'=>'Nama harus diisi'

        ]);

        $checkEmail=User::where("email",$request->email)->first();

        if($checkEmail){
            return redirect(URL::to('/').'/admin/datawilayah')->with('status','Gagal! Email sudah digunakan!');
        }
            // dd($request);
       DB::table('users')->insert(
        array(
               'name'     =>   $request->nama,
               'email'     =>   $request->email,
               'dusunid'     =>   $request->dusun_id,
               'tipeuser'     =>   'dusun',
               'password' => Hash::make($request->password),
               'created_at'=>date("Y-m-d H:i:s"),
               'updated_at'=>date("Y-m-d H:i:s")
        ));

        return redirect(URL::to('/').'/admin/datawilayah')->with('status','Data berhasil di tambahkan!');
    }

    public function dusunuserdestroy($dusun_id,$id)
    {
        // dd($id);
        user::destroy($id);
        return redirect(URL::to('/').'/admin/datawilayah/detail/'.$dusun_id)->with('status','Data berhasil dihapus!');
    }

    public function dusunuseredit($dusun_id,$id)
    {
        $dusun = DB::table('dusun')->where('id',$dusun_id)->get();
        $datas = DB::table('users')->where('id',$id)->get();
        return view('admin.datawilayah.dusunuseredit',compact('datas','dusun'));
    }

    public function dusunuserupdate(Request $request, $dusun_id,$id)
    {
        $request->validate([
            'name'=>'required',
            'password'=>'required',
            'password2'=>'required|same:password'

        ],
        [
            'nama.required'=>'Nama harus diisi'

        ]);
         //aksi update

        user::where('id',$id)
            ->update([
                'name'=>$request->name,
                'dusunid'=>$request->dusun_id,
                'dusunnama'=>$request->dusun_nama,
                'password' => Hash::make($request->password)
            ]);
            return redirect('/admin/datawilayah/detail/'.$dusun_id)->with('status','Data berhasil diupdate!');
    }


    public function rwuserstore(Request $request)
    {
        // dd($request);
        $request->validate([
            'nama'=>'required',
            'email'=>'required',
            'password'=>'required',
            'password2'=>'required|same:password'

        ],
        [
            'nama.required'=>'Nama harus diisi'

        ]);

        $checkEmail=User::where("email",$request->email)->first();

        if($checkEmail){
            return redirect(URL::to('/').'/admin/datawilayah')->with('status','Gagal! Email sudah digunakan!');
        }
            // dd($request);
       DB::table('users')->insert(
        array(
               'name'     =>   $request->nama,
               'email'     =>   $request->email,
               'dusunid'     =>   $request->dusun_id,
               'dusunnama'     =>   $request->dusun_nama,
               'rwid'     =>   $request->rw_id,
               'tipeuser'     =>   'rw',
               'password' => Hash::make($request->password),
               'created_at'=>date("Y-m-d H:i:s"),
               'updated_at'=>date("Y-m-d H:i:s")
        ));

        return redirect(URL::to('/').'/admin/datawilayah/detailrw/'.$request->dusun_id.'/'.$request->rw_id)->with('status','Data berhasil di tambahkan!');
    }

    public function detailrw($dusun_id,$id)
    {
        $dusun = DB::table('dusun')->where('id',$dusun_id)->get();
        $users = DB::table('users')->where('rwid',$id)->get();
        $rws = DB::table('rw')->where('id',$id)->get();
        return view('admin.datawilayah.detailrw',compact('rws','dusun','users'));
    }
    public function rwuserdestroy($dusun_id,$rw_id,$id)
    {
        // dd($id);
        user::destroy($id);
        return redirect(URL::to('/').'/admin/datawilayah/detailrw/'.$dusun_id.'/'.$rw_id)->with('status','Data berhasil dihapus!');
    }
    public function rwuseredit($dusun_id,$rw_id,$id)
    {
        $dusun = DB::table('dusun')->where('id',$dusun_id)->get();
        $rws = DB::table('rw')->where('id',$rw_id)->get();
        $datas = DB::table('users')->where('id',$id)->get();
        return view('admin.datawilayah.rwuseredit',compact('datas','dusun','rws'));
    }

    public function rwuserupdate(Request $request, $dusun_id,$rw_id,$id)
    {
        $request->validate([
            'name'=>'required',
            'password'=>'required',
            'password2'=>'required|same:password'

        ],
        [
            'nama.required'=>'Nama harus diisi'

        ]);
         //aksi update

        user::where('id',$id)
            ->update([
                'name'=>$request->name,
                'dusunid'=>$request->dusun_id,
                'dusunnama'=>$request->dusun_nama,
                'password' => Hash::make($request->password)
            ]);
            return redirect(URL::to('/').'/admin/datawilayah/detailrw/'.$dusun_id.'/'.$rw_id)->with('status','Data berhasil diupdate!');
    }
}
