<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

    // ======================== START LAMARAN ==============================================================================================
    public function lamaran()
    {
        $judul = "Lamaran";
        $penerimaan = "active";
        $lamaran = "active";

        return view('products/02_penerimaan.lamaran', [
            'judul' => $judul,
            'penerimaan' => $penerimaan,
            'lamaran' => $lamaran
        ]);
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
            'tglinput' => date('Y-m-d'),
            'dibuat' => Auth::user()->name,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data: ' . $request->nama . ' telah berhasil disimpan', 'status' => true);
        }
        return Response()->json($arr);
    }

    public function checkLamaran(Request $request)
    {
        if (empty($request->id)) {
            echo '<center><iframe src="https://lottie.host/embed/94d605b9-2cc4-4d11-809a-7f41357109b0/OzwBgj9bHl.json" width="300px" height="300px"></iframe></center>';
            echo "<center>Tidak ada data yang dipilih</center>";
        } else {
            $jml = count($request->id);

            echo '<div class="table-responsive">';
            echo '<div class="space-y">';

            // echo "      <table class='table table-bordered table-sm text-nowrap'>
            //                 <tr>
            //                     <td><b>No</b></td>
            //                     <td><b>NIK</b></td>
            //                     <td><b>Nama</b></td>
            //                     <td><b>Pendidikan</b></td>
            //                     <td><b>Jurusan</b></td>
            //                     <td><b>Tinggi</b></td>
            //                     <td><b>Berat</b></td>
            //                     <td><b>Telp</b></td>
            //                     <td><b>Keterangan</b></td>
            //                 </tr>";
            for ($i = 0; $i < $jml; $i++) {
                $data = DB::table('penerimaan_lamaran')->where('id', $request->id[$i])->get();
                foreach ($data as $u) {
                    if ($u->wawancara == 1) {
                        echo  '<input type="hidden" name="idlamaran[]" value="' . $u->id . '" >';
                        echo  '<input type="hidden" name="nama[]" value="' . $u->nama . '" >';
                        echo '
                        <div class="card shadow border-warning">
                            <div class="row g-0">
                                <div class="col-auto">
                                    <div class="card-body">
                                        <div class="avatar avatar-md shadow" style="background-image: url(./static/jobs/job-1.jpg)"></div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card-body ps-0">
                                        <div class="row">
                                        <div class="col">
                                            <h3 class="mb-0"><a href="#">' . $u->nama . '</a></h3>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md">
                                            <div class="mt-3 list-inline list-inline-dots mb-0 text-secondary d-sm-block d-none">
                                                <div class="list-inline-item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8"></path><path d="M13 7l0 .01"></path><path d="M17 7l0 .01"></path><path d="M17 11l0 .01"></path><path d="M17 15l0 .01"></path></svg>
                                                    ' . $u->pendidikan . '
                                                </div>
                                                <div class="list-inline-item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11"></path><path d="M9 7l4 0"></path><path d="M9 11l4 0"></path></svg>
                                                    ' . $u->nik . '
                                                </div>
                                                <div class="list-inline-item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline icon-tabler-phone" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                                                    ' . $u->notlp . '
                                                </div>
                                                </div>
                                                <div class="mt-3 list mb-0 text-secondary d-block d-sm-none">
                                                <div class="list-item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8"></path><path d="M13 7l0 .01"></path><path d="M17 7l0 .01"></path><path d="M17 11l0 .01"></path><path d="M17 15l0 .01"></path></svg>
                                                    ' . $u->pendidikan . '
                                                </div>
                                                <div class="list-item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11"></path><path d="M9 7l4 0"></path><path d="M9 11l4 0"></path></svg>
                                                    ' . $u->nik . '
                                                </div>
                                                <div class="list-item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline icon-tabler-phone" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                                                    ' . $u->notlp . '
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="mt-3 badges">
                                                <a href="#" class="badge badge-outline bg-red fw-normal badge-pill">Sudah Pernah Di Wawancara</a>
                                                <a href="#" class="badge badge-outline text-secondary fw-normal badge-pill">' . $u->posisi . '</a>
                                                <a href="#" class="badge badge-outline text-secondary fw-normal badge-pill">' . $u->jurusan . '</a>
                                                <a href="#" class="badge badge-outline text-secondary fw-normal badge-pill">Tinggi: ' . $u->tinggi . '</a>
                                                <a href="#" class="badge badge-outline text-secondary fw-normal badge-pill">Berat: ' . $u->berat . '</a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ';
                    } else {
                        echo  '<input type="hidden" name="idlamaran[]" value="' . $u->id . '" >';
                        echo  '<input type="hidden" name="nama[]" value="' . $u->nama . '" >';
                        echo '
                        <div class="card shadow border-green">
                            <div class="row g-0">
                                <div class="col-auto">
                                <div class="card-body">
                                    <div class="avatar avatar-md shadow" style="background-image: url(./static/jobs/job-1.jpg)"></div>
                                </div>
                                </div>
                                <div class="col">
                                <div class="card-body ps-0">
                                    <div class="row">
                                    <div class="col">
                                        <h3 class="mb-0"><a href="#">' . $u->nama . '</a></h3>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md">
                                        <div class="mt-3 list-inline list-inline-dots mb-0 text-secondary d-sm-block d-none">
                                            <div class="list-inline-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8"></path><path d="M13 7l0 .01"></path><path d="M17 7l0 .01"></path><path d="M17 11l0 .01"></path><path d="M17 15l0 .01"></path></svg>
                                                ' . $u->pendidikan . '
                                            </div>
                                            <div class="list-inline-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11"></path><path d="M9 7l4 0"></path><path d="M9 11l4 0"></path></svg>
                                                ' . $u->nik . '
                                            </div>
                                            <div class="list-inline-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline icon-tabler-phone" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                                                ' . $u->notlp . '
                                            </div>
                                            </div>
                                            <div class="mt-3 list mb-0 text-secondary d-block d-sm-none">
                                            <div class="list-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8"></path><path d="M13 7l0 .01"></path><path d="M17 7l0 .01"></path><path d="M17 11l0 .01"></path><path d="M17 15l0 .01"></path></svg>
                                                ' . $u->pendidikan . '
                                            </div>
                                            <div class="list-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11"></path><path d="M9 7l4 0"></path><path d="M9 11l4 0"></path></svg>
                                                ' . $u->nik . '
                                            </div>
                                            <div class="list-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline icon-tabler-phone" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                                                ' . $u->notlp . '
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="mt-3 badges">
                                            <a href="#" class="badge badge-outline text-secondary fw-normal badge-pill">' . $u->posisi . '</a>
                                            <a href="#" class="badge badge-outline text-secondary fw-normal badge-pill">' . $u->jurusan . '</a>
                                            <a href="#" class="badge badge-outline text-secondary fw-normal badge-pill">Tinggi: ' . $u->tinggi . '</a>
                                            <a href="#" class="badge badge-outline text-secondary fw-normal badge-pill">Berat: ' . $u->berat . '</a>
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
            echo '      </div>  
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
                                <input type="text" class="form-control" name="user" placeholder="User yang ikut mewawancarai" value="Kartika Dewi, ">
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
                'idlamaran' => 'required',
            ],
        );
        $jml = count($request->idlamaran);

        $noform = date('y') . "00000";
        // // GET NOFORM
        $checknoform = DB::table('penerimaan_wawancara')->orderBy('noform', 'desc')->limit('1')->get();
        foreach ($checknoform as $key) {
            $noform = $key->noform;
        }
        $y = substr($noform, 0, 2);
        if (date('y') == $y) {
            $noUrut = substr($noform, 2, 5);
            $na = $noUrut + 1;
            $char = date('y');
            $kodeSurat = $char . sprintf("%05s", $na);
        } else {
            $kodeSurat = date('y') . "00001";
        }

        for ($i = 0; $i < $jml; $i++) {
            $check = DB::table('penerimaan_lamaran')
                ->where('id', $request->idlamaran[$i])
                ->limit(1)
                ->update(
                    array(
                        'remember_token' => $request->_token,
                        'wawancara' => 1,
                        'noformwawancara' => $kodeSurat,
                        'dibuat' => Auth::user()->name,
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );

            // GET NOFORM
            DB::table('penerimaan_wawancara')->insert([
                'remember_token' => $request->_token,
                'idlamaran' => $request->idlamaran[$i],
                'noform' => $kodeSurat,
                'nama' => $request->nama[$i],
                'tglwawancara' => $request->tglwawancara,
                'user' => $request->user,
                'dibuat' => Auth::user()->name,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);

            $product = DB::table('penerimaan_wawancara')->orderBy('id', 'desc')->limit('1')->get();
            foreach ($product as $key) {
                $noform = $key->noform;
            }
            $arr = array('val' => $noform);
        }
        return Response()->json($arr);
    }

    public function printLamaran($id)
    {
        $check = DB::table('penerimaan_wawancara')
            ->join('penerimaan_lamaran', 'penerimaan_wawancara.idlamaran', '=', 'penerimaan_lamaran.id')
            ->where('noform', $id)
            ->get();
        return view('products/02_penerimaan.print', ['getData' => $check, 'noform' => $id,]);
    }

    public function listLamaran(Request $request)
    {
        $data = DB::table('penerimaan_lamaran')->where('id', $request->id)->get();
        foreach ($data as $l) {
            echo '
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <strong>Data Diri</strong>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-striped">
                                <tbody>
                                    <tr>
                                        <td>NIK</td>
                                        <td class="text-secondary">:</td>
                                        <td class="text-secondary">' . $l->nik . '</td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td class="text-secondary">:</td>
                                        <td class="text-secondary">' . $l->nama . '</td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td class="text-secondary">:</td>
                                        <td class="text-secondary">' . $l->gender . '</td>
                                    </tr>
                                    <tr>
                                        <td>Tempat, Tanggal Lahir</td>
                                        <td class="text-secondary">:</td>
                                        <td class="text-secondary">' . $l->tempat . ', ' . Carbon::parse($l->tgllahir)->format('d/m/Y') . '</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td class="text-secondary">:</td>
                                        <td class="text-secondary">' . $l->alamat . '</td>
                                    </tr>
                                    <tr>
                                        <td>Agama</td>
                                        <td class="text-secondary">:</td>
                                        <td class="text-secondary">' . $l->agama . '</td>
                                    </tr>
                                    <tr>
                                        <td>Tinggi Badan</td>
                                        <td class="text-secondary">:</td>
                                        <td class="text-secondary">' . $l->tinggi . '</td>
                                    </tr>
                                    <tr>
                                        <td>Berat Badan</td>
                                        <td class="text-secondary">:</td>
                                        <td class="text-secondary">' . $l->berat . '</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <strong>Riwayat Pendidikan</strong>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Asal Sekolah</td>
                                        <td class="text-secondary">:</td>
                                        <td class="text-secondary">' . $l->pendidikan . '</td>
                                    </tr>
                                    <tr>
                                        <td>Pendidikan</td>
                                        <td class="text-secondary">:</td>
                                        <td class="text-secondary">' . $l->pendidikan . '</td>
                                    </tr>
                                    <tr>
                                        <td>Jurusan</td>
                                        <td class="text-secondary">:</td>
                                        <td class="text-secondary">' . $l->jurusan . '</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Kontak yang dapat dihubungi</strong>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table table-striped">
                                        <tbody>
                                            <tr>
                                                <td>No Tlp / Whatsapp</td>
                                                <td class="text-secondary">:</td>
                                                <td class="text-secondary">' . $l->notlp . '</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td class="text-secondary">:</td>
                                                <td class="text-secondary">' . $l->email . '</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    Dokumen
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table table-striped">
                                        <tbody>
                                            <tr>
                                                <td>No Tlp / Whatsapp</td>
                                                <td class="text-secondary">:</td>
                                                <td class="text-secondary">' . $l->nik . '</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td class="text-secondary">:</td>
                                                <td class="text-secondary">' . $l->nama . '</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
    }
    // ======================== END LAMARAN ==============================================================================================
    // ======================== START WAWANCARA ==========================================================================================

    public function wawancara()
    {
        $judul = "Wawancara";
        $penerimaan = "active";
        $wawancara = "active";
        return view('products/02_penerimaan.wawancara', ['judul' => $judul, 'penerimaan' => $penerimaan, 'wawancara' => $wawancara]);
    }

    public function cancelWawancara(Request $request)
    {
        $check = DB::table('penerimaan_lamaran')
            ->where('id', $request->id)
            ->limit(1)
            ->update(
                array(
                    'remember_token' => $request->_token,
                    'wawancara' => 0,
                    'dibuat' => Auth::user()->name,
                    'updated_at' => date('Y-m-d H:i:s'),
                )
            );

        DB::table('penerimaan_wawancara')
            ->where('idlamaran', '=', $request->id)
            ->where('noform', '=', $request->noform)
            ->orderBy('id', 'desc')
            ->limit('1')
            ->delete();

        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data telah berhasil dikembalikan ke lamaran', 'status' => true);
        }
        return Response()->json($arr);
    }

    public function prosesWawancara(Request $request)
    {
        if (empty($request->id)) {
            echo '<center><iframe src="https://lottie.host/embed/94d605b9-2cc4-4d11-809a-7f41357109b0/OzwBgj9bHl.json" width="300px" height="300px"></iframe></center>';
            echo "<center>Tidak ada data yang dipilih</center>";
        } else {
            $jml = count($request->id);
            echo '<div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pelaksanaan Wawancara</label>
                            <input type="date" class="form-control" name="tglwawancara" value="' . date("Y-m-d") . '">
                        </div>
                    </div>
                </div>';
            echo '<div class="row row-cards text-center">
                    <div class="col-lg-12">
                        <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                            <thead class="text-center">
                                <tr>
                                    <th>Nama</th>
                                    <th class="w-1">Tinggi</th>
                                    <th class="w-1">Berat</th>
                                    <th>Opsi Cepat</th>
                                    <th class="w-1">Buta Warna</th>
                                    <th class="w-1">Mata Minus</th>
                                    <th class="w-1">Bersikap Baik</th>
                                    <th class="w-1">Jalan Cepat</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>';
            for ($i = 0; $i < $jml; $i++) {
                $data = DB::table('penerimaan_lamaran')->where('id', $request->id[$i])->get();
                foreach ($data as $u) {
                    if ($u->diterima == 1) {
                        echo '
                            <div class="col-md-4 col-lg-12">
                                <div class="card shadow bg-red-lt">
                                    <div class="card-body p-4 text-center">
                                        <span class="avatar avatar-xl mb-3 rounded" style="background-image: url(./static/avatars/000m.jpg); width:200px; height:200px;"></span>
                                        <h3 class="m-0 mb-1"><a href="#">' . $u->nama . '</a></h3>
                                        <div class="text-secondary">' . $u->posisi . '</div>
                                        <div class="mt-3">
                                        <span class="badge bg-danger">Sudah Diterima Sebagai Karyawan</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        ';
                    } else {
                        echo '
                                <tr>
                                    <td>' . $u->nama . '</td>
                                    <td><input style="width:40px" value="' . $u->tinggi . '"></td>
                                    <td><input style="width:50px" value="' . $u->berat . '"></td>
                                    <td>
                                        <div class="form-selectgroup">
                                        <label class="form-selectgroup-item bg-green-lt">
                                            <input type="radio" name="icons-' . $request->id[$i] . '" value="home" class="form-selectgroup-input" checked="">
                                            <span class="form-selectgroup-label text-success">
                                                <i class="fa-solid fa-check"></i>
                                            </span>
                                        </label>
                                        <label class="form-selectgroup-item bg-red-lt">
                                            <input type="radio" name="icons-' . $request->id[$i] . '" value="user" class="form-selectgroup-input">
                                            <span class="form-selectgroup-label text-warning">
                                                <i class="fa-solid fa-xmark"></i>
                                            </span>
                                        </label>    
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <input class="form-check-input" type="checkbox">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="checkbox">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="checkbox">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="checkbox">
                                    </td>
                                    <td><span class="badge bg-green text-green-fg">Diterima</span></td>
                                </tr>
                        ';
                    }
                }
            }
            echo '              </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>';
        }
        // return $result;
    }

    public function checkWawancara(Request $request)
    {
        if (empty($request->id)) {
            echo '<center><iframe src="https://lottie.host/embed/94d605b9-2cc4-4d11-809a-7f41357109b0/OzwBgj9bHl.json" width="300px" height="300px"></iframe></center>';
            echo "<center>Tidak ada data yang dipilih</center>";
        } else {
            $jml = count($request->id);
            echo '<div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pelaksanaan Wawancara</label>
                            <input type="date" class="form-control" name="tglwawancara" value="' . date("Y-m-d") . '">
                        </div>
                    </div>
                </div>';
            echo '<div class="row row-cards">';
            for ($i = 0; $i < $jml; $i++) {
                $data = DB::table('penerimaan_lamaran')->where('id', $request->id[$i])->get();
                foreach ($data as $u) {
                    if ($u->diterima == 1) {
                        echo '
                            <div class="col-md-4 col-lg-4">
                                <div class="card shadow bg-red-lt">
                                    <div class="card-body p-4 text-center">
                                        <span class="avatar avatar-xl mb-3 rounded" style="background-image: url(./static/avatars/000m.jpg); width:200px; height:200px;"></span>
                                        <h3 class="m-0 mb-1"><a href="#">' . $u->nama . '</a></h3>
                                        <div class="text-secondary">' . $u->posisi . '</div>
                                        <div class="mt-3">
                                        <span class="badge bg-danger">Sudah Diterima Sebagai Karyawan</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        ';
                    } else {
                        echo '
                        
                            <div class="col-md-4 col-lg-4">
                                <div class="card shadow">
                                    <div class="card-body p-4 text-center bg-green-lt">
                                        <span class="avatar avatar-xl mb-3 rounded" style="background-image: url(./static/avatars/000m.jpg); width:200px; height:200px;"></span>
                                        <h3 class="m-0 mb-1"><a href="#">' . $u->nama . '</a></h3>
                                        <div class="text-secondary">' . $u->posisi . '</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="form-label">Hasil Wawancara</div>
                                            <input type="hidden" name="id[]" value="' . $u->id . '" >
                                            <input type="hidden" name="nama[]" value="' . $u->nama . '" >
                                            <div>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="butawarna[]" value="1">
                                                    <span class="form-check-label">Buta Warna</span>
                                                </label>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="bersikapbaik[]" checked="true" value="1">
                                                    <span class="form-check-label">Bersikap Baik</span>
                                                </label>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="berlaricepat[]" checked="true" value="1">
                                                    <span class="form-check-label">Berlari Cepat</span>
                                                </label>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="diterima[]" checked="true" value="1">
                                                    <span class="form-check-label"><b>Diterima Sbg Karyawan</b></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Aktual Tinggi</label>
                                            <input type="number" class="form-control" name="tinggi[]" min="100" value="' . $u->tinggi . '">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Aktual Berat</label>
                                            <input type="number" class="form-control" name="berat[]" min="10" value="' . $u->berat . '">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Catatan Hasil Wawancara</label>
                                            <input type="text" class="form-control" name="keterangan[]" placeholder="Keterangan Tambahan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }
            }
            echo '  </div>';
        }
        // return $result;
    }

    public function checkWawancaraX(Request $request)
    {
        if (empty($request->id)) {
            echo '<center><iframe src="https://lottie.host/embed/94d605b9-2cc4-4d11-809a-7f41357109b0/OzwBgj9bHl.json" width="300px" height="300px"></iframe></center>';
            echo "<center>Tidak ada data yang dipilih</center>";
        } else {
            $jml = count($request->id);
            echo '<div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pelaksanaan Wawancara</label>
                            <input type="date" class="form-control" name="tglwawancara" value="' . date("Y-m-d") . '">
                        </div>
                    </div>
                </div>';
            echo '<div class="row row-cards">';
            for ($i = 0; $i < $jml; $i++) {
                $data = DB::table('penerimaan_lamaran')->where('id', $request->id[$i])->get();
                foreach ($data as $u) {
                    if ($u->diterima == 1) {
                        echo '
                            <div class="col-md-4 col-lg-4">
                                <div class="card shadow bg-red-lt">
                                    <div class="card-body p-4 text-center">
                                        <span class="avatar avatar-xl mb-3 rounded" style="background-image: url(./static/avatars/000m.jpg); width:200px; height:200px;"></span>
                                        <h3 class="m-0 mb-1"><a href="#">' . $u->nama . '</a></h3>
                                        <div class="text-secondary">' . $u->posisi . '</div>
                                        <div class="mt-3">
                                        <span class="badge bg-danger">Sudah Diterima Sebagai Karyawan</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        ';
                    } else {
                        echo '
                        
                            <div class="col-md-4 col-lg-4">
                                <div class="card shadow">
                                    <div class="card-body p-4 text-center">
                                        <span class="avatar avatar-xl mb-3 rounded" style="background-image: url(./static/avatars/000m.jpg); width:200px; height:200px;"></span>
                                        <h3 class="m-0 mb-1"><a href="#">' . $u->nama . '</a></h3>
                                        <div class="text-secondary">' . $u->posisi . '</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="form-label">Hasil Wawancara</div>
                                            <input type="hidden" name="id[]" value="' . $u->id . '" >
                                            <input type="hidden" name="nama[]" value="' . $u->nama . '" >
                                            <input type="hidden" name="diterima[]" value="2" >
                                            <div>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="butawarna[]" checked="true" value="1">
                                                    <span class="form-check-label">Buta Warna</span>
                                                </label>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="bersikapbaik[]" value="1">
                                                    <span class="form-check-label">Bersikap Baik</span>
                                                </label>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="berlaricepat[]" value="1">
                                                    <span class="form-check-label">Berlari Cepat</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Aktual Tinggi</label>
                                            <input type="number" class="form-control" name="tinggi[]" min="100" value="' . $u->tinggi . '">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Aktual Berat</label>
                                            <input type="number" class="form-control" name="berat[]" min="10" value="' . $u->berat . '">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Catatan Hasil Wawancara</label>
                                            <input type="text" class="form-control" name="keterangan[]" placeholder="Keterangan Tambahan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }
            }
            echo '  </div>';
        }
        // return $result;
    }

    public function storeChecklistWawancara(Request $request)
    {
        $request->validate(
            [
                '_token' => 'required',
                'id' => 'required',
            ],
        );
        $jml = count($request->id);

        for ($i = 0; $i < $jml; $i++) {
            $check = DB::table('penerimaan_wawancara')
                ->where('idlamaran', $request->id[$i])
                ->orderBy('noform', 'desc')
                ->limit(1)
                ->update(
                    array(
                        'remember_token' => $request->_token,
                        'tglwawancara' => $request->tglwawancara,
                        'butawarna' => isset($request->butawarna[$i]) ? $request->butawarna[$i] : 0,
                        'sikapbaik' => isset($request->bersikapbaik[$i]) ? $request->bersikapbaik[$i] : 0,
                        'laricepat' => isset($request->berlaricepat[$i]) ? $request->berlaricepat[$i] : 0,
                        'keterangan' => $request->keterangan[$i],
                        'diterima' => isset($request->diterima[$i]) ? $request->diterima[$i] : 0,
                        'dibuat' => Auth::user()->name,
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );

            DB::table('penerimaan_lamaran')
                ->where('id', $request->id[$i])
                ->limit(1)
                ->update(
                    array(
                        'remember_token' => $request->_token,
                        'diterima' => isset($request->diterima[$i]) ? $request->diterima[$i] : 0,
                        'tinggi' => $request->tinggi[$i],
                        'berat' => $request->berat[$i],
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );

            $getDataLam = DB::table('penerimaan_lamaran')->where('id', $request->id[$i])->limit(1)->get();
            foreach ($getDataLam as $l) {

                // GET PHL
                $noform = "0";
                $checknoform = DB::table('penerimaan_karyawan')
                    // ->where('stb', 'like', '%PHL%')
                    ->orderBy('userid', 'desc')
                    ->limit('1')
                    ->get();
                foreach ($checknoform as $key) {
                    $noform = $key->userid;
                }
                if ($noform != "0") {
                    $na = $noform + 1;
                    $kode = $na;
                } else {
                    $kode = "1";
                }
                // GET PHL

                DB::table('penerimaan_karyawan')->insert([
                    'remember_token' => $request->_token,
                    'entitas' => $l->entitas,
                    'nik' => $l->nik,
                    'userid' => $kode,
                    'nama' => $l->nama,
                    'gender' => $l->gender,
                    'tempat' => $l->tempat,
                    'tgllahir' => $l->tgllahir,
                    'pendidikan' => $l->pendidikan,
                    'jurusan' => $l->jurusan,
                    'alamat' => $l->alamat,
                    'agama' => $l->agama,
                    'tinggi' => $l->tinggi,
                    'berat' => $l->berat,
                    'notlp' => $l->notlp,
                    'email' => $l->email,

                    'gapok' => 100000,
                    'status' => 'OL',
                    'keterangan' => $l->keterangan,
                    'tglinput' => date('Y-m-d'),
                    'dibuat' => Auth::user()->name,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
        }
        return Response()->json($arr);
    }

    // ======================== END WAWANCARA ============================================================================================
    // ======================== START KARYAWAN =========================================================================================

    public function karyawan()
    {
        $judul = "Karyawan";
        $penerimaan = "active";
        $karyawan = "active";
        return view('products/02_penerimaan.karyawan', ['judul' => $judul, 'penerimaan' => $penerimaan, 'karyawan' => $karyawan]);
    }

    public function listKaryawan(Request $request)
    {
        $data = DB::table('penerimaan_karyawan')->where('id', $request->id)->get();
        foreach ($data as $u) {
            $link = url('photo/pas/' . $u->userid);
            $ktp = url('photo/ktp/' . $u->userid);
            echo '
            <div class="row">
                <div class="col-lg-3">
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
                    <div class="row">
                        <div class="shadow" style="padding: 0px 0px 0px 0px">
                            <div class="col-lg-12">
                                <a data-fslightbox="gallery" href="' . $ktp . '.jpg">
                                    <div class="img-responsive rounded-3 border"
                                        style="background-image: url(' . $ktp . '.jpg)">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card shadow bg-info-lt">
                        <div class="table-responsive">
                            <table class="table table-sm table-vcenter card-table">
                                <tr>
                                    <td>Userid</td>
                                    <td>:</td>
                                    <td>' . $u->userid . '</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Masuk</td>
                                    <td>:</td>
                                    <td>' . $u->tglmasuk . '</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Aktif</td>
                                    <td>:</td>
                                    <td>' . $u->tglaktif . '</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Keluar</td>
                                    <td>:</td>
                                    <td>' . $u->tglkeluar . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card shadow bg-green-lt">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col">
                                                <label class="form-label">No. Map</label>
                                                <input type="text" class="form-control" name="" placeholder="" value="' . $u->nomap . '" style="border-color:black" readonly />
                                            </div>
                                            <div class="col">
                                                <label class="form-label">STB</label>
                                                <input type="text" class="form-control" name="" placeholder="" value="' . $u->stb . '" style="border-color:black" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">KTP</label>
                                        <input type="text" class="form-control" name="" placeholder="" value="' . $u->nik . '"
                                            style="border-color:black" readonly />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="" placeholder="" value="' . $u->nama . '"
                                            style="border-color:black" readonly />
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col">
                                                <label class="form-label">Gender</label>
                                                <input type="text" class="form-control" name="" placeholder="" value="' . $u->gender . '"
                                                    style="border-color:black" readonly />
                                            </div>
                                            <div class="col">
                                                <label class="form-label">Agama</label>
                                                <input type="text" class="form-control" name="" placeholder="" value="' . $u->agama . '"
                                                    style="border-color:black" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col">
                                                <label class="form-label">Tinggi</label>
                                                <input type="text" class="form-control" name="" placeholder="" value="' . $u->tinggi . '"
                                                    style="border-color:black" readonly />
                                            </div>
                                            <div class="col">
                                                <label class="form-label">Berat</label>
                                                <input type="text" class="form-control" name="" placeholder="" value="' . $u->berat . '"
                                                    style="border-color:black" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tempat, Tanggal Lahir</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control" name="" placeholder="" value="' . $u->tempat . '" style="border-color:black" readonly />
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="" placeholder="" value="' . $u->tgllahir . '" style="border-color:black" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label">Pendidikan</label>
                                                <input type="text" class="form-control" name="" placeholder="" value="' . $u->pendidikan . '" style="border-color:black" readonly />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label">Jurusan</label>
                                                <input type="text" class="form-control" name="" placeholder="" value="' . $u->jurusan . '" style="border-color:black" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Telepon</label>
                                                <input type="text" class="form-control" name="" placeholder="" value="' . $u->notlp . '" style="border-color:black" readonly />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Serikat</label>
                                                <input type="text" class="form-control" name="" placeholder="" value="' . $u->serikat . '"
                                                    style="border-color:black" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card shadow bg-info-lt">
                                        <div class="table-responsive">
                                            <table class="table table-vcenter card-table">
                                                <tr>
                                                    <td width="70px">Divisi</td>
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
                                    <br>
                                    <div class="card shadow bg-warning-lt">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label class="form-label">Surat Internal</label>
                                                <h3>' . $u->internal . '</h3>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Surat Perjanjian</label>
                                                <h3>' . $u->perjanjian . '</h3>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Status Karyawan</label>
                                                <h3>' . $u->status . '</h3>
                                            </div>
                                        </div>
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

    // ======================== END KARYAWAN ===========================================================================================
    // ======================== START LEGALITAS =========================================================================================

    public function legalitas()
    {
        $judul = "Legalitas";
        $penerimaan = "active";
        $legalitas = "active";

        $basic = DB::table('daftar_surat')->where('jenissurat', '=', 'Basic')->get();
        return view('products/02_penerimaan.legalitas', [
            'basic' => $basic,
            'judul' => $judul,
            'penerimaan' => $penerimaan,
            'legalitas' => $legalitas
        ]);
    }

    public function legalEdit($id)
    {
        $data = DB::table('penerimaan_karyawan')->where('id', $id)->limit(1)->get();
        foreach ($data as $u) {
            $userid = $u->userid;
        }
        $basic = DB::table('penerimaan_legalitas')->where('userid', $userid)->where('suratjns', 'like', '%basic%')->orderBy('legalitastgl', 'asc')->get();
        $perjanjian = DB::table('penerimaan_legalitas')->where('userid', $userid)->where('suratjns', 'like', '%perjanjian%')->orderBy('legalitastgl', 'asc')->get();
        $intern = DB::table('penerimaan_legalitas')->where('userid', $userid)->where('suratjns', 'like', '%intern%')->orderBy('legalitastgl', 'asc')->get();
        $status = DB::table('penerimaan_legalitas')->where('userid', $userid)->where('suratjns', 'like', '%status%')->orderBy('legalitastgl', 'asc')->get();

        $p_divisi = DB::table('daftar_pospekerjaan')->where('type', 'like', '%DIVISI%')->orderBy('desc', 'asc')->get();
        $p_bagian = DB::table('daftar_pospekerjaan')->where('type', 'like', '%BAGIAN%')->orderBy('desc', 'asc')->get();
        $p_jabatan = DB::table('daftar_pospekerjaan')->where('type', 'like', '%JABATAN%')->orderBy('desc', 'asc')->get();
        $p_grup = DB::table('daftar_pospekerjaan')->where('type', 'like', '%GRUP%')->orderBy('desc', 'asc')->get();
        $p_shift = DB::table('daftar_pospekerjaan')->where('type', 'like', '%SHIFT%')->orderBy('desc', 'asc')->get();

        $j_perjanjian = DB::table('daftar_surat')->where('jenissurat', 'like', '%Perjanjian%')->orderBy('nmsurat', 'asc')->get();
        $j_internal = DB::table('daftar_surat')->where('jenissurat', 'like', '%Intern%')->orderBy('nmsurat', 'asc')->get();
        $j_status = DB::table('daftar_surat')->where('jenissurat', 'like', '%Status%')->orderBy('nmsurat', 'asc')->get();

        return view('products/02_penerimaan.legalitasEdit', [
            'getKar' => $data,
            'basic' => $basic,
            'perjanjian' => $perjanjian,
            'intern' => $intern,
            'status' => $status,
            'p_divisi' => $p_divisi,
            'p_bagian' => $p_bagian,
            'p_jabatan' => $p_jabatan,
            'p_grup' => $p_grup,
            'p_shift' => $p_shift,
            'j_perjanjian' => $j_perjanjian,
            'j_internal' => $j_internal,
            'j_status' => $j_status,
            'iduntukphl' => $id,
        ]);
    }

    public function storedataLegalitas(Request $request)
    {

        $request->validate(
            [
                '_token' => 'required',
            ],
        );
        if ($request->tgl || $request->tgl_perjanjian || $request->tgl_internal || $request->tgl_status) {
            $jml_basic = empty($request->tgl) ? 0 : count($request->tgl);
            $jml_perjanjian = empty($request->tgl_perjanjian) ? 0 : count($request->tgl_perjanjian);
            $jml_internal = empty($request->tgl_internal) ? 0 : count($request->tgl_internal);
            $jml_status = empty($request->tgl_status) ? 0 : count($request->tgl_status);

            // ================================================================================== BASIC =====================================================
            for ($i = 0; $i < $jml_basic; $i++) {
                // GET NOFORM
                $noform = date('y') . "00000";
                $checknoform = DB::table('schedule')->orderBy('idjob', 'desc')->limit('1')->get();
                foreach ($checknoform as $key) {
                    $noform = $key->idjob;
                }
                $y = substr($noform, 0, 2);
                if (date('y') == $y) {
                    $noUrut = substr($noform, 2, 5);
                    $na = $noUrut + 1;
                    $char = date('y');
                    $kode = $char . sprintf("%05s", $na);
                } else {
                    $kode = date('y') . "00001";
                }
                // GET NOFORM
                // Setting date Schedule
                if ($request->tgl[$i] <= date('Y-m-d')) {
                    $check = DB::table('penerimaan_legalitas')->insert([
                        'remember_token' => $request->_token,
                        'suratjns' => 'BASIC',
                        'userid' => $request->userid,
                        'stb' => $request->stb[$i],
                        'nama' => $request->nama,
                        'inputtgl' => date('Y-m-d'),
                        'legalitastgl' => $request->tgl[$i],
                        'tglmasuk' => $request->tglaktif[$i],
                        'nmsurat' => $request->namasurat[$i],
                        'divisi' => $request->divisi[$i],
                        'bagian' => $request->bagian[$i],
                        'jabatan' => $request->jabatan[$i],
                        'grup' => $request->grup[$i],
                        'profesi' => $request->profesi[$i],
                        'shift' => $request->shift[$i],
                        'hrlibur'  => $request->libur[$i],
                        'sethari' => $request->setengah[$i],
                        'keterangan' => $request->keterangan[$i],
                        'id_cron'    => $kode,
                        'dibuat' => Auth::user()->name,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                    $check = DB::table('schedule')->insert([
                        'remember_token' => $request->_token,
                        'entitas' => 'PINTEX',
                        'type' => 'Basic',
                        'title' => 'Penambahan Legalitas',
                        'idjob' => $kode,
                        'dbjob' => 'daftar_legalitas',
                        'job' => 'add',
                        'datejob' => $request->tgl[$i],
                        'nama' => $request->nama,
                        'idemployee' => $request->stb[$i],
                        'dibuat' => Auth::user()->name,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                    $check = DB::table('penerimaan_karyawan')
                        ->where('id', $request->iduntukphl)
                        ->limit(1)
                        ->update([
                            'entitas' => $request->entitas,
                            'stb' => $request->stb[$i],
                            'divisi' => $request->divisi[$i],
                            'bagian' => $request->bagian[$i],
                            'jabatan' => $request->jabatan[$i],
                            'grup' => $request->grup[$i],
                            'profesi' => $request->profesi[$i],
                            'shift' => $request->shift[$i],
                            'hrlibur'  => $request->libur[$i],
                            'sethari' => $request->setengah[$i],
                            'keterangan' => $request->keterangan[$i],
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                } else {
                    $check = DB::table('penerimaan_legalitas')->insert([
                        'remember_token' => $request->_token,
                        'suratjns' => 'BASIC',
                        'userid' => $request->userid,
                        'stb' => $request->stb[$i],
                        'nama' => $request->nama,
                        'inputtgl' => date('Y-m-d'),
                        'legalitastgl' => $request->tgl[$i],
                        // 'tglmasuk' => '',
                        // 'tglaw' => '',
                        // 'tglak' => '',
                        'nmsurat' => $request->namasurat[$i],
                        // 'suratket' => '',
                        'divisi' => $request->divisi[$i],
                        'bagian' => $request->bagian[$i],
                        'jabatan' => $request->jabatan[$i],
                        'grup' => $request->grup[$i],
                        'profesi' => $request->profesi[$i],
                        'shift' => $request->shift[$i],
                        'hrlibur'  => $request->libur[$i],
                        'sethari' => $request->setengah[$i],
                        // 'sacuti' => '',
                        'keterangan' => $request->keterangan[$i],
                        'id_cron'    => $kode,
                        'dibuat' => Auth::user()->name,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                    $check = DB::table('schedule')->insert([
                        'remember_token' => $request->_token,
                        'entitas' => 'PINTEX',
                        'type' => 'Basic',
                        'title' => 'Penambahan Legalitas',
                        'idjob' => $kode,
                        'dbjob' => 'daftar_legalitas',
                        'job' => 'add',
                        'datejob' => $request->tgl[$i],
                        'nama' => $request->nama,
                        'idemployee' => $request->stb[$i],
                        'dibuat' => Auth::user()->name,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            }
            // ================================================================================== BASIC =====================================================

            // ================================================================================== PERJANJIAN ================================================
            for ($j = 0; $j < $jml_perjanjian; $j++) {
                // GET NOFORM
                $noform = date('y') . "00000";
                $checknoform = DB::table('schedule')->orderBy('idjob', 'desc')->limit('1')->get();
                foreach ($checknoform as $key) {
                    $noform = $key->idjob;
                }
                $y = substr($noform, 0, 2);
                if (date('y') == $y) {
                    $noUrut = substr($noform, 2, 5);
                    $na = $noUrut + 1;
                    $char = date('y');
                    $kode = $char . sprintf("%05s", $na);
                } else {
                    $kode = date('y') . "00001";
                }
                // GET NOFORM
                if ($request->tgl_perjanjian[$j] <= date('Y-m-d')) {
                    $check = DB::table('penerimaan_legalitas')->insert([
                        'remember_token' => $request->_token,
                        'suratjns' => 'PERJANJIAN',
                        'userid' => $request->userid,
                        // 'stb' => $request->stb[$j],
                        'nama' => $request->nama,
                        'inputtgl' => date('Y-m-d'),
                        'legalitastgl' => $request->tgl_perjanjian[$j],
                        'tglaw' => $request->awal_perjanjian[$j],
                        'tglak' => $request->akhir_perjanjian[$j],
                        'nmsurat' => $request->nmperjanjian[$j],
                        'suratket' => $request->jenis_perjanjian[$j],
                        'sacuti' => $request->cuti[$j],
                        'id_cron'    => $kode,
                        'dibuat' => Auth::user()->name,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                    $check = DB::table('schedule')->insert([
                        'remember_token' => $request->_token,
                        'entitas' => 'PINTEX',
                        'type' => 'Perjanjian',
                        'title' => 'Penambahan Legalitas',
                        'idjob' => $kode,
                        'dbjob' => 'daftar_legalitas',
                        'job' => 'add',
                        'datejob' => $request->tgl_perjanjian[$j],
                        'nama' => $request->nama,
                        'idemployee' => $request->userid,
                        'dibuat' => Auth::user()->name,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                    if ($request->nmperjanjian[$j] == "Perjanjian Kontrak") {
                        // tambah USERID DISINI
                        $check = DB::table('penerimaan_karyawan')
                            ->where('id', $request->iduntukphl)
                            ->limit(1)
                            ->update([
                                'tglaktif' => $request->tglaw,
                                'tglkeluar' => $request->tglak,
                                'perjanjian' => $request->suratket . "(" . $request->tglaw . " s.d. " . $request->tglak . ")",
                                'status' => 'Aktif',
                                'updated_at' => date('Y-m-d H:i:s'),
                            ]);
                    } else {
                        $check = DB::table('penerimaan_karyawan')
                            ->where('id', $request->iduntukphl)
                            ->limit(1)
                            ->update([
                                'tglaktif' => $request->tglaw,
                                'tglkeluar' => $request->tglak,
                                'perjanjian' => $request->suratket . "(" . $request->tglaw . " s.d. " . $request->tglak . ")",
                                'updated_at' => date('Y-m-d H:i:s'),
                            ]);
                    }
                } else {
                    $check = DB::table('penerimaan_legalitas')->insert([
                        'remember_token' => $request->_token,
                        'suratjns' => 'PERJANJIAN',
                        'userid' => $request->userid,
                        // 'stb' => $request->stb[$j],
                        'nama' => $request->nama,
                        'inputtgl' => date('Y-m-d'),
                        'legalitastgl' => $request->tgl_perjanjian[$j],
                        'tglaw' => $request->awal_perjanjian[$j],
                        'tglak' => $request->akhir_perjanjian[$j],
                        'nmsurat' => $request->nmperjanjian[$j],
                        'suratket' => $request->jenis_perjanjian[$j],
                        'sacuti' => $request->cuti[$j],
                        'id_cron'    => $kode,
                        'dibuat' => Auth::user()->name,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                    $check = DB::table('schedule')->insert([
                        'remember_token' => $request->_token,
                        'entitas' => 'PINTEX',
                        'type' => 'Perjanjian',
                        'title' => 'Penambahan Legalitas',
                        'idjob' => $kode,
                        'dbjob' => 'daftar_legalitas',
                        'job' => 'add',
                        'datejob' => $request->tgl_perjanjian[$j],
                        'nama' => $request->nama,
                        'idemployee' => $request->userid,
                        'dibuat' => Auth::user()->name,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            }
            // ================================================================================== PERJANJIAN ================================================
        } else {
            $check = null;
            $arr = array('msg' => 'Tidak Ada data yang diubah', 'status' => false);
        }

        // $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
        }
        return Response()->json($arr);
    }

    public function listStb(Request $request)
    {
        $data = DB::table('penerimaan_karyawan')
            ->where('stb', 'like', '1' . date('y') . '%')
            ->orderBy('stb', 'desc')
            ->limit(1)
            ->get();
        $data2 = DB::table('penerimaan_karyawan')
            ->where('stb', 'like', '2' . date('y') . '%')
            ->orderBy('stb', 'desc')
            ->limit(1)
            ->get();
        $data3 = DB::table('penerimaan_karyawan')
            ->where('stb', 'like', '3' . date('y') . '%')
            ->orderBy('stb', 'desc')
            ->limit(1)
            ->get();

        echo 'Berikut Urutan STB yang dapat digunakan : <br>';
        foreach ($data as $u) {
            $stbnew = $u->stb + 1;
            echo '<p>1. Awalan 1 Terakhir dipakai oleh : ' . $u->nama . ' => ' . $u->stb . '</p>';
        }
        foreach ($data2 as $u2) {
            $stbnew2 = $u2->stb + 1;
            echo '<p>2. Awalan 2 Terakhir dipakai oleh : ' . $u2->nama . ' => ' . $u2->stb . '</p>';
        }
        foreach ($data3 as $u3) {
            $stbnew3 = $u3->stb + 1;
            echo '<p>3. Awalan 3 Terakhir dipakai oleh : ' . $u3->nama . ' => ' . $u3->stb . '</p>';
        }
        echo '
            <p id="myText" hidden>' . $stbnew . '</p>
            <p id="myText2" hidden>' . $stbnew2 . '</p>
            <p id="myText3" hidden>' . $stbnew3 . '</p>
            <script>
                let text = document.getElementById("myText").innerHTML;
                let text2 = document.getElementById("myText2").innerHTML;
                let text3 = document.getElementById("myText3").innerHTML;
                const copyContent = async () => {
                    try {
                        await navigator.clipboard.writeText(text);
                        console.log("Content copied to clipboard");
                        $("#modal-stb").modal("hide");
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            title: "STB ' . $stbnew . ' Berhasil Disalin ke Clipboard",
                        });

                    } catch (err) {
                        console.error("Failed to copy: ", err);
                    }
                }
                const copyContent2 = async () => {
                    try {
                        await navigator.clipboard.writeText(text2);
                        console.log("Content copied to clipboard");
                        $("#modal-stb").modal("hide");
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            title: "STB ' . $stbnew2 . ' Berhasil Disalin ke Clipboard",
                        });
                    } catch (err) {
                        console.error("Failed to copy: ", err);
                    }
                }
                const copyContent3 = async () => {
                    try {
                        await navigator.clipboard.writeText(text3);
                        console.log("Content copied to clipboard");
                        $("#modal-stb").modal("hide");
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            title: "STB ' . $stbnew3 . ' Berhasil Disalin ke Clipboard",
                        });
                    } catch (err) {
                        console.error("Failed to copy: ", err);
                    }
                }
            </script>
            <div class="row">
                <div class="col">
                    <div class="alert alert-important alert-success" role="alert">
                        Nomor 1 : <h1><a href="javascript:void(0)" onclick="copyContent()">' . $stbnew . '</a></h1>
                    </div>
                </div>
                <div class="col">
                    <div class="alert alert-important alert-success" role="alert">
                        Nomor 2 : <h1><a href="javascript:void(0)" onclick="copyContent2()">' . $stbnew2 . '</a></h1>
                    </div>
                </div>
                <div class="col">
                    <div class="alert alert-important alert-success" role="alert">
                        Nomor3 : <h1><a href="javascript:void(0)" onclick="copyContent3()">' . $stbnew3 . '</a></h1>
                    </div>
                </div>
            </div>
            ';
        echo '<i>*Klik STB untuk menyalin</i>';
    }

    // ======================== END LEGALITAS ===========================================================================================
}
