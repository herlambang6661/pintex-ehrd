<?php

namespace App\Http\Controllers;

use App\Models\Pos_pekerjaan;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Daftar extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

        $check = DB::table('tarif_lembur')->insert([
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
        $data = DB::table('tarif_lembur')->where('id', $request->id)->get();
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

        $check = DB::table('tarif_lembur')
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
            'Harilibur' => $Harilibur,
            'libur' => $libur
        ]);
    }

    public function storelibur(Request $request)
    {
        $request->validate(
            [
                'entitas' => 'required',
                'tanggal' => 'required',
                'libur_nasional' => 'required',
                'sumber_ketentuan'   => 'required',
                'keterangan' => 'required',
            ],
        );

        $check = DB::table('hari_libur_nasional')->insert([
            'entitas' => $request->entitas,
            'tanggal' => $request->tanggal,
            'libur_nasional' => $request->libur_nasional,
            'sumber_ketentuan'   => $request->sumber_ketentuan,
            'keterangan' => $request->keterangan,
        ]);
        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data: ' . $request->tanggal . ' ' . $request->libur_nasional . '' . $request->sumber_ketentuan . '' . $request->keterangan . ' telah berhasil disimpan', 'status' => true);
        }
        return Response()->json($arr);
    }

    public function liburnasview(Request $request)
    {
        $data = DB::table('hari_libur_nasional')->where('id', $request->id)->get();
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

    public function updateliburnas(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'entitas' => 'required',
            'tanggal' => 'required',
            'libur_nasional' => 'required',
            'sumber_ketentuan' => 'required',
            'keterangan' => 'required',
        ]);

        $check = DB::table('hari_libur_nasional')
            ->where('id', $request->id)
            ->update([
                'entitas' => $request->entitas,
                'tanggal' => $request->tanggal,
                'libur_nasional' => $request->libur_nasional,
                'sumber_ketentuan' => $request->sumber_ketentuan,
                'keterangan' => $request->keterangan,
                'updated_at'    => now(),

            ]);

        $arr = array('msg' => 'Ada kesalahan. Silakan coba lagi nanti.', 'status' => false);

        if ($check) {
            $arr = array('msg' => 'Data: ' . $request->entitas . ' ' . $request->tanggal . ' ' . $request->libur_nasional . ' ' . $request->sumber_ketentuan . ' ' . $request->keterangan . ' berhasil diperbarui', 'status' => true);
        }

        return response()->json($arr);
    }

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

        $check = DB::table('shift')->insert([
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
        $data = DB::table('shift')->where('id', $request->id)->get();
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

        $check = DB::table('shift')
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
}
