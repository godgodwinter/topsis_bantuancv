@extends('admin.main')

@section('title','Edit')

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

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>@yield('title')</h4>
                    {{-- <span>Halaman Mastering @yield('title')</span> --}}
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
@foreach ($dusun as $ds)
@endforeach
@foreach ($datas as $data)
@endforeach

@foreach ($rws as $rw)
@endforeach
<!-- Section start -->
<div class="page-body">
    <!-- DOM/Jquery table start -->

    <!-- DOM/Jquery table end -->
    <!-- tambah -->
    <div class="card">
        <div class="card-block">
            <div class="card-body">
                <form action="/admin/datawilayah/userrw/{{ $ds->id }}/{{ $rw->id }}/{{$data->id}}" method="post">
                    @method('put')
                    @csrf
                    <h5>Edit User '{{ $data->name }}' dari <b>  {{ $rw->nama }} Dusun {{ $ds->nama }} </b></h5>
                    <span>&nbsp; </span>
                    <div class="pl-lg-4">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Nama  (*</label>
                                    <input type="hidden" name="dusun_id" id="input-nama"
                                    class="form-control form-control-alternative "
                                    placeholder="Contoh : Dusun Krajan " value="{{ $ds->id }}" required>
                                    <input type="hidden" name="dusun_nama" id="input-nama"
                                    class="form-control form-control-alternative "
                                    placeholder="Contoh : Dusun Krajan " value="{{ $ds->nama }}" required>
                                    <input type="text" name="name" id="input-name"
                                        class="form-control form-control-alternative  @error('name') is-invalid @enderror"
                                        placeholder="Contoh : Joko Widodo "  value="{{$data->name}}"  required>
                                    @error('name')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>


                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-email">Email  (*</label>
                            <input type="email" name="email" id="input-email"
                                class="form-control form-control-alternative  @error('email') is-invalid @enderror"  value="{{$data->email}}" readonly>
                            @error('email')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-password">Pasword  (*</label>
                            <input type="password" name="password" id="input-password"
                                class="form-control form-control-alternative  @error('password') is-invalid @enderror" value="{{old('password')}}" required>
                            @error('password')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-password2">Konfirmasi Pasword (*</label>
                            <input type="password" name="password2" id="input-password2"
                                class="form-control form-control-alternative  @error('password2') is-invalid @enderror"value="{{old('password2')}}" required>
                            @error('password2')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
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
