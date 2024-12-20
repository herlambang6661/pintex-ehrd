<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use DatePeriod;
use DateInterval;
use Carbon\Carbon;
use App\Exports\ExportSKD;
use Illuminate\Http\Request;
use App\Exports\ExportAbsensi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;

class Absensi extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Jakarta');
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
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

    public function cuti()
    {
        $judul = "Aktifitas Cuti";
        $absensi = "active";
        $cuti = "active";

        return view('products/03_absensi.cuti', [
            'judul' => $judul,
            'absensi' => $absensi,
            'cuti' => $cuti,
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

    public function exportLamaran()
    {
        $file_path = public_path('file_excel/ContohUploadLamaran.xlsx');

        return response()->download($file_path);
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

            if ($request->fbagian == '*') {
                $fbagian = '%%';
            } else {
                $fbagian = '%' . $request->fbagian . '%';
            }

            if ($request->fstatus) {
                if ($request->fstatus == '*') {
                    $fstatus = '%%';
                } else {
                    $fstatus = '%' . $request->fstatus . '%';
                }
            } else {
                $fstatus = '%Aktif%';
            }

            if ($request->fshift == '*') {
                $shiftst = 'LIKE';
                $fshift = '%%';
            } else {
                $shiftst = '=';
                $fshift = $request->fshift;
            }

            // SQL Ambil Data Absensi by date
            $results = DB::table('penerimaan_karyawan AS k')
                ->select(DB::raw(
                    "k.userid, k.stb, k.nama, k.bagian, k.grup,
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
                    (SELECT a.sst FROM absensi_absensi a WHERE a.userid = k.userid AND a.tanggal = '$tgl31') AS _31,
                    (SELECT COUNT(a.sst) FROM absensi_absensi a WHERE a.userid = k.userid AND a.sst = 'H' AND (a.tanggal BETWEEN '$request->tglaw' AND '$request->tglak')) AS _H,
                    (SELECT COUNT(a.sst) FROM absensi_absensi a WHERE a.userid = k.userid AND a.sst = 'S' AND (a.tanggal BETWEEN '$request->tglaw' AND '$request->tglak')) AS _S,
                    (SELECT COUNT(a.sst) FROM absensi_absensi a WHERE a.userid = k.userid AND a.sst = 'I' AND (a.tanggal BETWEEN '$request->tglaw' AND '$request->tglak')) AS _I,
                    (SELECT COUNT(a.sst) FROM absensi_absensi a WHERE a.userid = k.userid AND a.sst = 'A' AND (a.tanggal BETWEEN '$request->tglaw' AND '$request->tglak')) AS _A"
                ))
                ->where('k.bagian', 'like', $fbagian)
                ->where('k.status', 'like', $fstatus)
                ->where('k.shift', $shiftst, $fshift)
                ->orderBy('k.nama', 'ASC')
                ->get();
            echo '  
                <div class="table-responsive">
                    <table style="width:100%; font-size:12px" class="display table table-sm  table-bordered table-hover text-nowrap datatable-absensi" id="tbabsensi">
                        <thead>
                            <tr class="text-center">
                                <th>STB</th>
                                <th>NAMA</th> 
                                <th>BAGIAN</th> 
                                <th>GRUP</th> 
                            ';
            for ($i = 0; $i < 31; $i++) {
                $SST = !empty($request->tgl[$i]) ? ($request->tgl[$i]) : '';
                echo '          <th style="width: 30px" class="text-center">' . $SST . '</th>';
            }
            echo '              <th style="width: 30px" class="text-center"></th>';
            echo '              <th style="width: 30px" class="text-center">H</th>';
            echo '              <th style="width: 30px" class="text-center">S</th>';
            echo '              <th style="width: 30px" class="text-center">I</th>';
            echo '              <th style="width: 30px" class="text-center">A</th>';
            echo '              
                            </tr>
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
                echo '      <tr>
                                <th>
                                    <a href="#" data-bs-toggle="modal" data-bs-target=".modal-detail-absensi" data-id="' . $item2->stb . '" data-tglaw="' . $request->tglaw . '" data-tglak="' . $request->tglak . '" style="text-decoration: none !important;color: inherit;">' . $item2->stb . '</a>
                                </th>
                                <th>' . $item2->nama . '</th>
                                <th>' . $item2->bagian . '</th>
                                <th>' . $item2->grup . '</th>';
                echo '          <td style="width: 30px" class="text-center ' . $sst01 . '">' . $item2->_01 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst02 . '">' . $item2->_02 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst03 . '">' . $item2->_03 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst04 . '">' . $item2->_04 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst05 . '">' . $item2->_05 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst06 . '">' . $item2->_06 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst07 . '">' . $item2->_07 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst08 . '">' . $item2->_08 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst09 . '">' . $item2->_09 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst10 . '">' . $item2->_10 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst11 . '">' . $item2->_11 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst12 . '">' . $item2->_12 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst13 . '">' . $item2->_13 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst14 . '">' . $item2->_14 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst15 . '">' . $item2->_15 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst16 . '">' . $item2->_16 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst17 . '">' . $item2->_17 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst18 . '">' . $item2->_18 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst19 . '">' . $item2->_19 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst20 . '">' . $item2->_20 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst21 . '">' . $item2->_21 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst22 . '">' . $item2->_22 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst23 . '">' . $item2->_23 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst24 . '">' . $item2->_24 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst25 . '">' . $item2->_25 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst26 . '">' . $item2->_26 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst27 . '">' . $item2->_27 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst28 . '">' . $item2->_28 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst29 . '">' . $item2->_29 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst30 . '">' . $item2->_30 . '</td>';
                echo '          <td style="width: 30px" class="text-center ' . $sst31 . '">' . $item2->_31 . '</td>';
                echo '          <td style="width: 30px" class="text-center"></td>';
                echo '          <td style="width: 30px" class="text-center">' . $item2->_H . '</td>';
                echo '          <td style="width: 30px" class="text-center">' . $item2->_S . '</td>';
                echo '          <td style="width: 30px" class="text-center">' . $item2->_I . '</td>';
                echo '          <td style="width: 30px" class="text-center">' . $item2->_A . '</td>';
                echo '      </tr>';
            }
            echo '      </tbody>
                    </table>
                </div>';
            echo '
                <script>
                    tb1 = $(".datatable-absensi").DataTable({
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
                                text: `<i class="fa-solid fa-filter" style="margin-right:5px"></i> Filter Absensi`,
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
                                text: `<i class="fa fa-file-excel text-white" style="margin-right:5px"></i> Download Excel`,
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
                    
                    function newexportaction(e, dt, button, config) {
                        var self = this;
                        var oldStart = dt.settings()[0]._iDisplayStart;
                        dt.one("preXhr", function(e, s, data) {
                            // Just this once, load all data from the server...
                            data.start = 0;
                            data.length = 2147483647;
                            dt.one("preDraw", function(e, settings) {
                                // Call the original action function
                                if (button[0].className.indexOf("buttons-copy") >= 0) {
                                    $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                                } else if (button[0].className.indexOf("buttons-excel") >= 0) {
                                    $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                                        $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                                        $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                                } else if (button[0].className.indexOf("buttons-csv") >= 0) {
                                    $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                                        $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                                        $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                                } else if (button[0].className.indexOf("buttons-pdf") >= 0) {
                                    $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                                        $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                                        $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                                } else if (button[0].className.indexOf("buttons-print") >= 0) {
                                    $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                                }
                                dt.one("preXhr", function(e, s, data) {
                                    // DataTables thinks the first item displayed is index 0, but we are not drawing that.
                                    // Set the property to what it was before exporting.
                                    settings._iDisplayStart = oldStart;
                                    data.start = oldStart;
                                });
                                // Reload the grid with the original page. Otherwise, API functions like table.cell(this) dont work properly.
                                setTimeout(dt.ajax.reload, 0);
                                // Prevent rendering of the full data to the DOM
                                return false;
                            });
                        });
                        // Requery the server with the new one-time export settings
                        dt.ajax.reload();
                    }
                </script>
                ';
        }
    }

    public function listAbsensiDetail(Request $request)
    {

        $data = DB::table('penerimaan_karyawan')->where('stb', $request->id)->get();
        $absensi = DB::table('absensi_absensi AS a')
            ->select('a.tanggal', 'a.in', 'a.out', 'a.qj', 'a.jis', 'a.qjnet', 'a.sst', 'b.keterangan', 'b.ket_acc')
            ->leftJoin('absensi_komunikasiacc AS b', function ($join) {
                $join->on('a.userid', '=', 'b.userid');
                $join->on('a.tanggal', '=', 'b.tanggal');
            })
            ->where('a.stb', $request->id)
            ->whereBetween('a.tanggal', [$request->tglaw, $request->tglak])
            ->orderBy('a.tanggal', 'asc')
            ->get();
        foreach ($data as $u) {
            $link = url('photo/pas/' . $u->userid);
            echo '
            <div class="row">
                <div class="col-lg-12 mb-2 mt-0">
                    <div class="row">
                        <div class="col">
                            <form method="POST" action="printAbsen" target="_blank">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" name="userid" value="' . $u->userid . '">
                                <input type="hidden" name="tglawal" value="' . $request->tglaw . '">
                                <input type="hidden" name="tglakhir" value="' . $request->tglak . '">
                                <button class="btn btn-blue w-100" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-printer">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                        <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                                    </svg>
                                    Print Absensi ' . Carbon::parse($request->tglaw)->format('d-m') . ' s/d ' . Carbon::parse($request->tglak)->format('d-m') . '
                                </button>
                            </form>
                        </div>
                        <div class="col">
                            <a href="' . url("penerimaan/legalitas/edit/$u->userid") . '" class="btn btn-blue w-100" target="_blank" data-toggle="tooltip" data-placement="top" title="Edit Data Legalitas Karyawan">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-cog"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h2.5" /><path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M19.001 15.5v1.5" /><path d="M19.001 21v1.5" /><path d="M22.032 17.25l-1.299 .75" /><path d="M17.27 20l-1.3 .75" /><path d="M15.97 17.25l1.3 .75" /><path d="M20.733 20l1.3 .75" /></svg>
                                Edit Legalitas
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="row">
                        <div class="shadow" style="padding: 0px 0px 0px 0px;height:290px">
                            <div class="col-lg-12">
                                <a data-fslightbox="gallery" href="' . $link . '.jpg">
                                    <div class="img-responsive rounded-3 border"
                                        style="background-image: url(' . $link . '.jpg);height:290px">
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
                            <table class="table table-vcenter card-table table-sm table-striped">
                                <tr>
                                    <td width="150px">STB</td>
                                    <td>:</td>
                                    <td>' . $u->stb . '</td>
                                </tr>
                                <tr>
                                    <td width="150px">Nama</td>
                                    <td>:</td>
                                    <td>' . $u->nama . '</td>
                                </tr>
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
                            <table class="table table-vcenter card-table table-sm text-nowrap table-bordered table-hover table-striped" style="width:100%; font-size:12px">
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
                                        <td>Keterangan</td>
                                    </tr>
                                </thead>
                                ';
            foreach ($absensi as $key) {
                $setIn = !empty($key->in) ? Carbon::parse($key->in)->format('H:i:s') : '';
                $setout = !empty($key->out) ? Carbon::parse($key->out)->format('H:i:s') : '';
                $sstnm = $key->sst == 'A' ? 'text-red' : ($key->sst == 'I' || $key->sst == 'F1' || $key->sst == 'F2' || $key->sst == '½' ? 'text-yellow' : '');

                echo '
                                <tbody>
                                    <tr class="text-center">
                                        <td>' . $key->tanggal . '</td>
                                        <td>' . strtoupper(Carbon::parse($key->tanggal)->isoFormat('dddd')) . '</td>
                                        <td>' . $setIn . '</td>
                                        <td>' . $setout . '</td>
                                        <td>' . $key->qj . '</td>
                                        <td>' . $key->jis . '</td>
                                        <td>' . $key->qjnet . '</td>
                                        <td class="' . $sstnm . '">' . $key->sst . '</td>
                                        <td>' . $key->ket_acc . '</td>
                                    </tr>
                                </tbody>
                                ';
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
        $sst = $request->sst;
        if ($sst == "C") {
            // $data = DB::table('penerimaan_karyawan as k')
            //     // ->select('k.userid', 'k.stb', 'k.nama')
            //     ->select(DB::raw(
            //         "k.userid, k.stb, k.nama, 
            //         (SELECT tglaw FROM penerimaan_legalitas l WHERE l.userid = k.userid ORDER BY tglaw DESC LIMIT 1 ) AS tglawal,
            //         (SELECT tglak FROM penerimaan_legalitas l WHERE l.userid = k.userid ORDER BY tglaw DESC LIMIT 1 ) AS tglakhir,
            //         (SELECT sacuti FROM penerimaan_legalitas l WHERE l.userid = k.userid AND suratjns = 'PERJANJIAN' AND l.tglak >= tglawal AND l.tglak <= tglakhir ) AS sacuti,
            //         (SELECT sacuti FROM penerimaan_legalitas l WHERE l.userid = k.userid AND suratjns = 'CUTI' AND l.tglak >= tglawal AND l.tglak <= tglakhir ) AS sacuti2,
            //         (SELECT COUNT(o.sst) FROM absensi_komunikasiacc o WHERE o.userid = k.userid AND o.sst = 'C' AND o.tanggal >= tglawal AND o.tanggal <= tglakhir ) AS cutiterpakai
            //         "
            //     ))
            //     ->where('k.status', 'like', '%aktif%')
            //     ->where('k.stb', $stb)
            //     ->get();
            $data = DB::table('penerimaan_karyawan as k')
                ->select(DB::raw("k.userid, k.stb, k.nama, k.tgl_awalcuti, k.tgl_akhircuti, k.cutiaktif"))
                ->where('k.status', 'like', '%aktif%')
                ->where('k.stb', $stb)
                ->get();
            if ($data->isNotEmpty()) {
                foreach ($data as $k) {

                    $ctTerpakai = DB::table('absensi_komunikasiacc')
                        ->where('userid', $k->userid)
                        ->where('sst', 'C')
                        ->whereBetween('tanggal', [$k->tgl_awalcuti, $k->tgl_akhircuti])
                        ->get();
                    $sisacuti = $k->cutiaktif;
                    return ['success' => 'Data Ditemukan', 'stat' => true, 'result' => '( Sisa Cuti : ' . ($sisacuti - $ctTerpakai->count()) . ' ) ' . $k->nama, 'userid' => $k->userid, 'sisacuti' => $sisacuti, 'cutidikomunikasi' => $ctTerpakai->count(), 'tglawal' => $k->tgl_awalcuti, 'tglakhir' => $k->tgl_akhircuti];
                }
            } else {
                return ['error' => 'Data Tidak Ditemukan', 'stat' => false];
            }
        } else {
            $data = DB::table('penerimaan_karyawan as k')
                ->select('k.userid', 'k.stb', 'k.nama')
                ->where('k.status', 'like', '%aktif%')
                ->where('k.stb', $stb)
                ->get();
            if ($data->isNotEmpty()) {
                foreach ($data as $k) {
                    return ['success' => 'Data Ditemukan', 'stat' => true, 'result' => $k->nama, 'userid' => $k->userid];
                }
            } else {
                return ['error' => 'Data Tidak Ditemukan', 'stat' => false];
            }
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

    private function getBetweenDates($startDate, $endDate)
    {
        $array = array();
        $interval = new DateInterval('P1D');

        $realEnd = new DateTime($endDate);
        $realEnd->add($interval);

        $period = new DatePeriod(new DateTime($startDate), $interval, $realEnd);

        foreach ($period as $date) {
            $array[] = $date->format('Y-m-d');
        }

        return $array;
    }

    function cek()
    {
        print_r($this->getBetweenDates('2019-01-01', "2019-01-05"));
    }

    function storeKomunikasi(Request $request)
    {
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

        $jml = count($request->idf);
        $check = DB::table('absensi_komunikasi')->insert([
            'entitas' => 'PINTEX',
            'noform' => $kodeSurat,
            'tanggal' => $request->tanggalform,
            'dibuat' => $request->dibuat,
            'keteranganform' => $request->keteranganform,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        for ($i = 0; $i < $jml; $i++) {
            if ($request->totaltanggal[$i] == '2') {
                $tgl2 = $request->tanggalitm2[$i];
            } else {
                $tgl2 = $request->tanggalitm[$i];
            }
            $getDataKaryawan = DB::table('penerimaan_karyawan')->select('nama')->where('userid', $request->userid[$i])->first();
            // for ($j = 0; $j < $jmlTgl; $j++) {
            $checkitm = DB::table('absensi_komunikasiitm')->insert([
                'entitas' => 'PINTEX',
                'noform' => $kodeSurat,
                'tanggal' => $request->tanggalitm[$i],
                'tanggal2' => $tgl2,
                'userid' => $request->userid[$i],
                'nama' => $getDataKaryawan->nama,
                'suratid' => $request->suratid[$i],
                'sst' => $request->sst[$i],
                'keterangan' => $request->keterangan[$i],
                'dibuat' => $request->dibuat,
                'statussurat' => "PENGAJUAN",
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            // }
        }

        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data Komunikasi telah berhasil disimpan.', 'status' => true);
        }
        return Response()->json($arr);
    }

    function printSurat($id)
    {
        $check = DB::table('absensi_komunikasi')
            ->where('noform', $id)
            ->get();

        $checkitm = DB::table('absensi_komunikasiitm AS k')
            ->select('k.tanggal', 'k.tanggal2', 's.stb', 'k.nama', 'k.suratid', 'k.sst', 'k.keterangan')
            ->join('penerimaan_karyawan AS s', 's.userid', '=', 'k.userid')
            ->where('noform', $id)
            ->get();
        return view('products/03_absensi.print', ['getData' => $check, 'getDataItm' => $checkitm, 'noform' => $id,]);
    }

    function checkAccKomunikasi(Request $request)
    {
        if (empty($request->id)) {
            echo '<div class="modal-body text-center py-4">';
            echo '<center><iframe src="https://lottie.host/embed/94d605b9-2cc4-4d11-809a-7f41357109b0/OzwBgj9bHl.json" width="300px" height="300px"></iframe></center>';
            echo "<center>Tidak ada data yang dipilih</center>";
            echo '</div>';
        } else {
            $jml = count($request->id);
            echo '
                        <div class="modal-body text-center py-4">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-messages mb-2 text-green icon-lg"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 14l-3 -3h-7a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1h9a1 1 0 0 1 1 1v10" /><path d="M14 15v2a1 1 0 0 1 -1 1h-7l-3 3v-10a1 1 0 0 1 1 -1h2" /></svg>
                            <h3>PENERIMAAN SURAT KOMUNIKASI</h3>
                                <div class="table-responsive">
                                    <table class="table table-sm table-vcenter table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Noform</th>
                                                <th>Tgl Aw</th>
                                                <th>Tgl Ak</th>
                                                <th>Hari</th>
                                                <th>STB</th>
                                                <th>Nama</th>
                                                <th>Surat</th>
                                                <th>Dibuat</th>
                                                <th>Sst</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
            ';
            for ($i = 0; $i < $jml; $i++) {
                if ($request->tipe == "form") {
                    $idrequest = 'o.noform';
                } else {
                    $idrequest = 'o.id';
                }
                $data = DB::table('absensi_komunikasiitm as o')->select('o.id', 'o.noform', 'o.userid', 'o.nama', 'k.stb', 'o.tanggal', 'o.tanggal2', 'o.suratid', 'o.sst', 'o.keterangan', 'o.dibuat')->join('penerimaan_karyawan as k', 'k.userid', '=', 'o.userid')->where($idrequest, $request->id[$i])->get();
                foreach ($data as $u) {
                    // if ($u->tanggal == $u->tanggal2) {
                    //     $tgl = Carbon::parse($u->tanggal)->format('d/m/Y');
                    // } else {
                    //     $tgl = Carbon::parse($u->tanggal)->format('d') . "-" . Carbon::parse($u->tanggal2)->format('d/m/Y');
                    // }
                    $diff = 1 + Carbon::parse($u->tanggal)->diffInDays($u->tanggal2);
                    echo '
                                            <input type="hidden" name="idsuratkomunikasi[]" value="' . $u->id . '">
                                            <input type="hidden" name="userid[]" value="' . $u->userid . '">
                                            <tr>
                                                <td>' . $u->noform . '</td>
                                                <td><input type="date" name="tanggal[]" class="form-control form-control-sm" value="' . $u->tanggal . '"></td>
                                                <td><input type="date" name="tanggal2[]" class="form-control form-control-sm" value="' . $u->tanggal2 . '"></td>
                                                <td>' . $diff . '</td>
                                                <td>' . $u->stb . '</td>
                                                <td>' . $u->nama . '</td>
                                                <td>' . $u->suratid . '</td>
                                                <td>' . $u->dibuat . '</td>
                                                <td>
                                                        <div class="col">
                                                            <select name="sst[]" class="form-select form-select-sm">
                                                                <option value="' . $u->sst . '">-- ' . $u->sst . ' --</option>
                                                                <option value="S">S</option>
                                                                <option value="I">IP</option>
                                                                <option value="A">A</option>
                                                                <option value="L">L</option>
                                                                <option value="CK">CK</option>
                                                                <option value="H">H</option>
                                                                <option value="½">½</option>
                                                                <option value="Batal">Batalkan Surat</option>
                                                            </select>
                                                        </div></td>
                                                <td> 
                                                    <input type="text" class="form-control form-control-sm" name="keterangan[]" value="' . $u->keterangan . '">
                                                </td>
                                            </tr>
                    ';
                }
            }
            echo '
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col">
                                        <button type="button" class="btn w-100" data-bs-dismiss="modal">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-back-up"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 14l-4 -4l4 -4" /><path d="M5 10h11a4 4 0 1 1 0 8h-1" /></svg>
                                            Kembali
                                        </button>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-success w-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Proses Surat Komunikasi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
            ';
        }
        // return $result;
    }

    function storeKomunikasiAcc(Request $request)
    {
        $request->validate(
            [
                '_token' => 'required',
            ],
        );
        for ($i = 0; $i < count($request->id); $i++) {
            // if ($request->tanggal[$i] >= date('Y-m-d')) {
            //     echo $request->tanggal[$i];
            //     echo 'lebih masuk cron';
            // } else {
            //     echo $request->tanggal[$i];
            //     echo 'kurang eksekusi';
            // }
            // die();
            if ($request->tanggal[$i] >= date('Y-m-d')) {
                // Jika tidak maka akan langsung di eksekusi
                $update = DB::table('absensi_komunikasiitm')
                    ->where('id', '=', $request->id[$i])
                    ->update(
                        array(
                            'statussurat' => 'DITERIMA',
                            'updated_at' => date('Y-m-d H:i:s'),
                            'cron' => '0',
                        )
                    );
            } else {
                // jika tanggal komunikasi lebih dari hari ini maka masuk schedule
                $update = DB::table('absensi_komunikasiitm')
                    ->where('id', '=', $request->id[$i])
                    ->update(
                        array(
                            'statussurat' => 'DITERIMA',
                            'updated_at' => date('Y-m-d H:i:s'),
                            'cron' => '1',
                        )
                    );

                $updateabsensi = DB::table('absensi_absensi')
                    ->where(
                        'userid',
                        '=',
                        $request->userid[$i]
                    )
                    ->where('tanggal', '=', $request->tanggal[$i])
                    ->update(
                        array(
                            'sst' => $request->chgsst[$i],
                            'updated_at' => date('Y-m-d H:i:s'),
                        )
                    );
            }
        }

        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($update) {
            $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
        }
        return Response()->json($arr);
    }

    function storedataAcc(Request $request)
    {
        $request->validate(
            [
                '_token' => 'required',
            ],
        );
        $jml = count($request->idsuratkomunikasi);
        for ($i = 0; $i < $jml; $i++) {
            if ($request->sst[$i] == "Batal") {
                $update = DB::table('absensi_komunikasiitm')
                    ->where('id', '=', $request->idsuratkomunikasi[$i])
                    ->update(
                        array(
                            'statussurat' => 'DIBATALKAN',
                            'ket_acc' => $request->keterangan[$i],
                            'updated_at' => date('Y-m-d H:i:s'),
                            'cron' => '1',
                        )
                    );
            } else {
                $getSurat = DB::table('absensi_komunikasiitm')->where('id', '=', $request->idsuratkomunikasi[$i])->first();

                $period = new DatePeriod(new DateTime($request->tanggal[$i]), new DateInterval('P1D'), new DateTime(date("Y-m-d", strtotime($request->tanggal2[$i] . "+1 days"))));
                foreach ($period as $key => $value) {
                    DB::table('absensi_komunikasiacc')
                        ->insert(
                            [
                                'entitas' => $getSurat->entitas,
                                'noform' => $getSurat->noform,
                                'tanggal' => $value->format('Y-m-d'),
                                'userid' => $getSurat->userid,
                                'nama' => $getSurat->nama,
                                'suratid' => $getSurat->suratid,
                                'sst' => $request->sst[$i],
                                'statussurat' => "ACC",
                                'ket_acc' => $request->keterangan[$i],
                                'keterangan' => $getSurat->keterangan,
                                'cron' => 0,
                                'dibuat' => Auth::user()->name,
                                'updated_at' => date('Y-m-d H:i:s'),

                            ]
                        );

                    $updateabsensi = DB::table('absensi_absensi')
                        ->where('userid', '=', $getSurat->userid)
                        ->where('tanggal', '=', $value->format('Y-m-d'))
                        ->update(
                            array(
                                'sst' => $request->sst[$i],
                                'koreksi' => 1,
                                'updated_at' => date('Y-m-d H:i:s'),
                            )
                        );
                }

                $update = DB::table('absensi_komunikasiitm')
                    ->where('id', '=', $request->idsuratkomunikasi[$i])
                    ->update(
                        array(
                            'tanggal' => $request->tanggal[$i],
                            'tanggal2' => $request->tanggal2[$i],
                            'statussurat' => "ACC",
                            'sst' => $request->sst[$i],
                            'ket_acc' => $request->keterangan[$i],
                            'updated_at' => date('Y-m-d H:i:s'),
                            'cron' => '0',
                        )
                    );
            }
        }

        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($update) {
            $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
        }
        return Response()->json($arr);
    }

    public function syncKom(Request $request)
    {
        $tgl_awal = $request->tglaw;
        $tgl_akhir = $request->tglak;

        $dbKomunikasi = DB::table('absensi_komunikasiacc')->whereBetween('tanggal', [$tgl_awal, $tgl_akhir])->where('statussurat', '=', 'ACC')->get();
        foreach ($dbKomunikasi as $key) {
            $updateKomunikasi = DB::table('absensi_komunikasiacc')
                ->where('id', '=', $key->id)
                ->update(
                    array(
                        'cron' => '1',
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );
            $updateAbsensi = DB::table('absensi_absensi')
                ->where('tanggal', '=', $key->tanggal)
                ->where('userid', '=', $key->userid)
                ->update(
                    array(
                        'sst' => $key->sst,
                        'koreksi' => 1,
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );
        }

        if ($updateKomunikasi && $updateAbsensi) {
            $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
        } else {
            $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        }
        return Response()->json($arr);
    }

    public function getcuti(Request $request)
    {
        // $getKaryawan = DB::table('penerimaan_karyawan')->where('nama', 'like', '%' . $request->idcari . '%')->orWhere('stb', '=', $request->idcari)->where('status', 'like', '%aktif%')->get();
        if (empty($request->idcari)) {
            echo '<div class="alert alert-important alert-warning alert-dismissible" role="alert">
                    <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 9v4"></path><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path><path d="M12 16h.01"></path></svg>
                    </div>
                    <div>
                        Kolom Tidak Boleh Kosong
                    </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>';
        } else {
            if (Auth::user()->admin == '1') {
                // Untuk Admin Unit 1
                $unit = 'UNIT 1';
                $getKaryawan = DB::table('penerimaan_karyawan as k')
                    ->select(DB::raw(
                        "k.userid, k.stb, k.nama, k.bagian, k.profesi,
                        (SELECT l.tglaw FROM penerimaan_legalitas l WHERE l.userid = k.userid ORDER BY l.tglaw DESC LIMIT 1 ) AS tglawal,
                        (SELECT l.tglak FROM penerimaan_legalitas l WHERE l.userid = k.userid ORDER BY l.tglaw DESC LIMIT 1 ) AS tglakhir,
                        (SELECT sacuti FROM penerimaan_legalitas l WHERE l.userid = k.userid AND suratjns = 'PERJANJIAN' AND l.tglak >= tglawal AND l.tglak <= tglakhir ) AS sacuti,
                        (SELECT sacuti FROM penerimaan_legalitas l WHERE l.userid = k.userid AND suratjns = 'CUTI' AND l.tglak >= tglawal AND l.tglak <= tglakhir ) AS sacuti2,
                        (SELECT COUNT(o.sst) FROM absensi_komunikasiacc o WHERE o.userid = k.userid AND o.sst = 'C' AND o.tanggal >= tglawal AND o.tanggal <= tglakhir ) AS cutiterpakai"
                    ))
                    ->where('k.bagian', '=', $unit)
                    ->where('k.nama', 'like', '%' . $request->idcari . '%')
                    ->orWhere('k.stb', '=', $request->idcari)
                    ->where('k.status', 'like', '%aktif%')
                    ->get();
            } elseif (Auth::user()->admin == '2') {
                // Untuk Admin Unit 2
                $getKaryawan = DB::table('penerimaan_karyawan as k')
                    ->select(DB::raw(
                        "k.id, k.userid, k.stb, k.nama, k.bagian, k.profesi,
                        (SELECT l.tglaw FROM penerimaan_legalitas l WHERE l.userid = k.userid ORDER BY l.tglaw DESC LIMIT 1 ) AS tglawal,
                        (SELECT l.tglak FROM penerimaan_legalitas l WHERE l.userid = k.userid ORDER BY l.tglaw DESC LIMIT 1 ) AS tglakhir,
                        (SELECT sacuti FROM penerimaan_legalitas l WHERE l.userid = k.userid AND suratjns = 'PERJANJIAN' AND l.tglak >= tglawal AND l.tglak <= tglakhir ) AS sacuti,
                        (SELECT sacuti FROM penerimaan_legalitas l WHERE l.userid = k.userid AND suratjns = 'CUTI' AND l.tglak >= tglawal AND l.tglak <= tglakhir ) AS sacuti2,
                        (SELECT COUNT(o.sst) FROM absensi_komunikasiacc o WHERE o.userid = k.userid AND o.sst = 'C' AND o.tanggal >= tglawal AND o.tanggal <= tglakhir ) AS cutiterpakai"
                    ))
                    ->whereIn('k.bagian', ['TFO', 'TFO 1', 'TFO 2', 'UNIT 2', 'WCR & WORKSHOP'])
                    ->where('k.nama', 'like', '%' . $request->idcari . '%')
                    ->orWhere('k.stb', '=', $request->idcari)
                    ->where('k.status', 'like', '%aktif%')
                    ->get();
            } elseif (Auth::user()->admin == '3') {
                // Untuk Admin Unit 3
                $getKaryawan = DB::table('penerimaan_karyawan as k')
                    ->select(DB::raw(
                        "k.id, k.userid, k.stb, k.nama, k.bagian, k.profesi,
                        (SELECT l.tglaw FROM penerimaan_legalitas l WHERE l.userid = k.userid ORDER BY l.tglaw DESC LIMIT 1 ) AS tglawal,
                        (SELECT l.tglak FROM penerimaan_legalitas l WHERE l.userid = k.userid ORDER BY l.tglaw DESC LIMIT 1 ) AS tglakhir,
                        (SELECT sacuti FROM penerimaan_legalitas l WHERE l.userid = k.userid AND suratjns = 'PERJANJIAN' AND l.tglak >= tglawal AND l.tglak <= tglakhir ) AS sacuti,
                        (SELECT sacuti FROM penerimaan_legalitas l WHERE l.userid = k.userid AND suratjns = 'CUTI' AND l.tglak >= tglawal AND l.tglak <= tglakhir ) AS sacuti2,
                        (SELECT COUNT(o.sst) FROM absensi_komunikasiacc o WHERE o.userid = k.userid AND o.sst = 'C' AND o.tanggal >= tglawal AND o.tanggal <= tglakhir ) AS cutiterpakai"
                    ))
                    ->whereIn('k.bagian', ['GUDANG', 'GUDANG 1', 'GUDANG 2', 'UMUM'])
                    ->where('k.nama', 'like', '%' . $request->idcari . '%')
                    ->orWhere('k.stb', '=', $request->idcari)
                    ->where('k.status', 'like', '%aktif%')
                    ->get();
            } else {
                $getKaryawan = DB::table('penerimaan_karyawan as k')
                    ->select(DB::raw(
                        "k.id, k.userid, k.stb, k.nama, k.bagian, k.profesi,
                        (SELECT l.tglaw FROM penerimaan_legalitas l WHERE l.userid = k.userid ORDER BY l.tglaw DESC LIMIT 1 ) AS tglawal,
                        (SELECT l.tglak FROM penerimaan_legalitas l WHERE l.userid = k.userid ORDER BY l.tglaw DESC LIMIT 1 ) AS tglakhir,
                        (SELECT sacuti FROM penerimaan_legalitas l WHERE l.userid = k.userid AND suratjns = 'PERJANJIAN' AND l.tglak >= tglawal AND l.tglak <= tglakhir ) AS sacuti,
                        (SELECT sacuti FROM penerimaan_legalitas l WHERE l.userid = k.userid AND suratjns = 'CUTI' AND l.tglak >= tglawal AND l.tglak <= tglakhir ) AS sacuti2,
                        (SELECT COUNT(o.sst) FROM absensi_komunikasiacc o WHERE o.userid = k.userid AND o.sst = 'C' AND o.tanggal >= tglawal AND o.tanggal <= tglakhir ) AS cutiterpakai"
                    ))
                    ->where('k.nama', 'like', '%' . $request->idcari . '%')
                    ->orWhere('k.stb', '=', $request->idcari)
                    ->where('k.status', 'like', '%aktif%')
                    ->get();
            }

            foreach ($getKaryawan as $key) {
                if (!empty($key->sacuti)) {
                    $sisacuti = $key->sacuti;
                } else {
                    $sisacuti = $key->sacuti2;
                }

                echo '
                <div class="card mb-5 shadow border border-azure">
                    <div class="table-responsive">
                        <table class="table table-vcenter table-bordered table-nowrap card-table table-sm">
                            <thead>
                                <tr>
                                    <td class="w-50" rowspan="3">
                                        <h2>( ' . $key->stb . ' ) ' . $key->nama . '</h2>
                                        <div class="text-secondary text-wrap">
                                            Bagian: ' . $key->bagian . ', Profesi: ' . $key->profesi . '
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-blue font-weight-medium">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-month"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M7 14h.013" /><path d="M10.01 14h.005" /><path d="M13.01 14h.005" /><path d="M16.015 14h.005" /><path d="M13.015 17h.005" /><path d="M7.01 17h.005" /><path d="M10.01 17h.005" /></svg>
                                        ';
                if ($sisacuti == '5') {
                    $getKaryawanCuti = DB::table('penerimaan_legalitas as l')
                        ->where('l.userid', '=', $key->userid)
                        ->where('l.suratjns', '=', 'CUTI')
                        ->first();
                    echo '                      <i> Dapat digunakan pada Periode: ' . Carbon::parse($getKaryawanCuti->tglaw)->isoFormat('D MMMM Y') . ' s/d ' . Carbon::parse($getKaryawanCuti->tglak)->isoFormat('D MMMM Y') . '</i>';
                } else {
                    echo '                      <i> Dapat digunakan pada Periode: ' . Carbon::parse($key->tglawal)->isoFormat('D MMMM Y') . ' s/d ' . Carbon::parse($key->tglakhir)->isoFormat('D MMMM Y') . '</i>';
                }
                echo '
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="text-uppercase text-secondary font-weight-medium">Total Cuti</div>
                                        <div class="display-6 fw-bold my-3">' . (empty($sisacuti) ? 0 : $sisacuti) . '</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="text-uppercase text-secondary font-weight-medium">Cuti Terpakai</div>
                                        <div class="display-6 fw-bold my-3">' . $key->cutiterpakai . '</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="text-uppercase text-secondary font-weight-medium">Sisa Cuti</div>
                                        <div class="display-6 fw-bold my-3">' . ($sisacuti - $key->cutiterpakai) . '</div>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                ';
                if ($key->cutiterpakai > 0) {
                    $getRiwayat = DB::table('absensi_komunikasiacc')->Where('userid', '=', $key->userid)->where('sst', '=', 'C')->whereBetween('tanggal', [$key->tglawal, $key->tglakhir])->get();
                    echo '
                                <tr class="bg-light">
                                    <th colspan="4" class="subheader">Riwayat Cuti ' . Carbon::parse($key->tglawal)->isoFormat('D MMMM Y') . ' s/d ' . Carbon::parse($key->tglakhir)->isoFormat('D MMMM Y') . '</th>
                                </tr>
                    ';
                    foreach ($getRiwayat as $x) {
                        echo '
                                <tr>
                                    <td style="text-align: end;">' . Carbon::parse($x->tanggal)->isoFormat('DD/MM/Y') . '</td>
                                    <td colspan="3">' . $x->suratid . ': ' . $x->keterangan . '</td>
                                </tr>';
                    }
                }

                $lega = DB::table('penerimaan_legalitas as l')
                    ->where('l.userid', '=', $key->userid)
                    ->whereIn('l.suratjns', ['PERJANJIAN', 'CUTI'])
                    ->orderBy('l.id', 'desc')
                    ->skip(1)
                    ->first();
                $getRiwayatperiodelalu = DB::table('absensi_komunikasiacc as a')
                    ->where('a.userid', '=', $key->userid)
                    ->where('a.sst', '=', 'C')
                    ->whereBetween('a.tanggal', [$lega->tglaw, $lega->tglak])
                    ->orderBy('a.tanggal', 'desc')
                    ->get();
                echo '
                            </tbody>
                        </table>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header bg-light" id="heading' . $key->stb . '">
                                    <button class="accordion-button collapsed py-1 subheader" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $key->stb . '" aria-expanded="false" aria-controls="collapse' . $key->stb . '">
                                        Riwayat ' . Carbon::parse($lega->tglaw)->isoFormat('D MMMM Y') . ' s/d ' . Carbon::parse($lega->tglak)->isoFormat('D MMMM Y') . '
                                    </button>
                                </h2>
                                <div id="collapse' . $key->stb . '" class="accordion-collapse collapse" aria-labelledby="heading' . $key->stb . '" data-bs-parent="#accordionExample">
                                    <div class="accordion-body py-0 px-0">
                                        <div class="table-responsive">
                                            <table class="table table-vcenter table-bordered table-nowrap card-table table-sm">
                                        ';
                $no = 1;
                foreach ($getRiwayatperiodelalu as $y) {
                    echo '
                                            <tr class="text-secondary subheader">
                                                <td class="w-1">' . $no . '</td>
                                                <td style="text-align: end;" class="w-5">' . Carbon::parse($y->tanggal)->isoFormat('DD/MM/Y') . '</td>
                                                <td colspan="3">' . $y->suratid . ': ' . $y->keterangan . '</td>
                                            </tr>';
                    $no++;
                }
                echo '
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
            }
        }
    }

    public function getNewCuti(Request $request)
    {
        // $getKaryawan = DB::table('penerimaan_karyawan')->where('nama', 'like', '%' . $request->idcari . '%')->orWhere('stb', '=', $request->idcari)->where('status', 'like', '%aktif%')->get();
        if (empty($request->idcari)) {
            echo '<div class="alert alert-important alert-warning alert-dismissible" role="alert">
                    <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 9v4"></path><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path><path d="M12 16h.01"></path></svg>
                    </div>
                    <div>
                        Kolom Tidak Boleh Kosong
                    </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>';
        } else {
            if (Auth::user()->admin == '1') {
                // Untuk Admin Unit 1
                $unit = 'UNIT 1';
                $getKaryawan = DB::table('penerimaan_karyawan as k')
                    ->select(DB::raw("k.id, k.userid, k.stb, k.nama, k.bagian, k.profesi, k.cutiaktif, k.tgl_awalcuti, k.tgl_akhircuti"))
                    ->where('k.nama', 'like', '%' . $request->idcari . '%')
                    ->orWhere('k.stb', '=', $request->idcari)
                    ->where('k.bagian', '=', $unit)
                    ->where('k.status', 'like', '%aktif%')
                    ->get();
            } elseif (Auth::user()->admin == '2') {
                // Untuk Admin Unit 2
                $getKaryawan = DB::table('penerimaan_karyawan as k')
                    ->select(DB::raw("k.id, k.userid, k.stb, k.nama, k.bagian, k.profesi, k.cutiaktif, k.tgl_awalcuti, k.tgl_akhircuti"))
                    ->where('k.nama', 'like', '%' . $request->idcari . '%')
                    ->orWhere('k.stb', '=', $request->idcari)
                    ->whereIn('k.bagian', ['TFO', 'TFO 1', 'TFO 2', 'UNIT 2', 'WCR & WORKSHOP'])
                    ->where('k.status', 'like', '%aktif%')
                    ->get();
            } elseif (Auth::user()->admin == '3') {
                // Untuk Admin Unit 3
                $getKaryawan = DB::table('penerimaan_karyawan as k')
                    ->select(DB::raw("k.id, k.userid, k.stb, k.nama, k.bagian, k.profesi, k.cutiaktif, k.tgl_awalcuti, k.tgl_akhircuti"))
                    ->where('k.nama', 'like', '%' . $request->idcari . '%')
                    ->orWhere('k.stb', '=', $request->idcari)
                    ->whereIn('k.bagian', ['GUDANG', 'GUDANG 1', 'GUDANG 2', 'UMUM'])
                    ->where('k.status', 'like', '%aktif%')
                    ->get();
            } else {
                $getKaryawan = DB::table('penerimaan_karyawan as k')
                    ->select(DB::raw("k.id, k.userid, k.stb, k.nama, k.bagian, k.profesi, k.cutiaktif, k.tgl_awalcuti, k.tgl_akhircuti"))
                    ->where('k.nama', 'like', '%' . $request->idcari . '%')
                    ->orWhere('k.stb', '=', $request->idcari)
                    ->where('k.status', 'like', '%aktif%')
                    ->get();
            }

            foreach ($getKaryawan as $key) {
                $dtKaryawan = DB::table('absensi_komunikasiacc')
                    ->where('userid', $key->userid)
                    ->where('sst', 'C')
                    ->whereBetween('tanggal', [$key->tgl_awalcuti, $key->tgl_akhircuti])
                    ->get();
                echo '
                <div class="card mb-5 shadow border border-azure">
                    <div class="table-responsive">
                        <table class="table table-vcenter table-bordered table-nowrap card-table table-sm">
                            <thead>
                                <tr>
                                    <td class="w-50" rowspan="3">
                                        <h2>( ' . $key->stb . ' ) ' . $key->nama . '</h2>
                                        <div class="text-secondary text-wrap">
                                            Bagian: ' . $key->bagian . ', Profesi: ' . $key->profesi . '
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-blue font-weight-medium">
                                        ';
                if ((empty($key->cutiaktif) ? 0 : $key->cutiaktif) > 0) {
                    echo '                      
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-month"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M7 14h.013" /><path d="M10.01 14h.005" /><path d="M13.01 14h.005" /><path d="M16.015 14h.005" /><path d="M13.015 17h.005" /><path d="M7.01 17h.005" /><path d="M10.01 17h.005" /></svg>
                                        <i> Dapat digunakan pada Periode: ' . Carbon::parse($key->tgl_awalcuti)->isoFormat('D MMMM Y') . ' s/d ' . Carbon::parse($key->tgl_akhircuti)->isoFormat('D MMMM Y') . '</i>';
                }
                echo '
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="text-uppercase text-secondary font-weight-medium">Total Cuti</div>
                                        <div class="display-6 fw-bold my-3">' . (empty($key->cutiaktif) ? 0 : $key->cutiaktif) . '</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="text-uppercase text-secondary font-weight-medium">Cuti Terpakai</div>
                                        <div class="display-6 fw-bold my-3">' . $dtKaryawan->count() . '</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="text-uppercase text-secondary font-weight-medium">Sisa Cuti</div>
                                        <div class="display-6 fw-bold my-3">' . ((empty($key->cutiaktif) ? 0 : $key->cutiaktif) - $dtKaryawan->count()) . '</div>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                ';
                if ($dtKaryawan->count() > 0) {
                    $getRiwayat = DB::table('absensi_komunikasiacc')->Where('userid', '=', $key->userid)->where('sst', '=', 'C')->whereBetween('tanggal', [$key->tgl_awalcuti, $key->tgl_akhircuti])->get();
                    echo '
                                <tr class="bg-light">
                                    <th colspan="4" class="subheader">Riwayat Cuti ' . Carbon::parse($key->tgl_awalcuti)->isoFormat('D MMMM Y') . ' s/d ' . Carbon::parse($key->tgl_akhircuti)->isoFormat('D MMMM Y') . '</th>
                                </tr>
                    ';
                    foreach ($getRiwayat as $x) {
                        echo '
                                <tr>
                                    <td style="text-align: end;">' . Carbon::parse($x->tanggal)->isoFormat('DD/MM/Y') . '</td>
                                    <td colspan="3">' . $x->suratid . ': ' . $x->keterangan . '</td>
                                </tr>';
                    }
                }

                $lega = DB::table('penerimaan_legalitas as l')
                    ->where('l.userid', '=', $key->userid)
                    ->whereIn('l.suratjns', ['PERJANJIAN', 'CUTI'])
                    ->orderBy('l.id', 'desc')
                    ->skip(1)
                    ->first();
                $getRiwayatperiodelalu = DB::table('absensi_komunikasiacc as a')
                    ->where('a.userid', '=', $key->userid)
                    ->where('a.sst', '=', 'C')
                    ->whereBetween('a.tanggal', [date('Y-m-d'), date('Y-m-d', strtotime("-12 months"))])
                    ->orderBy('a.tanggal', 'desc')
                    ->get();
                echo '
                            </tbody>
                        </table>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header bg-light" id="heading' . $key->stb . '">
                                    <button class="accordion-button collapsed py-1 subheader" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $key->stb . '" aria-expanded="false" aria-controls="collapse' . $key->stb . '">
                                        Riwayat Cuti Lain
                                    </button>
                                </h2>
                                <div id="collapse' . $key->stb . '" class="accordion-collapse collapse" aria-labelledby="heading' . $key->stb . '" data-bs-parent="#accordionExample">
                                    <div class="accordion-body py-0 px-0">
                                        <div class="table-responsive">
                                            <table class="table table-vcenter table-bordered table-nowrap card-table table-sm">
                                        ';
                $no = 1;
                foreach ($getRiwayatperiodelalu as $y) {
                    echo '
                                            <tr class="text-secondary subheader">
                                                <td class="w-1">' . $no . '</td>
                                                <td style="text-align: end;" class="w-5">' . Carbon::parse($y->tanggal)->isoFormat('DD/MM/Y') . '</td>
                                                <td colspan="3">' . $y->suratid . ': ' . $y->keterangan . '</td>
                                            </tr>';
                    $no++;
                }
                echo '
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
            }
        }
    }

    public function fixUmum(Request $request)
    {
        $start = $request->tglaw;
        $end = $request->tglak;

        $checkUmum = DB::table('absensi_absensi')->where('bagian', '=', 'UMUM')->whereBetween('tanggal', [$start, $end])->orderBy('tanggal', 'desc')->get();
        foreach ($checkUmum as $key) {
            DB::table('absensi_absensi')
                ->where('id', $key->id)
                ->where('bagian', '=', 'UMUM')
                ->where('sst', '=', 'A')
                ->orWhere('sst', '=', 'F1')
                ->orWhere('sst', '=', 'F2')
                ->update(
                    array(
                        'sst' => "H",
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );
        }

        if ($checkUmum) {
            $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
        } else {
            $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        }
        return Response()->json($arr);
    }

    function absenkosong(Request $request)
    {
        if ($request->input('jns') == "alpa") {
            // $getAlpa = DB::table('absensi_absensi as a')
            //     ->select('a.*', 'a.id as idabsensi', 'k.jabatan', 'k.bagian', 'k.profesi')
            //     ->join('penerimaan_karyawan as k', 'a.userid', '=', 'k.userid')
            //     ->where('a.sst', '=', 'A')
            //     ->whereNull('a.koreksi')
            //     ->where('a.stb', 'NOT LIKE', '%PHL-%')
            //     ->where('a.stb', 'NOT LIKE', '%OL-%')
            //     ->where('k.status', 'LIKE', '%Aktif%')
            //     ->whereBetween('a.tanggal', [$request->input('tglstart'), $request->input('tglend')])
            //     ->orderBy('a.bagian', 'asc')
            //     ->orderBy('a.grup', 'asc')
            //     ->orderBy('a.name', 'asc')
            //     ->get();
            $judul = "Absensi Alpa";
            $absensi = "active";
            $list = "active";
            return view('products/03_absensi.alpa', [
                'judul' => $judul,
                'absensi' => $absensi,
                'list' => $list,
                'jenis' => 'alpa',
                'dari' => $request->input('tglstart'),
                'sampai' => $request->input('tglend'),
                'jns' => $request->input('jns'),
            ]);
        } elseif ($request->jns == "f1f2") {
            // $getF1 = DB::table('absensi_absensi as a')
            //     ->select('a.*', 'a.id as idabsensi', 'k.jabatan', 'k.bagian', 'k.profesi')
            //     ->join('penerimaan_karyawan as k', 'a.userid', '=', 'k.userid')
            //     ->whereNull('a.koreksi')
            //     ->whereIn('a.sst', ['F1', 'F2', '½'])
            //     ->where('a.stb', 'NOT LIKE', '%PHL-%')
            //     ->where('a.stb', 'NOT LIKE', '%OL-%')
            //     ->where('k.status', 'LIKE', '%Aktif%')
            //     ->whereBetween('a.tanggal', [$request->input('tglstart'), $request->input('tglend')])
            //     ->orderBy('a.bagian', 'asc')
            //     ->orderBy('a.grup', 'asc')
            //     ->orderBy('a.name', 'asc')
            //     ->get();
            $judul = "Absensi F1F2";
            $absensi = "active";
            $list = "active";
            return view('products/03_absensi.alpa', [
                'judul' => $judul,
                'absensi' => $absensi,
                'list' => $list,
                'jenis' => 'f1f2',
                'dari' => $request->input('tglstart'),
                'sampai' => $request->input('tglend'),
                'jns' => $request->input('jns'),
            ]);
        } elseif ($request->jns == 'fingerprint') {
            $judul = "Data Fingerprint";
            $absensi = "active";
            $list = "active";
            return view('products/03_absensi.absensifingerprint', [
                'judul' => $judul,
                'absensi' => $absensi,
                'list' => $list,
                'dari' => $request->input('tglstart'),
                'sampai' => $request->input('tglend'),
                'jns' => $request->input('jns'),
            ]);
        }
    }

    public function exportAbsensi(Request $request)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        ini_set('memory_limit', '-1');
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return Excel::download(new ExportAbsensi($request->dari, $request->sampai), 'Absen Periode ' . $request->dari . ' - ' . $request->sampai . ' (' . $randomString . ').xlsx');
    }

    public function exportSKD(Request $request)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return Excel::download(new ExportSKD($request->skdstart, $request->skdend), 'SKD Periode ' . $request->skdstart . ' - ' . $request->skdend . ' (' . $randomString . ').xlsx');
    }

    public function printAbsen(Request $request)
    {
        $karyawan = DB::table('penerimaan_karyawan')->where('userid', $request->userid)->get();
        $absensi = DB::table('absensi_absensi AS a')
            ->select('a.tanggal', 'a.in', 'a.out', 'a.qj', 'a.jis', 'a.qjnet', 'a.sst', 'b.keterangan', 'b.suratid')
            ->leftJoin('absensi_komunikasiacc AS b', function ($join) {
                $join->on('a.userid', '=', 'b.userid');
                $join->on('a.tanggal', '=', 'b.tanggal');
            })
            ->where('a.userid', $request->userid)
            ->whereBetween('a.tanggal', [$request->tglawal, $request->tglakhir])
            ->orderBy('a.tanggal', 'asc')
            ->get();
        return view('products/03_absensi.printDetailAbsen', ['karyawan' => $karyawan, 'absensi' => $absensi]);
    }

    public function checkProses(Request $request)
    {
        if (empty($request->id)) {
            echo '
                    <div class="alert alert-danger" role="alert">
                        <div class="d-flex">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path><path d="M12 8v4"></path><path d="M12 16h.01"></path></svg>
                            </div>
                            <div>
                                Tidak Ada Item yang dipilih
                            </div>
                        </div>
                    </div>
                ';
        } else {
            echo '
            <div class="row">
                <div class="col-lg-3 mb-3">
                    <label class="form-label">Tipe Proses</label>
                    <select name="tipeUbah" id="tipeUbah" class="form-select border-dark">
                        <option value="" hidden>Pilih Tipe</option>
                        <option value="H">Hadir</option>
                        <option value="½">Potong F1</option>
                        <option value="½">Potong Setengah Hari (PC)</option>
                        <option value="I">Potong Satu Hari</option>
                        <option value="L">Libur / Lembur</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <label class="form-label">Keterangan</label>
                    <input type="text" class="form-control border border-dark" name="ket" id="ket" placeholder="Masukkan Keterangan">
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped mb-0 table-hover text-nowrap border border-dark">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">STB</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">IN</th>
                                    <th class="text-center">OUT</th>
                                    <th class="text-center">Hari Libur</th>
                                    <th class="text-center">Set. Hari</th>
                                    <th class="text-center">Grup</th>
                                    <th class="text-center">Bagian</th>
                                    <th class="text-center">SST</th>
                                </tr>
                            </thead>
                            <tbody>';
            $no = 1;
            $jml = count($request->id);
            for ($i = 0; $i < $jml; $i++) {
                $karyawan = DB::table('absensi_absensi as a')
                    ->where('a.id', $request->id[$i])
                    ->get();
                foreach ($karyawan as $k) {
                    echo '
                            <input type="hidden" name="idabsen[]" value="' . $k->id . '">
                            <input type="hidden" name="userid[]" value="' . $k->userid . '">
                                    <tr>
                                        <td class="text-center">' . $no . '</td>
                                        <td class="text-center">' . $k->tanggal . '</td>
                                        <td class="text-center">' . $k->stb . '</td>
                                        <td class="">' . $k->name . '</td>
                                        <td class="text-center">' . $k->in . '</td>
                                        <td class="text-center">' . $k->out . '</td>
                                        <td class="text-center">' . $k->hrlibur . '</td>
                                        <td class="text-center">' . $k->sethari . '</td>
                                        <td class="text-center">' . $k->grup . '</td>
                                        <td class="text-center">' . $k->bagian . '</td>
                                        <td class="text-center">' . $k->sst . '</td>
                                    </tr>';
                    $no++;
                }
            }
            echo '
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        ';
        }
    }

    public function storedataF1(Request $request)
    {
        $request->validate(
            [
                '_token'    => 'required',
                'tipeUbah'  => 'required',
                'ket'       => 'required',
                "idabsen"   => "required",
                "userid"    => "required",
                // "name.*"  => "required|string|distinct|min:3",
            ],
            [
                'tipeUbah.required' => 'Tipe Proses Diperlukan',
                'ket.required' => 'Keterangan Diperlukan',
                'idabsen.required' => 'ID Absen Diperlukan',
                'userid.required' => 'Userid Diperlukan',
            ]
        );
        try {
            // Generate Komunikasi
            $noform = 'K' . date('y') . "0001";
            $checknoform = DB::table('absensi_komunikasi')
                ->orderBy('noform', 'desc')
                ->first();
            $noform = $checknoform->noform;
            $y = substr($noform, 1, 2);
            if (date('y') == $y) {
                $noUrut = substr($noform, 3, 4);
                $na = $noUrut + 1;
                $char = date('y');
                $kodeSurat = "K" . $char . sprintf("%04s", $na);
            } else {
                $kodeSurat = "K" . date('y') . "0001";
            }
            // Insert Komunikasi
            $check = DB::table('absensi_komunikasi')->insert([
                'entitas' => 'PINTEX',
                'noform' => $kodeSurat,
                'tanggal' => date('Y-m-d'),
                'dibuat' => Auth::user()->name,
                'keteranganform' => $request->ket,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $jml = count($request->idabsen);
            // Jika Tipe yang dipilih ½ maka akan create komunikasi F1
            if ($request->tipeUbah == '½') {
                // pengulangan berdasarkan banyaknya absen yang dipilih
                for ($i = 0; $i < $jml; $i++) {
                    // ambil data absensi
                    $dataAbs = DB::table('absensi_absensi')
                        ->where('id', $request->idabsen[$i])
                        ->first();
                    // update absensi
                    $check = DB::table('absensi_absensi')
                        ->where('id', '=', $request->idabsen[$i])
                        ->update([
                            'sst' => $request->tipeUbah,
                            'koreksi' => 1,
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                    // insert ke absensi komunikasiitm
                    $check2 = DB::table('absensi_komunikasiitm')->insert([
                        'entitas' => 'PINTEX',
                        'noform' => $kodeSurat,
                        'tanggal' => $dataAbs->tanggal,
                        'tanggal2' => $dataAbs->tanggal,
                        'userid' => $dataAbs->userid,
                        'nama' => $dataAbs->name,
                        'suratid' => 'Surat Izin Setengah Hari',
                        'sst' => '½',
                        'keterangan' => $request->ket,
                        'dibuat' => Auth::user()->name,
                        'statussurat' => "ACC",
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                    // insert ke absensi komunikasiacc
                    $check3 = DB::table('absensi_komunikasiacc')->insert([
                        'entitas' => 'PINTEX',
                        'noform' => $kodeSurat,
                        'tanggal' => $dataAbs->tanggal,
                        'tanggal2' => null,
                        'userid' => $dataAbs->userid,
                        'nama' => $dataAbs->name,
                        'suratid' => 'Surat Izin Setengah Hari',
                        'sst' => '½',
                        'ket_acc' => $request->ket,
                        'keterangan' => $request->ket,
                        'dibuat' => Auth::user()->name,
                        'statussurat' => "ACC",
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            } elseif ($request->tipeUbah == 'H') {
                // pengulangan berdasarkan banyaknya absen yang dipilih
                for ($i = 0; $i < $jml; $i++) {
                    // ambil data absensi
                    $dataAbs = DB::table('absensi_absensi')
                        ->where('id', $request->idabsen[$i])
                        ->first();
                    // update absensi
                    $check = DB::table('absensi_absensi')
                        ->where('id', '=', $request->idabsen[$i])
                        ->update([
                            'sst' => $request->tipeUbah,
                            'koreksi' => 1,
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                    // insert ke absensi komunikasiitm
                    DB::table('absensi_komunikasiitm')->insert([
                        'entitas' => 'PINTEX',
                        'noform' => $kodeSurat,
                        'tanggal' => $dataAbs->tanggal,
                        'tanggal2' => $dataAbs->tanggal,
                        'userid' => $dataAbs->userid,
                        'nama' => $dataAbs->name,
                        'suratid' => 'Keputusan-Mgr. Hadir',
                        'sst' => 'H',
                        'keterangan' => '',
                        'dibuat' => Auth::user()->name,
                        'statussurat' => "ACC",
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                    // insert ke absensi komunikasiacc
                    DB::table('absensi_komunikasiacc')->insert([
                        'entitas' => 'PINTEX',
                        'noform' => $kodeSurat,
                        'tanggal' => $dataAbs->tanggal,
                        'tanggal2' => null,
                        'userid' => $dataAbs->userid,
                        'nama' => $dataAbs->name,
                        'suratid' => 'Keputusan-Mgr. Hadir',
                        'sst' => 'H',
                        'ket_acc' => '',
                        'keterangan' => '',
                        'dibuat' => Auth::user()->name,
                        'statussurat' => "ACC",
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            } elseif ($request->tipeUbah == 'I') {
                // pengulangan berdasarkan banyaknya absen yang dipilih
                for ($i = 0; $i < $jml; $i++) {
                    // ambil data absensi
                    $dataAbs = DB::table('absensi_absensi')
                        ->where('id', $request->idabsen[$i])
                        ->first();
                    // update absensi
                    $check = DB::table('absensi_absensi')
                        ->where('id', '=', $request->idabsen[$i])
                        ->update([
                            'sst' => $request->tipeUbah,
                            'koreksi' => 1,
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                    // insert ke absensi komunikasiitm
                    DB::table('absensi_komunikasiitm')->insert([
                        'entitas' => 'PINTEX',
                        'noform' => $kodeSurat,
                        'tanggal' => $dataAbs->tanggal,
                        'tanggal2' => $dataAbs->tanggal,
                        'userid' => $dataAbs->userid,
                        'nama' => $dataAbs->name,
                        'suratid' => 'Keputusan-Mgr. Izin',
                        'sst' => 'I',
                        'keterangan' => $request->ket,
                        'dibuat' => Auth::user()->name,
                        'statussurat' => "ACC",
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                    // insert ke absensi komunikasiacc
                    DB::table('absensi_komunikasiacc')->insert([
                        'entitas' => 'PINTEX',
                        'noform' => $kodeSurat,
                        'tanggal' => $dataAbs->tanggal,
                        'tanggal2' => null,
                        'userid' => $dataAbs->userid,
                        'nama' => $dataAbs->name,
                        'suratid' => 'Keputusan-Mgr. Izin',
                        'sst' => 'I',
                        'ket_acc' => $request->ket,
                        'keterangan' => $request->ket,
                        'dibuat' => Auth::user()->name,
                        'statussurat' => "ACC",
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            } elseif ($request->tipeUbah == 'L') {
                // pengulangan berdasarkan banyaknya absen yang dipilih
                for ($i = 0; $i < $jml; $i++) {
                    // ambil data absensi
                    $dataAbs = DB::table('absensi_absensi')
                        ->where('id', $request->idabsen[$i])
                        ->first();
                    // update absensi
                    $check = DB::table('absensi_absensi')
                        ->where('id', '=', $request->idabsen[$i])
                        ->update([
                            'sst' => $request->tipeUbah,
                            'koreksi' => 1,
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                    // insert ke absensi komunikasiitm
                    $check2 = DB::table('absensi_komunikasiitm')->insert([
                        'entitas' => 'PINTEX',
                        'noform' => $kodeSurat,
                        'tanggal' => $dataAbs->tanggal,
                        'tanggal2' => $dataAbs->tanggal,
                        'userid' => $dataAbs->userid,
                        'nama' => $dataAbs->name,
                        'suratid' => 'Surat Geser/Tukar Libur',
                        'sst' => 'L',
                        'keterangan' => $request->ket,
                        'dibuat' => Auth::user()->name,
                        'statussurat' => "ACC",
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                    // insert ke absensi komunikasiacc
                    $check3 = DB::table('absensi_komunikasiacc')->insert([
                        'entitas' => 'PINTEX',
                        'noform' => $kodeSurat,
                        'tanggal' => $dataAbs->tanggal,
                        'tanggal2' => null,
                        'userid' => $dataAbs->userid,
                        'nama' => $dataAbs->name,
                        'suratid' => 'Surat Geser/Tukar Libur',
                        'sst' => 'L',
                        'ket_acc' => $request->ket,
                        'keterangan' => $request->ket,
                        'dibuat' => Auth::user()->name,
                        'statussurat' => "ACC",
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            }
            if ($check) {
                $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
            } else {
                $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
            }
            return Response()->json($arr);
        } catch (\Illuminate\Database\QueryException $e) {
            $arr = array('msg' => 'Something goes to wrong. ' . $e->getMessage(), 'status' => false);
            return Response()->json($arr);
        }
    }

    public function storedataAlpa(Request $request)
    {
        $request->validate(
            [
                '_token'    => 'required',
                'tipeUbah'  => 'required',
                'ket'       => 'required',
                "idabsen"   => "required",
                "userid"    => "required",
                // "name.*"  => "required|string|distinct|min:3",
            ],
            [
                'tipeUbah.required' => 'Tipe Proses Diperlukan',
                'ket.required' => 'Keterangan Diperlukan',
                'idabsen.required' => 'ID Absen Diperlukan',
                'userid.required' => 'Userid Diperlukan',
            ]
        );
        try {
            // Generate Komunikasi
            $noform = 'K' . date('y') . "0001";
            $checknoform = DB::table('absensi_komunikasi')
                ->orderBy('noform', 'desc')
                ->first();
            $noform = $checknoform->noform;
            $y = substr($noform, 1, 2);
            if (date('y') == $y) {
                $noUrut = substr($noform, 3, 4);
                $na = $noUrut + 1;
                $char = date('y');
                $kodeSurat = "K" . $char . sprintf("%04s", $na);
            } else {
                $kodeSurat = "K" . date('y') . "0001";
            }
            // Insert Komunikasi
            $check = DB::table('absensi_komunikasi')->insert([
                'entitas' => 'PINTEX',
                'noform' => $kodeSurat,
                'tanggal' => date('Y-m-d'),
                'dibuat' => Auth::user()->name,
                'keteranganform' => $request->ket,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $jml = count($request->idabsen);
            // Jika Tipe yang dipilih ½ maka akan create komunikasi F1
            if ($request->tipeUbah == '½') {
                // pengulangan berdasarkan banyaknya absen yang dipilih
                for ($i = 0; $i < $jml; $i++) {
                    // ambil data absensi
                    $dataAbs = DB::table('absensi_absensi')
                        ->where('id', $request->idabsen[$i])
                        ->first();
                    // update absensi
                    $check = DB::table('absensi_absensi')
                        ->where('id', '=', $request->idabsen[$i])
                        ->update([
                            'sst' => $request->tipeUbah,
                            'koreksi' => 1,
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                    // insert ke absensi komunikasiitm
                    $check2 = DB::table('absensi_komunikasiitm')->insert([
                        'entitas' => 'PINTEX',
                        'noform' => $kodeSurat,
                        'tanggal' => $dataAbs->tanggal,
                        'tanggal2' => $dataAbs->tanggal,
                        'userid' => $dataAbs->userid,
                        'nama' => $dataAbs->name,
                        'suratid' => 'Surat Izin Setengah Hari',
                        'sst' => '½',
                        'keterangan' => $request->ket,
                        'dibuat' => Auth::user()->name,
                        'statussurat' => "ACC",
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                    // insert ke absensi komunikasiacc
                    $check3 = DB::table('absensi_komunikasiacc')->insert([
                        'entitas' => 'PINTEX',
                        'noform' => $kodeSurat,
                        'tanggal' => $dataAbs->tanggal,
                        'tanggal2' => null,
                        'userid' => $dataAbs->userid,
                        'nama' => $dataAbs->name,
                        'suratid' => 'Surat Izin Setengah Hari',
                        'sst' => '½',
                        'ket_acc' => $request->ket,
                        'keterangan' => $request->ket,
                        'dibuat' => Auth::user()->name,
                        'statussurat' => "ACC",
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            } elseif ($request->tipeUbah == 'H') {
                // pengulangan berdasarkan banyaknya absen yang dipilih
                for ($i = 0; $i < $jml; $i++) {
                    // ambil data absensi
                    $dataAbs = DB::table('absensi_absensi')
                        ->where('id', $request->idabsen[$i])
                        ->first();
                    // update absensi
                    $check = DB::table('absensi_absensi')
                        ->where('id', '=', $request->idabsen[$i])
                        ->update([
                            'sst' => $request->tipeUbah,
                            'koreksi' => 1,
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                    // insert ke absensi komunikasiitm
                    DB::table('absensi_komunikasiitm')->insert([
                        'entitas' => 'PINTEX',
                        'noform' => $kodeSurat,
                        'tanggal' => $dataAbs->tanggal,
                        'tanggal2' => $dataAbs->tanggal,
                        'userid' => $dataAbs->userid,
                        'nama' => $dataAbs->name,
                        'suratid' => 'Keputusan-Mgr. Hadir',
                        'sst' => 'H',
                        'keterangan' => '',
                        'dibuat' => Auth::user()->name,
                        'statussurat' => "ACC",
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                    // insert ke absensi komunikasiacc
                    DB::table('absensi_komunikasiacc')->insert([
                        'entitas' => 'PINTEX',
                        'noform' => $kodeSurat,
                        'tanggal' => $dataAbs->tanggal,
                        'tanggal2' => null,
                        'userid' => $dataAbs->userid,
                        'nama' => $dataAbs->name,
                        'suratid' => 'Keputusan-Mgr. Hadir',
                        'sst' => 'H',
                        'ket_acc' => '',
                        'keterangan' => '',
                        'dibuat' => Auth::user()->name,
                        'statussurat' => "ACC",
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            } elseif ($request->tipeUbah == 'I') {
                // pengulangan berdasarkan banyaknya absen yang dipilih
                for ($i = 0; $i < $jml; $i++) {
                    // ambil data absensi
                    $dataAbs = DB::table('absensi_absensi')
                        ->where('id', $request->idabsen[$i])
                        ->first();
                    // update absensi
                    $check = DB::table('absensi_absensi')
                        ->where('id', '=', $request->idabsen[$i])
                        ->update([
                            'sst' => $request->tipeUbah,
                            'koreksi' => 1,
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                    // insert ke absensi komunikasiitm
                    DB::table('absensi_komunikasiitm')->insert([
                        'entitas' => 'PINTEX',
                        'noform' => $kodeSurat,
                        'tanggal' => $dataAbs->tanggal,
                        'tanggal2' => $dataAbs->tanggal,
                        'userid' => $dataAbs->userid,
                        'nama' => $dataAbs->name,
                        'suratid' => 'Keputusan-Mgr. Izin',
                        'sst' => 'I',
                        'keterangan' => $request->ket,
                        'dibuat' => Auth::user()->name,
                        'statussurat' => "ACC",
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                    // insert ke absensi komunikasiacc
                    DB::table('absensi_komunikasiacc')->insert([
                        'entitas' => 'PINTEX',
                        'noform' => $kodeSurat,
                        'tanggal' => $dataAbs->tanggal,
                        'tanggal2' => null,
                        'userid' => $dataAbs->userid,
                        'nama' => $dataAbs->name,
                        'suratid' => 'Keputusan-Mgr. Izin',
                        'sst' => 'I',
                        'ket_acc' => $request->ket,
                        'keterangan' => $request->ket,
                        'dibuat' => Auth::user()->name,
                        'statussurat' => "ACC",
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            } elseif ($request->tipeUbah == 'L') {
                // pengulangan berdasarkan banyaknya absen yang dipilih
                for ($i = 0; $i < $jml; $i++) {
                    // ambil data absensi
                    $dataAbs = DB::table('absensi_absensi')
                        ->where('id', $request->idabsen[$i])
                        ->first();
                    // update absensi
                    $check = DB::table('absensi_absensi')
                        ->where('id', '=', $request->idabsen[$i])
                        ->update([
                            'sst' => $request->tipeUbah,
                            'koreksi' => 1,
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                    // insert ke absensi komunikasiitm
                    $check2 = DB::table('absensi_komunikasiitm')->insert([
                        'entitas' => 'PINTEX',
                        'noform' => $kodeSurat,
                        'tanggal' => $dataAbs->tanggal,
                        'tanggal2' => $dataAbs->tanggal,
                        'userid' => $dataAbs->userid,
                        'nama' => $dataAbs->name,
                        'suratid' => 'Surat Geser/Tukar Libur',
                        'sst' => 'L',
                        'keterangan' => $request->ket,
                        'dibuat' => Auth::user()->name,
                        'statussurat' => "ACC",
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                    // insert ke absensi komunikasiacc
                    $check3 = DB::table('absensi_komunikasiacc')->insert([
                        'entitas' => 'PINTEX',
                        'noform' => $kodeSurat,
                        'tanggal' => $dataAbs->tanggal,
                        'tanggal2' => null,
                        'userid' => $dataAbs->userid,
                        'nama' => $dataAbs->name,
                        'suratid' => 'Surat Geser/Tukar Libur',
                        'sst' => 'L',
                        'ket_acc' => $request->ket,
                        'keterangan' => $request->ket,
                        'dibuat' => Auth::user()->name,
                        'statussurat' => "ACC",
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            }
            if ($check) {
                $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
            } else {
                $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
            }
            return Response()->json($arr);
        } catch (\Illuminate\Database\QueryException $e) {
            $arr = array('msg' => 'Something goes to wrong. ' . $e->getMessage(), 'status' => false);
            return Response()->json($arr);
        }
    }

    public function syncCuti(Request $request)
    {
        $karyawan = DB::table('penerimaan_karyawan')->where('status', 'like', '%Aktif%')->get();
        for ($i = 0; $i < $karyawan->count(); $i++) {
            if ($karyawan[$i]->custom_cuti > 0) {
                try {
                    $dataLegalitas = DB::table('penerimaan_legalitas')
                        ->where('userid', $karyawan[$i]->userid)
                        ->where('sacuti', '>', 0)
                        ->where('suratjns', 'like', '%cuti%')
                        ->where('tglaw', '<', date('Y-m-d'))
                        ->where('tglak', '>', date('Y-m-d'))
                        ->orderBy('legalitastgl', 'desc')
                        ->first();
                    $update = DB::table('penerimaan_karyawan')
                        ->where('userid', $karyawan[$i]->userid)
                        ->update(
                            array(
                                'cutiaktif' => empty($dataLegalitas->sacuti) ? 0 : $dataLegalitas->sacuti,
                                'tgl_awalcuti' => empty($dataLegalitas->tglaw) ? null : $dataLegalitas->tglaw,
                                'tgl_akhircuti' => empty($dataLegalitas->tglak) ? null : $dataLegalitas->tglak,
                            )
                        );
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json('Error. ' . $e->getMessage());
                }
            } else {
                try {
                    $dataLegalitas = DB::table('penerimaan_legalitas')
                        ->where('userid', $karyawan[$i]->userid)
                        ->where('sacuti', '>', 0)
                        ->where('suratjns', 'like', '%perjanjian%')
                        ->where('tglaw', '<', date('Y-m-d'))
                        ->where('tglak', '>', date('Y-m-d'))
                        ->orderBy('legalitastgl', 'desc')
                        ->first();
                    $update = DB::table('penerimaan_karyawan')
                        ->where('userid', $karyawan[$i]->userid)
                        ->update(
                            array(
                                'cutiaktif' => empty($dataLegalitas->sacuti) ? 0 : $dataLegalitas->sacuti,
                                'tgl_awalcuti' => empty($dataLegalitas->tglaw) ? null : $dataLegalitas->tglaw,
                                'tgl_akhircuti' => empty($dataLegalitas->tglak) ? null : $dataLegalitas->tglak,
                            )
                        );
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json('Error. ' . $e->getMessage());
                }
            }
        }
        return response()->json('Berhasil Sinkronisasi ' . $karyawan->count() . ' Karyawan. ');
    }
}
