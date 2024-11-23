<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Imports\ImportExcelPayroll;
use Illuminate\Support\Facades\Session;
use App\Imports\ImportExcelAbsenPayroll;
use Maatwebsite\Excel\Facades\Excel as ExcelM;

class Administrasi extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Jakarta');
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    }

    public function payroll()
    {
        $judul = "Payroll";
        $administrasi = "active";
        $payroll = "active";

        $gapok = DB::table('daftar_upah')
            ->where('jenis', '=', 'gapok')
            ->get();

        foreach ($gapok as $k) {
            $pkumr = $k->id;
            $nominal = $k->nominal;
        }

        return view('products/04_administrasi.payroll', [
            'judul' => $judul,
            'administrasi' => $administrasi,
            'payroll' => $payroll,
            'nominal' => $nominal,
            'pkumr' => $pkumr,
        ]);
    }

    public function thr()
    {
        $judul = "Tunjangan Hari Raya";
        $administrasi = "active";
        $thr = "active";

        return view('products/04_administrasi.thr', [
            'judul' => $judul,
            'administrasi' => $administrasi,
            'thr' => $thr,
        ]);
    }

    public function generateTunjangan(Request $request)
    {
        $request->validate(
            [
                '_token' => 'required',
                'tahun' => 'required',
                'tglThr' => 'required',
            ],
        );

        // get karyawan hanya yang aktif
        $karyawanAktif = DB::table('penerimaan_karyawan')
            ->where('status', 'LIKE', '%Aktif%')
            ->orderBy('userid', 'asc')
            ->get();

        foreach ($karyawanAktif as $key) {
            // cek karyawan
            $cekUpdateKaryawan = DB::table('administrasi_tunjanganhariraya')
                ->where('userid', '=', $key->userid)
                ->where('periode', '=', $request->tahun)
                ->first();

            if ($cekUpdateKaryawan) {
                $check = DB::table('administrasi_tunjanganhariraya')
                    ->where('userid', '=', $key->userid)
                    ->where('periode', '=', $request->tahun)
                    ->limit(1)
                    ->update(
                        array(
                            'entitas' => 'PINTEX',
                            'periode' => $request->tahun,
                            'tanggal_thr' => $request->tglThr,
                            'tgl_masuk' => $key->tglmasuk,
                            'stb' => $key->stb,
                            'nama' => $key->nama,
                            'level' => $key->level,
                            'divisi' => $key->divisi,
                            'bagian' => $key->bagian,
                            'jabatan' => $key->jabatan,
                            'grup' => $key->grup,
                            'profesi' => $key->profesi,
                            'shift' => $key->shift,
                            'umr' => $key->gapok,
                            'gapok' => $key->gapok,
                            'bank' => $key->banknm,
                            'rekening' => $key->bankrek,
                            'tjabat' => $key->tjabat,
                            'prestasi' => $key->tprestasi,
                            'locked' => 0,
                            'printed' => 0,
                            'created_at' => date('Y-m-d H:i:s'),
                        )
                    );
                Session::flash('success', 'Data Karyawan Berhasil Diperbarui untuk data Payroll');
            } else {
                // tidak menemukan karyawan sesuai, buat data baru
                $check = DB::table('administrasi_tunjanganhariraya')
                    ->insert(
                        array(
                            'entitas' => 'PINTEX',
                            'periode' => $request->tahun,
                            'tanggal_thr' => $request->tglThr,
                            'tgl_masuk' => $key->tglmasuk,
                            'userid' => $key->userid,
                            'stb' => $key->stb,
                            'nama' => $key->nama,
                            'level' => $key->level,
                            'divisi' => $key->divisi,
                            'bagian' => $key->bagian,
                            'jabatan' => $key->jabatan,
                            'grup' => $key->grup,
                            'profesi' => $key->profesi,
                            'shift' => $key->shift,
                            'umr' => $key->gapok,
                            'gapok' => $key->gapok,
                            'bank' => $key->banknm,
                            'rekening' => $key->bankrek,
                            'tjabat' => $key->tjabat,
                            'prestasi' => $key->tprestasi,
                            'locked' => 0,
                            'printed' => 0,
                            'created_at' => date('Y-m-d H:i:s'),
                        )
                    );
                Session::flash('success', 'Data Karyawan Berhasil Dibuat untuk data Payroll');
            }
        }

        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data Periode ' . $request->tahun . ' telah berhasil disimpan', 'status' => true);
        }
        return Response()->json($arr);
    }

    public function updateumr(Request $request)
    {
        if ($request->ajax()) {
            DB::table('daftar_upah')
                ->where('id', $request->name)
                ->limit(1)
                ->update(
                    array(
                        'nominal' => $request->value,
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );
            DB::table('penerimaan_karyawan')
                ->where('status', 'LIKE', '%Aktif%')
                ->update(
                    array(
                        'gapok' => $request->value,
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );
            return response()->json(['success' => true]);
        }
    }

    public function updateTambahanPayroll(Request $request)
    {
        if ($request->ajax()) {
            if ($request->pk == "koperasi") {
                DB::table('administrasi_payrolldtl')
                    ->where('id', $request->name)
                    ->limit(1)
                    ->update(
                        array(
                            'koperasi' => $request->value,
                            'updated_at' => date('Y-m-d H:i:s'),
                        )
                    );
                return response()->json(['success' => true]);
            }
            if ($request->pk == "pinjaman") {
                DB::table('administrasi_payrolldtl')
                    ->where('id', $request->name)
                    ->limit(1)
                    ->update(
                        array(
                            'pinjaman' => $request->value,
                            'updated_at' => date('Y-m-d H:i:s'),
                        )
                    );
                return response()->json(['success' => true]);
            }
        }
    }

    public function getpayroll(Request $request)
    {

        echo '  
                <div class="table-responsive">
                    <table style="width:100%; font-size:12px" class="display table table-sm  table-bordered table-hover text-nowrap datatable-payroll" id="tbabsensi">
                        <thead>
                            <tr class="text-center">
                                <th>STB</th>
                                <th>NAMA</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>';
    }

    public function generateKaryawan(Request $request)
    {
        // set periode gaji
        $periode = substr($request->tahun, -2) . "" . $request->bulan;
        // get karyawan hanya yang aktif
        $karyawanAktif = DB::table('penerimaan_karyawan')
            ->select('userid', 'stb', 'nama', 'level', 'divisi', 'bagian', 'jabatan', 'grup', 'profesi', 'shift', 'gapok', 'tjabat', 'tprestasi', 'banknm', 'bankrek')
            ->where('status', 'LIKE', '%Aktif%')
            ->orderBy('userid', 'asc')
            ->get();

        foreach ($karyawanAktif as $key) {
            // cek karyawan
            $cekUpdateKaryawan = DB::table('administrasi_payroll')
                ->where('userid', '=', $key->userid)
                ->where('periode', '=', $periode)
                ->first();

            if ($cekUpdateKaryawan) {
                DB::table('administrasi_payroll')
                    ->where('userid', '=', $key->userid)
                    ->where('periode', '=', $periode)
                    ->limit(1)
                    ->update(
                        array(
                            'entitas' => 'PINTEX',
                            'dari' => date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")),
                            'sampai' => $request->tahun . '-' . $request->bulan . '-15',
                            'stb' => $key->stb,
                            'nama' => $key->nama,
                            'level' => $key->level,
                            'divisi' => $key->divisi,
                            'bagian' => $key->bagian,
                            'jabatan' => $key->jabatan,
                            'grup' => $key->grup,
                            'profesi' => $key->profesi,
                            'shift' => $key->shift,
                            'umr' => $key->gapok,
                            'gapok' => $key->gapok,
                            'tjabat' => $key->tjabat,
                            'prestasi' => $key->tprestasi,
                            'bank' => $key->banknm,
                            'rekening' => $key->bankrek,
                            'potongan_infaq' => '-5000',
                            'updated_at' => date('Y-m-d H:i:s'),
                        )
                    );
                Session::flash('success', 'Data Karyawan Berhasil Diperbarui untuk data Payroll');
            } else {
                // tidak menemukan karyawan sesuai, buat data baru
                DB::table('administrasi_payroll')
                    ->insert(
                        array(
                            'entitas' => 'PINTEX',
                            'periode' => $periode,
                            'dari' => date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")),
                            'sampai' => $request->tahun . '-' . $request->bulan . '-15',
                            'userid' => $key->userid,
                            'stb' => $key->stb,
                            'nama' => $key->nama,
                            'level' => $key->level,
                            'divisi' => $key->divisi,
                            'bagian' => $key->bagian,
                            'jabatan' => $key->jabatan,
                            'grup' => $key->grup,
                            'profesi' => $key->profesi,
                            'shift' => $key->shift,
                            'umr' => $key->gapok,
                            'gapok' => $key->gapok,
                            'tjabat' => $key->tjabat,
                            'prestasi' => $key->tprestasi,
                            'bank' => $key->banknm,
                            'rekening' => $key->bankrek,
                            'potongan_infaq' => '-5000',
                            'created_at' => date('Y-m-d H:i:s'),
                        )
                    );
                Session::flash('success', 'Data Karyawan Berhasil Dibuat untuk data Payroll');
            }
        }
    }

    public function generatePayroll(Request $request)
    {
        // set periode gaji
        $periode = substr($request->tahun, -2) . "" . $request->bulan;
        // get karyawan hanya yang aktif
        $cekUpdateKaryawan = DB::table('administrasi_payroll')
            ->where('periode', '=', $periode)
            ->orderBy('userid', 'asc')
            ->get();
        foreach ($cekUpdateKaryawan as $key) {
            // menemukan karyawan sesuai, update
            $hadir  = $this->absensi('H', $key->userid, date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")), $request->tahun . '-' . $request->bulan . '-15');
            $sakit  = $this->absensi('S', $key->userid, date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")), $request->tahun . '-' . $request->bulan . '-15');
            $izin   = $this->absensi('I', $key->userid, date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")), $request->tahun . '-' . $request->bulan . '-15');
            $alpha  = $this->absensi('A', $key->userid, date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")), $request->tahun . '-' . $request->bulan . '-15');
            $set    = $this->absensi('½', $key->userid, date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")), $request->tahun . '-' . $request->bulan . '-15');
            // hitung potongan absen = (bruto/25)*jml_absen. bruto = gapok + prestasi + tunj.jabatan.
            $absen_rp = (($key->gapok + $key->prestasi + $key->tjabat) / 25) * $key->potongan_absen_fix;
            DB::table('administrasi_payroll')
                ->where('userid', '=', $key->userid)
                ->where('periode', '=', $periode)
                ->limit(1)
                ->update(
                    array(
                        'potongan_absen' => ($sakit + $izin + $set),
                        'potongan_absen_rp' => - ($absen_rp),
                        'H' => $hadir,
                        'S' => $sakit,
                        'I' => $izin,
                        'A' => $alpha,
                        'SET' => $set,
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );
            Session::flash('success', 'Data Berhasil Diperbarui untuk data Payroll');
        }
    }

    public function generateBPJS(Request $request)
    {
        // set periode gaji
        $periode = substr($request->tahun, -2) . "" . $request->bulan;
        // get karyawan hanya yang aktif
        $cekUpdateKaryawan = DB::table('administrasi_payroll')
            ->where('periode', '=', $periode)
            ->orderBy('userid', 'asc')
            ->get();

        foreach ($cekUpdateKaryawan as $key) {
            $bpjs_jkk   = $this->get_bpjs('bpjs_jkk', $key->stb);
            $bpjs_jkm   = $this->get_bpjs('bpjs_jkm', $key->stb);
            $bpjs_jp    = $this->get_bpjs('bpjs_jp', $key->stb);
            $bpjs_jht   = $this->get_bpjs('bpjs_jht', $key->stb);
            $bpjs_ks    = $this->get_bpjs('bpjs_ks', $key->stb);
            $bpjs_ksAdd = $this->get_bpjs('bpjs_ksAdd', $key->stb);
            DB::table('administrasi_payroll')
                ->where('userid', '=', $key->userid)
                ->where('periode', '=', $periode)
                ->limit(1)
                ->update(
                    array(
                        'pot_bpjs_jkk' => $bpjs_jkk,
                        'pot_bpjs_jkm' => $bpjs_jkm,
                        'pot_bpjs_jp' => $bpjs_jp,
                        'pot_bpjs_jht' => $bpjs_jht,
                        'pot_bpjs_ks' => $bpjs_ks,
                        'pot_bpjs_ksAdd' => $bpjs_ksAdd,
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );
            Session::flash('success', 'Data Berhasil Diperbarui untuk data Payroll');
        }
    }

    public function uploadTambahanPayroll(Request $request)
    {
        $judul = "Koperasi & Pinjaman";
        $administrasi = "active";
        $payroll = "active";

        $periode = substr($request->selectedyear, -2) . $request->selectedmonth;

        $getTambahan = DB::table('administrasi_payroll')->where('periode', '=', $periode)->get();

        return view('products/04_administrasi.tambahanPayroll', [
            'judul' => $judul,
            'administrasi' => $administrasi,
            'payroll' => $payroll,
            'periode' => $periode,
            'tambahan' => $getTambahan,
        ]);
    }

    public function uploadtambahanAbsensi(Request $request)
    {
        $judul = "Kelola Absensi";
        $administrasi = "active";
        $payroll = "active";

        $periode = substr($request->selectedyear, -2) . $request->selectedmonth;

        $getTambahan = DB::table('administrasi_payroll')->where('periode', '=', $periode)->get();

        return view('products/04_administrasi.tambahanAbsensi', [
            'judul' => $judul,
            'administrasi' => $administrasi,
            'payroll' => $payroll,
            'periode' => $periode,
            'absensi' => $getTambahan,
        ]);
    }

    public function printPayroll(Request $request)
    {
        $judul = "Print Payroll";
        $administrasi = "active";
        $payroll = "active";

        for ($i = 0; $i < count($request->id); $i++) {
            $getPayroll[] = DB::table('administrasi_payroll as p')
                ->select('p.*', 'k.bankrek')
                ->join('penerimaan_karyawan as k', 'p.userid', '=', 'k.userid')
                ->where('p.id', '=', $request->id[$i])
                ->first();

            $updatePrinted = DB::table('administrasi_payroll')
                ->where('id', '=', $request->id[$i])
                ->update(
                    [
                        'printed' => DB::raw('IFNULL(printed, 0) + 1'),
                        'print_date' => date('Y-m-d H:i:s'),
                    ]
                );
        }

        return view('products/04_administrasi.printPayroll', [
            'judul' => $judul,
            'administrasi' => $administrasi,
            'payroll' => $payroll,
            'getPayroll' => $getPayroll,
        ]);
    }

    public function getSlipgaji(Request $request)
    {
        if (empty($request->id)) {
            echo '<center><iframe src="https://lottie.host/embed/94d605b9-2cc4-4d11-809a-7f41357109b0/OzwBgj9bHl.json" width="300px" height="300px"></iframe></center>';
            echo "<center>Tidak ada data yang dipilih</center>";
        } else {

            $bulan = array(
                1 =>       'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );

            $jml = count($request->id);
            echo '<div class="table-responsive">';
            echo '<div class="space-y">';

            for ($i = 0; $i < $jml; $i++) {
                $data = DB::table('administrasi_payroll')->where('id', $request->id[$i])->get();
                foreach ($data as $u) {
                    echo  '<input type="hidden" name="id[]" value="' . $u->id . '" >';
                    echo  '<input type="hidden" name="nama[]" value="' . $u->nama . '" >';
                    echo '
                        <div class="card shadow ' . (($u->printed > 0) ? "border-red bg-red-lt" : "border-green") . '">
                            <div class="row g-0">
                                <div class="col-auto">
                                    <div class="card-body">
                                        <div class="avatar avatar-md shadow" style="background-image: url(/photo/pas/' . $u->userid . '.jpg)"></div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card-body ps-0">
                                        <div class="row">
                                            <div class="col">
                                                <h3 class="mb-0">' . $u->nama . ' ( ' . $u->stb . ' )</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                <div class="mt-3 list-inline list-inline-dots mb-0 text-secondary d-sm-block d-none">
                                                    <div class="list-inline-item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11"></path><path d="M9 7l4 0"></path><path d="M9 11l4 0"></path></svg>
                                                        ' . $bulan[(int)substr($u->periode, 2)] . ' 20' . substr($u->periode, 0, 2) . '
                                                    </div>
                                                    <div class="list-inline-item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8"></path><path d="M13 7l0 .01"></path><path d="M17 7l0 .01"></path><path d="M17 11l0 .01"></path><path d="M17 15l0 .01"></path></svg>
                                                        ' . $u->bagian . '
                                                    </div>
                                                </div>
                                                <div class="mt-3 list mb-0 text-secondary d-block d-sm-none">
                                                    <div class="list-item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11"></path><path d="M9 7l4 0"></path><path d="M9 11l4 0"></path></svg>
                                                        ' . $u->periode . '
                                                    </div>
                                                    <div class="list-item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8"></path><path d="M13 7l0 .01"></path><path d="M17 7l0 .01"></path><path d="M17 11l0 .01"></path><path d="M17 15l0 .01"></path></svg>
                                                        ' . $u->bagian . '
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-auto">
                                                <div class="mt-3 badges">
                                                    <i href="#" class="badge badge-outline text-secondary fw-normal badge-pill">' . ((($u->printed > 0) ? "<span class='status-dot status-dot-animated status-red'></span>" : "")) . ' Tanggal Print: ' . (empty($u->print_date) ? ' -' : carbon::parse($u->print_date)->format('d/m/Y') . " Jam " . carbon::parse($u->print_date)->format('H:i:s')) . '</i>
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
        // return $result;
    }

    public function rekapPayroll(Request $request)
    {
        $bulan = array(
            1 =>       'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $periode = substr($request->tahun, 2) . $request->bulan;

        // mendapatkan jumlah karyawan berdasarkan level
        $getPayroll = DB::table('administrasi_payroll')
            ->select(DB::raw("
                        (SELECT COUNT(level) FROM administrasi_payroll WHERE level = 'UNIT 1' AND periode = '$periode' ) AS level_unit1,
                        (SELECT COUNT(level) FROM administrasi_payroll WHERE level = 'UNIT 2' AND periode = '$periode' ) AS level_unit2,
                        (SELECT COUNT(level) FROM administrasi_payroll WHERE level = 'UMUM' AND periode = '$periode' ) AS level_umum,
                        (SELECT COUNT(level) FROM administrasi_payroll WHERE level = 'STAFF' AND periode = '$periode' ) AS level_staff,
                        (SELECT COUNT(level) FROM administrasi_payroll WHERE level = 'TFI' AND periode = '$periode' ) AS level_tfi,
                        (SELECT COUNT(level) FROM administrasi_payroll WHERE level = 'TFO' AND periode = '$periode' ) AS level_tfo,
                        (SELECT COUNT(level) FROM administrasi_payroll WHERE level = 'WCR & WORKSHOP' AND periode = '$periode' ) AS level_wcrwr,

                        (SELECT (SUM(gapok) + SUM(prestasi) + SUM(tjabat)) FROM administrasi_payroll WHERE level = 'UNIT 1' AND periode = '$periode' ) AS bruto_unit1,
                        (SELECT (SUM(gapok) + SUM(prestasi) + SUM(tjabat)) FROM administrasi_payroll WHERE level = 'UNIT 2' AND periode = '$periode' ) AS bruto_unit2,
                        (SELECT (SUM(gapok) + SUM(prestasi) + SUM(tjabat)) FROM administrasi_payroll WHERE level = 'UMUM' AND periode = '$periode' ) AS bruto_umum,
                        (SELECT (SUM(gapok) + SUM(prestasi) + SUM(tjabat)) FROM administrasi_payroll WHERE level = 'STAFF' AND periode = '$periode' ) AS bruto_staff,
                        (SELECT (SUM(gapok) + SUM(prestasi) + SUM(tjabat)) FROM administrasi_payroll WHERE level = 'TFI' AND periode = '$periode' ) AS bruto_tfi,
                        (SELECT (SUM(gapok) + SUM(prestasi) + SUM(tjabat)) FROM administrasi_payroll WHERE level = 'TFO' AND periode = '$periode' ) AS bruto_tfo,
                        (SELECT (SUM(gapok) + SUM(prestasi) + SUM(tjabat)) FROM administrasi_payroll WHERE level = 'WCR & WORKSHOP' AND periode = '$periode' ) AS bruto_wcrwr,

                        (SELECT SUM(potongan_koperasi) FROM administrasi_payroll WHERE level = 'UNIT 1' AND periode = '$periode' ) AS koperasi_unit1,
                        (SELECT SUM(potongan_koperasi) FROM administrasi_payroll WHERE level = 'UNIT 2' AND periode = '$periode' ) AS koperasi_unit2,
                        (SELECT SUM(potongan_koperasi) FROM administrasi_payroll WHERE level = 'UMUM' AND periode = '$periode' ) AS koperasi_umum,
                        (SELECT SUM(potongan_koperasi) FROM administrasi_payroll WHERE level = 'STAFF' AND periode = '$periode' ) AS koperasi_staff,
                        (SELECT SUM(potongan_koperasi) FROM administrasi_payroll WHERE level = 'TFI' AND periode = '$periode' ) AS koperasi_tfi,
                        (SELECT SUM(potongan_koperasi) FROM administrasi_payroll WHERE level = 'TFO' AND periode = '$periode' ) AS koperasi_tfo,
                        (SELECT SUM(potongan_koperasi) FROM administrasi_payroll WHERE level = 'WCR & WORKSHOP' AND periode = '$periode' ) AS koperasi_wcrwr,

                        (SELECT SUM(potongan_infaq) FROM administrasi_payroll WHERE level = 'UNIT 1' AND periode = '$periode' ) AS infaq_unit1,
                        (SELECT SUM(potongan_infaq) FROM administrasi_payroll WHERE level = 'UNIT 2' AND periode = '$periode' ) AS infaq_unit2,
                        (SELECT SUM(potongan_infaq) FROM administrasi_payroll WHERE level = 'UMUM' AND periode = '$periode' ) AS infaq_umum,
                        (SELECT SUM(potongan_infaq) FROM administrasi_payroll WHERE level = 'STAFF' AND periode = '$periode' ) AS infaq_staff,
                        (SELECT SUM(potongan_infaq) FROM administrasi_payroll WHERE level = 'TFI' AND periode = '$periode' ) AS infaq_tfi,
                        (SELECT SUM(potongan_infaq) FROM administrasi_payroll WHERE level = 'TFO' AND periode = '$periode' ) AS infaq_tfo,
                        (SELECT SUM(potongan_infaq) FROM administrasi_payroll WHERE level = 'WCR & WORKSHOP' AND periode = '$periode' ) AS infaq_wcrwr,

                        (SELECT SUM(potongan_pinjaman) FROM administrasi_payroll WHERE level = 'UNIT 1' AND periode = '$periode' ) AS pinjaman_unit1,
                        (SELECT SUM(potongan_pinjaman) FROM administrasi_payroll WHERE level = 'UNIT 2' AND periode = '$periode' ) AS pinjaman_unit2,
                        (SELECT SUM(potongan_pinjaman) FROM administrasi_payroll WHERE level = 'UMUM' AND periode = '$periode' ) AS pinjaman_umum,
                        (SELECT SUM(potongan_pinjaman) FROM administrasi_payroll WHERE level = 'STAFF' AND periode = '$periode' ) AS pinjaman_staff,
                        (SELECT SUM(potongan_pinjaman) FROM administrasi_payroll WHERE level = 'TFI' AND periode = '$periode' ) AS pinjaman_tfi,
                        (SELECT SUM(potongan_pinjaman) FROM administrasi_payroll WHERE level = 'TFO' AND periode = '$periode' ) AS pinjaman_tfo,
                        (SELECT SUM(potongan_pinjaman) FROM administrasi_payroll WHERE level = 'WCR & WORKSHOP' AND periode = '$periode' ) AS pinjaman_wcrwr,

                        (SELECT COALESCE(SUM(pot_bpjs_jkk),0)+COALESCE(SUM(pot_bpjs_jkm),0)+COALESCE(SUM(pot_bpjs_jp),0)+COALESCE(SUM(pot_bpjs_jht),0) FROM administrasi_payroll WHERE level = 'UNIT 1' AND periode = '$periode' ) AS bpjstk_unit1,
                        (SELECT COALESCE(SUM(pot_bpjs_jkk),0)+COALESCE(SUM(pot_bpjs_jkm),0)+COALESCE(SUM(pot_bpjs_jp),0)+COALESCE(SUM(pot_bpjs_jht),0) FROM administrasi_payroll WHERE level = 'UNIT 2' AND periode = '$periode' ) AS bpjstk_unit2,
                        (SELECT COALESCE(SUM(pot_bpjs_jkk),0)+COALESCE(SUM(pot_bpjs_jkm),0)+COALESCE(SUM(pot_bpjs_jp),0)+COALESCE(SUM(pot_bpjs_jht),0) FROM administrasi_payroll WHERE level = 'UMUM' AND periode = '$periode' ) AS bpjstk_umum,
                        (SELECT COALESCE(SUM(pot_bpjs_jkk),0)+COALESCE(SUM(pot_bpjs_jkm),0)+COALESCE(SUM(pot_bpjs_jp),0)+COALESCE(SUM(pot_bpjs_jht),0) FROM administrasi_payroll WHERE level = 'STAFF' AND periode = '$periode' ) AS bpjstk_staff,
                        (SELECT COALESCE(SUM(pot_bpjs_jkk),0)+COALESCE(SUM(pot_bpjs_jkm),0)+COALESCE(SUM(pot_bpjs_jp),0)+COALESCE(SUM(pot_bpjs_jht),0) FROM administrasi_payroll WHERE level = 'TFI' AND periode = '$periode' ) AS bpjstk_tfi,
                        (SELECT COALESCE(SUM(pot_bpjs_jkk),0)+COALESCE(SUM(pot_bpjs_jkm),0)+COALESCE(SUM(pot_bpjs_jp),0)+COALESCE(SUM(pot_bpjs_jht),0) FROM administrasi_payroll WHERE level = 'TFO' AND periode = '$periode' ) AS bpjstk_tfo,
                        (SELECT COALESCE(SUM(pot_bpjs_jkk),0)+COALESCE(SUM(pot_bpjs_jkm),0)+COALESCE(SUM(pot_bpjs_jp),0)+COALESCE(SUM(pot_bpjs_jht),0) FROM administrasi_payroll WHERE level = 'WCR & WORKSHOP' AND periode = '$periode' ) AS bpjstk_wcrwr,

                        (SELECT COALESCE(SUM(potongan_absen_rp),0) FROM administrasi_payroll WHERE level = 'UNIT 1' AND periode = '$periode' ) AS absensi_unit1,
                        (SELECT COALESCE(SUM(potongan_absen_rp),0) FROM administrasi_payroll WHERE level = 'UNIT 2' AND periode = '$periode' ) AS absensi_unit2,
                        (SELECT COALESCE(SUM(potongan_absen_rp),0) FROM administrasi_payroll WHERE level = 'UMUM' AND periode = '$periode' ) AS absensi_umum,
                        (SELECT COALESCE(SUM(potongan_absen_rp),0) FROM administrasi_payroll WHERE level = 'STAFF' AND periode = '$periode' ) AS absensi_staff,
                        (SELECT COALESCE(SUM(potongan_absen_rp),0) FROM administrasi_payroll WHERE level = 'TFI' AND periode = '$periode' ) AS absensi_tfi,
                        (SELECT COALESCE(SUM(potongan_absen_rp),0) FROM administrasi_payroll WHERE level = 'TFO' AND periode = '$periode' ) AS absensi_tfo,
                        (SELECT COALESCE(SUM(potongan_absen_rp),0) FROM administrasi_payroll WHERE level = 'WCR & WORKSHOP' AND periode = '$periode' ) AS absensi_wcrwr,
                        
                        (SELECT COALESCE(SUM(pot_bpjs_ks),0)+COALESCE(SUM(pot_bpjs_ksAdd),0) FROM administrasi_payroll WHERE level = 'UNIT 1' AND periode = '$periode' ) AS bpjsks_unit1,
                        (SELECT COALESCE(SUM(pot_bpjs_ks),0)+COALESCE(SUM(pot_bpjs_ksAdd),0) FROM administrasi_payroll WHERE level = 'UNIT 2' AND periode = '$periode' ) AS bpjsks_unit2,
                        (SELECT COALESCE(SUM(pot_bpjs_ks),0)+COALESCE(SUM(pot_bpjs_ksAdd),0) FROM administrasi_payroll WHERE level = 'UMUM' AND periode = '$periode' ) AS bpjsks_umum,
                        (SELECT COALESCE(SUM(pot_bpjs_ks),0)+COALESCE(SUM(pot_bpjs_ksAdd),0) FROM administrasi_payroll WHERE level = 'STAFF' AND periode = '$periode' ) AS bpjsks_staff,
                        (SELECT COALESCE(SUM(pot_bpjs_ks),0)+COALESCE(SUM(pot_bpjs_ksAdd),0) FROM administrasi_payroll WHERE level = 'TFI' AND periode = '$periode' ) AS bpjsks_tfi,
                        (SELECT COALESCE(SUM(pot_bpjs_ks),0)+COALESCE(SUM(pot_bpjs_ksAdd),0) FROM administrasi_payroll WHERE level = 'TFO' AND periode = '$periode' ) AS bpjsks_tfo,
                        (SELECT COALESCE(SUM(pot_bpjs_ks),0)+COALESCE(SUM(pot_bpjs_ksAdd),0) FROM administrasi_payroll WHERE level = 'WCR & WORKSHOP' AND periode = '$periode' ) AS bpjsks_wcrwr
                    "))
            ->first();
        $levels = array(
            'UNIT 1' => $getPayroll->level_unit1,
            'UNIT 2' => $getPayroll->level_unit2,
            'UMUM' => $getPayroll->level_umum,
            'STAFF' => $getPayroll->level_staff,
            'TFI' => $getPayroll->level_tfi,
            'TFO' => $getPayroll->level_tfo,
            'WCR & WORKSHOP' => $getPayroll->level_wcrwr,
        );
        $brutos = array(
            'UNIT 1' => $getPayroll->bruto_unit1,
            'UNIT 2' => $getPayroll->bruto_unit2,
            'UMUM' => $getPayroll->bruto_umum,
            'STAFF' => $getPayroll->bruto_staff,
            'TFI' => $getPayroll->bruto_tfi,
            'TFO' => $getPayroll->bruto_tfo,
            'WCR & WORKSHOP' => $getPayroll->bruto_wcrwr,
        );
        $koperasis = array(
            'UNIT 1' => $getPayroll->koperasi_unit1,
            'UNIT 2' => $getPayroll->koperasi_unit2,
            'UMUM' => $getPayroll->koperasi_umum,
            'STAFF' => $getPayroll->koperasi_staff,
            'TFI' => $getPayroll->koperasi_tfi,
            'TFO' => $getPayroll->koperasi_tfo,
            'WCR & WORKSHOP' => $getPayroll->koperasi_wcrwr,
        );
        $infaqs = array(
            'UNIT 1' => $getPayroll->infaq_unit1,
            'UNIT 2' => $getPayroll->infaq_unit2,
            'UMUM' => $getPayroll->infaq_umum,
            'STAFF' => $getPayroll->infaq_staff,
            'TFI' => $getPayroll->infaq_tfi,
            'TFO' => $getPayroll->infaq_tfo,
            'WCR & WORKSHOP' => $getPayroll->infaq_wcrwr,
        );
        $pinjamans = array(
            'UNIT 1' => $getPayroll->pinjaman_unit1,
            'UNIT 2' => $getPayroll->pinjaman_unit2,
            'UMUM' => $getPayroll->pinjaman_umum,
            'STAFF' => $getPayroll->pinjaman_staff,
            'TFI' => $getPayroll->pinjaman_tfi,
            'TFO' => $getPayroll->pinjaman_tfo,
            'WCR & WORKSHOP' => $getPayroll->pinjaman_wcrwr,
        );
        $bpjstks = array(
            'UNIT 1' => $getPayroll->bpjstk_unit1,
            'UNIT 2' => $getPayroll->bpjstk_unit2,
            'UMUM' => $getPayroll->bpjstk_umum,
            'STAFF' => $getPayroll->bpjstk_staff,
            'TFI' => $getPayroll->bpjstk_tfi,
            'TFO' => $getPayroll->bpjstk_tfo,
            'WCR & WORKSHOP' => $getPayroll->bpjstk_wcrwr,
        );
        $bpjskss = array(
            'UNIT 1' => $getPayroll->bpjsks_unit1,
            'UNIT 2' => $getPayroll->bpjsks_unit2,
            'UMUM' => $getPayroll->bpjsks_umum,
            'STAFF' => $getPayroll->bpjsks_staff,
            'TFI' => $getPayroll->bpjsks_tfi,
            'TFO' => $getPayroll->bpjsks_tfo,
            'WCR & WORKSHOP' => $getPayroll->bpjsks_wcrwr,
        );
        $absens = array(
            'UNIT 1' => $getPayroll->absensi_unit1,
            'UNIT 2' => $getPayroll->absensi_unit2,
            'UMUM' => $getPayroll->absensi_umum,
            'STAFF' => $getPayroll->absensi_staff,
            'TFI' => $getPayroll->absensi_tfi,
            'TFO' => $getPayroll->absensi_tfo,
            'WCR & WORKSHOP' => $getPayroll->absensi_wcrwr,
        );

        // insert atau update setelah mendapatkan data jumlah karyawan
        // UNIT 1
        DB::table('administrasi_payrollrekap')
            ->updateOrInsert(
                [
                    'entitas' => 'PINTEX',
                    'level' => 'UNIT 1',
                    'periode' => $periode,
                ],
                [
                    'dari' => date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")),
                    'sampai' => $request->tahun . '-' . $request->bulan . '-15',
                    'jml_karyawan' => $levels['UNIT 1'],
                    'bruto' => $brutos['UNIT 1'],
                    'koperasi' => $koperasis['UNIT 1'],
                    'infaq' => $infaqs['UNIT 1'],
                    'lainnya' => $pinjamans['UNIT 1'],
                    'bpjs_tk' => $bpjstks['UNIT 1'],
                    'bpjs_ks' => $bpjskss['UNIT 1'],
                    'absensi' => $absens['UNIT 1'],
                    'tot_potongan' => $koperasis['UNIT 1'] + $infaqs['UNIT 1'] + $pinjamans['UNIT 1'] + $bpjstks['UNIT 1'] + $bpjskss['UNIT 1'] + $absens['UNIT 1'],
                    'netto' => $brutos['UNIT 1'] + $bpjskss['UNIT 1'] + $bpjstks['UNIT 1'] + $koperasis['UNIT 1'] + $infaqs['UNIT 1'] + $pinjamans['UNIT 1'] + $absens['UNIT 1'],
                ],
            );
        // UNIT 2
        DB::table('administrasi_payrollrekap')
            ->updateOrInsert(
                [
                    'entitas' => 'PINTEX',
                    'level' => 'UNIT 2',
                    'periode' => $periode,
                ],
                [
                    'dari' => date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")),
                    'sampai' => $request->tahun . '-' . $request->bulan . '-15',
                    'jml_karyawan' => $levels['UNIT 2'],
                    'bruto' => $brutos['UNIT 2'],
                    'koperasi' => $koperasis['UNIT 2'],
                    'infaq' => $infaqs['UNIT 2'],
                    'lainnya' => $pinjamans['UNIT 2'],
                    'bpjs_tk' => $bpjstks['UNIT 2'],
                    'bpjs_ks' => $bpjskss['UNIT 2'],
                    'absensi' => $absens['UNIT 2'],
                    'tot_potongan' => $koperasis['UNIT 2'] + $infaqs['UNIT 2'] + $pinjamans['UNIT 2'] + $bpjstks['UNIT 2'] + $bpjskss['UNIT 2'] + $absens['UNIT 2'],
                    'netto' => $brutos['UNIT 2'] + $bpjskss['UNIT 2'] + $bpjstks['UNIT 2'] + $koperasis['UNIT 2'] + $infaqs['UNIT 2'] + $pinjamans['UNIT 2'] + $absens['UNIT 2'],
                ],
            );
        // UMUM
        DB::table('administrasi_payrollrekap')
            ->updateOrInsert(
                [
                    'entitas' => 'PINTEX',
                    'level' => 'UMUM',
                    'periode' => $periode,
                ],
                [
                    'dari' => date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")),
                    'sampai' => $request->tahun . '-' . $request->bulan . '-15',
                    'jml_karyawan' => $levels['UMUM'],
                    'bruto' => $brutos['UMUM'],
                    'koperasi' => $koperasis['UMUM'],
                    'infaq' => $infaqs['UMUM'],
                    'lainnya' => $pinjamans['UMUM'],
                    'bpjs_tk' => $bpjstks['UMUM'],
                    'bpjs_ks' => $bpjskss['UMUM'],
                    'absensi' => $absens['UMUM'],
                    'tot_potongan' => $koperasis['UMUM'] + $infaqs['UMUM'] + $pinjamans['UMUM'] + $bpjstks['UMUM'] + $bpjskss['UMUM'] + $absens['UMUM'],
                    'netto' => $brutos['UMUM'] + $bpjskss['UMUM'] + $bpjstks['UMUM'] + $koperasis['UMUM'] + $infaqs['UMUM'] + $pinjamans['UMUM'] + $absens['UMUM'],
                ],
            );
        // STAFF
        DB::table('administrasi_payrollrekap')
            ->updateOrInsert(
                [
                    'entitas' => 'PINTEX',
                    'level' => 'STAFF',
                    'periode' => $periode,
                ],
                [
                    'dari' => date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")),
                    'sampai' => $request->tahun . '-' . $request->bulan . '-15',
                    'jml_karyawan' => $levels['STAFF'],
                    'bruto' => $brutos['STAFF'],
                    'koperasi' => $koperasis['STAFF'],
                    'infaq' => $infaqs['STAFF'],
                    'lainnya' => $pinjamans['STAFF'],
                    'bpjs_ks' => $bpjskss['STAFF'],
                    'bpjs_tk' => $bpjstks['STAFF'],
                    'absensi' => $absens['STAFF'],
                    'tot_potongan' => $koperasis['STAFF'] + $infaqs['STAFF'] + $pinjamans['STAFF'] + $bpjstks['STAFF'] + $bpjskss['STAFF'] + $absens['STAFF'],
                    'netto' => $brutos['STAFF'] + $bpjskss['STAFF'] + $bpjstks['STAFF'] + $koperasis['STAFF'] + $infaqs['STAFF'] + $pinjamans['STAFF'] + $absens['STAFF'],
                ],
            );
        // TFI
        DB::table('administrasi_payrollrekap')
            ->updateOrInsert(
                [
                    'entitas' => 'PINTEX',
                    'level' => 'TFI',
                    'periode' => $periode,
                ],
                [
                    'dari' => date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")),
                    'sampai' => $request->tahun . '-' . $request->bulan . '-15',
                    'jml_karyawan' => $levels['TFI'],
                    'bruto' => $brutos['TFI'],
                    'koperasi' => $koperasis['TFI'],
                    'infaq' => $infaqs['TFI'],
                    'lainnya' => $pinjamans['TFI'],
                    'bpjs_ks' => $bpjskss['TFI'],
                    'bpjs_tk' => $bpjstks['TFI'],
                    'absensi' => $absens['TFI'],
                    'tot_potongan' => $koperasis['TFI'] + $infaqs['TFI'] + $pinjamans['TFI'] + $bpjstks['TFI'] + $bpjskss['TFI'] + $absens['TFI'],
                    'netto' => $brutos['TFI'] + $bpjskss['TFI'] + $bpjstks['TFI'] + $koperasis['TFI'] + $infaqs['TFI'] + $pinjamans['TFI'] + $absens['TFI'],
                ],
            );
        // TFO
        DB::table('administrasi_payrollrekap')
            ->updateOrInsert(
                [
                    'entitas' => 'PINTEX',
                    'level' => 'TFO',
                    'periode' => $periode,
                ],
                [
                    'dari' => date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")),
                    'sampai' => $request->tahun . '-' . $request->bulan . '-15',
                    'jml_karyawan' => $levels['TFO'],
                    'bruto' => $brutos['TFO'],
                    'koperasi' => $koperasis['TFO'],
                    'infaq' => $infaqs['TFO'],
                    'lainnya' => $pinjamans['TFO'],
                    'bpjs_ks' => $bpjskss['TFO'],
                    'bpjs_tk' => $bpjstks['TFO'],
                    'absensi' => $absens['TFO'],
                    'tot_potongan' => $koperasis['TFO'] + $infaqs['TFO'] + $pinjamans['TFO'] + $bpjstks['TFO'] + $bpjskss['TFO'] + $absens['TFO'],
                    'netto' => $brutos['TFO'] + $bpjskss['TFO'] + $bpjstks['TFO'] + $koperasis['TFO'] + $infaqs['TFO'] + $pinjamans['TFO'] + $absens['TFO'],
                ],
            );
        // WCR & WORKSHOP
        DB::table('administrasi_payrollrekap')
            ->updateOrInsert(
                [
                    'entitas' => 'PINTEX',
                    'level' => 'WCR & WORKSHOP',
                    'periode' => $periode,
                ],
                [
                    'dari' => date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")),
                    'sampai' => $request->tahun . '-' . $request->bulan . '-15',
                    'jml_karyawan' => $levels['WCR & WORKSHOP'],
                    'bruto' => $brutos['WCR & WORKSHOP'],
                    'koperasi' => $koperasis['WCR & WORKSHOP'],
                    'infaq' => $infaqs['WCR & WORKSHOP'],
                    'lainnya' => $pinjamans['WCR & WORKSHOP'],
                    'bpjs_ks' => $bpjskss['WCR & WORKSHOP'],
                    'bpjs_tk' => $bpjstks['WCR & WORKSHOP'],
                    'absensi' => $absens['WCR & WORKSHOP'],
                    'tot_potongan' => $koperasis['WCR & WORKSHOP'] + $infaqs['WCR & WORKSHOP'] + $pinjamans['WCR & WORKSHOP'] + $bpjstks['WCR & WORKSHOP'] + $bpjskss['WCR & WORKSHOP'] + $absens['WCR & WORKSHOP'],
                    'netto' => $brutos['WCR & WORKSHOP'] + $bpjskss['WCR & WORKSHOP'] + $bpjstks['WCR & WORKSHOP'] + $koperasis['WCR & WORKSHOP'] + $infaqs['WCR & WORKSHOP'] + $pinjamans['WCR & WORKSHOP'] + $absens['WCR & WORKSHOP'],
                ],
            );

        $getRekap = DB::table('administrasi_payrollrekap')
            ->where('periode', '=', $periode)
            ->get();

        echo '
                <div class="card">
                    <div class="card-header">
                        <h5 class="modal-title">Rekap Payroll Periode ' . $bulan[(int)$request->bulan] . ', ' . $request->tahun . '</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm card-table table-vcenter text-nowrap datatable table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Grup</th>
                                    <th class="text-center">Jml Karyawan</th>
                                    <th class="text-center">Gaji Bruto</th>
                                    <th class="text-center">Koperasi</th>
                                    <th class="text-center">Infaq</th>
                                    <th class="text-center">Pinjaman</th>
                                    <th class="text-center">BPJS TK</th>
                                    <th class="text-center">BPJS Kesehatan</th>
                                    <th class="text-center">Absensi</th>
                                    <th class="text-center">Total Potongan</th>
                                    <th class="text-center">Gaji Netto</th>
                                </tr>
                            </thead>
                            <tbody>';
        foreach ($getRekap as $r) {
            echo '
                                <tr>
                                    <th>' . $r->level . '</th>
                                    <th class="text-center">' . $r->jml_karyawan . '</th>
                                    <th class="text-center">' . number_format($r->bruto, 0, ',', '.') . '</th>
                                    <th class="text-center">' . number_format($r->koperasi, 0, ',', '.') . '</th>
                                    <th class="text-center">' . number_format($r->infaq, 0, ',', '.') . '</th>
                                    <th class="text-center">' . number_format($r->lainnya, 0, ',', '.') . '</th>
                                    <th class="text-center">' . number_format($r->bpjs_tk, 0, ',', '.') . '</th>
                                    <th class="text-center">' . number_format($r->bpjs_ks, 0, ',', '.') . '</th>
                                    <th class="text-center">' . number_format($r->absensi, 0, ',', '.') . '</th>
                                    <th class="text-center">' . number_format($r->tot_potongan, 0, ',', '.') . '</th>
                                    <th class="text-center">' . number_format($r->netto, 0, ',', '.') . '</th>
                                </tr>
                        ';
        }
        echo '
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">' . number_format(array_sum($levels), 0, ',', '.') . '</th>
                                    <th class="text-center">' . number_format(array_sum($brutos), 0, ',', '.') . '</th>
                                    <th class="text-center">' . number_format(array_sum($koperasis), 0, ',', '.') . '</th>
                                    <th class="text-center">' . number_format(array_sum($infaqs), 0, ',', '.') . '</th>
                                    <th class="text-center">' . number_format(array_sum($pinjamans), 0, ',', '.') . '</th>
                                    <th class="text-center">' . number_format(array_sum($bpjstks), 0, ',', '.') . '</th>
                                    <th class="text-center">' . number_format(array_sum($bpjskss), 0, ',', '.') . '</th>
                                    <th class="text-center">' . number_format(array_sum($absens), 0, ',', '.') . '</th>
                                    <th class="text-center">' . number_format((array_sum($koperasis) + array_sum($infaqs) + array_sum($pinjamans) + array_sum($bpjstks) + array_sum($bpjskss) + array_sum($absens)), 0, ',', '.') . '</th>
                                    <th class="text-center">' . number_format((array_sum($brutos) + array_sum($bpjskss) + array_sum($bpjstks) + array_sum($koperasis) + array_sum($infaqs) + array_sum($pinjamans) + array_sum($absens)), 0, ',', '.') . '</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Tutup</button>
                </div>
            ';
    }

    private function absensi($params, $userid, $start, $end)
    {
        if ($params == "½") {
            $absensi = DB::table('absensi_absensi')
                ->select(DB::raw("SUM(IF(sst = '$params', 0.5, 0)) as Result"))
                ->where('userid', '=', $userid)
                ->whereBetween('tanggal', [$start, $end])
                ->get();
            foreach ($absensi as $a) {
                $result = $a->Result;
            }
        } else {
            $absensi = DB::table('absensi_absensi')
                ->select(DB::raw("SUM(IF(sst = '$params', 1, 0)) as Result"))
                ->where('userid', '=', $userid)
                ->whereBetween('tanggal', [$start, $end])
                ->get();
            foreach ($absensi as $a) {
                $result = $a->Result;
            }
        }

        return $result;
    }

    private function get_bpjs($jenis, $stb)
    {
        $karyawanAktif = DB::table('penerimaan_karyawan')
            ->where('stb', '=', $stb)
            ->first();
        if ($jenis == 'bpjs_jkk') {
            $bpjs = DB::table('daftar_upah')
                ->where('jenis', '=', 'bpjs_jkk')
                ->first();
            if ($karyawanAktif->bpjs_jkk > 0) {
                if ($karyawanAktif->jabatan == 'KASIE') {
                    $res = - (($karyawanAktif->gapok + 125000) * $bpjs->nominal) / 100;
                } elseif ($karyawanAktif->jabatan == 'KABAG') {
                    $res = - (($karyawanAktif->gapok + 500000) * $bpjs->nominal) / 100;
                } elseif ($karyawanAktif->jabatan == 'MANAGER') {
                    $res = - (($karyawanAktif->gapok + 1000000) * $bpjs->nominal) / 100;
                } else {
                    $res = - ($karyawanAktif->gapok * $bpjs->nominal) / 100;
                }
            } else {
                $res = null;
            }
        } elseif ($jenis == 'bpjs_jkm') {
            $bpjs = DB::table('daftar_upah')
                ->where('jenis', '=', 'bpjs_jkm')
                ->first();
            if ($karyawanAktif->bpjs_jkm > 0) {
                if ($karyawanAktif->jabatan == 'KASIE') {
                    $res = - (($karyawanAktif->gapok + 125000) * $bpjs->nominal) / 100;
                } elseif ($karyawanAktif->jabatan == 'KABAG') {
                    $res = - (($karyawanAktif->gapok + 500000) * $bpjs->nominal) / 100;
                } elseif ($karyawanAktif->jabatan == 'MANAGER') {
                    $res = - (($karyawanAktif->gapok + 1000000) * $bpjs->nominal) / 100;
                } else {
                    $res = - ($karyawanAktif->gapok * $bpjs->nominal) / 100;
                }
            } else {
                $res = null;
            }
        } elseif ($jenis == 'bpjs_jp') {
            $bpjs = DB::table('daftar_upah')
                ->where('jenis', '=', 'bpjs_jp')
                ->first();
            if ($karyawanAktif->bpjs_jp > 0) {
                if ($karyawanAktif->jabatan == 'KASIE') {
                    $res = - (($karyawanAktif->gapok + 125000) * $bpjs->nominal) / 100;
                } elseif ($karyawanAktif->jabatan == 'KABAG') {
                    $res = - (($karyawanAktif->gapok + 500000) * $bpjs->nominal) / 100;
                } elseif ($karyawanAktif->jabatan == 'MANAGER') {
                    $res = - (($karyawanAktif->gapok + 1000000) * $bpjs->nominal) / 100;
                } else {
                    $res = - ($karyawanAktif->gapok * $bpjs->nominal) / 100;
                }
            } else {
                $res = null;
            }
        } elseif ($jenis == 'bpjs_jht') {
            $bpjs = DB::table('daftar_upah')
                ->where('jenis', '=', 'bpjs_jht')
                ->first();
            if ($karyawanAktif->bpjs_jht > 0) {
                if ($karyawanAktif->jabatan == 'KASIE') {
                    $res = - (($karyawanAktif->gapok + 125000) * $bpjs->nominal) / 100;
                } elseif ($karyawanAktif->jabatan == 'KABAG') {
                    $res = - (($karyawanAktif->gapok + 500000) * $bpjs->nominal) / 100;
                } elseif ($karyawanAktif->jabatan == 'MANAGER') {
                    $res = - (($karyawanAktif->gapok + 1000000) * $bpjs->nominal) / 100;
                } else {
                    $res = - ($karyawanAktif->gapok * $bpjs->nominal) / 100;
                }
            } else {
                $res = null;
            }
        } elseif ($jenis == 'bpjs_ks') {
            $bpjs = DB::table('daftar_upah')
                ->where('jenis', '=', 'bpjs_ks')
                ->first();
            if ($karyawanAktif->bpjs_ks > 0) {
                $res = - ($karyawanAktif->gapok * $bpjs->nominal) / 100;
            } else {
                $res = null;
            }
        } elseif ($jenis == 'bpjs_ksAdd') {
            $bpjs = DB::table('daftar_upah')
                ->where('jenis', '=', 'bpjs_ks')
                ->first();
            if ($karyawanAktif->bpjs_ksAdd > 0) {
                $res = - ($karyawanAktif->gapok * $bpjs->nominal) / 100;
            } else {
                $res = null;
            }
        }

        return $res;
    }

    public function importPayroll(Request $request)
    {
        // validasi
        $request->validate(
            [
                '_token' => 'required',
                'file' => 'required|mimes:csv,xls,xlsx',
            ],
        );
        // menangkap file excel
        $file = $request->file('file');
        // membuat nama file
        $nama_file = 'Periode-' . $request->periode . '_upload-' . date('Ymd') . '-' . $file->getClientOriginalName();
        // upload ke folder file_excel di dalam folder public
        $file->move('file_excel/c_payroll', $nama_file);
        // import data
        $folder = public_path('file_excel/c_payroll/' . $nama_file);
        ExcelM::import(new ImportExcelPayroll, $folder);
        // notifikasi dengan session
        Session::flash('success', 'Data Payroll Berhasil Diimport!');
        // alihkan halaman kembali
        // return redirect()->back()->with('success', 'Data Payroll Berhasil Diimport!');

        $judul = "Koperasi & Pinjaman";
        $administrasi = "active";
        $payroll = "active";
        $getTambahan = DB::table('administrasi_payrolldtl')->where('periode', '=', $request->periode)->get();

        return view('products/04_administrasi.tambahanPayroll', [
            'judul' => $judul,
            'administrasi' => $administrasi,
            'payroll' => $payroll,
            'periode' => $request->periode,
            'tambahan' => $getTambahan,
        ]);
    }

    public function importAbsenPayroll(Request $request)
    {
        // validasi
        $request->validate(
            [
                '_token' => 'required',
                'file' => 'required|mimes:csv,xls,xlsx',
            ],
        );
        // menangkap file excel
        $file = $request->file('file');
        // membuat nama file
        $nama_file = 'Periode-' . $request->periode . '_upload-' . date('Ymd') . '-' . $file->getClientOriginalName();
        // upload ke folder file_excel di dalam folder public
        $file->move('file_excel/c_absen', $nama_file);
        // import data
        $folder = public_path('file_excel/c_absen/' . $nama_file);
        ExcelM::import(new ImportExcelAbsenPayroll, $folder);
        // notifikasi dengan session
        Session::flash('success', 'Data Payroll Berhasil Diimport!');
        // alihkan halaman kembali
        // return redirect()->back()->with('success', 'Data Payroll Berhasil Diimport!');

        $judul = "Kelola Absensi";
        $administrasi = "active";
        $payroll = "active";

        $periode = substr($request->selectedyear, -2) . $request->selectedmonth;

        $getTambahan = DB::table('administrasi_payroll')->where('periode', '=', $request->periode)->get();

        return view('products/04_administrasi.tambahanAbsensi', [
            'judul' => $judul,
            'administrasi' => $administrasi,
            'payroll' => $payroll,
            'payroll' => $payroll,
            'periode' => $request->periode,
            'absensi' => $getTambahan,
        ]);
    }

    public function pilihFixAbsen(Request $request)
    {
        if ($request->pilihAbsen == "SISTEM") {
            $getAbsen = DB::table('administrasi_payroll')->select('potongan_absen', 'stb', 'gapok', 'prestasi', 'tjabat', 'potongan_absen_fix')->where('periode', '=', $request->periode)->get();
        } elseif ($request->pilihAbsen == "INPUT") {
            $getAbsen = DB::table('administrasi_payroll')->select('potongan_absen_input', 'stb', 'gapok', 'prestasi', 'tjabat', 'potongan_absen_fix')->where('periode', '=', $request->periode)->get();
        }

        foreach ($getAbsen as $key) {
            DB::table('administrasi_payroll')
                ->where('periode', '=', $request->periode)
                ->where('stb', '=', $key->stb)
                ->update(
                    array(
                        'potongan_absen_fix' => $key->potongan_absen_input,
                        'potongan_absen_rp' => - (($key->gapok + $key->prestasi + $key->tjabat) / 25) * $key->potongan_absen_fix,
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );
        }
        // notifikasi dengan session
        Session::flash('success', 'Data Berhasil Diperbarui!');

        $judul = "Kelola Absensi";
        $administrasi = "active";
        $payroll = "active";

        $getTambahan = DB::table('administrasi_payroll')->where('periode', '=', $request->periode)->get();

        return view('products/04_administrasi.tambahanAbsensi', [
            'judul' => $judul,
            'administrasi' => $administrasi,
            'payroll' => $payroll,
            'payroll' => $payroll,
            'periode' => $request->periode,
            'absensi' => $getTambahan,
        ]);
    }

    public function kelolalevel(Request $request)
    {
        $judul = "Kelola Data Karyawan";
        $administrasi = "active";
        $payroll = "active";

        $periode = substr($request->selectedyear, -2) . $request->selectedmonth;

        $getTambahan = DB::table('administrasi_payroll')->where('periode', '=', $periode)->orderBy('nama')->get();

        return view('products/04_administrasi.kelolaKaryawan', [
            'judul' => $judul,
            'administrasi' => $administrasi,
            'payroll' => $payroll,
            'periode' => $periode,
            'absensi' => $getTambahan,
        ]);
    }

    public function editLevelKaryawan(Request $request)
    {

        $data = DB::table('administrasi_payroll')->where('id', $request->id)->get();
        foreach ($data as $u) {
            echo '
                    <div class="mb-3">
                        <label class="form-label">STB</label>
                        <input type="text" class="form-control" disabled value="' . $u->stb . '" />
                        <input type="hidden" name="periode" value="' . $u->periode . '" />
                        <input type="hidden" name="userid" value="' . $u->userid . '" />
                        <input type="hidden" name="stb" value="' . $u->stb . '" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" disabled value="' . $u->nama . '" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Level Gaji</label>
                        <input type="text" list="levels" name="level" class="form-control" value="' . $u->level . '" />
                        <datalist id="levels">
                            <option value="UNIT 1">
                            <option value="UNIT 2">
                            <option value="UMUM">
                            <option value="STAFF">
                            <option value="TFI">
                            <option value="TFO">
                            <option value="WCR & WORKSHOP">
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tunj. Jabatan</label>
                        <input type="text" name="tjabat" class="form-control" value="' . $u->tjabat . '" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prestasi</label>
                        <input type="text" name="prestasi" class="form-control" value="' . $u->prestasi . '" />
                    </div>
            ';
        }
    }

    public function storeUpdateLevelKaryawan(Request $request)
    {
        $request->validate(
            [
                '_token' => 'required',
            ],
        );
        $check = DB::table('penerimaan_karyawan')
            ->where('userid', $request->userid)
            ->limit(1)
            ->update(
                array(
                    'level' => $request->level,
                    'tjabat' => $request->tjabat,
                    'tprestasi' => $request->prestasi,
                    'updated_at' => date('Y-m-d H:i:s'),
                )
            );

        DB::table('administrasi_payroll')
            ->where('periode', $request->periode)
            ->where('userid', $request->userid)
            ->limit(1)
            ->update(
                array(
                    'level' => $request->level,
                    'tjabat' => $request->tjabat,
                    'prestasi' => $request->prestasi,
                    'updated_at' => date('Y-m-d H:i:s'),
                )
            );

        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data: ' . $request->nama . ' telah berhasil diubah', 'status' => true);
        }
        return Response()->json($arr);
    }

    public function exportPayroll()
    {
        $file_path = public_path('file_excel/ContohUploadPayroll.xlsx');
        $file_name = 'Contoh Format Upload Tambahan dan Potongan Payroll.xlsx';

        return response()->download($file_path, $file_name);
    }

    public function exportAbsenPayroll()
    {
        $file_path = public_path('file_excel/ContohUploadAbsenPayroll.xlsx');
        $file_name = 'Contoh Format Upload Absensi Payroll.xlsx';

        return response()->download($file_path, $file_name);
    }

    public function bpjs()
    {
        $judul = "BPJS";
        $administrasi = "active";
        $bpjs = "active";

        $bpjs_jkk = DB::table('daftar_upah')
            ->where('jenis', '=', 'bpjs_jkk')
            ->get();
        $bpjs_jkm = DB::table('daftar_upah')
            ->where('jenis', '=', 'bpjs_jkm')
            ->get();
        $bpjs_jp = DB::table('daftar_upah')
            ->where('jenis', '=', 'bpjs_jp')
            ->get();
        $bpjs_jht = DB::table('daftar_upah')
            ->where('jenis', '=', 'bpjs_jht')
            ->get();
        $bpjs_ks = DB::table('daftar_upah')
            ->where('jenis', '=', 'bpjs_ks')
            ->get();

        foreach ($bpjs_jkk as $k) {
            $pkbpjs_jkk = $k->id;
            $nobpjs_jkk = $k->nominal;
        }
        foreach ($bpjs_jkm as $l) {
            $pkbpjs_jkm = $l->id;
            $nobpjs_jkm = $l->nominal;
        }
        foreach ($bpjs_jp as $m) {
            $pkbpjs_jp = $m->id;
            $nobpjs_jp = $m->nominal;
        }
        foreach ($bpjs_jht as $n) {
            $pkbpjs_jht = $n->id;
            $nobpjs_jht = $n->nominal;
        }
        foreach ($bpjs_ks as $o) {
            $pkbpjs_ks = $o->id;
            $nobpjs_ks = $o->nominal;
        }

        return view('products/04_administrasi.bpjs', [
            'judul' => $judul,
            'administrasi' => $administrasi,
            'bpjs' => $bpjs,

            'pkbpjs_jkk' => $pkbpjs_jkk,
            'nobpjs_jkk' => $nobpjs_jkk,

            'pkbpjs_jkm' => $pkbpjs_jkm,
            'nobpjs_jkm' => $nobpjs_jkm,

            'pkbpjs_jp' => $pkbpjs_jp,
            'nobpjs_jp' => $nobpjs_jp,

            'pkbpjs_jht' => $pkbpjs_jht,
            'nobpjs_jht' => $nobpjs_jht,

            'pkbpjs_ks' => $pkbpjs_ks,
            'nobpjs_ks' => $nobpjs_ks,
        ]);
    }

    public function listBPJSKaryawan(Request $request)
    {
        $data = DB::table('penerimaan_karyawan')->where('id', $request->id)->get();
        foreach ($data as $u) {
            $jkk = !empty($u->bpjs_jkk) ? 'checked=""' : "";
            $jkm = !empty($u->bpjs_jkm) ? 'checked=""' : "";
            $jp = !empty($u->bpjs_jp) ? 'checked=""' : "";
            $jht = !empty($u->bpjs_jht) ? 'checked=""' : "";
            $ks = !empty($u->bpjs_ks) ? 'checked=""' : "";
            echo '
                    <script>
                        $("#jkk").on("change", function() {
                            if ($(this).is(":checked")) {
                                $(this).attr("value", "1");
                            } else {
                                $(this).attr("value", "0");
                            }
                        });
                        $("#jkm").on("change", function() {
                            if ($(this).is(":checked")) {
                                $(this).attr("value", "1");
                            } else {
                                $(this).attr("value", "0");
                            }
                        });
                        $("#jp").on("change", function() {
                            if ($(this).is(":checked")) {
                                $(this).attr("value", "1");
                            } else {
                                $(this).attr("value", "0");
                            }
                        });
                        $("#jht").on("change", function() {
                            if ($(this).is(":checked")) {
                                $(this).attr("value", "1");
                            } else {
                                $(this).attr("value", "0");
                            }
                        });
                        $("#ks").on("change", function() {
                            if ($(this).is(":checked")) {
                                $(this).attr("value", "1");
                            } else {
                                $(this).attr("value", "0");
                            }
                        });
                    </script>
                    <table class="table text-center">
                        <tbody>
                            <tr>
                                <input type="hidden" name="id" value="' . $u->id . '">
                                <th>' . $u->nama . ' <br> ( ' . $u->nik . ' )</th>
                            </tr>
                        </tbody>
                    </table>
                    <div class="divide-y">
                        <div>
                            <label class="row">
                                <span class="col">Jaminan Kecelakaan Kerja (JKK)</span>
                                <span class="col-auto">
                                    <label class="form-check form-check-single form-switch">
                                        <input class="form-check-input" type="checkbox" ' . $jkk . ' id="jkk" value="' . $u->bpjs_jkk . '" name="jkk">
                                    </label>
                                </span>
                            </label>
                        </div>
                        <div>
                            <label class="row">
                                <span class="col">Jaminan Kematian (JKM)</span>
                                <span class="col-auto">
                                <label class="form-check form-check-single form-switch">
                                    <input class="form-check-input" type="checkbox" ' . $jkm . ' id="jkm" value="' . $u->bpjs_jkm . '" name="jkm">
                                </label>
                                </span>
                            </label>
                        </div>
                        <div>
                            <label class="row">
                                <span class="col">Jaminan Pensiun (JP)</span>
                                <span class="col-auto">
                                <label class="form-check form-check-single form-switch">
                                    <input class="form-check-input" type="checkbox" ' . $jp . ' id="jp" value="' . $u->bpjs_jp . '" name="jp">
                                </label>
                                </span>
                            </label>
                        </div>
                        <div>
                            <label class="row">
                                <span class="col">Jaminan Hari Tua (JHT)</span>
                                <span class="col-auto">
                                <label class="form-check form-check-single form-switch">
                                    <input class="form-check-input" type="checkbox" ' . $jht . ' id="jht" value="' . $u->bpjs_jht . '" name="jht">
                                </label>
                                </span>
                            </label>
                        </div>
                        <div>
                            <label class="row">
                                <span class="col">BPJS Kesehatan</span>
                                <span class="col-auto">
                                <label class="form-check form-check-single form-switch">
                                    <input class="form-check-input" type="checkbox" ' . $ks . ' id="ks" value="' . $u->bpjs_ks . '" name="ks">
                                </label>
                                </span>
                            </label>
                        </div>
                        <div>
                            <label class="row">
                                <span class="col">Tanggungan</span>
                                <span class="col-auto">
                                    <input class="form-control" type="number" value="' . $u->bpjs_ksAdd . '" min="0" name="ksadd">
                                </span>
                            </label>
                        </div>
                        <div>
                            <label class="row">
                                <span class="col">Fasilitas Kesehatan</span>
                                <span class="col-auto">
                                    <input class="form-control" type="text" name="faskes" value="' . $u->faskes_bpjs . '">
                                </span>
                            </label>
                        </div>
                    </div>
            ';
        }
    }

    public function updateBPJS(Request $request)
    {
        $jkk = ($request->jkk == "1") ? $request->jkk : '0';
        $jkm = ($request->jkm == "1") ? $request->jkm : '0';
        $jp = ($request->jp == "1") ? $request->jp : '0';
        $jht = ($request->jht == "1") ? $request->jht : '0';
        $ks = ($request->ks == "1") ? $request->ks : '0';
        $ksadd = ($request->ksadd == "1") ? $request->ksadd : '0';
        if ($request->ajax()) {
            DB::table('penerimaan_karyawan')
                ->where('id', $request->id)
                ->limit(1)
                ->update(
                    array(
                        'bpjs_jkk' => $jkk,
                        'bpjs_jkm' => $jkm,
                        'bpjs_jp' => $jp,
                        'bpjs_jht' => $jht,
                        'bpjs_ks' => $ks,
                        'bpjs_ksAdd' => $ksadd,
                        'faskes_bpjs' => $request->faskes,
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );
            return response()->json(['success' => true]);
        }
    }

    public function updateUpahBpjs(Request $request)
    {
        if ($request->ajax()) {
            DB::table('daftar_upah')
                ->where('id', $request->name)
                ->update(
                    array(
                        'nominal' => $request->value,
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );
            // DB::table('penerimaan_karyawan')
            // ->where('status', 'LIKE', '%Aktif%')
            // ->update(
            //     array(
            //         'gapok' => $request->value,
            //         'updated_at' => date('Y-m-d H:i:s'),
            //     )
            // );
            return response()->json(['success' => true]);
        }
    }

    public function terlambat()
    {
        $judul = "Keterlambatan";
        $administrasi = "active";
        $terlambat = "active";

        return view('products/04_administrasi.terlambat', [
            'judul' => $judul,
            'administrasi' => $administrasi,
            'terlambat' => $terlambat,
        ]);
    }

    public function lembur()
    {
        $judul = "Lemburan";
        $administrasi = "active";
        $lembur = "active";

        return view('products/04_administrasi.lembur', [
            'judul' => $judul,
            'administrasi' => $administrasi,
            'lembur' => $lembur,
        ]);
    }
}
