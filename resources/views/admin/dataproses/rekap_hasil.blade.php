
<html>
    <head>
        <title>Laporan Tahun Pelajaran</title>
    </head>
    <body>
        <style type="text/css">
        table {
  border-collapse: collapse;
}
            table tr td,
            table tr th{
                font-size: 12px;
                font-family: Georgia, 'Times New Roman', Times, serif;
            }
            td{
                height:10px;
            }
            body {
                font-size: 12px;
                font-family:Georgia, 'Times New Roman', Times, serif;
                }
            h1 h2 h3 h4 h5{
                line-height: 1.2;
            }
            .spa{
              letter-spacing:3px;
            }
        </style>
        <table width="100%" border="0">
            {{-- <tr>
            <td width="13%" align="right"><img src="../download.jpeg" width="110" height="110"></td>
            <td width="80%" align="center"><p><b><font size="28px">SMK DHARMA WANITA KROMENGAN</font><br>
                                          <font size="20px">STATUS : TERAKREDITASI "A" </font></b><br>
                                          KOMPETENSI KEAHLIAN<BR>
                                            1. TEKNIK OTOMOTIF &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2. TEKNIK KOMPUTER&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  3. PEMASARAN
                                            <BR>
                                            NSS. 322051818001&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NPSN. 20517715
                                            <br>Jl.NAILUN SELATAN NO 22 P 085-100-454-667 KROMENGAN - MALANG<BR>
                                            Email: smk_kromengan0735@gmail.com&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;http://smkdwkromengan.sch,id
                                        </p>

                                        </td>
            <td widht="7%"></td>
            </tr> --}}
            {{-- <tr>
                <td colspan="3"><hr style="border:2px;">
                </td>
            </tr> --}}
            </table>
            @foreach ($th_penerimaans as $tp)
            @php
                $tahun=$tp->tahun;
            @endphp
            @endforeach
            <center><h1>Data Penerima Bantuan Covid19 Tahun {{ $tahun }}</h1></center>

     <br>
      <table width="100%" border="1">


                  {{-- {{dd($pernyataans)}} --}}




                    <tr>
                            <th>No</th>
                            <th>NIK -Nama Lengkap</th>
                            <th>Nilai</th>

                    </tr>

                    @foreach($th_penerimaans as $th_penerimaan)
                    @endforeach
                                            <?php
                    $kuota=$th_penerimaan->kuota;
                        $datahasiltopsiss = DB::table('data_proses')->where('th_penerimaan_id',$th_penerimaan->id)->orderBy('hasil_topsis', 'desc')->skip(0)->take($kuota)->get();
                                            ?>
                                            @foreach($datahasiltopsiss as $data_proses)
                                                <tr>
                                                    <td align="center">{{ ($loop->index)+1 }} </td>
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


                    <td  align="center">

                       {{ $data_proses->hasil_topsis }}
                    </td>

                    </tr>

                    @endforeach


                  </tfoot>
                </table>
                <br>
               <br><br><br><br><br>
    <table width="100%" border="0">
        <tr>
            <th width="3%"></th>
            <th width="30%" align="center"></th>
            <th width="30%" align="center"></th>
            <th width="30%" align="center">
                Mengetahui, <br>
               Kepala Desa <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <br><br><br><br><br>
                <hr style="width:70%; border-top:2px dotted; border-style: none none dotted;  ">

            </th>

            {{-- <th width="34%"></th> --}}

            {{-- <th width="30%" align="center"> --}}
                {{-- .........,..............................20 --}}
{{--
                <br>Yang Membuat Pernyataan,<br>
                <br><br>
                <hr style="width:80%; border-top:2px dotted; border-style: none none dotted;  "> --}}

            {{-- </th> --}}
            <th width="3%"></th>

        </tr>
    </table>
    </body>
    </html>
