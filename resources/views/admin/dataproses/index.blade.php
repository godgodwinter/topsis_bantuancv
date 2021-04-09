@extends('admin.main')

@section('title','Data Proses')

@section('csshere')
<!-- Data Table Css -->
<link rel="stylesheet" type="text/css"
    href="{{ asset("admin-style/") }}/files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="{{ asset("admin-style/") }}/files/assets/pages/data-table/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css"
    href="{{ asset("admin-style/") }}/files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
@endsection

@section('jshere')
<!-- data-table js -->

@endsection
@section('headernav')

{{-- {{dd($kriterias) }} --}}


@foreach($data_wargas as $data_warga)
@endforeach
@foreach($th_penerimaans as $th_penerimaan)
@endforeach

{{-- {{dd($kriteria) }} --}}
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4> @yield('title')</h4>
                    <span> </span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.html"> <i class="feather icon-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">@yield('title')</a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('notif')
@if(session('status'))
    <div class="alert alert-info border-info">
        {{ session('status') }} <button type="button" class="close" data-dismiss="alert"
            aria-label="Close"><span class="pcoded-micon"> <i class="feather icon-x-square"></i></span>
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@endsection

@section('container')
<!-- Section start -->
<div class="page-body">
    <!-- DOM/Jquery table start -->

    <!-- DOM/Jquery table end -->
    <!-- tambah -->
    <div class="card">
        <div class="cointainer"> <a class="btn btn-success btn-outline-success"
                href="/admin/dataproses/{{ $th_penerimaan->id }}/addwarga"><span class="pcoded-micon"> <i
                        class="feather icon-edit"></i>Tambah Calon Penerima Bantuan</span></a></div>
    </div>
    <div class="card">

        <div class="card-header">
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            @foreach($kriterias as $kriteria)
                                <th>{{ $kriteria->nama }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        {{-- data warga --}}
                        @foreach($data_prosess as $data_proses)
                            <tr>
                                <td>{{ ($loop->index)+1 }} </td>
                                <td>{{ $data_proses->nik }}</td>
                                {{-- data warga diulang perkriteria --}}
                                @foreach($kriterias as $kriteria)
                                    <td>
                                        <!-- Tombal Modal -->
                                        <button type="button" class="btn btn-primary btn-outline-primary" data-toggle="modal"
                                            data-target="#Modalnik{{ $data_proses->id }}kriteria{{ $kriteria->id }}">
                                               {{-- $datasettingrange = DB::select('select * from setting_range where kriteria_id = ?', array($kriteria->id)); --}}
                                                    <?php
                                                       $cari = $cari = DB::table('data_proses_detail')
 ->where('nik', '=', $data_proses->nik)
 ->where('th_penerimaan_id', '=', $th_penerimaan->id)
 ->where('kriteria_id', '=', $kriteria->id)
 ->count();
//  dd($cari);
if($cari<1){
    echo" Isi Data";
    $data_proses_detail_id=0;
}else{
    //ambil id setting range pada table data proses detail
    $ambildataprosesdetail = DB::table('data_proses_detail')
 ->where('nik', '=', $data_proses->nik)
 ->where('th_penerimaan_id', '=', $th_penerimaan->id)
 ->where('kriteria_id', '=', $kriteria->id)->first();

        // dd($ambildataprosesdetail);
        $data_proses_detail_id=$ambildataprosesdetail->id;
        $sr_id=$ambildataprosesdetail->setting_range_id;
                                                    // echo $sr_id;

        $ambilsetting_range= DB::table('setting_range')
 ->where('id', '=', $sr_id)->first();

        // dd($ambilsetting_range);
        $dataaslitersimpan=$ambilsetting_range->nilai1;

             echo $dataaslitersimpan;
}
?>
                                        </button>
                                    </td>


                                    <!-- Modal Tambah -->
                                    <div class="modal fade"
                                        id="Modalnik{{ $data_proses->id }}kriteria{{ $kriteria->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title
                                                        {{ $data_proses->nik }} - {{ $kriteria->nama }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <form action="/admin/dataproses/isidata/add " method="post">
                                                        @csrf

                                                        <input type="hidden" name="data_proses_detail_id"
                                                            value="{{ $data_proses_detail_id }}">
                                                        <input type="hidden" name="th_penerimaan_id"
                                                            value="{{ $th_penerimaan->id }}">
                                                        <input type="hidden" name="nik"
                                                            value="{{ $data_proses->nik }}">
                                                        <input type="hidden" name="kriteria_id"
                                                            value="{{ $kriteria->id }}">

                                                        <div class="col-lg-6 col-sm-6 col-xl-6 m-b-30">
                                                            <label class="form-control-label" for="input-setting_range_id">Pilih
                                                                Data (*</label>
                                                            <select name="setting_range_id" id="input-setting_range_id"
                                                                class="form-control form-control-info  @error('setting_range_id') is-invalid @enderror"
                                                                required>

                                                                {{-- <option>{{ $kriteria->id }}</option> --}}
                                    <?php
                                        $datasettingrange = DB::select('select * from setting_range where kriteria_id = ?', array($kriteria->id));
                                                    foreach ($datasettingrange as $ambil) {
                                                        // dd($ambil);
                                                        // $sr_nilai=$ambil->nilai1;
                                                        ?>

                                                    <option value="{{ $ambil->id }}">{{ $ambil->nilai1 }}</option>
                                                        <?php
                                                    }
                                        ?>
                                                                {{-- @foreach ($kriterias as $kriteria)


                                                    <option>{{ $kriteria->id }}</option>
                                @endforeach--}}
                                </select> @error('setting_range_id')<div class="invalid-feedback"> {{ $message }}
                                </div>
                        @enderror
            </div>


            {{-- <input type="hidden" name="nik" value="{{ $data->nik }}">
            --}}
            {{-- <button class="btn btn-warning btn-outline-warning"
                                            onclick="return  confirm('Anda menambahkan data ini? Y/N')"><span
                                            class="pcoded-micon"> <i class="feather icon-edit"></i>Tambahkan</span></button> --}}


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
    </div>
</div>
</div>

@endforeach






</tr>
@endforeach
</tbody>
<tfoot>
    <tr>
        <th>No</th>
        <th>NIK</th>
        @foreach($kriterias as $kriteria)
            <th>{{ $kriteria->nama }}</th>
        @endforeach
    </tr>
</tfoot>
</table>
</div>
</div>
</div>

</div>
<!-- Section end -->


<!-- page body -->
@endsection
