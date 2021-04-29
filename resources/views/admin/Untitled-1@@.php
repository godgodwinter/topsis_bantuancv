
    if((Auth::user()->current_team_id)==1){
        //halaman kades

    }else{
        return redirect(URL::to('/').'/404')->with('status','Data berhasil dihapus!');
    }
