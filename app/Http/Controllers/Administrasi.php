<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Imports\ImportExcelPayroll;
use Illuminate\Support\Facades\Session;
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
        $karyawanAktif = DB::table('penerimaan_karyawan')
            ->where('status', 'LIKE', '%Aktif%')
            ->orderBy('userid', 'asc')
            ->get();

        foreach ($karyawanAktif as $key) {
            // cek karyawan
            $cekUpdateKaryawan = DB::table('administrasi_payroll')
                ->where('userid', '=', $key->userid)
                ->where('periode', '=', $periode)
                ->first();
            // menemukan karyawan sesuai, update
            $hadir  = $this->absensi('H', $key->userid, date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")), $request->tahun . '-' . $request->bulan . '-15');
            $sakit  = $this->absensi('S', $key->userid, date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")), $request->tahun . '-' . $request->bulan . '-15');
            $izin   = $this->absensi('I', $key->userid, date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")), $request->tahun . '-' . $request->bulan . '-15');
            $alpha  = $this->absensi('A', $key->userid, date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")), $request->tahun . '-' . $request->bulan . '-15');

            $bpjs_jkk   = $this->get_bpjs('bpjs_jkk', $key->stb);
            $bpjs_jkm   = $this->get_bpjs('bpjs_jkm', $key->stb);
            $bpjs_jp    = $this->get_bpjs('bpjs_jp', $key->stb);
            $bpjs_jht   = $this->get_bpjs('bpjs_jht', $key->stb);
            $bpjs_ks    = $this->get_bpjs('bpjs_ks', $key->stb);
            $bpjs_ksAdd = $this->get_bpjs('bpjs_ksAdd', $key->stb);

            if ($cekUpdateKaryawan) {
                DB::table('administrasi_payroll')
                    ->where('userid', '=', $key->userid)
                    ->where('periode', '=', $periode)
                    ->limit(1)
                    ->update(
                        array(
                            'potongan_absen' => ($sakit + $izin),
                            'pot_bpjs_jp' => $bpjs_jp,
                            'pot_bpjs_ks' => $bpjs_ks,
                            'H' => $hadir,
                            'S' => $sakit,
                            'I' => $izin,
                            'A' => $alpha,
                            'updated_at' => date('Y-m-d H:i:s'),
                        )
                    );
                Session::flash('success', 'Data Berhasil Diperbarui untuk data Payroll');
            }
        }
    }

    public function uploadTambahanPayroll(Request $request)
    {
        $judul = "Koperasi & Pinjaman";
        $administrasi = "active";
        $payroll = "active";

        $periode = substr($request->selectedyear, -2) . $request->selectedmonth;

        $getTambahan = DB::table('administrasi_payrolldtl')->where('periode', '=', $periode)->get();

        return view('products/04_administrasi.tambahanPayroll', [
            'judul' => $judul,
            'administrasi' => $administrasi,
            'payroll' => $payroll,
            'periode' => $periode,
            'tambahan' => $getTambahan,
        ]);
    }

    private function absensi($params, $userid, $start, $end)
    {
        $absensi = DB::table('absensi_absensi')
            ->select(DB::raw("SUM(IF(sst = '$params', 1, 0)) as Result"))
            ->where('userid', '=', $userid)
            ->whereBetween('tanggal', [$start, $end])
            ->get();
        foreach ($absensi as $a) {
            $result = $a->Result;
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
        } elseif ($jenis == 'bpjs_ks') {
            $bpjs = DB::table('daftar_upah')
                ->where('jenis', '=', 'bpjs_ks')
                ->first();
        } elseif ($jenis == 'bpjs_jp') {
            $bpjs = DB::table('daftar_upah')
                ->where('jenis', '=', 'bpjs_jp')
                ->first();
        }

        if ($karyawanAktif->bpjs_ks > 0) {
            $res = - ($karyawanAktif->gapok * $bpjs->nominal) / 100;
        } else {
            $res = null;
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

    public function exportPayroll()
    {
        $file_path = public_path('file_excel/ContohUploadPayroll.xlsx');
        $file_name = 'Contoh Format Upload Tambahan dan Potongan Payroll.xlsx';

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

    public function rekapPayroll(Request $request)
    {
        $bulan = array(
            1 =>   'Januari',
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
        echo '
                <div class="card">
                    <div class="card-header">
                        <h5 class="modal-title">Rekap Payroll Periode ' . $bulan[(int)$request->bulan] . ', ' . $request->tahun . '</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th>Grup</th>
                                    <th>Jml Karyawan</th>
                                    <th>Gaji Bruto</th>
                                    <th>Koperasi</th>
                                    <th>Infaq</th>
                                    <th>Lainnya</th>
                                    <th>BPJS TK</th>
                                    <th>BPJS Kesehatan</th>
                                    <th>Absensi</th>
                                    <th>Total Potongan</th>
                                    <th>Gaji Netto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Grup</th>
                                    <th>Jml Karyawan</th>
                                    <th>Gaji Bruto</th>
                                    <th>Koperasi</th>
                                    <th>Infaq</th>
                                    <th>Lainnya</th>
                                    <th>BPJS TK</th>
                                    <th>BPJS Kesehatan</th>
                                    <th>Absensi</th>
                                    <th>Total Potongan</th>
                                    <th>Gaji Netto</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Tutup</button>
                </div>
            ';
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
}
