@extends('admin.main')

@section('title','Detail Dusun')

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
<!-- Section start -->
<div class="page-body">
    <!-- DOM/Jquery table start -->
    <div class="card">
        <div class="card-header">
            <h5>Data RW di Dusun {{ $ds->nama }}</h5>
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)


                        <tr>
                            <td>{{ ($loop->index)+1 }} </td>
                            <td>{{$data->nama}}</td>

                            <td>
                              
                                <a class="btn btn-info btn-sm btn-outline-info"
                                href="/admin/datawilayah/detailrw/{{$ds->id}}/{{$data->id}}"><span class="pcoded-micon"> <i
                                        class="feather icon-edit"></i>User di RW</span></a>
                                <a class="btn btn-warning btn-outline-warning btn-sm"
                                    href="/admin/datawilayah/detail/{{ $ds->id }}/{{$data->id}}/edit"><span class="pcoded-micon"> <i
                                            class="feather icon-edit"></i></span></a>
                                <form action="/admin/datawilayah/detail/{{ $ds->id }}/{{$data->id}}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm btn-outline-warning"
                                        onclick="return  confirm('Anda yakin menghapus data ini? Y/N')"><span
                                            class="pcoded-micon"> <i class="feather icon-delete"></i></span></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- DOM/Jquery table end -->

    <!-- dusunuser table start -->
    <div class="card">
        <div class="card-header">
            <h5>User di Dusun {{ $ds->nama }}</h5>
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $data)


                        <tr>
                            <td>{{ ($loop->index)+1 }} </td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->email}}</td>

                            <td>
                              
                                <a class="btn btn-warning btn-outline-warning btn-sm"
                                    href="/admin/datawilayah/user/{{ $ds->id }}/{{$data->id}}/edit"><span class="pcoded-micon"> <i
                                            class="feather icon-edit"></i></span></a>
                                <form action="/admin/datawilayah/user/{{ $ds->id }}/{{$data->id}}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm btn-outline-warning"
                                        onclick="return  confirm('Anda yakin menghapus data ini? Y/N')"><span
                                            class="pcoded-micon"> <i class="feather icon-delete"></i></span></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- dusunuser table end -->
    <!-- tambah -->
    <div class="card">
        <div class="card-block">
            <div class="card-body">
                <form action="/admin/datawilayah/detail/{{ $ds->id }}" method="post">
                    @csrf
                    <h5>Tambah RW di <b>Dusun {{ $ds->nama }}</b></h5>
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
                                  
                                    <input type="text" name="nama" id="input-nama"
                                        class="form-control form-control-alternative  @error('nama') is-invalid @enderror"
                                        placeholder="Contoh : RW 1 " value="{{old('nama')}}" required>
                                    @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
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


    <!-- TambahUser -->
    <div class="card">
        <div class="card-block">
            <div class="card-body">
                <form action="/admin/datawilayah/rwuser" method="post">
                    @csrf
                    <h5>Tambah RW User di Dusun {{ $ds->nama }}</h5>
                    <span>&nbsp; </span>
                    <div class="pl-lg-4">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Nama  (*</label>
                                    <input type="hidden" name="dusun_id" id="input-dusun_id"
                                    class="form-control form-control-alternative"  value="{{$ds->id}}" required>
                                    <input type="hidden" name="dusun_nama" id="input-dusun_id"
                                    class="form-control form-control-alternative"  value="{{$ds->nama}}" required>
                                    <input type="text" name="nama" id="input-nama"
                                        class="form-control form-control-alternative  @error('nama') is-invalid @enderror" value="{{old('nama')}}" required>
                                    @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-email">Email  (*</label>
                                    <input type="email" name="email" id="input-email"
                                        class="form-control form-control-alternative  @error('email') is-invalid @enderror" value="{{old('email')}}" required>
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

                            <div class="col-lg-6 col-sm-6 col-xl-6 m-b-30">
                                <label class="form-control-label" for="input-status">Pilih RW (*</label>
                                <select name="rw_id" id="input-status"
                                    class="form-control form-control-info  @error('status') is-invalid @enderror"
                                    required>
                                @foreach ($datas as $data)
                                    
                                  <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                                </select> @error('status')<div class="invalid-feedback"> {{$message}}
                                </div>
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
                                    <button type="Simpan" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- TambahUser end -->


</div>
<!-- Section end -->

<!-- page body -->
@endsection
