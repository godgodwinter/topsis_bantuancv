@extends('admin.main')

@section('title','Hasil Proses Perhitungan TOPSIS')

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




      <!-- End tombol -->

    {{-- Langkah 8 --}}
    <div class="card">

        <div class="card-header">
            @php
                if($th_penerimaan->verif==='Terverifikasi'){
            @endphp
             <a href="cetak" class="btn btn-primary" target="_blank">CETAK PDF</a>
            @php
                }else{
            @endphp
             <a href="#" class="btn btn-secondary" >CETAK PDF</a> <p><i>Tunggu Verifikasi Kepala Desa</i></p>

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
                            <th>Wilayah</th>
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

                            //revisi
                            // ambil data kuota per rw
                            ?>
@foreach($kuota_rw as $kr)

{{-- <tr>
    <td>{{ $kr->rw_id }}</td>
    <td>{{ $kuota=$kr->total }}</td>
   

</tr> --}}
@php
$kuota=$kr->total
@endphp
@if ($kuota>0)
    @php
    $datasakhir = DB::table('data_warga')
        ->join('data_proses','data_proses.nik','=','data_warga.nik')
    ->where('rw_id',$kr->rw_id)
        ->orderBy('data_proses.hasil_topsis', 'desc')->skip(0)->take($kuota)->get()

    @endphp
    @foreach($datasakhir as $da)

    <tr>
        <td> - </td>
        <td>{{ $da->nik }} - {{ $da->nama }}</td>
    
        <td>
            <?php
            $caridusuns= DB::table('dusun')
                ->where('id', '=', $da->dusun_id)
                ->get();
            ?>  

            <?php
            $carirw = $carirw = DB::table('rw')
                ->where('id', '=', $da->rw_id)
                ->get();
            ?>  
            @foreach ($caridusuns as $ds)
                   Dusun {{ $ds->nama }} - 
            @endforeach

            @foreach ($carirw as $rw)
                   {{ $rw->nama }} 
            @endforeach
        </td>
        <td>{{ $da->hasil_topsis }}</td>
    

    </tr>


    @endforeach

    
@else
    
@endif

   

{{-- {{ dd($datasakhir) }} --}}



@endforeach

        <?php
                            //foreach limit per rw

                            ?>
                            
                        {{-- data warga --}}
                        @foreach($th_penerimaans as $th_penerimaan)
@endforeach
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
                                                    $dusun_id=$ambildw->dusun_id;
                                                    $rw_id=$ambildw->rw_id;
                                                    ?>

                                              {{ $ambildw->nama }}
                                                    <?php
                                                }
                                    ?>

                                </td>
                                <td>

                                

                                    <?php
                                    $caridusuns= DB::table('dusun')
                                        ->where('id', '=', $dusun_id)
                                        ->get();
                                    ?>  
    
                                    <?php
                                    $carirw = $carirw = DB::table('rw')
                                        ->where('id', '=', $rw_id)
                                        ->get();
                                    ?>  
                                    @foreach ($caridusuns as $ds)
                                           Dusun {{ $ds->nama }} - 
                                    @endforeach
    
                                    @foreach ($carirw as $rw)
                                           {{ $rw->nama }} 
                                    @endforeach
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
        <th>Wilayah</th>
        <th>Nilai Preferensi</th>
    </tr>

</tfoot>
</table>
</div>
</div>
</div>

    {{-- END Langkah 8 --}}

    {{-- <div class="wrapper">
            <div id="chart" style="height: 300px;">    </div>
    </div> --}}


<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">
            {{-- <h5>Threshold plugin for chartist</h5>
            <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span> --}}
            <canvas id="myChart" width="400" height="200"></canvas>
        </div>
        <div class="card-block">
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js" integrity="sha512-VMsZqo0ar06BMtg0tPsdgRADvl0kDHpTbugCBBrL55KmucH6hP9zWdLIWY//OTfMnzz6xWQRxQqsUFefwHuHyg==" crossorigin="anonymous"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            @php
            $data_prosess = DB::table('data_proses')->where('th_penerimaan_id',$th_penerimaan->id)->orderBy('hasil_topsis', 'desc')->get();

            @endphp
            labels: [
           @php
 foreach($data_prosess as $dp){
                // dd($dp->nik);
                $datawarga = DB::table('data_warga')->where('nik',$dp->nik)->get();
                    foreach($datawarga as $dw){
                        $namawarga=$dw->nama;
                        $namawargalimit=mb_strimwidth($namawarga, 0, 10, "");
                        echo "'".$namawargalimit."',";
                    }
               }

           @endphp
            ],
            datasets: [{
                label: '# of Votes',
                data: [
                    @php
         foreach($data_prosess as $dp){
                // dd($dp->nik);
                $newdata_hasil=$dp->hasil_topsis;
            // $data["chart"]["labels"][] = $newdata;
            // $data["datasets"][0]["values"][] = $newdata_hasil;
                        echo "".$newdata_hasil.",";

               }

           @endphp
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>

{{--
// <script>
//     var ctx = document.getElementById('myChart').getContext('2d');
//     var myChart = new Chart(ctx, {
//         type: 'bar',
//         data: {
//             labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
//             datasets: [{
//                 label: '# of Votes',
//                 data: [12, 19, 3, 5, 2, 3, 19, 3, 5, 2, 3, 19, 3, 5, 2, 3, 19, 3, 5, 2, 3],
//                 backgroundColor: [
//                     'rgba(255, 99, 132, 0.2)',
//                     'rgba(54, 162, 235, 0.2)',
//                     'rgba(255, 206, 86, 0.2)',
//                     'rgba(75, 192, 192, 0.2)',
//                     'rgba(153, 102, 255, 0.2)',
//                     'rgba(255, 159, 64, 0.2)'
//                 ],
//                 borderColor: [
//                     'rgba(255, 99, 132, 1)',
//                     'rgba(54, 162, 235, 1)',
//                     'rgba(255, 206, 86, 1)',
//                     'rgba(75, 192, 192, 1)',
//                     'rgba(153, 102, 255, 1)',
//                     'rgba(255, 159, 64, 1)'
//                 ],
//                 borderWidth: 1
//             }]
//         },
//         options: {
//             scales: {
//                 y: {
//                     beginAtZero: true
//                 }
//             }
//         }
//     });
//     </script> --}}


{{--

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

    </script> --}}

</div>
<!-- Section end  -->


<!-- page body -->
@endsection
