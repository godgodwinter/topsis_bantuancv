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

{{-- {{ dd($jmldata) }} --}}
{{-- {{dd($kriteria) }} --}}
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4> @yield('title')</h4>
                    <span>Jumlah Warga harus lebih dari  Dua <code>(>2)</code> </span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="#"> <i class="feather icon-home"></i> </a>
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
        <div class="cointainer"> 
            <a class="btn btn-success btn-outline-success"
            href="/admin/dataproses/{{ $th_penerimaan->id }}/kuota"><span class="pcoded-micon"> <i
                    class="feather icon-edit"></i>Kuota</span></a>
            <a class="btn btn-success btn-outline-success"
            href="/admin/dataproses/{{ $th_penerimaan->id }}/kriteria"><span class="pcoded-micon"> <i
                    class="feather icon-edit"></i>Kriteria</span></a>

            <a class="btn btn-success btn-outline-success"
                href="/admin/dataproses/{{ $th_penerimaan->id }}/addwarga"><span class="pcoded-micon"> <i
                        class="feather icon-edit"></i>Tambah Calon Penerima Bantuan</span></a>
                        <?php
                        if($jmldata>2){
                            ?>

<a class="btn btn-danger btn-outline-danger"
href="/admin/dataproses/{{ $th_penerimaan->id }}/topsis"><span class="pcoded-micon"> <i
        class="feather icon-edit"></i>Lanjutkan Proses TOPSIS</span></a>

                            <?php
                        }else{
?>
<button class="btn btn-inverse btn-outline-inverse" disabled><span class="pcoded-micon"> <i
        class="feather icon-edit"></i>Lanjutkan Proses TOPSIS</span></button>

<?php
                        }
                        ?>

                    </div>
    </div>
    <div class="card">

        <div class="card-header">
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
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
                                <td>
                                    <form action="/admin/dataproses/{{$data_proses->nik}}/{{$th_penerimaan->id}}/hapusdatacalon" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm btn-outline-warning"
                                            onclick="return  confirm('Anda yakin menghapus data ini? Y/N')"><span
                                                class="pcoded-micon"> <i class="feather icon-delete"></i> {{ ($loop->index)+1 }}</span></button>
                                    </form>
                                </td>
                                <td>{{ $data_proses->nik }} -
                                    <?php
                                    $datwargas = DB::select('select * from data_warga where nik = ?', array($data_proses->nik));
                                                foreach ($datwargas as $ambildw) {
                                                    // dd($ambil);
                                                    // $sr_nilai=$ambil->nilai1;
                                                    ?>

                                              {{ $ambildw->nama }}
                                                    <?php
                                                }
                                    ?>

                                </td>
                                {{-- data warga diulang perkriteria --}}
                                @foreach($kriterias as $kriteria)
                                    <td>
                                        <!-- Tombal Modal -->
                                        <button type="button" class="btn btn-primary btn-outline-primary" data-toggle="modal"
                                            data-target="#Modalnik{{ $data_proses->id }}kriteria{{ $kriteria->id }}">
                                               {{-- $datasettingrange = DB::select('select * from setting_range where kriteria_id = ?', array($kriteria->id)); --}}
                                                    <?php
                                                    $dataaslitersimpan=0;
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

        if($kriteria->tipekriteria==='Fixed'){
             // dd($ambilsetting_range);
        $dataaslitersimpan=$ambilsetting_range->nilai1;

        }else{
        $dataaslitersimpan=$ambildataprosesdetail->datareal;

        }
       

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
                                                    <h5 class="modal-title" id="exampleModalLabel">Data
                                                        {{ $data_proses->nik }} - {{ $kriteria->nama }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    @if ($kriteria->tipekriteria==="Fixed")

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
                                                            <input type="hidden" name="tipekriteria"
                                                                value="{{ $kriteria->tipekriteria }}">

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
                                                        
                                                    @else
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
                                                            <input type="hidden" name="tipekriteria"
                                                                value="{{ $kriteria->tipekriteria }}">

                                                        <div class="col-lg-6 col-sm-6 col-xl-6 m-b-30">
                                                            <label class="form-control-label" for="input-setting_range_id">Input
                                                                Data (*</label>
                                                                <input type="number" name="datareal" id="input-datareal"
                                                                class="form-control form-control-alternative  @error('datareal') is-invalid @enderror"
                                                                placeholder="Contoh : 1 " value="{{ $dataaslitersimpan }}" required>
                                                            @error('datareal')<div class="invalid-feedback"> {{$message}}</div>
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
                                                    
                                                        
                                                    @endif


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
