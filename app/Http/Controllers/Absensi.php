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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class Absensi extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        setlocale(LC_ALL, 'IND');
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
                ->orderBy('k.nama', 'ASC')
                ->get();
            echo '  
                <div class="table-responsive">
                    <table style="width:100%; font-size:12px" class="display table table-sm  table-bordered table-hover text-nowrap datatable-absensi" id="tbabsensi">
                        <thead>
                            <tr class="text-center">
                            <th>STB</th>
                            <th>NAMA</th> ';
            for ($i = 0; $i < 31; $i++) {
                $SST = !empty($request->tgl[$i]) ? ($request->tgl[$i]) : '';
                echo '          <th style="width: 30px" class="text-center">' . $SST . '</th>';
            }
            echo '          </tr>
                        </thead>
                        <tbody>';
            foreach ($results as $item2) {
                $sst01 = ($item2->_01 == "A") ? "bg-pink text-white" : (($item2->_01 == "F1") ? "bg-warning text-white" : (($item2->_01 == "F2") ? "bg-warning text-white" : (($item2->_01 == "½") ? "bg-warning text-white" : "")));
                $sst02 = ($item2->_02 == "A") ? "bg-pink text-white" : (($item2->_02 == "F1") ? "bg-warning text-white" : (($item2->_02 == "F2") ? "bg-warning text-white" : (($item2->_02 == "½") ? "bg-warning text-white" : "")));
                $sst03 = ($item2->_03 == "A") ? "bg-pink text-white" : (($item2->_03 == "F1") ? "bg-warning text-white" : (($item2->_03 == "F2") ? "bg-warning text-white" : (($item2->_03 == "½") ? "bg-warning text-white" : "")));
                $sst04 = ($item2->_04 == "A") ? "bg-pink text-white" : (($item2->_04 == "F1") ? "bg-warning text-white" : (($item2->_04 == "F2") ? "bg-warning text-white" : (($item2->_04 == "½") ? "bg-warning text-white" : "")));
                $sst05 = ($item2->_05 == "A") ? "bg-pink text-white" : (($item2->_05 == "F1") ? "bg-warning text-white" : (($item2->_05 == "F2") ? "bg-warning text-white" : (($item2->_05 == "½") ? "bg-warning text-white" : "")));
                $sst06 = ($item2->_06 == "A") ? "bg-pink text-white" : (($item2->_06 == "F1") ? "bg-warning text-white" : (($item2->_06 == "F2") ? "bg-warning text-white" : (($item2->_06 == "½") ? "bg-warning text-white" : "")));
                $sst07 = ($item2->_07 == "A") ? "bg-pink text-white" : (($item2->_07 == "F1") ? "bg-warning text-white" : (($item2->_07 == "F2") ? "bg-warning text-white" : (($item2->_07 == "½") ? "bg-warning text-white" : "")));
                $sst08 = ($item2->_08 == "A") ? "bg-pink text-white" : (($item2->_08 == "F1") ? "bg-warning text-white" : (($item2->_08 == "F2") ? "bg-warning text-white" : (($item2->_08 == "½") ? "bg-warning text-white" : "")));
                $sst09 = ($item2->_09 == "A") ? "bg-pink text-white" : (($item2->_09 == "F1") ? "bg-warning text-white" : (($item2->_09 == "F2") ? "bg-warning text-white" : (($item2->_09 == "½") ? "bg-warning text-white" : "")));
                $sst10 = ($item2->_10 == "A") ? "bg-pink text-white" : (($item2->_10 == "F1") ? "bg-warning text-white" : (($item2->_10 == "F2") ? "bg-warning text-white" : (($item2->_10 == "½") ? "bg-warning text-white" : "")));
                $sst11 = ($item2->_11 == "A") ? "bg-pink text-white" : (($item2->_11 == "F1") ? "bg-warning text-white" : (($item2->_11 == "F2") ? "bg-warning text-white" : (($item2->_11 == "½") ? "bg-warning text-white" : "")));
                $sst12 = ($item2->_12 == "A") ? "bg-pink text-white" : (($item2->_12 == "F1") ? "bg-warning text-white" : (($item2->_12 == "F2") ? "bg-warning text-white" : (($item2->_12 == "½") ? "bg-warning text-white" : "")));
                $sst13 = ($item2->_13 == "A") ? "bg-pink text-white" : (($item2->_13 == "F1") ? "bg-warning text-white" : (($item2->_13 == "F2") ? "bg-warning text-white" : (($item2->_13 == "½") ? "bg-warning text-white" : "")));
                $sst14 = ($item2->_14 == "A") ? "bg-pink text-white" : (($item2->_14 == "F1") ? "bg-warning text-white" : (($item2->_14 == "F2") ? "bg-warning text-white" : (($item2->_14 == "½") ? "bg-warning text-white" : "")));
                $sst15 = ($item2->_15 == "A") ? "bg-pink text-white" : (($item2->_15 == "F1") ? "bg-warning text-white" : (($item2->_15 == "F2") ? "bg-warning text-white" : (($item2->_15 == "½") ? "bg-warning text-white" : "")));
                $sst16 = ($item2->_16 == "A") ? "bg-pink text-white" : (($item2->_16 == "F1") ? "bg-warning text-white" : (($item2->_16 == "F2") ? "bg-warning text-white" : (($item2->_16 == "½") ? "bg-warning text-white" : "")));
                $sst17 = ($item2->_17 == "A") ? "bg-pink text-white" : (($item2->_17 == "F1") ? "bg-warning text-white" : (($item2->_17 == "F2") ? "bg-warning text-white" : (($item2->_17 == "½") ? "bg-warning text-white" : "")));
                $sst18 = ($item2->_18 == "A") ? "bg-pink text-white" : (($item2->_18 == "F1") ? "bg-warning text-white" : (($item2->_18 == "F2") ? "bg-warning text-white" : (($item2->_18 == "½") ? "bg-warning text-white" : "")));
                $sst19 = ($item2->_19 == "A") ? "bg-pink text-white" : (($item2->_19 == "F1") ? "bg-warning text-white" : (($item2->_19 == "F2") ? "bg-warning text-white" : (($item2->_19 == "½") ? "bg-warning text-white" : "")));
                $sst20 = ($item2->_20 == "A") ? "bg-pink text-white" : (($item2->_20 == "F1") ? "bg-warning text-white" : (($item2->_20 == "F2") ? "bg-warning text-white" : (($item2->_20 == "½") ? "bg-warning text-white" : "")));
                $sst21 = ($item2->_21 == "A") ? "bg-pink text-white" : (($item2->_21 == "F1") ? "bg-warning text-white" : (($item2->_21 == "F2") ? "bg-warning text-white" : (($item2->_21 == "½") ? "bg-warning text-white" : "")));
                $sst22 = ($item2->_22 == "A") ? "bg-pink text-white" : (($item2->_22 == "F1") ? "bg-warning text-white" : (($item2->_22 == "F2") ? "bg-warning text-white" : (($item2->_22 == "½") ? "bg-warning text-white" : "")));
                $sst23 = ($item2->_23 == "A") ? "bg-pink text-white" : (($item2->_23 == "F1") ? "bg-warning text-white" : (($item2->_23 == "F2") ? "bg-warning text-white" : (($item2->_23 == "½") ? "bg-warning text-white" : "")));
                $sst24 = ($item2->_24 == "A") ? "bg-pink text-white" : (($item2->_24 == "F1") ? "bg-warning text-white" : (($item2->_24 == "F2") ? "bg-warning text-white" : (($item2->_24 == "½") ? "bg-warning text-white" : "")));
                $sst25 = ($item2->_25 == "A") ? "bg-pink text-white" : (($item2->_25 == "F1") ? "bg-warning text-white" : (($item2->_25 == "F2") ? "bg-warning text-white" : (($item2->_25 == "½") ? "bg-warning text-white" : "")));
                $sst26 = ($item2->_26 == "A") ? "bg-pink text-white" : (($item2->_26 == "F1") ? "bg-warning text-white" : (($item2->_26 == "F2") ? "bg-warning text-white" : (($item2->_26 == "½") ? "bg-warning text-white" : "")));
                $sst27 = ($item2->_27 == "A") ? "bg-pink text-white" : (($item2->_27 == "F1") ? "bg-warning text-white" : (($item2->_27 == "F2") ? "bg-warning text-white" : (($item2->_27 == "½") ? "bg-warning text-white" : "")));
                $sst28 = ($item2->_28 == "A") ? "bg-pink text-white" : (($item2->_28 == "F1") ? "bg-warning text-white" : (($item2->_28 == "F2") ? "bg-warning text-white" : (($item2->_28 == "½") ? "bg-warning text-white" : "")));
                $sst29 = ($item2->_29 == "A") ? "bg-pink text-white" : (($item2->_29 == "F1") ? "bg-warning text-white" : (($item2->_29 == "F2") ? "bg-warning text-white" : (($item2->_29 == "½") ? "bg-warning text-white" : "")));
                $sst30 = ($item2->_30 == "A") ? "bg-pink text-white" : (($item2->_30 == "F1") ? "bg-warning text-white" : (($item2->_30 == "F2") ? "bg-warning text-white" : (($item2->_30 == "½") ? "bg-warning text-white" : "")));
                $sst31 = ($item2->_31 == "A") ? "bg-pink text-white" : (($item2->_31 == "F1") ? "bg-warning text-white" : (($item2->_31 == "F2") ? "bg-warning text-white" : (($item2->_31 == "½") ? "bg-warning text-white" : "")));
                echo '          <tr>
                                        <th>
                                        <a href="#" data-bs-toggle="modal" data-bs-target=".modal-detail-absensi" data-id="' . $item2->stb . '" data-tglaw="' . $request->tglaw . '" data-tglak="' . $request->tglak . '" style="text-decoration: none !important;color: inherit;">' . $item2->stb . '</a></th>
                                        <th>' . $item2->nama . '</th>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst01 . '">' . $item2->_01 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst02 . '">' . $item2->_02 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst03 . '">' . $item2->_03 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst04 . '">' . $item2->_04 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst05 . '">' . $item2->_05 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst06 . '">' . $item2->_06 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst07 . '">' . $item2->_07 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst08 . '">' . $item2->_08 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst09 . '">' . $item2->_09 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst10 . '">' . $item2->_10 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst11 . '">' . $item2->_11 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst12 . '">' . $item2->_12 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst13 . '">' . $item2->_13 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst14 . '">' . $item2->_14 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst15 . '">' . $item2->_15 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst16 . '">' . $item2->_16 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst17 . '">' . $item2->_17 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst18 . '">' . $item2->_18 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst19 . '">' . $item2->_19 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst20 . '">' . $item2->_20 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst21 . '">' . $item2->_21 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst22 . '">' . $item2->_22 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst23 . '">' . $item2->_23 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst24 . '">' . $item2->_24 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst25 . '">' . $item2->_25 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst26 . '">' . $item2->_26 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst27 . '">' . $item2->_27 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst28 . '">' . $item2->_28 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst29 . '">' . $item2->_29 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst30 . '">' . $item2->_30 . '</td>';
                echo '                  <td style="width: 30px" class="text-center ' . $sst31 . '">' . $item2->_31 . '</td>';
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
                            "lengthMenu": "Menampilkan _MENU_",
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
                        autoWidth: false,
                        "columnDefs": [ {
                            "targets": "no-sort",
                            "orderable": false,
                        } ]
                    });
                </script>
                ';
        }
    }

    public function listAbsensiDetail(Request $request)
    {

        $data = DB::table('penerimaan_karyawan')->where('stb', $request->id)->get();
        $absensi = DB::table('absensi_absensi')->where('stb', $request->id)->whereBetween('tanggal', [$request->tglaw, $request->tglak])->get();
        foreach ($data as $u) {
            $link = url('photo/pas/' . $u->userid);
            echo '
            <div class="row">
                <div class="col-lg-5">
                    <div class="row">
                        <div class="shadow" style="padding: 0px 0px 0px 0px">
                            <div class="col-lg-12">
                                <a data-fslightbox="gallery" href="' . $link . '.jpg">
                                    <div class="img-responsive rounded-3 border"
                                        style="background-image: url(' . $link . '.jpg)">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="col-lg-7">
                    <div class="card shadow bg-info-lt">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-sm">
                                <tr>
                                    <td width="150px">Divisi</td>
                                    <td>:</td>
                                    <td>' . $u->divisi . '</td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td>:</td>
                                    <td>' . $u->jabatan . '</td>
                                </tr>
                                <tr>
                                    <td>Bagian</td>
                                    <td>:</td>
                                    <td>' . $u->bagian . '</td>
                                </tr>
                                <tr>
                                    <td>Grup</td>
                                    <td>:</td>
                                    <td>' . $u->grup . '</td>
                                </tr>
                                <tr>
                                    <td>Shift</td>
                                    <td>:</td>
                                    <td>' . $u->shift . '</td>
                                </tr>
                                <tr>
                                    <td>Profesi</td>
                                    <td>:</td>
                                    <td>' . $u->profesi . '</td>
                                </tr>
                                <tr>
                                    <td>Hari Libur</td>
                                    <td>:</td>
                                    <td>' . $u->hrlibur . '</td>
                                </tr>
                                <tr>
                                    <td>Setengah Hari</td>
                                    <td>:</td>
                                    <td>' . $u->sethari . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-sm text-nowrap table-bordered table-hover " style="width:100%; font-size:12px">
                                <thead>
                                    <tr class="text-center">
                                        <td>Tanggal</td>
                                        <td>Hari</td>
                                        <td>Masuk</td>
                                        <td>Keluar</td>
                                        <td>QJAM</td>
                                        <td>ISH</td>
                                        <td>JK</td>
                                        <td>ST</td>
                                    </tr>
                                </thead>
                                ';
            foreach ($absensi as $key) {
                echo '
                                <tr class="text-center">
                                    <td>' . $key->tanggal . '</td>
                                    <td>' . strtoupper(Carbon::parse($key->tanggal)->formatLocalized('%A')) . '</td>
                                    <td>' . Carbon::parse($key->in)->format('H:i:s') . '</td>
                                    <td>' . Carbon::parse($key->out)->format('H:i:s') . '</td>
                                    <td>' . $key->qj . '</td>
                                    <td>' . $key->jis . '</td>
                                    <td>' . $key->qjnet . '</td>
                                    <td>' . $key->sst . '</td>
                                </tr>';
            }
            echo '
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        ';
        }
    }

    public function komunikasi()
    {
        $judul = "Surat Komunikasi";
        $absensi = "active";
        $komunikasi = "active";

        return view('products/03_absensi.komunikasi', [
            'judul' => $judul,
            'absensi' => $absensi,
            'komunikasi' => $komunikasi
        ]);
    }

    function getalpha(Request $request)
    {
        Artisan::call('cache:clear');
        $stb = $request->stb;

        $data = DB::table('penerimaan_karyawan')
            ->select('userid', 'stb', 'nama')
            ->where('status', 'like', '%aktif%')
            ->where('stb', $stb)
            ->get();
        if ($data->isNotEmpty()) {
            foreach ($data as $k) {
                return ['success' => 'Data Ditemukan', 'stat' => true, 'result' => $k->nama, 'userid' => $k->userid];
            }
        } else {
            return ['error' => 'Data Tidak Ditemukan', 'stat' => false];
        }
    }

    function getalphabydate(Request $request)
    {
        $aw = $request->tglaw;
        $ak = $request->tglak;

        $data = DB::table('absensi_absensi AS a')
            ->select('a.stb', 'a.name', 'a.sst', 'k.bagian', 'k.grup')
            ->join('penerimaan_karyawan AS k', 'a.userid', '=', 'k.userid')
            ->where('a.sst', '=', 'A')
            ->whereBetween('a.tanggal', [$aw, $ak])
            ->get();
        echo '  
                <div class="table-responsive">
                    <table style="width:100%;" class="display table table-sm  table-bordered table-hover text-nowrap datatable-absensi" id="tbabsensi">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center">STB</th>
                                <th>NAMA</th>
                                <th class="text-center">BAGIAN</th>
                                <th class="text-center">GRUP</th>
                                <th class="text-center">SST</th>
                                <th>Surat Komunikasi</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                        ';
        foreach ($data as $key) {
            echo '
                            <tr>
                                <td class="text-center">' . $key->stb . '</td>
                                <td>' . $key->name . '</td>
                                <td class="text-center">' . $key->bagian . '</td>
                                <td class="text-center">' . $key->grup . '</td>
                                <td class="text-center">' . $key->sst . '</td>
                                <td>
                                    <select class="form-select">
                                        <option></option>
                                    </select>
                                </td>
                                <td>
                                    <input class="form-control" type="text">
                                </td>
                            </tr>
                            ';
        }
        echo '
                        </tbody>
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
                            "lengthMenu": "Menampilkan _MENU_",
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
                        autoWidth: false,
                        "columnDefs": [ {
                            "targets": "no-sort",
                            "orderable": false,
                        } ]
                    });
                </script>
            ';
    }

    function storeKomunikasi(Request $request)
    {

        $request->validate(
            [
                'nama' => 'required|array|min:1',
                'tanggalform' => 'required',
                'dibuat' => 'required',
            ],
            [
                "nama.*"  => [
                    'required',
                ]
            ]
        );

        $noform = date('y') . "0000";
        // // GET NOFORM
        $checknoform = DB::table('absensi_komunikasi')->orderBy('noform', 'desc')->limit('1')->get();
        foreach ($checknoform as $key) {
            $noform = $key->noform;
        }
        $y = substr($noform, 1, 2);
        if (date('y') == $y) {
            $noUrut = substr($noform, 3, 4);
            $na = $noUrut + 1;
            $char = date('y');
            $kodeSurat = "K" . $char . sprintf("%04s", $na);
        } else {
            $kodeSurat = "K" . date('y') . "0001";
        }

        $check = DB::table('absensi_komunikasi')->insert([
            'entitas' => 'PINTEX',
            'noform' => $kodeSurat,
            'tanggal' => $request->tanggalform,
            'dibuat' => $request->dibuat,
            'keteranganform' => $request->keteranganform,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        for ($i = 0; $i < count($request->userid); $i++) {
            $checkitm = DB::table('absensi_komunikasiitm')->insert([
                'entitas' => 'PINTEX',
                'noform' => $kodeSurat,
                'tanggal' => $request->tanggalform,
                'userid' => $request->userid[$i],
                'nama' => $request->nama[$i],
                'suratid' => $request->suratid[$i],
                'sst' => $request->sst[$i],
                'keterangan' => $request->keterangan[$i],
                'dibuat' => $request->dibuat,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data Komunikasi telah berhasil disimpan.', 'status' => true);
        }
        return Response()->json($arr);
    }
}
