<?php

namespace App\Http\Controllers;

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
                ->where('id', $request->id)
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
            $hadir = $this->absensi('H', $key->userid, date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")), $request->tahun . '-' . $request->bulan . '-15');
            $sakit = $this->absensi('S', $key->userid, date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")), $request->tahun . '-' . $request->bulan . '-15');
            $izin = $this->absensi('I', $key->userid, date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")), $request->tahun . '-' . $request->bulan . '-15');
            $alpha = $this->absensi('A', $key->userid, date("Y-m-d", strtotime($request->tahun . '-' . $request->bulan . '-16' . "-1 month")), $request->tahun . '-' . $request->bulan . '-15');

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
                            'bank' => $key->banknm,
                            'rekening' => $key->bankrek,
                            'H' => $hadir,
                            'S' => $sakit,
                            'I' => $izin,
                            'A' => $alpha,
                            'potongan_infaq' => '-5000',
                            'updated_at' => date('Y-m-d H:i:s'),
                        )
                    );
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
                            'umr' => $key->gapok,
                            'gapok' => $key->gapok,
                            'bank' => $key->banknm,
                            'rekening' => $key->bankrek,
                            'H' => $hadir,
                            'S' => $sakit,
                            'I' => $izin,
                            'A' => $alpha,
                            'potongan_infaq' => '-5000',
                            'updated_at' => date('Y-m-d H:i:s'),
                        )
                    );
            }

            // $karyawanPayroll = DB::table('administrasi_payroll')->where('userid', '=', $key->userid)->where('periode', '=', $periode)->get();
            // foreach ($karyawanPayroll as $p) {
            //     $absensi = DB::table('absensi_absensi')
            //         ->select(DB::raw("
            //             SUM(IF(sst = 'H', 1, 0)) as Hadir,
            //             SUM(IF(sst = 'S', 1, 0)) as Sakit,
            //             SUM(IF(sst = 'I', 1, 0)) as Izin,
            //             SUM(IF(sst = 'A', 1, 0)) as Alpha
            //         "))
            //         ->where('stb', '=', $key->stb)
            //         ->whereBetween('tanggal', [$p->dari, $p->sampai])
            //         ->get();
            //     foreach ($absensi as $a) {
            //         DB::table('administrasi_payroll')
            //             ->where('id', '=', $p->id)
            //             ->limit(1)
            //             ->update(
            //                 array(
            //                     'H' => $a->Hadir,
            //                     'S' => $a->Sakit,
            //                     'I' => $a->Izin,
            //                     'A' => $a->Alpha,
            //                 )
            //             );
            //     }
            // }
        }
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

        // membuat nama file unik
        $nama_file = 'Periode-' . $request->periode . '_upload-' . date('Ymd') . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_excel', $nama_file);

        // import data
        // ExcelM::import(new ImportExcelTest, public_path('/file_excel/' . $nama_file));
        $folder = public_path('file_excel/' . $nama_file);
        ExcelM::import(new ImportExcelPayroll, $folder);

        // notifikasi dengan session
        Session::flash('success', 'Data Payroll Berhasil Diimport!');

        // alihkan halaman kembali
        return redirect()->back()->with('success', 'Data Payroll Berhasil Diimport!');
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

        $gapok = DB::table('daftar_upah')
            ->where('jenis', '=', 'gapok')
            ->get();

        foreach ($gapok as $k) {
            $pkumr = $k->id;
            $nominal = $k->nominal;
        }

        return view('products/04_administrasi.bpjs', [
            'judul' => $judul,
            'administrasi' => $administrasi,
            'bpjs' => $bpjs,
            'nominal' => $nominal,
            'pkumr' => $pkumr,
        ]);
    }
}
