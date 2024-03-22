<?php

namespace App\Http\Controllers;

use App\Models\Pos_pekerjaan;
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
            'id'        => 'required', // Tambahkan validasi untuk id
            'entitas'   => 'required',
            'type'      => 'required',
            'desc'      => 'required',
        ]);

        $check = DB::table('daftar_pospekerjaan')
            ->where('id', $request->id) // Ubah kondisi where menjadi id
            ->update([
                'entitas'       => $request->entitas,
                'type'          => $request->type,
                'desc'          => $request->desc,
                'dibuat'        => Auth::user()->name,
                'updated_at'    => now(),
            ]);

        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);

        if ($check) {
            $arr = array('msg' => 'Data: ' . $request->entitas . ' ' . $request->type . '' . $request->desc . ' telah berhasil diupdate', 'status' => true);
        }

        return Response()->json($arr);
    }
}
