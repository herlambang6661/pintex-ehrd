<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use DatePeriod;
use DateInterval;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class Absensi extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function absensi()
    {
        $judul = "Absensi";
        $absensi = "active";
        $list = "active";

        return view('products/03_absensi.listabsensi', [
            'judul' => $judul,
            'absensi' => $absensi,
            'list' => $list
        ]);
    }

    public function fingerprint()
    {
        $judul = "Fingerprint";
        $absensi = "active";
        $list = "active";
        return view('products/03_absensi.fingerprint', [
            'judul' => $judul,
            'absensi' => $absensi,
            'list' => $list
        ]);
    }

    public function getabsensi(Request $request)
    {
        if (count($request->tgl) > 32) {
            echo '<div class="alert alert-danger" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path><path d="M12 8v4"></path><path d="M12 16h.01"></path></svg>
                    </div>
                    <div>
                        Tanggal tidak boleh melebihi 31 Hari
                    </div>
                </div>
            </div>';
        } else {
            // inisiasi variabel tanggal awal dan akhir
            $period = new DatePeriod(
                new DateTime($request->tglaw),
                new DateInterval('P1D'),
                new DateTime($request->tglak)
            );
            foreach ($period as $key => $value) {
                $datesFull[] = $value->format('Y-m-d'); //yyy-mm-dd
                $day[] = $value->format('d'); // dd
                $month[] = $value->format('m'); // mm
            }

            // echo json_encode($request->tglfull[1]);
            // die();

            // get data karyawan aktif
            // $absens = DB::table('penerimaan_karyawan')
            //     ->select('userid', 'stb', 'nama')
            //     ->where('status', 'like', '%Aktif%')
            //     ->orderBy('nama', 'ASC')
            //     ->get();
            // $arrayName = array();
            // foreach ($absens as $item2) {
            //     for ($i = 0; $i < count($datesFull); $i++) {
            //         $arrayName[] = array(
            //             'stb' => $item2->stb,
            //             'name' => $item2->nama,
            //             $day[$i] => $day[$i],
            //         );
            //     }
            // }

            for ($i = 0; $i < count($request->tglfull); $i++) {
                $tgl1 = !empty($request->tglfull[0]) ? $request->tglfull[0] : '';
                $tgl2 = !empty($request->tglfull[1]) ? $request->tglfull[1] : '';
                $tgl3 = !empty($request->tglfull[2]) ? $request->tglfull[2] : '';
                $tgl4 = !empty($request->tglfull[3]) ? $request->tglfull[3] : '';
                $tgl5 = !empty($request->tglfull[4]) ? $request->tglfull[4] : '';
                $tgl6 = !empty($request->tglfull[5]) ? $request->tglfull[5] : '';
                $tgl7 = !empty($request->tglfull[6]) ? $request->tglfull[6] : '';
                $tgl8 = !empty($request->tglfull[7]) ? $request->tglfull[7] : '';
                $tgl9 = !empty($request->tglfull[8]) ? $request->tglfull[8] : '';
                $tgl10 = !empty($request->tglfull[9]) ? $request->tglfull[9] : '';
                $tgl11 = !empty($request->tglfull[10]) ? $request->tglfull[10] : '';
                $tgl12 = !empty($request->tglfull[11]) ? $request->tglfull[11] : '';
                $tgl13 = !empty($request->tglfull[12]) ? $request->tglfull[12] : '';
                $tgl14 = !empty($request->tglfull[13]) ? $request->tglfull[13] : '';
                $tgl15 = !empty($request->tglfull[14]) ? $request->tglfull[14] : '';
                $tgl16 = !empty($request->tglfull[15]) ? $request->tglfull[15] : '';
                $tgl17 = !empty($request->tglfull[16]) ? $request->tglfull[16] : '';
                $tgl18 = !empty($request->tglfull[17]) ? $request->tglfull[17] : '';
                $tgl19 = !empty($request->tglfull[18]) ? $request->tglfull[18] : '';
                $tgl20 = !empty($request->tglfull[19]) ? $request->tglfull[19] : '';
                $tgl21 = !empty($request->tglfull[20]) ? $request->tglfull[20] : '';
                $tgl22 = !empty($request->tglfull[21]) ? $request->tglfull[21] : '';
                $tgl23 = !empty($request->tglfull[22]) ? $request->tglfull[22] : '';
                $tgl24 = !empty($request->tglfull[23]) ? $request->tglfull[23] : '';
                $tgl25 = !empty($request->tglfull[24]) ? $request->tglfull[24] : '';
                $tgl26 = !empty($request->tglfull[25]) ? $request->tglfull[25] : '';
                $tgl27 = !empty($request->tglfull[26]) ? $request->tglfull[26] : '';
                $tgl28 = !empty($request->tglfull[27]) ? $request->tglfull[27] : '';
                $tgl29 = !empty($request->tglfull[28]) ? $request->tglfull[28] : '';
                $tgl30 = !empty($request->tglfull[29]) ? $request->tglfull[29] : '';
                $tgl31 = !empty($request->tglfull[30]) ? $request->tglfull[30] : '';
            }

            // echo json_encode($tgl2);
            // die();
            $results = DB::table('penerimaan_karyawan AS k')
                ->select(DB::raw("k.userid, k.stb, k.nama, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl1') AS _01, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl2') AS _02, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl3') AS _03, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl4') AS _04, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl5') AS _05, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl6') AS _06, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl7') AS _07, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl8') AS _08, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl9') AS _09, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl10') AS _10, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl11') AS _11, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl12') AS _12, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl13') AS _13, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl14') AS _14, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl15') AS _15, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl16') AS _16, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl17') AS _17, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl18') AS _18, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl19') AS _19, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl20') AS _20, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl21') AS _21, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl22') AS _22, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl23') AS _23, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl24') AS _24, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl25') AS _25, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl26') AS _26, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl27') AS _27, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl28') AS _28, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl29') AS _29, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl30') AS _30, 
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl31') AS _31"))
                ->where('k.status', 'like', '%Aktif%')
                ->get();
            echo '  
                <div class="table-responsive">
                    <table style="width:100%; font-size:12px" class="display table  table-sm table-striped table-bordered table-hover text-nowrap datatable-absensi" id="tbabsensi">
                        <thead>
                            <tr class="text-center">
                                <th>STB</th>
                                <th>NAMA</th> ';
            for ($i = 0; $i < count($request->tgl); $i++) {
                echo '          <th style="width: 30px" class="text-center">' . $request->tgl[$i] . '</th>';
            }
            echo '          </tr>
                        </thead>
                        <tbody>';
            foreach ($results as $item2) {
                echo '          <tr>
                                        <th>' . $item2->stb . '</th>
                                        <th>' . $item2->nama . '</th>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_01 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_02 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_03 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_04 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_05 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_06 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_07 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_08 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_09 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_10 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_11 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_12 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_13 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_14 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_15 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_16 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_17 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_18 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_19 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_20 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_21 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_22 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_23 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_24 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_25 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_26 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_27 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_28 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_29 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_30 . '</td>';
                echo '                  <td style="width: 30px" class="text-center">' . $item2->_31 . '</td>';
                echo '          </tr>';
            }
            echo '   </tbody>
                    </table>
                </div>';
            echo '
                <script>
                    var tb1 = $(".datatable-absensi").DataTable({
                        "processing": true, 
                        "serverSide": false, 
                        "scrollX": true,
                        "scrollCollapse": true,
                        "pagingType": "full_numbers",
                        "lengthMenu": [
                            [25, 35, 40, 50, -1],
                            ["25", "35", "40", "50", "Tampilkan Semua"]
                        ],
                        "dom": `<"card-header h3" B>` +
                            `<"card-body border-bottom py-3" <"row"<"col-sm-6"l><"col-sm-6"f>> >` +
                            `<"table-responsive" <"col-sm-12"tr> >` +
                            `<"card-footer" <"row"<"col-sm-8"i><"col-sm-4"p> >>`,
                        buttons: [
                            {
                                text: `<i class="fa-solid fa-filter" style="margin-right:5px"></i>`,
                                className: "btn btn-blue w_filter",
                                attr: {
                                    "href": "#offcanvasEnd-lamaran",
                                    "data-bs-toggle": "offcanvas",
                                    "role": "button",
                                    "aria-controls": "offcanvasEnd",
                                }
                            },
                            {
                                extend: "excelHtml5",
                                autoFilter: true,
                                className: "btn btn-success",
                                text: `<i class="fa fa-file-excel text-white" style="margin-right:5px"></i>`,
                                // action: newexportaction,
                            },
                        ],
                        "language": {
                            "lengthMenu": "Menampilkan Karyawan _MENU_",
                            "zeroRecords": "Data Tidak Ditemukan",
                            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ total data",
                            "infoEmpty": "Data Tidak Ditemukan",
                            "infoFiltered": "(Difilter dari _MAX_ total records)",
                            "processing": `<div class="container container-slim py-4"><div class="text-center"><div class="mb-3"></div><div class="text-secondary mb-3">Loading Data...</div><div class="progress progress-sm"><div class="progress-bar progress-bar-indeterminate"></div></div></div></div>`,
                            "search": `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path><path d="M21 21l-6 -6"></path></svg>`,
                            "paginate": {
                                "first": `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left-pipe" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 6v12"></path><path d="M18 6l-6 6l6 6"></path></svg>`,
                                "last": `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right-pipe" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 6l6 6l-6 6"></path><path d="M17 5v13"></path></svg>`,
                                "next": `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 6l6 6l-6 6"></path></svg>`,
                                "previous": `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 6l-6 6l6 6"></path></svg>`,
                            },
                        },
                        order: [[1, "asc"]]
                    });
                </script>';
        }
    }
}
