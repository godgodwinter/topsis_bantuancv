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
                    <h4>{{$kriteria->nama}} - {{$kriteria->nilai}}</h4>
                    <span>Tipe "{{ $kriteria->tipekriteria }}" </span> 
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
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th width="5%"  class="text-center text-uppercase">No</th>
                            <th  class="text-center text-uppercase">Range</th>
                            <th  width="15%" class="text-center text-uppercase">bobot</th>
                            <th width="5%"  class="text-center text-uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $sr)


                        <tr>
                            <td  class="text-center text-uppercase">{{ ($loop->index)+1 }} </td>
                            <td  class="text-left text-capitalize"> 
                               <?php
                                if ($sr->tanda=="Diantara"){
                                    ?>
                                   Diantara {{$sr->nilai1}} sampai {{$sr->nilai2}}
                                    <?php
                                }elseif($sr->tanda=="Kurang dari sama dengan"){
                                    ?>
                                    Kurang dari sama dengan {{$sr->nilai1}}
                                    <?php
                                }else {
                                   ?>
                                    Lebih dari sama dengan {{$sr->nilai1}}
                                   <?php
                                }
                                ?> 
                            </td>
                            <td class="text-center text-uppercase">{{$sr->bobot}}</td>

                            <td >

                                <a class="btn btn-warning btn-outline-warning"
                                    href="/admin/dataproses/{{$th->id}}/settingrange/{{$kriteria->id}}/edit/{{$sr->id}}"><span class="pcoded-micon"> <i
                                            class="feather icon-edit"></i></span></a>
                                <form action="/admin/dataproses/{{$th->id}}/settingrange/{{$kriteria->id}}/{{$sr->id}}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-outline-warning"
                                        onclick="return  confirm('Anda yakin menghapus data ini? Y/N')"><span
                                            class="pcoded-micon"> <i class="feather icon-delete"></i></span></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="5%"  class="text-center text-uppercase">No</th>
                            <th  class="text-center text-uppercase">Range</th>
                            <th  width="15%" class="text-center text-uppercase">bobot</th>
                            <th width="5%"  class="text-center text-uppercase">Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @if ($kriteria->tipekriteria==='Dinamis')

    <!-- tambahdinamis -->
    <div class="card">
        <div class="card-block">
            <div class="card-body">
                <form action="/admin/dataproses/{{ $th->id }}/settingrange/{{ $kriteria->id }}" method="post">
                    @csrf
                    <h5>Tambah Range Tipe Kriteria "Dinamis"</h5>
                    {{-- <span>**) Jika memilih Kurang dari atau lebih dari kosongkan inputan nilai 2 </span> --}}
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nilai1">Nilai 1 (*</label>
                                    <input type="text" name="nilai1" id="input-nilai1"
                                        class="form-control form-control-alternative  @error('nilai1') is-invalid @enderror"
                                        placeholder="Contoh : 1 " value="{{old('nilai1')}}" required>
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
                                        placeholder="Isi nilai 0 jika tidak menggunakan 'diantara' " value="{{old('nilai2')}}" required>
                                    @error('nilai2')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6 col-sm-6 col-xl-6 m-b-30">
                                <label class="form-control-label" for="input-tanda">Pilih Jenis Range  (*</label>
                                <select name="tanda" id="input-tanda"
                                    class="form-control form-control-info  @error('tanda') is-invalid @enderror"
                                    required>

                                    <option>Diantara</option>
                                    <option>Kurang dari sama dengan</option>
                                    <option>Lebih dari sama dengan</option>
                                </select> @error('tanda')<div class="invalid-feedback"> {{$message}}
                                </div>
                                @enderror
                            </div> 

                            {{-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nilai2">Nilai 2  (*</label>
                                    <input type="text" name="nilai2" id="input-nilai2"
                                        class="form-control form-control-alternative  @error('nilai2') is-invalid @enderror"
                                        placeholder="Contoh : 5 " value="{{old('nilai2')}}" >
                                    @error('nilai2')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>



                            <div class="col-lg-6 col-sm-6 col-xl-6 m-b-30">
                                <label class="form-control-label" for="input-tanda">Pilih Jenis Range  (*</label>
                                <select name="tanda" id="input-tanda"
                                    class="form-control form-control-info  @error('tanda') is-invalid @enderror"
                                    required>

                                    <option>Diantara</option>
                                    <option>Kurang dari sama dengan</option>
                                    <option>Lebih dari sama dengan</option>
                                </select> @error('tanda')<div class="invalid-feedback"> {{$message}}
                                </div>
                                @enderror
                            </div> --}}

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-bobot">Bobot  (*</label>
                                    <input type="text" name="bobot" id="input-bobot"
                                        class="form-control form-control-alternative  @error('bobot') is-invalid @enderror"
                                        placeholder="Contoh : 4" value="{{old('bobot')}}" required>
                                    @error('bobot')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6 col-sm-6 col-xl-6 m-b-30 mt-4">
                                <label class="form-control-label" for="input-status"><strong>Diantara</strong> -> Isi nilai 1 dan nilai 2 (batas bawah dan batas atas), Contoh : Nilai1< $datareal < Nilai2 </label>
                                <label class="form-control-label" for="input-status"><strong>Kurang dari sama dengan</strong> -> Isi nilai1 saja, contoh : Nilai1<=$datareal</label>
                                <label class="form-control-label" for="input-status"><strong>Lebih dari sama dengan</strong> -> Isi nilai1 saja, contoh : Nilai1>=$datareal</label>
                                <label class="form-control-label" for="input-status"><strong>Jika $datareal tidak terjangkau setting range maka bobot di isi 0</strong> </label>
                                
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
                                    <button type="Simpan" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- tambahdinamis end -->
        
    @else
        
  
    <!-- tambah -->
    <div class="card">
        <div class="card-block">
            <div class="card-body">
                <form action="/admin/settingrange " method="post">
                    @csrf
                    <h5>Tambah Range</h5>
                    {{-- <span>**) Jika memilih Kurang dari atau lebih dari kosongkan inputan nilai 2 </span> --}}
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nilai1">Nilai (*</label>
                                    <input type="hidden" name="kriteria_id" value="{{ $kriteria->id }}">
                                    <input type="text" name="nilai1" id="input-nilai1"
                                        class="form-control form-control-alternative  @error('nilai1') is-invalid @enderror"
                                        placeholder="Contoh : 1 " value="{{old('nilai1')}}" required>
                                    @error('nilai1')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nilai2">Nilai 2  (*</label>
                                    <input type="text" name="nilai2" id="input-nilai2"
                                        class="form-control form-control-alternative  @error('nilai2') is-invalid @enderror"
                                        placeholder="Contoh : 5 " value="{{old('nilai2')}}" >
                                    @error('nilai2')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>



                            <div class="col-lg-6 col-sm-6 col-xl-6 m-b-30">
                                <label class="form-control-label" for="input-tanda">Pilih Jenis Range  (*</label>
                                <select name="tanda" id="input-tanda"
                                    class="form-control form-control-info  @error('tanda') is-invalid @enderror"
                                    required>

                                    <option>Diantara</option>
                                    <option>Kurang dari sama dengan</option>
                                    <option>Lebih dari sama dengan</option>
                                </select> @error('tanda')<div class="invalid-feedback"> {{$message}}
                                </div>
                                @enderror
                            </div> --}}

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-bobot">Bobot  (*</label>
                                    <input type="text" name="bobot" id="input-bobot"
                                        class="form-control form-control-alternative  @error('bobot') is-invalid @enderror"
                                        placeholder="Contoh : 4" value="{{old('bobot')}}" required>
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
                                    <button type="Simpan" class="btn btn-success">Simpan</button>
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
