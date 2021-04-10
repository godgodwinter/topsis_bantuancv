@extends('admin.main')

@section('title','Proses Perhitungan TOPSIS')

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


     <!-- tombol -->
     <div class="card">
        <div class="cointainer">
                        <a class="btn btn-danger btn-outline-danger"
                        href="/admin/dataproses/1/endtopsis"><span class="pcoded-micon"> <i
                                class="feather icon-edit"></i>Akhiri Proses TOPSIS</span></a>
                    </div>
    </div>

      <!-- End tombol -->
    {{-- DATA WARGA AWAL --}}
    <div class="card">

        <div class="card-header">
            <h5>Data Warga</h5>
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            @foreach($kriterias as $kriteria)
                                <th>{{ $kriteria->nama }} </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        {{-- data warga --}}
                        @foreach($data_prosess as $data_proses)
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
                                {{-- data warga diulang perkriteria --}}
                                @foreach($kriterias as $kriteria)
                                    <td>
                                        <!-- Tombal Modal -->
                                       <?php
                                                       $cari = $cari = DB::table('data_proses_detail')
 ->where('nik', '=', $data_proses->nik)
 ->where('th_penerimaan_id', '=', $th_penerimaan->id)
 ->where('kriteria_id', '=', $kriteria->id)
 ->count();
