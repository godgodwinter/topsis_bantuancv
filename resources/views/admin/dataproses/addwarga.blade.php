@extends('admin.main')

@section('title','Data Warga')

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
                    <span>Pilih @yield('title')</span>
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

@foreach ($th_penerimaans as $th_penerimaan)
@endforeach
<!-- Section start -->
<div class="page-body">
    <!-- DOM/Jquery table start -->
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
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>No Telp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)


                        <tr>
                            <td>{{ ($loop->index)+1 }} </td>
                            <td>{{$data->nik}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->alamat}}</td>
                            <td>{{$data->jk}}</td>
                            <td>{{$data->hp}}</td>

                            <td>

                                            <form action="/admin/dataproses/addwarga/store " method="post">
                                                @csrf

                                    <input type="hidden" name="th_penerimaan_id" value="{{ $th_penerimaan->id }}">

                                    <input type="hidden" name="nik" value="{{ $data->nik }}">
                                    <button class="btn btn-warning btn-outline-warning"
                                        onclick="return  confirm('Anda menambahkan data ini? Y/N')"><span
                                            class="pcoded-micon"> <i class="feather icon-edit"></i>Tambahkan</span></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>No Telp</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- DOM/Jquery table end -->

</div>
<!-- Section end -->

<!-- page body -->
@endsection
