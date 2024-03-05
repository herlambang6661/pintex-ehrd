<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Penerimaan extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function lamaran()
    {
        return view('products/02_penerimaan.lamaran');
    }

    public function storeLamaran(Request $request)
    {
        $request->validate(
            [
                '_token' => 'required',
                'entitas' => 'required',
                'nik' => 'required|unique:penerimaan_lamaran,nik',
                'nama' => 'required',
                'gender' => 'required',
                'tempat' => 'required',
                'tanggallahir' => 'required',
                'pendidikan' => 'required',
                'jurusan' => 'required',
                'alamat' => 'required',
                'agama' => 'required',
                'tinggi' => 'required',
                'berat' => 'required',
                'notlp' => 'required',
                'posisi' => 'required',
            ],
            [
                'nik.unique' => 'Nomor NIK: ' . $request->nik . ' sudah ada, Cek kembali inputan anda',
            ]
        );

        // $noform = date('y') . "00000";
        // // // GET NOFORM
        // $checknoform = DB::table('raw_suratkontrak')->orderBy('NOFORM', 'desc')->limit('1')->get();
        // foreach ($checknoform as $key) {
        //     $noform = $key->NOFORM;
        // }
        // $y = substr($noform, 0, 2);
        // if (date('y') == $y) {
        //     $noUrut = substr($noform, 2, 5);
        //     $na = $noUrut + 1;
        //     $char = date('y');
        //     $kodeSurat = $char . sprintf("%05s", $na);
        // } else {
        //     $kodeSurat = date('y') . "00001";
        // }
        // GET NOFORM

        $check = DB::table('penerimaan_lamaran')->insert([
            'remember_token' => $request->_token,
            'entitas' => $request->entitas,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'gender' => $request->gender,
            'tempat' => $request->tempat,
            'tgllahir' => $request->tanggallahir,
            'pendidikan' => $request->pendidikan,
            'jurusan' => $request->jurusan,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'tinggi' => $request->tinggi,
            'berat' => $request->berat,
            'notlp' => $request->notlp,
            'posisi' => $request->posisi,
            'email' => $request->email,
            'wawancara' => 0,
            'diterima' => 0,
            'keterangan' => $request->keterangan,
            'dibuat' => Auth::user()->name,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data: ' . $request->nik . ' telah berhasil disimpan', 'status' => true);
        }
        return Response()->json($arr);
    }

    public function checkLamaran(Request $request)
    {
        if (empty($request->id)) {
            echo "Tidak ada data yang dipilih";
        } else {
            $jml = count($request->id);

            echo '<div class="table-responsive">';
            echo "      <table class='table table-bordered table-sm text-nowrap'>
                            <tr>
                                <td><b>No</b></td>
                                <td><b>NIK</b></td>
                                <td><b>Nama</b></td>
                                <td><b>Pendidikan</b></td>
                                <td><b>Jurusan</b></td>
                                <td><b>Tinggi</b></td>
                                <td><b>Berat</b></td>
                                <td><b>Telp</b></td>
                                <td><b>Keterangan</b></td>
                            </tr>";
            $j = 1;
            for ($i = 0; $i < $jml; $i++) {
                $data = DB::table('penerimaan_lamaran')->where('id', $request->id[$i])->get();
                foreach ($data as $u) {
                    echo  '<input type="text" name="idlamaran" value="' . $u->id . '" hidden>';
                    echo  "<tr>";
                    echo  "<td>" . $j . "</td>";
                    echo  "<td>" . $u->nik . "</td>";
                    echo  "<td>" . $u->nama . "</td>";
                    echo  "<td>" . $u->pendidikan . "</td>";
                    echo  "<td>" . $u->jurusan . "</td>";
                    echo  "<td>" . $u->tinggi . "</td>";
                    echo  "<td>" . $u->berat . "</td>";
                    echo  "<td>" . $u->notlp . "</td>";
                    echo  "<td>" . $u->keterangan . "</td>";
                    echo  "</tr>";
                }
                $j++;
            }
            echo '      </table>  
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Wawancara</label>
                                <input type="date" class="form-control" name="tglwawancara" value="' . date("Y-m-d") . '">
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">User <i>(Optional)</i></label>
                                <input type="text" class="form-control" name="user" placeholder="User yang ikut mewawancarai">
                            </div>
                        </div>
                    </div>';
        }
        // return $result;
    }

    public function storeChecklistLamaran(Request $request)
    {
        $request->validate(
            [
                '_token' => 'required',
                'entitas' => 'required',
                'nik' => 'required|unique:penerimaan_lamaran,nik',
                'nama' => 'required',
                'gender' => 'required',
                'tempat' => 'required',
                'tanggallahir' => 'required',
                'pendidikan' => 'required',
                'jurusan' => 'required',
                'alamat' => 'required',
                'agama' => 'required',
                'tinggi' => 'required',
                'berat' => 'required',
                'notlp' => 'required',
                'posisi' => 'required',
            ],
            [
                'nik.unique' => 'Nomor NIK: ' . $request->nik . ' sudah ada, Cek kembali inputan anda',
            ]
        );

        $check = DB::table('penerimaan_lamaran')->insert([
            'remember_token' => $request->_token,
            'entitas' => $request->entitas,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'gender' => $request->gender,
            'tempat' => $request->tempat,
            'tgllahir' => $request->tanggallahir,
            'pendidikan' => $request->pendidikan,
            'jurusan' => $request->jurusan,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'tinggi' => $request->tinggi,
            'berat' => $request->berat,
            'notlp' => $request->notlp,
            'posisi' => $request->posisi,
            'email' => $request->email,
            'wawancara' => 0,
            'diterima' => 0,
            'keterangan' => $request->keterangan,
            'dibuat' => Auth::user()->name,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data: ' . $request->nik . ' telah berhasil disimpan', 'status' => true);
        }
        return Response()->json($arr);
    }
}
