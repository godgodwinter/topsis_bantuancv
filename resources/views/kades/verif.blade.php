@extends('admin.main')

@section('title','Laporan Hasil Proses Perhitungan TOPSIS')

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

    @foreach($th_penerimaans as $th_penerimaan)
    @endforeach


      <!-- End tombol -->

    {{-- Langkah 8 --}}
    <div class="card">

        <div class="card-header">
            <a href="{{url('/')}}/admin/dataproses/{{ $th_penerimaan->id }}/cetak" class="btn btn-primary" target="_blank">CETAK PDF</a>
            @php
                if(($th_penerimaan->verif)==""){
            @endphp

            <a href="verifikasi" class="btn btn-warning"
            onclick="return  confirm('Anda yakin verifikasi data ini? Y/N')">Verifikasi</a>
            @php

                }else{
            @endphp

            <a href="verifikasibatalkan" class="btn btn-danger"
            onclick="return  confirm('Anda yakin membatalkan verifikasi data ini? Y/N')">Batalkan Verifikasi</a>
            @php

                }
            @endphp
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nilai Preferensi</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        // $jsonhasil=json_encode($hasiltopsis);
// // dd($hasiltopsis);
// rsort($hasiltopsis);

// var_dump($jsonhasil);
	// $hasiltopsis = (array) null;

                            ?>
                        {{-- data warga --}}

                        <?php
$kuota=$th_penerimaan->kuota;
    $datahasiltopsiss = DB::table('data_proses')->where('th_penerimaan_id',$th_penerimaan->id)->orderBy('hasil_topsis', 'desc')->skip(0)->take($kuota)->get();
                        ?>
                        @foreach($datahasiltopsiss as $data_proses)
                            <tr>
                                <td>{{ ($loop->index)+1 }} </td>
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


<td>

   {{ $data_proses->hasil_topsis }}
</td>

</tr>

@endforeach

</tbody>
<tfoot>
    <tr>
        <th>No</th>
        <th>NIK</th>
        <th>Nilai Preferensi</th>
    </tr>

</tfoot>
</table>
</div>
</div>
</div>

    {{-- END Langkah 8 --}}

<div class="card">

    <div id="chart" style="height: 300px;">    </div>
</div>








    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
  <script>
      const chart = new Chartisan({
        el: '#chart',
        url: "{{url('/charttopsis')}}/{{ $th_penerimaan->id }}",
      });

    </script>

</div>
<!-- Section end  -->


<!-- page body -->
@endsection
