@extends('admin.main')

@section('title','Kriteria')

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

{{-- {{dd($kriterias)}} --}}
@foreach ($kriterias as $kriteria)
@endforeach

{{-- {{dd($kriteria)}} --}}
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>@yield('title')</h4>
                    <span>Halaman Mastering @yield('title') </span>
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
    @if (session('status'))
    <div class="alert alert-info border-info">
        {{ session('status') }} <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            class="pcoded-micon"> <i class="feather icon-x-square"></i></span>
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
@endsection

@section('container')
@foreach ($th_penerimaans as $th)
@endforeach
<!-- Section start -->
<div class="page-body">
    <!-- DOM/Jquery table start -->

    <!-- DOM/Jquery table end -->
    <!-- tambah -->
    <div class="card">
        <div class="card-block">
            <div class="card-body">
                <form action="/admin/dataproses/{{ $th->id }}/kriteria/{{$kriteria->id}}" method="post">
                    @method('put')
                    @csrf
                    <h5>Edit @yield('title')</h5>
                    <span>&nbsp; </span>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Nama Kriteria (*</label>
                                    <input type="text" name="nama" id="input-nama"
                                        class="form-control form-control-alternative  @error('nama') is-invalid @enderror"
                                        placeholder="Contoh : Tanggungan Keluarga "  value="{{$kriteria->nama}}"  required>
                                    @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-telp">nilai *)</label>
                                    <input type="number" name="nilai" id="input-telp"
                                        class="form-control form-control-alternative  @error('nilai') is-invalid @enderror"
                                        placeholder="Contoh : 5 "  value="{{$kriteria->nilai}}"  required>
                                    @error('nilai')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6 col-sm-6 col-xl-6 m-b-30">
                                <label class="form-control-label" for="input-status">Pilih Tipe (*</label>
                                <select name="tipekriteria" id="input-status"
                                    class="form-control form-control-info  @error('status') is-invalid @enderror"
                                    required>
                                    
                                  <option >{{ $kriteria->tipekriteria }}</option>
                                  <option >Dinamis</option>
                                  <option >Fixed</option>
                               
                                </select> @error('status')<div class="invalid-feedback"> {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="col-lg-6 col-sm-6 col-xl-6 m-b-30 mt-4">
                                <label class="form-control-label" for="input-status"><strong>Dinamis</strong> -> Input data berbentuk Real contoh : Data Penghasilan berupa Rp.500.000,00</label>
                                <label class="form-control-label" for="input-status"><strong>Fixed</strong> -> Input data berbentuk combobox contoh : Data Tempat tinggal berupa pilihan 1. Milik pribadi 2. Keluarga dst</label>
                                
                            </div>



                        </div>
                    </div>
                    <hr class="my-4" />
                    <!-- Address -->
                    <h6 class="heading-small text-muted mb-4">Aksi</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="Simpan" class="btn btn-success">Update</button>
                                </div>
                            </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- tambah end -->
</div>
<!-- Section end -->

<!-- page body -->
@endsection
