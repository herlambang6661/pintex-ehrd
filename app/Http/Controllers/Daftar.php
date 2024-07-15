<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Shift;
use Illuminate\Http\Request;
use App\Models\Pos_pekerjaan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Daftar extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Jakarta');
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    }

    //Surat-surat
    public function surat()
    {
        return view('products/01_daftar.surat');
    }

    public function storeSurat(Request $request)
    {
        $request->validate(
            [
                '_token' => 'required',
                'entitas' => 'required',
                'jenissurat' => 'required',
                'nmsurat' => 'required',
            ],
        );

        $check = DB::table('daftar_surat')->insert([
            'remember_token' => $request->_token,
            'entitas' => $request->entitas,
            'jenissurat' => $request->jenissurat,
            'nmsurat' => $request->nmsurat,
            'nilai' => $request->nilai,
            'dibuat' => Auth::user()->name,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data: ' . $request->jenissurat . ' ' . $request->nmsurat . ' ' . $request->nilai . ' telah berhasil disimpan', 'status' => true);
        }
        return Response()->json($arr);
    }

    public function updatesurat(Request $request)
    {
        $request->validate([
            '_token'    => 'required',
            'id'        => 'required',
            'entitas'   => 'required',
            'jenissurat'      => 'required',
            'nmsurat'      => 'required',
            'nilai'      => 'required',
        ]);

        $check = DB::table('daftar_surat')
            ->where('id', $request->id)
            ->update([
                'entitas'       => $request->entitas,
                'jenissurat'          => $request->jenissurat,
                'nmsurat'          => $request->nmsurat,
                'nilai'          => $request->nilai,
                'dibuat'        => Auth::user()->name,
                'updated_at'    => now(),
            ]);

        $arr = array('msg' => 'Ada yang salah. Silakan coba lagi nanti.', 'status' => false);

        if ($check !== false) {
            $arr = array('msg' => 'Data: ' . $request->entitas . ' ' . $request->jenissurat . ' ' . $request->nmsurat . ' ' . $request->nilai . ' berhasil diperbarui', 'status' => true);
        }

        return response()->json($arr);
    }

    public function viewsurat(Request $request)
    {
        $data = DB::table('daftar_surat')->where('id', $request->id)->get();
        foreach ($data as $s) {
            echo '
            <div class="card-stamp card-stamp-lg">
                            <div class="card-stamp-icon bg-primary">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Entitas</label>
                            <input type="text" class="form-control border border-dark" name="" id="" value="' . $s->entitas . '" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Surat</label>
                            <input type="text" class="form-control border border-dark" name="" id="" value="' . $s->jenissurat . '" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Surat</label>
                            <input type="text" class="form-control border border-dark" name="" id="" value="' . $s->nmsurat . '" readonly>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nilai</label>
                                    <input type="text" class="form-control border border-dark" name=""
                                        id="" value="' . $s->nilai . '" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Dibuat</label>
                                    <input type="text" class="form-control border border-dark" name=""
                                        id="" value="' . $s->dibuat . '" readonly>
                                </div>
                            </div>
                        </div>
                        </div>
        ';
        }
    }

    //Pos_pekerjaan
    public function pos()
    {
        $judul = "Pos-Pekerjaan";
        $Pospekerjaan = "active";
        $pos = "active";
        return view('products.01_daftar.pos_pekerjaan', [
            'judul' => $judul,
            'Pospekerjaan' => $Pospekerjaan,
            'pos' => $pos
        ]);
    }

    public function storePos(Request $request)
    {
        $request->validate(
            [
                '_token'    => 'required',
                'entitas'   => 'required',
                'type'      => 'required',
                'desc'      => 'required',
            ],
        );

        $check = DB::table('daftar_pospekerjaan')->insert([
            'remember_token' => $request->token,
            'entitas'       => $request->entitas,
            'type'          => $request->type,
            'desc'          => $request->desc,
            'dibuat'        => Auth::user()->name,
            'created_at'    => date('Y-m-d H:i:s'),
        ]);
        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data: ' . $request->entitas . ' ' . $request->type . '' . $request->desc . ' telah berhasil disimpan', 'status' => true);
        }
        return Response()->json($arr);
    }

    public function listPos(Request $request)
    {
        $data = DB::table('daftar_pospekerjaan')->where('id', $request->id)->get();
        foreach ($data as $l) {
            echo '
            <div class="row">
                <div class="col-lg-9">
                    <div class="card shadow bg-green-lt">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Entitas</label>
                                        <input type="text" class="form-control" name="" placeholder="" value="' . $l->entitas . '"
                                            style="border-color:black" readonly />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Type</label>
                                        <input type="text" class="form-control" name="" placeholder="" value="' . $l->type . '"
                                            style="border-color:black" readonly />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Desc</label>
                                        <input type="text" class="form-control" name="" placeholder="" value="' . $l->desc . '"
                                            style="border-color:black" readonly />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Dibuat</label>
                                        <input type="text" class="form-control" name="" placeholder="" value="' . $l->dibuat . '"
                                            style="border-color:black" readonly />
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

    public function updatePos(Request $request)
    {
        $request->validate([
            '_token'    => 'required',
            'id'        => 'required',
            'entitas'   => 'required',
            'type'      => 'required',
            'desc'      => 'required',
        ]);

        $check = DB::table('daftar_pospekerjaan')
            ->where('id', $request->id)
            ->update([
                'entitas'       => $request->entitas,
                'type'          => $request->type,
                'desc'          => $request->desc,
                'dibuat'        => Auth::user()->name,
                'updated_at'    => now(),
            ]);

        $arr = array('msg' => 'Ada yang salah. Silakan coba lagi nanti.', 'status' => false);

        if ($check !== false) {
            $arr = array('msg' => 'Data: ' . $request->entitas . ' ' . $request->type . ' ' . $request->desc . ' berhasil diperbarui', 'status' => true);
        }

        return response()->json($arr);
    }

    //Tarif_lembur
    public function tariflembur()
    {
        $judul = "Tarif-Lembur";
        $Tariflembur = "active";
        $lembur = "active";
        return view('products.01_daftar.tarif_lembur', [
            'judul' => $judul,
            'Tariflembur' => $Tariflembur,
            'lembur' => $lembur
        ]);
    }

    public function storelembur(Request $request)
    {
        $request->validate(
            [
                'entitas' => 'required',
                'basic' => 'required',
                'level' => 'required',
                'kjk'   => 'required',
                'insidentil' => 'required',
            ],
        );

        $check = DB::table('daftar_tarif_lembur')->insert([
            'entitas' => $request->entitas,
            'basic' => $request->basic,
            'level' => $request->level,
            'kjk'   => $request->kjk,
            'insidentil' => $request->insidentil,
        ]);
        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data: ' . $request->basic . ' ' . $request->level . '' . $request->kjk . '' . $request->insidentil . ' telah berhasil disimpan', 'status' => true);
        }
        return Response()->json($arr);
    }

    public function lemburview(Request $request)
    {
        $data = DB::table('daftar_tarif_lembur')->where('id', $request->id)->get();
        foreach ($data as $b) {
            echo '
            <div class="card-stamp card-stamp-lg">
                            <div class="card-stamp-icon bg-primary">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Shift</label>
                            <input type="text" class="form-control border border-dark" name="shift" id="shift"
                                placeholder="Masukkan Nama Shift" value="' . $b->entitas . '" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis</label>
                            <input type="text" class="form-control border border-dark" name="jenis" id="jenis"
                                placeholder="Masukkan Jenis Shift" value="' . $b->basic . '" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis</label>
                            <input type="text" class="form-control border border-dark" name="jenis" id="jenis"
                                placeholder="Masukkan Jenis Shift" value="' . $b->level . '" readonly>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Kjk</label>
                                    <input type="text" class="form-control border border-dark" name="kjk"
                                        id="kjk" placeholder="Masukkan kjk" value="' . $b->kjk . '" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">insidentil</label>
                                    <input type="text" class="form-control border border-dark" name="insidentil"
                                        id="insidentil" placeholder="Masukkan insidentil" value="' . $b->insidentil . '" readonly>
                                </div>
                            </div>
                        </div>
                        </div>
        ';
        }
    }

    public function updatelembur(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'entitas' => 'required',
            'basic' => 'required',
            'level' => 'required',
            'kjk' => 'required',
            'insidentil' => 'required',
        ]);

        $check = DB::table('daftar_tarif_lembur')
            ->where('id', $request->id)
            ->update([
                'entitas' => $request->entitas,
                'basic' => $request->basic,
                'level' => $request->level,
                'kjk' => $request->kjk,
                'insidentil' => $request->insidentil,
                'updated_at'    => now(),
            ]);

        $arr = array('msg' => 'Ada kesalahan. Silakan coba lagi nanti.', 'status' => false);

        if ($check) {
            $arr = array('msg' => 'Data: ' . $request->entitas . ' ' . $request->basic . ' ' . $request->level . ' ' . $request->kjk . ' ' . $request->insidentil . ' berhasil diperbarui', 'status' => true);
        }

        return response()->json($arr);
    }


    //Daftar Hari Libur Nasional
    public function liburnas()
    {
        $judul = "Hari Libur Nasional";
        $Harilibur = "active";
        $libur = "active";
        return view('products.01_daftar.hari_libur_nasional', [
            'judul' => $judul,
            'daftar' => $Harilibur,
            'libur' => $libur,
        ]);
        // return view('products.01_daftar.hari_libur_nasional_new', [
        //     'judul' => $judul,
        //     'daftar' => $Harilibur,
        //     'libur' => $libur,
        // ]);
    }

    public function prosesLibnas($id)
    {

        $libnas = DB::table('daftar_hari_libur_nasional')->where('id', $id)->first();
        $absens = DB::table('absensi_absensi')->where('tanggal', '=', $libnas->tanggal)->get();
        try {
            foreach ($absens as $key) {
                if ($key->raw_sst == 'A' || $key->raw_sst == 'L') {
                    $up = DB::table('absensi_absensi')
                        ->where('tanggal', '=', $libnas->tanggal)
                        ->where('userid', '=', $key->userid)
                        ->update(
                            array(
                                'sst' => 'L',
                                'updated_at' => date('Y-m-d H:i:s'),
                            )
                        );
                } elseif ($key->raw_sst == 'H' || $key->raw_sst == 'F1' || $key->raw_sst == 'F2' || $key->raw_sst == '½') {
                    $up = DB::table('absensi_absensi')
                        ->where('tanggal', '=', $libnas->tanggal)
                        ->where('userid', '=', $key->userid)
                        ->update(
                            array(
                                'sst' => 'LS',
                                'updated_at' => date('Y-m-d H:i:s'),
                            )
                        );
                }
            }
            // Session::flash('success', 'Data Payroll Berhasil Diimport!');
            return redirect('/daftar/liburnas')->with('success', 'Berhasil Diperbarui');
        } catch (\Throwable $th) {
            return redirect('/daftar/liburnas')->with('error', 'Gagal Diperbarui,' . $th);
        }
    }

    public function kembalikanLibnas($tgl)
    {
        $libnas = DB::table('absensi_absensi')->where('tanggal', $tgl)->get();
        foreach ($libnas as $key) {
            DB::table('absensi_absensi')
                ->where('tanggal', '=', $key->tanggal)
                ->update(
                    array(
                        'sst' => $key->raw_sst,
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );
        }
        return response()->json(['success' => true]);
    }

    public function getLibur(Request $request)
    {
        $absen = DB::table('daftar_hari_libur_nasional')
            ->where('tahun', $request->thn)
            ->orderBy('libur_nasional')
            ->get();
        echo '
            <table style="width:100%; font-family: "Trebuchet MS", Helvetica, sans-serif;"
                class="display table table-vcenter card-table table-sm table-bordered table-hover text-nowrap datatable-libur"
                id="tblamaran">
                <thead>
                    <tr class="text-center">
                        <th>Opsi</th>
                        <th>Tanggal</th>
                        <th>Tahun</th>
                        <th>Libur Nasional</th>
                        <th>Sumber Ketentuan</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>';
        foreach ($absen as $key) {
            echo '<body>
                    <tr>
                        <td class="text-center"><button class="btn btn-danger btn-icon" />
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        </td>
                        <td class="text-center">
                            <a href="" class="editable" data-type="text" data-viewformat="yyyy-mm-dd" data-name="' . $key->id . '" data-pk="' . $key->id . '">' . $key->tanggal . '</a>
                        </td>
                        <td class="text-center">' . $key->tahun . '</td>
                        <td>' . $key->libur_nasional . '</td>
                        <td class="text-center">' . $key->sumber_ketentuan . '</td>
                        <td class="text-center">' . $key->keterangan . '</td>
                    </tr>
                </body>
            ';
        }
        echo '</table>';
        echo '
            
                <script>
                    $.fn.editable.defaults.mode = "inline";

                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": "' . csrf_token() . '"
                        }
                    });

                    $(".editable").editable({
                        url: "/liburnas/update",
                        type: "date",
                        pk: 1,
                    });
                </script>
        ';
    }

    public function updatelibur(Request $request)
    {
        $up = DB::table('daftar_hari_libur_nasional')
            ->where('id', '=', $request->id)
            ->update(
                array(
                    'tanggal' => $request->tanggal,
                    'tahun' => Carbon::parse($request->tanggal)->format('Y'),
                    'libur_nasional' => $request->libur_nasional,
                    'sumber_ketentuan' => $request->sumber_ketentuan,
                    'keterangan' => $request->keterangan,
                    'updated_at' => date('Y-m-d H:i:s'),
                )
            );
        return response()->json(['success' => true]);
    }

    public function storelibur(Request $request)
    {
        $request->validate(
            [
                'entitas' => 'required',
                'tanggal' => 'required',
                'libur_nasional' => 'required',
                'sumber_ketentuan'   => 'required',
            ],
        );

        $check = DB::table('daftar_hari_libur_nasional')->insert([
            'entitas' => $request->entitas,
            'tanggal' => $request->tanggal,
            'tahun' => Carbon::parse($request->tanggal)->format('Y'),
            'libur_nasional' => $request->libur_nasional,
            'sumber_ketentuan'   => $request->sumber_ketentuan,
            'keterangan' => $request->keterangan,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data: ' . $request->tanggal . ' ' . $request->libur_nasional . '' . $request->sumber_ketentuan . '' . $request->keterangan . ' telah berhasil disimpan', 'status' => true);
        }
        return Response()->json($arr);
    }

    public function liburnasview(Request $request)
    {
        $data = DB::table('daftar_hari_libur_nasional')->where('id', $request->id)->get();
        foreach ($data as $n) {
            echo '
            <div class="card-stamp card-stamp-lg">
                            <div class="card-stamp-icon bg-primary">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Entitas</label>
                            <input type="text" class="form-control border border-dark" name="" id="" value="' . $n->entitas . '" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="text" class="form-control border border-dark" name="" id="" value="' . $n->tanggal . '" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Libur Nasional</label>
                            <input type="text" class="form-control border border-dark" name="" id="" value="' . $n->libur_nasional . '" readonly>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Sumber Ketentuan</label>
                                    <input type="text" class="form-control border border-dark" name=""
                                        id="" value="' . $n->sumber_ketentuan . '" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <input type="text" class="form-control border border-dark" name=""
                                        id="" value="' . $n->keterangan . '" readonly>
                                </div>
                            </div>
                        </div>
                        </div>
        ';
        }
    }

    public function generateLiburNasional(Request $request)
    {
        $arrayLiburNas = array(
            array("id" => 1, "text" => "Tahun Baru Masehi",),
            array("id" => 2, "text" => "Isra Mi’raj Nabi Muhammad SAW",),
            array("id" => 3, "text" => "Tahun Baru Imlek",),
            array("id" => 4, "text" => "Hari Suci Nyepi Tahun Baru Saka",),
            array("id" => 5, "text" => "Wafat Isa Almasih",),
            array("id" => 6, "text" => "Hari Paskah",),
            array("id" => 7, "text" => "Hari Raya Idul Fitri",),
            array("id" => 8, "text" => "Hari Buruh Internasional",),
            array("id" => 9, "text" => "Kenaikan Isa Almasih",),
            array("id" => 10, "text" => "Hari Raya Waisak",),
            array("id" => 11, "text" => "Hari Lahir Pancasila",),
            array("id" => 12, "text" => "Hari Raya Idul Adha",),
            array("id" => 13, "text" => "Tahun Baru Islam",),
            array("id" => 14, "text" => "Hari Kemerdekaan RI",),
            array("id" => 15, "text" => "Maulid Nabi Muhammad SAW",),
            array("id" => 16, "text" => "Hari Raya Natal",),
            array("id" => 17, "text" => "Cuti Bersama Tahun Baru Imlek",),
            array("id" => 18, "text" => "Cuti Bersama Hari Suci Nyepi Tahun Baru Saka",),
            array("id" => 19, "text" => "Cuti Bersama Idul Fitri",),
            array("id" => 20, "text" => "Cuti Bersama Kenaikan Isa Al Masih",),
            array("id" => 21, "text" => "Cuti Bersama Hari Raya Waisak",),
            array("id" => 22, "text" => "Cuti Bersama Idul Adha",),
            array("id" => 23, "text" => "Cuti Bersama Hari Raya Natal",),
        );
        // print_r($arrayLiburNas);
        // die();
        $idn = 1;
        for ($i = 0; $i < count($arrayLiburNas); $i++) {
            $check = DB::table('daftar_hari_libur_nasional')
                ->where('id_libur', $idn)
                ->where('tahun', $request->year)
                ->first();
            if (!$check) {
                DB::table('daftar_hari_libur_nasional')
                    ->insert(
                        [
                            'entitas' => 'PINTEX',
                            'tahun' => $request->year,
                            'id_libur' => $arrayLiburNas[$i]['id'],
                            'libur_nasional' => $arrayLiburNas[$i]['text'],
                            'sumber_ketentuan' => 'PEMERINTAH',
                            // 'keterangan' => '',
                            'created_at' => date('Y-m-d H:i:s'),
                        ]
                    );
            }
            $idn++;
        }
        $arr = array('msg' => 'Data ' . $request->year . ' Berhasil di Generate Ulang.', 'status' => true);

        return response()->json($arr);
    }

    // public function updateliburnas(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required',
    //         'entitas' => 'required',
    //         'tanggal' => 'required',
    //         'libur_nasional' => 'required',
    //         'sumber_ketentuan' => 'required',
    //         'keterangan' => 'required',
    //     ]);

    //     $check = DB::table('daftar_hari_libur_nasional')
    //         ->where('id', $request->id)
    //         ->update([
    //             'entitas' => $request->entitas,
    //             'tanggal' => $request->tanggal,
    //             'libur_nasional' => $request->libur_nasional,
    //             'sumber_ketentuan' => $request->sumber_ketentuan,
    //             'keterangan' => $request->keterangan,
    //             'updated_at'    => now(),
    //         ]);

    //     $arr = array('msg' => 'Ada kesalahan. Silakan coba lagi nanti.', 'status' => false);

    //     if ($check) {
    //         $arr = array('msg' => 'Data: ' . $request->entitas . ' ' . $request->tanggal . ' ' . $request->libur_nasional . ' ' . $request->sumber_ketentuan . ' ' . $request->keterangan . ' berhasil diperbarui', 'status' => true);
    //     }

    //     return response()->json($arr);
    // }

    //Shift
    public function jadwalshift()
    {
        $judul = "Jadwal Shift";
        $Jadwalshift = "active";
        $shift = "active";
        return view('products.01_daftar.shift', [
            'judul' => $judul,
            'Jadwalshift' => $Jadwalshift,
            'shift' => $shift
        ]);
    }

    public function storeshift(Request $request)
    {
        $request->validate([
            'entitas' => 'required',
            'shift' => 'required',
            'jenis' => 'required',
            'in' => 'required',
            'out' => 'required',
            'keterangan' => 'required',
            'in_rest' => 'required',
            'out_rest' => 'required',
        ]);

        $check = DB::table('daftar_shift')->insert([
            'entitas' => $request->entitas,
            'shift' => $request->shift,
            'jenis' => $request->jenis,
            'in' => $request->in,
            'out' => $request->out,
            'keterangan' => $request->keterangan,
            'in_rest' => $request->in_rest,
            'out_rest' => $request->out_rest,
        ]);

        $arr = [
            'msg' => $check ? 'Data berhasil disimpan' : 'Gagal menyimpan data',
            'status' => $check
        ];

        return response()->json($arr);
    }


    public function shiftview(Request $request)
    {
        $data = DB::table('daftar_shift')->where('id', $request->id)->get();
        foreach ($data as $l) {
            echo '
            <div class="card-stamp card-stamp-lg">
                            <div class="card-stamp-icon bg-primary">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Shift</label>
                            <input type="text" class="form-control border border-dark" name="shift" id="shift"
                                placeholder="Masukkan Nama Shift" value="' . $l->shift . '" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis</label>
                            <input type="text" class="form-control border border-dark" name="jenis" id="jenis"
                                placeholder="Masukkan Jenis Shift" value="' . $l->jenis . '" readonly>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">In</label>
                                    <input type="time" class="form-control border border-dark" name="in"
                                        id="in" placeholder="Masukkan In" value="' . $l->in . '" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Out</label>
                                    <input type="time" class="form-control border border-dark" name="out"
                                        id="out" placeholder="Masukkan Out" value="' . $l->out . '" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <input type="text" class="form-control border border-dark" name="keterangan"
                                id="keterangan" placeholder="Masukkan Keterangan " value="' . $l->keterangan . '" readonly>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">In Rest</label>
                                    <input type="time" class="form-control border border-dark" name="in_rest"
                                        id="in_rest" placeholder="Masukkan In Rest" value="' . $l->in_rest . '" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Out Rest</label>
                                    <input type="time" class="form-control border border-dark" name="out_rest"
                                        id="out_rest" placeholder="Masukkan Out Rest" value="' . $l->out_rest . '" readonly>
                                </div>
                            </div>
                        </div>
                        </div>
        ';
        }
    }

    public function updateshif(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'entitas' => 'required',
            'shift' => 'required',
            'jenis' => 'required',
            'in' => 'required',
            'out' => 'required',
            'keterangan' => 'required',
            'in_rest' => 'required',
            'out_rest' => 'required',
        ]);

        $check = DB::table('daftar_shift')
            ->where('id', $request->id)
            ->update([
                'entitas' => $request->entitas,
                'shift' => $request->shift,
                'jenis' => $request->jenis,
                'in' => $request->in,
                'out' => $request->out,
                'keterangan' => $request->keterangan,
                'in_rest' => $request->in_rest,
                'out_rest' => $request->out_rest,
                'updated_at'    => now(),
            ]);

        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);

        if ($check) {
            $arr = array('msg' => 'Data: ' . $request->entitas . ' ' . $request->shift . ' ' . $request->jenis . '' . $request->in . '' . $request->out . '' . $request->keterangan . '' . $request->in_rest . '' . $request->out_rest . ' telah berhasil diupdate', 'status' => true);
        }

        return Response()->json($arr);
    }

    public function entitas()
    {
        $judul = "Daftar Entitas";
        $Daftarentitas = "active";
        $entitas = "active";
        return view('products.01_daftar.daftar_entitas', [
            'judul' => $judul,
            'Daftarentitas' => $Daftarentitas,
            'entitas' => $entitas,
        ]);
    }

    public function viewentitas(Request $request)
    {
        $data = DB::table('daftar_entitas')->where('id', $request->id)->get();
        foreach ($data as $l) {
            echo '
            <div class="card-stamp card-stamp-lg">
                            <div class="card-stamp-icon bg-primary">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Singkatan</label>
                            <input type="text" class="form-control border border-dark" name="singkatan" id="singkatan"
                                placeholder="Masukkan Nama singkatan" value="' . $l->singkatan . '" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control border border-dark" name="nama" id="nama"
                                placeholder="Masukkan nama Shift" value="' . $l->nama . '" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" class="form-control border border-dark" name="alamat" id="alamat"
                                placeholder="Masukkan alamat Shift" value="' . $l->alamat . '" readonly>
                        </div>
                        </div>
        ';
        }
    }

    public function storeentitas(Request $request)
    {
        $request->validate(
            [
                'singkatan' => 'required',
                'nama' => 'required',
                'alamat'   => 'required',
            ],
        );

        $check = DB::table('daftar_entitas')->insert([
            'singkatan' => $request->singkatan,
            'nama' => $request->nama,
            'alamat'   => $request->alamat,
        ]);
        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data: ' . $request->singkatan . ' ' . $request->nama . '' . $request->alamat . ' telah berhasil disimpan', 'status' => true);
        }
        return Response()->json($arr);
    }

    public function updateentitas(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'singkatan' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
        ]);

        $check = DB::table('daftar_entitas')
            ->where('id', $request->id)
            ->update([
                'singkatan' => $request->singkatan,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'updated_at'    => now(),

            ]);

        $arr = array('msg' => 'Ada kesalahan. Silakan coba lagi nanti.', 'status' => false);

        if ($check) {
            $arr = array('msg' => 'Data berhasil diperbarui', 'status' => true);
        }

        return response()->json($arr);
    }

    public function loker()
    {
        $judul = "Lowongan Pekerjaan";
        $daftar = "active";
        $loker = "active";

        return view('products/01_daftar.loker', [
            'judul' => $judul,
            'daftar' => $daftar,
            'loker' => $loker,
        ]);
    }

    public function storeLoker(Request $request)
    {
        $request->validate(
            [
                '_token' => 'required',
                'entitas' => 'required',
                'posisi' => 'required|unique:penerimaan_lamaran,nik',
                'tanggal_buka' => 'required',
                'tanggal_tutup' => 'required',
                // 'deskripsi' => 'required',
                // 'persyaratan' => 'required',
            ],
            // [
            //     'nik.unique' => 'Nomor NIK: ' . $request->nik . ' sudah ada, Cek kembali inputan anda',
            // ]
        );

        $check = DB::connection('mysql_karir')->table('tb_posisi_lamaran')->insert([
            'posisi' => $request->posisi,
            'tanggal_buka' => $request->tanggal_buka,
            'tanggal_tutup' => $request->tanggal_tutup,
            'deskripsi' => $request->deskripsi,
            'persyaratan' => $request->persyaratan,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data: ' . $request->posisi . ' telah berhasil disimpan', 'status' => true);
        }
        return Response()->json($arr);
    }

    //upah
    public function upah()
    {
        $judul = "Data Upah";
        $daftar = "active";
        $upah = "active";

        return view('products.01_daftar.upah', [
            'judul' => $judul,
            'daftar' => $daftar,
            'upah' => $upah,
        ]);
    }

    public function updateupah(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'jenis' => 'required',
            'nominal' => 'required',
        ]);

        $check = DB::table('daftar_upah')
            ->where('id', $request->id)
            ->update([
                'jenis' => $request->jenis,
                'nominal' => $request->nominal,
                'updated_at'    => now(),
            ]);

        $arr = array('msg' => 'Ada kesalahan. Silakan coba lagi nanti.', 'status' => false);

        if ($check) {
            $arr = array('msg' => 'Data berhasil diperbarui', 'status' => true);
        }

        return response()->json($arr);
    }

    public function users()
    {
        $judul = "Data Users";
        $daftar = "active";
        $users = "active";

        return view('products.01_daftar.users', [
            'judul' => $judul,
            'daftar' => $daftar,
            'users' => $users,
        ]);
    }

    public function storeusers(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'group' => 'required',
            'level' => 'required',
        ]);

        $check = DB::table('daftar_users')->insert([
            'name' => $request->name,
            'group' => $request->group,
            'level' => $request->level,
        ]);

        $arr = [
            'msg' => $check ? 'Data berhasil disimpan' : 'Gagal menyimpan data',
            'status' => $check
        ];

        return response()->json($arr);
    }

    public function updateUsers(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'group' => 'required',
            'level' => 'required',
        ]);

        $check = DB::table('daftar_users')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'group' => $request->group,
                'level' => $request->level,
                'updated_at'    => now(),
            ]);

        $arr = array('msg' => 'Ada kesalahan. Silakan coba lagi nanti.', 'status' => false);

        if ($check) {
            $arr = array('msg' => 'Data berhasil diperbarui', 'status' => true);
        }

        return response()->json($arr);
    }
}
