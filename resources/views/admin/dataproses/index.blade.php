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

{{-- {{dd($kriterias)}} --}}


@foreach ($data_wargas as $data_warga)
@endforeach
@foreach ($th_penerimaans as $th_penerimaan)
@endforeach

{{-- {{dd($kriteria)}} --}}
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
        <div class="cointainer"> <a class="btn btn-success btn-outline-success"
                href="/admin/dataproses/{{$th_penerimaan->id}}/addwarga"><span class="pcoded-micon"> <i
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
                            @foreach ($kriterias as $kriteria)
                            <th>{{ $kriteria->nama }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        {{-- data warga --}}
                        @foreach ($data_prosess as $data_proses)
                        <tr>
                            <td>{{ $data_proses->nik }}</td>
                                {{-- data warga diulang perkriteria --}}
                            @foreach ($kriterias as $kriteria)
                            <td>  <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#Modalnik{{ $data_proses->id }}kriteria{{ $kriteria->id }}">
                                    Isi Data {{ $data_proses->nik }} - {{ $kriteria->nama }}
                                </button>
                                 </td>


                            <!-- Modal -->
                            <div class="modal fade" id="Modalnik{{ $data_proses->id }}kriteria{{ $kriteria->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title  {{ $data_proses->nik }} - {{ $kriteria->nama }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
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
                            @foreach ($kriterias as $kriteria)
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