//  dd($cari);
if($cari<1){
    echo"Data Belum diisi";
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

        // dd($ambilsetting_range);
        $dataaslitersimpan=$ambilsetting_range->nilai1;

             echo $dataaslitersimpan;
}
?>
                                    </td>




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

    {{-- END DATA WARGA AWAL --}}


    {{-- langkah 1 --}}
    <div class="card">

        <div class="card-header">
            <h5>Langkah 1 : Ubah data ke matrik</h5>
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            @foreach($kriterias as $kriteria)
                                <th>{{ $kriteria->nama }}  / C {{ ($loop->index)+1 }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        {{-- data warga --}}
                        @foreach($data_prosess as $data_proses)
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
                                {{-- data warga diulang perkriteria --}}
                                @foreach($kriterias as $kriteria)
                                    <td>
                                        <!-- Tombal Modal -->
                                       <?php
                                                       $cari = $cari = DB::table('data_proses_detail')
 ->where('nik', '=', $data_proses->nik)
 ->where('th_penerimaan_id', '=', $th_penerimaan->id)
 ->where('kriteria_id', '=', $kriteria->id)
 ->count();
//  dd($cari);
//jika data belum diisi
if($cari<1){
    $data_proses_detail_id=0;
    $bobot[$data_proses->nik][$kriteria->id]=0;
             echo $bobot[$data_proses->nik][$kriteria->id];
}else{
    //ambil id setting range pada table data proses detail
    $ambildataprosesdetail = DB::table('data_proses_detail')
 ->where('nik', '=', $data_proses->nik)
 ->where('th_penerimaan_id', '=', $th_penerimaan->id)
 ->where('kriteria_id', '=', $kriteria->id)->first();

        // dd($ambildataprosesdetail);
        $data_proses_detail_id=$ambildataprosesdetail->id;
        $bobot_sr=$ambildataprosesdetail->bobot_sr;
        $bobot[$data_proses->nik][$kriteria->id]=$bobot_sr;
//di ambil dari bobot sr tabel data proses detail,,jadi jika data bobot di tabel kriteria g terpangaruh

             echo $bobot[$data_proses->nik][$kriteria->id];
//         $sr_id=$ambildataprosesdetail->setting_range_id;
//                                                     // echo $sr_id;

//         $ambilsetting_range= DB::table('setting_range')
//  ->where('id', '=', $sr_id)->first();

//         // dd($ambilsetting_range);
//         $dataaslitersimpan=$ambilsetting_range->nilai1;

//              echo $dataaslitersimpan;
}
?>
                                    </td>




@endforeach






</tr>
@endforeach
</tbody>
<tfoot>
    <tr>
        <th>No</th>
        <th>NIK</th>
        @foreach($kriterias as $kriteria)
            <th>{{ $kriteria->nama }}  / C {{ ($loop->index)+1 }}</th>
        @endforeach
    </tr>
</tfoot>
</table>
</div>
</div>
</div>

    {{-- END langkah 1 --}}


    {{-- langkah 2 --}}
    <div class="card">

        <div class="card-header">
            <h5>langkah 2 : Xn=dikuadratkan kemudian dijumlah kemudian di akar </h5>
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            @foreach($kriterias as $kriteria)
                                <th>C {{ ($loop->index)+1 }}</th>

{{-- //variabel perkriteria --}}
<?php
$jmlxn[$kriteria->id]=0;
?>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        {{-- data warga --}}
                        @foreach($data_prosess as $data_proses)
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
                                {{-- data warga diulang perkriteria --}}
                                @foreach($kriterias as $kriteria)
                                    <td>
                                        <!-- Tombal Modal -->
                                       <?php
                                                       $cari = $cari = DB::table('data_proses_detail')
 ->where('nik', '=', $data_proses->nik)
 ->where('th_penerimaan_id', '=', $th_penerimaan->id)
 ->where('kriteria_id', '=', $kriteria->id)
 ->count();
//  dd($cari);

//jika data belum diisi
if($cari<1){
    $data_proses_detail_id=0;
    $bobot[$data_proses->nik][$kriteria->id]=0;
             echo $bobot[$data_proses->nik][$kriteria->id];
}else{
    //ambil id setting range pada table data proses detail
    $ambildataprosesdetail = DB::table('data_proses_detail')
 ->where('nik', '=', $data_proses->nik)
 ->where('th_penerimaan_id', '=', $th_penerimaan->id)
 ->where('kriteria_id', '=', $kriteria->id)->first();

        // dd($ambildataprosesdetail);
        $data_proses_detail_id=$ambildataprosesdetail->id;
        $bobot_sr=$ambildataprosesdetail->bobot_sr;
        $bobot[$data_proses->nik][$kriteria->id]=$bobot_sr;
//di ambil dari bobot sr tabel data proses detail,,jadi jika data bobot di tabel kriteria g terpangaruh

            $powbobot[$data_proses->nik][$kriteria->id]=pow($bobot[$data_proses->nik][$kriteria->id],2);
             echo $powbobot[$data_proses->nik][$kriteria->id];
             $jmlxn[$kriteria->id]+=$powbobot[$data_proses->nik][$kriteria->id];
//         $sr_id=$ambildataprosesdetail->setting_range_id;
//                                                     // echo $sr_id;

//         $ambilsetting_range= DB::table('setting_range')
//  ->where('id', '=', $sr_id)->first();

//         // dd($ambilsetting_range);
//         $dataaslitersimpan=$ambilsetting_range->nilai1;

//              echo $dataaslitersimpan;
}
?>
                                    </td>




@endforeach

</tr>

@endforeach
<tr>
    <td>-</td>
    <td>Jumlah Xn</td>
    @foreach($kriterias as $kriteria)
         <td>{{ $jmlxn[$kriteria->id] }}</td>
    @endforeach
</tr>


<tr>
    <td>-</td>
    <td>Akar Jumlah Xn</td>
    @foreach($kriterias as $kriteria)
        <?php $sqrtjmlxn[$kriteria->id]=number_format(sqrt($jmlxn[$kriteria->id]),3)?>
         <td>{{ $sqrtjmlxn[$kriteria->id] }}</td>
    @endforeach
</tr>
</tbody>
<tfoot>
    <tr>
        <th>No</th>
        <th>NIK</th>
        @foreach($kriterias as $kriteria)
            <th>C {{ ($loop->index)+1 }}</th>
        @endforeach
    </tr>
</tfoot>
</table>
</div>
</div>
</div>

    {{-- END langkah 2 --}}

    {{-- Langkah 3 --}}
    <div class="card">

        <div class="card-header">
            <h5>Langkah 3 : Rij=matrik data/Xn  </h5>
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            @foreach($kriterias as $kriteria)
                                <th>C {{ ($loop->index)+1 }}</th>

{{-- //variabel perkriteria --}}
<?php
// $jmlxn[$kriteria->id]=0;
?>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        {{-- data warga --}}
                        @foreach($data_prosess as $data_proses)
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
                                {{-- data warga diulang perkriteria --}}
                                @foreach($kriterias as $kriteria)
                                    <td>
                                        <!-- Tombal Modal -->
                                       <?php
                                                       $cari = $cari = DB::table('data_proses_detail')
 ->where('nik', '=', $data_proses->nik)
 ->where('th_penerimaan_id', '=', $th_penerimaan->id)
 ->where('kriteria_id', '=', $kriteria->id)
 ->count();
//  dd($cari);
$rij[$data_proses->nik][$kriteria->id]=number_format(($bobot[$data_proses->nik][$kriteria->id]/$sqrtjmlxn[$kriteria->id]),3);
echo $bobot[$data_proses->nik][$kriteria->id]." / ".$sqrtjmlxn[$kriteria->id]." = ".$rij[$data_proses->nik][$kriteria->id];
// //jika data belum diisi
// if($cari<1){
//     $data_proses_detail_id=0;
//     $bobot[$data_proses->nik][$kriteria->id]=0;
//              echo $bobot[$data_proses->nik][$kriteria->id];
// }else{
//     //ambil id setting range pada table data proses detail
//     $ambildataprosesdetail = DB::table('data_proses_detail')
//  ->where('nik', '=', $data_proses->nik)
//  ->where('th_penerimaan_id', '=', $th_penerimaan->id)
//  ->where('kriteria_id', '=', $kriteria->id)->first();

//         // dd($ambildataprosesdetail);
//         $data_proses_detail_id=$ambildataprosesdetail->id;
//         $bobot_sr=$ambildataprosesdetail->bobot_sr;
//         $bobot[$data_proses->nik][$kriteria->id]=$bobot_sr;
// //di ambil dari bobot sr tabel data proses detail,,jadi jika data bobot di tabel kriteria g terpangaruh

//             $powbobot[$data_proses->nik][$kriteria->id]=pow($bobot[$data_proses->nik][$kriteria->id],2);
//              echo $powbobot[$data_proses->nik][$kriteria->id];
//             //  $jmlxn[$kriteria->id]+=$powbobot[$data_proses->nik][$kriteria->id];
// //         $sr_id=$ambildataprosesdetail->setting_range_id;
// //                                                     // echo $sr_id;

// //         $ambilsetting_range= DB::table('setting_range')
// //  ->where('id', '=', $sr_id)->first();

// //         // dd($ambilsetting_range);
// //         $dataaslitersimpan=$ambilsetting_range->nilai1;

// //              echo $dataaslitersimpan;
// }
?>
                                    </td>




@endforeach

</tr>

@endforeach

</tbody>
<tfoot>
    <tr>
        <th>No</th>
        <th>NIK</th>
        @foreach($kriterias as $kriteria)
            <th>C {{ ($loop->index)+1 }}</th>
        @endforeach
    </tr>
</tfoot>
</table>
</div>
</div>
</div>

    {{-- END Langkah 3 --}}

    {{-- Langkah 4 dan 5 --}}
    <div class="card">

        <div class="card-header">
            <h5>Langkah 4 dan 5 : 4) yij=wi atau bobot kriteria *rij. kemudian disimpan dalam array untuk proses selanjutnya 5) Cari min dan max yij per kriteria  </h5>
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            @foreach($kriterias as $kriteria)
                                <th>C {{ ($loop->index)+1 }} </th>

{{-- //variabel perkriteria --}}
<?php
	//$dataarray[$id_kriteria]=array("kosong");
	$dataarray[$kriteria->id] = (array) null;
// $jmlxn[$kriteria->id]=0;
?>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        {{-- data warga --}}
                        @foreach($data_prosess as $data_proses)
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
                                {{-- data warga diulang perkriteria --}}
                                @foreach($kriterias as $kriteria)
                                    <td>
                                        <!-- Tombal Modal -->
                                       <?php
                                                       $cari = $cari = DB::table('data_proses_detail')
 ->where('nik', '=', $data_proses->nik)
 ->where('th_penerimaan_id', '=', $th_penerimaan->id)
 ->where('kriteria_id', '=', $kriteria->id)
 ->count();
$yij[$data_proses->nik][$kriteria->id]=number_format(($kriteria->nilai*$rij[$data_proses->nik][$kriteria->id]),2);
//masukkan kedalam array dataarray(kriteria)
array_push($dataarray[$kriteria->id],$yij[$data_proses->nik][$kriteria->id]);


echo $kriteria->nilai." / ".$rij[$data_proses->nik][$kriteria->id]." = " .$yij[$data_proses->nik][$kriteria->id];

//untuk langkah 6
$jmlpowkurangdplus[$data_proses->nik]=0;
$jmlpowkurangdmin[$data_proses->nik]=0;
?>
                                    </td>




@endforeach

</tr>

@endforeach
<tr>
    <td>-</td>
    <td>Min</td>
    @foreach($kriterias as $kriteria)
        <td>
            <?php
                $min[$kriteria->id]=min($dataarray[$kriteria->id]);
            ?>
            {{ $min[$kriteria->id] }}
        </td>
    @endforeach

</tr>
<tr>
    <td>-</td>
    <td>Max</td>
    @foreach($kriterias as $kriteria)
        <td>
            <?php
                $max[$kriteria->id]=max($dataarray[$kriteria->id]);
            ?>
            {{ $max[$kriteria->id] }}
        </td>
    @endforeach

</tr>

</tbody>
<tfoot>
    <tr>
        <th>No</th>
        <th>NIK</th>
        @foreach($kriterias as $kriteria)
            <th>C {{ ($loop->index)+1 }}</th>
            {{-- {{ dd($dataarray[$kriteria->id]) }} --}}
        @endforeach
    </tr>

</tfoot>
</table>
</div>
</div>
</div>

    {{-- END Langkah 4 dan 5 --}}

    {{-- Langkah 6 --}}
    <div class="card">

        <div class="card-header">
            <h5>Langkah 6 : Cari D+, ymax dikuarngi yij ,hasilnya dikuadratkan . Kemudian jumlahkan per nik . Kemudian Akar untuk mendapatkan D+ </h5>
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            @foreach($kriterias as $kriteria)
                                <th>C {{ ($loop->index)+1 }} ( W{{ ($loop->index)+1 }}={{ $kriteria->nilai }})</th>


{{-- //variabel perkriteria --}}
<?php
	//$dataarray[$id_kriteria]=array("kosong");
	// $dataarray[$kriteria->id] = (array) null;
// $jmlxn[$kriteria->id]=0;
?>
                            @endforeach
                            <th>Jumlah Per NIK</th>
                                <th>D+</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- data warga --}}
                        @foreach($data_prosess as $data_proses)
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
                                {{-- data warga diulang perkriteria --}}
                                @foreach($kriterias as $kriteria)
                                    <td>
                                        <!-- Tombal Modal -->
                                       <?php
                                                       $cari = $cari = DB::table('data_proses_detail')
 ->where('nik', '=', $data_proses->nik)
 ->where('th_penerimaan_id', '=', $th_penerimaan->id)
 ->where('kriteria_id', '=', $kriteria->id)
 ->count();
// $yij[$data_proses->nik][$kriteria->id]=number_format(($kriteria->nilai/$rij[$data_proses->nik][$kriteria->id]),2);
//masukkan kedalam array dataarray(kriteria)
// array_push($dataarray[$kriteria->id],$yij[$data_proses->nik][$kriteria->id]);
$hasilkurang[$data_proses->nik]=$max[$kriteria->id]-$yij[$data_proses->nik][$kriteria->id];
$powhasilkurang[$data_proses->nik]=number_format(pow($hasilkurang[$data_proses->nik],2),3);
$jmlpowkurangdplus[$data_proses->nik]+=$powhasilkurang[$data_proses->nik];

echo  $max[$kriteria->id]."- ".$yij[$data_proses->nik][$kriteria->id]. " = " .$hasilkurang[$data_proses->nik] ."<hr>".$powhasilkurang[$data_proses->nik];

?>
                                    </td>




@endforeach

<td>{{ $jmlpowkurangdplus[$data_proses->nik] }}</td>



<td>
    <?php
        $dplus[$data_proses->nik]=number_format(sqrt($jmlpowkurangdplus[$data_proses->nik]),3);
    ?>
    {{ $dplus[$data_proses->nik] }}</td>

</tr>

@endforeach

</tbody>
<tfoot>
    <tr>
        <th>No</th>
        <th>NIK</th>
        @foreach($kriterias as $kriteria)
            <th>C {{ ($loop->index)+1 }}</th>
            {{-- {{ dd($dataarray[$kriteria->id]) }} --}}
        @endforeach
        <th>Jumlah Per NIK</th>
        <th>D+</th>
    </tr>

</tfoot>
</table>
</div>
</div>
</div>

    {{-- END Langkah 6 --}}

    {{-- Langkah 7 --}}
    <div class="card">

        <div class="card-header">
            <h5>Langkah 7 : Cari D- , ymin  dikuarngi yij ,hasilnya dikuadratkan . Kemudian jumlahkan per nik . Kemudian Akar untuk mendapatkan D-</h5>
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            @foreach($kriterias as $kriteria)
                                <th>C {{ ($loop->index)+1 }} ( W{{ ($loop->index)+1 }}={{ $kriteria->nilai }})</th>


{{-- //variabel perkriteria --}}
<?php
	//$dataarray[$id_kriteria]=array("kosong");
	// $dataarray[$kriteria->id] = (array) null;
// $jmlxn[$kriteria->id]=0;
?>
                            @endforeach
                            <th>Jumlah Per NIK</th>
                                <th>D-</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- data warga --}}
                        @foreach($data_prosess as $data_proses)
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
                                {{-- data warga diulang perkriteria --}}
                                @foreach($kriterias as $kriteria)
                                    <td>
                                        <!-- Tombal Modal -->
                                       <?php
                                                       $cari = $cari = DB::table('data_proses_detail')
 ->where('nik', '=', $data_proses->nik)
 ->where('th_penerimaan_id', '=', $th_penerimaan->id)
 ->where('kriteria_id', '=', $kriteria->id)
 ->count();
// $yij[$data_proses->nik][$kriteria->id]=number_format(($kriteria->nilai/$rij[$data_proses->nik][$kriteria->id]),2);
//masukkan kedalam array dataarray(kriteria)
// array_push($dataarray[$kriteria->id],$yij[$data_proses->nik][$kriteria->id]);
$hasilkurang[$data_proses->nik]=$min[$kriteria->id]-$yij[$data_proses->nik][$kriteria->id];
$powhasilkurang[$data_proses->nik]=number_format(pow($hasilkurang[$data_proses->nik],2),3);
$jmlpowkurangdmin[$data_proses->nik]+=$powhasilkurang[$data_proses->nik];

echo $min[$kriteria->id]. " - ".$yij[$data_proses->nik][$kriteria->id]. " = " .$hasilkurang[$data_proses->nik] ."<hr>".$powhasilkurang[$data_proses->nik];

?>
                                    </td>




@endforeach

<td>{{ $jmlpowkurangdmin[$data_proses->nik] }}</td>



<td>
    <?php
        $dmin[$data_proses->nik]=number_format(sqrt($jmlpowkurangdmin[$data_proses->nik]),3);
    ?>
    {{ $dmin[$data_proses->nik] }}</td>

</tr>

@endforeach

</tbody>
<tfoot>
    <tr>
        <th>No</th>
        <th>NIK</th>
        @foreach($kriterias as $kriteria)
            <th>C {{ ($loop->index)+1 }}</th>
            {{-- {{ dd($dataarray[$kriteria->id]) }} --}}
        @endforeach
        <th>Jumlah Per NIK</th>
        <th>D-</th>
    </tr>

</tfoot>
</table>
</div>
</div>
</div>

    {{-- END Langkah 7 --}}

    {{-- Langkah 8 --}}
    <div class="card">

        <div class="card-header">
            <h5>Langkah 8 : Hasil Nilai Preferensi</h5>
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nilai </th>

                        </tr>
                    </thead>
                    <tbody>
                        {{-- data warga --}}
<?php
    // $hasiltopsis = (array) null;
?>
                        @foreach($data_prosess as $data_proses)
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
    <?php
        $hasilpreferensi[$data_proses->nik]=number_format($dmin[$data_proses->nik]/($dmin[$data_proses->nik]+$dplus[$data_proses->nik]),3);

        $updatedatatopsis = DB::table('data_proses')
 ->where('id', '=', $data_proses->id)->update([
    'hasil_topsis'=>$hasilpreferensi[$data_proses->nik]]);
    // if($hasilpreferensi[$data_proses->nik]===0.000){
    //     $hasilpreferensi[$data_proses->nik]=0;
    // }
// array_push($hasiltopsis,([$data_proses->nik=>$hasilpreferensi[$data_proses->nik]]));
    ?>
    {{ $dmin[$data_proses->nik] }} / ( {{ $dmin[$data_proses->nik] }} + {{ $dplus[$data_proses->nik] }}) = {{ $hasilpreferensi[$data_proses->nik] }}
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

    {{-- Langkah 8 --}}
    <div class="card">

        <div class="card-header">
            <h5>Langkah 9 : Perangkingan</h5>
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

    $datahasiltopsiss = DB::table('data_proses')->where('th_penerimaan_id',$th_penerimaan->id)->orderBy('hasil_topsis', 'desc')->get();
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

   {{ $hasilpreferensi[$data_proses->nik] }}
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




</div>
<!-- Section end  -->


<!-- page body -->
@endsection
