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
@foreach ($datas as $data)
@endforeach

<?php

$kriterias = DB::table('kriteria')->where('id',$data->kriteria_id)->get();
// dd($kriterias);

?>


@foreach ($th_penerimaans as $th)
@endforeach
@foreach ($kriterias as $kriteria)
@endforeach

{{-- {{dd($kriteria)}} --}}
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>{{$kriteria->nama}} </h4>
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
<!-- Section start -->
<div class="page-body">
    <!-- DOM/Jquery table start -->

    <!-- DOM/Jquery table end -->
    <!-- tambah -->

    @if ($kriteria->tipekriteria==='Dinamis')
    <!-- tambah -->
    <div class="card">
        <div class="card-block">
            <div class="card-body">
                <form action="/admin/dataproses/{{$th->id}}/settingrange/{{ $kriteria->id }}/update/{{ $data->id }}" method="post">
                    @method('put')
                    @csrf
                    <h5>Edit Range</h5>
                    {{-- <span>**) Jika memilih Kurang dari atau lebih dari kosongkan inputan nilai 2 </span> --}}
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nilai1">Nilai (*</label>
                                    <input type="hidden" name="kriteria_id" value="{{ $data->kriteria_id }}">
                                    <input type="text" name="nilai1" id="input-nilai1"
                                        class="form-control form-control-alternative  @error('nilai1') is-invalid @enderror"
                                        placeholder="Contoh : 1 " value="{{ $data->nilai1 }}" required>
                                    @error('nilai1')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nilai2">Nilai 2 (*</label>
                                    <input type="hidden" name="kriteria_id" value="{{ $kriteria->id }}">
                                    <input type="text" name="nilai2" id="input-nilai2"
                                        class="form-control form-control-alternative  @error('nilai2') is-invalid @enderror"
                                        placeholder="Isi nilai 0 jika tidak menggunakan 'diantara' " value="{{ $data->nilai2 }}" required>
                                    @error('nilai2')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6 col-sm-6 col-xl-6 m-b-30">
                                <label class="form-control-label" for="input-tanda">Pilih Jenis Range  (*</label>
                                <select name="tanda" id="input-tanda"
                                    class="form-control form-control-info  @error('tanda') is-invalid @enderror"
                                    required>

                                    <option>{{ $data->tanda }}</option>
                                    <option>Diantara</option>
                                    <option>Kurang dari sama dengan</option>
                                    <option>Lebih dari sama dengan</option>
                                </select> @error('tanda')<div class="invalid-feedback"> {{$message}}
                                </div>
                                @enderror
                            </div> 

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-bobot">Bobot  (*</label>
                                    <input type="text" name="bobot" id="input-bobot"
                                        class="form-control form-control-alternative  @error('bobot') is-invalid @enderror"
                                        placeholder="Contoh : 4" value="{{ $data->bobot }}" required>
                                    @error('bobot')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
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
 
@else
<!-- tambah -->
<div class="card">
    <div class="card-block">
        <div class="card-body">
            <form action="/admin/dataproses/{{$th->id}}/settingrange/{{ $kriteria->id }}/update/{{ $data->id }}" method="post">
                @method('put')
                @csrf
                <h5>Edit Range</h5>
                {{-- <span>**) Jika memilih Kurang dari atau lebih dari kosongkan inputan nilai 2 </span> --}}
                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-nilai1">Nilai (*</label>
                                <input type="hidden" name="kriteria_id" value="{{ $data->kriteria_id }}">
                                <input type="text" name="nilai1" id="input-nilai1"
                                    class="form-control form-control-alternative  @error('nilai1') is-invalid @enderror"
                                    placeholder="Contoh : 1 " value="{{ $data->nilai1 }}" required>
                                @error('nilai1')<div class="invalid-feedback"> {{$message}}</div>
                                @enderror
                            </div>
                        </div>

                    


                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-bobot">Bobot  (*</label>
                                <input type="text" name="bobot" id="input-bobot"
                                    class="form-control form-control-alternative  @error('bobot') is-invalid @enderror"
                                    placeholder="Contoh : 4" value="{{ $data->bobot }}" required>
                                @error('bobot')<div class="invalid-feedback"> {{$message}}</div>
                                @enderror
                            </div>
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
        
@endif
</div>
<!-- Section end -->

<!-- page body -->
@endsection
