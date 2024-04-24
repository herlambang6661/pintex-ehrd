<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

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

        return view('products/04_administrasi.payroll', [
            'judul' => $judul,
            'administrasi' => $administrasi,
            'payroll' => $payroll
        ]);
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
        // set periode
        $periode = substr($request->tahun, -2) . "" . $request->bulan;
        // get karyawan yang aktif
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
                            'potongan_infaq' => '-5000',
                            'updated_at' => date('Y-m-d H:i:s'),
                        )
                    );
            }
        }
    }
}
