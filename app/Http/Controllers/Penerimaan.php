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
            // echo '<div class="row row-cards text-center">
            //         <div class="col-lg-12">
            //             <div class="table-responsive" style="height:350px">
            //                 <div class="border border-dark shadow">
            //                     <table class="table table-vcenter card-table table-sm table-striped table-hover">
            //                         <thead class="text-center border border-dark">
            //                             <tr>
            //                                 <th class="w-8">Opsi Cepat</th>
            //                                 <th>Nama</th>
            //                                 <th class="w-1">Tinggi</th>
            //                                 <th class="w-1">Berat</th>
            //                                 <th class="w-1">Buta Warna</th>
            //                                 <th class="w-1">Mata Minus</th>
            //                                 <th class="w-1">Bersikap Baik</th>
            //                                 <th class="w-1">Jalan Cepat</th>
            //                                 <th class="w-1"></th>
            //                                 <th class="w-8">Status</th>
            //                             </tr>
            //                         </thead>
            //                         <tbody class="border border-dark">';
            // for ($i = 0; $i < $jml; $i++) {
            //     $data = DB::table('penerimaan_lamaran')->where('id', $request->id[$i])->get();
            //     foreach ($data as $u) {
            //         if ($u->diterima == 1) {
            //             echo '
            //                 <div class="col-md-4 col-lg-12">
            //                     <div class="card shadow bg-red-lt">
            //                         <div class="card-body p-4 text-center">
            //                             <span class="avatar avatar-xl mb-3 rounded" style="background-image: url(./static/avatars/000m.jpg); width:200px; height:200px;"></span>
            //                             <h3 class="m-0 mb-1"><a href="#">' . $u->nama . '</a></h3>
            //                             <div class="text-secondary">' . $u->posisi . '</div>
            //                             <div class="mt-3">
            //                             <span class="badge bg-danger">Sudah Diterima Sebagai Karyawan</span>
            //                             </div>
            //                         </div>
            //                     </div>
            //                 </div>
            //             ';
            //         } else {
            //             // input hidden
            //             echo '
            //                             <input type="hidden" id="gender' . $request->id[$i] . '" value="' . strtoupper($u->gender) . '">
            //                             <input type="hidden" name="idlamaran[]" value="' . $u->id . '">
            //                             <input type="hidden" name="entitas[]" value="' . $u->entitas . '">
            //                             <input type="hidden" name="nik[]" value="' . $u->nik . '">
            //                             <input type="hidden" name="nama[]" value="' . $u->nama . '">
            //                             <input type="hidden" name="gender[]" value="' . $u->gender . '">
            //                             <input type="hidden" name="tempat[]" value="' . $u->tempat . '">
            //                             <input type="hidden" name="tgllahir[]" value="' . $u->tgllahir . '">
            //                             <input type="hidden" name="sekolah[]" value="' . $u->sekolah . '">
            //                             <input type="hidden" name="pendidikan[]" value="' . $u->pendidikan . '">
            //                             <input type="hidden" name="jurusan[]" value="' . $u->jurusan . '">
            //                             <input type="hidden" name="alamat[]" value="' . $u->alamat . '">
            //                             <input type="hidden" name="agama[]" value="' . $u->agama . '">
            //                             <input type="hidden" name="notlp[]" value="' . $u->notlp . '">
            //                             <input type="hidden" name="posisi[]" value="' . $u->posisi . '">
            //                             <input type="hidden" name="email[]" value="' . $u->email . '">
            //                             <input type="hidden" name="keterangan[]" value="' . $u->keterangan . '">
            //                             <input type="hidden" name="wawancara[]" value="' . $u->wawancara . '">
            //                             <input type="hidden" name="noformwawancara[]" value="' . $u->noformwawancara . '">
            //                             <input type="hidden" name="sst[]" id="sst' . $request->id[$i] . '" value="1">
            //             ';
            //             echo '
            //                             <tr>
            //                                 <td>
            //                                     <div class="form-selectgroup">
            //                                         <label class="form-selectgroup-item bg-green-lt">
            //                                             <input type="radio" name="icons-' . $request->id[$i] . '" id="iconv-' . $request->id[$i] . '" value="check" class="form-selectgroup-input" checked onclick="status(' . $request->id[$i] . ', 1)">
            //                                             <span class="form-selectgroup-label text-success">
            //                                                 <i class="fa-solid fa-check"></i>
            //                                             </span>
            //                                         </label>
            //                                         <label class="form-selectgroup-item bg-red-lt">
            //                                             <input type="radio" name="icons-' . $request->id[$i] . '" id="iconx-' . $request->id[$i] . '" value="xmark" class="form-selectgroup-input" onclick="status(' . $request->id[$i] . ', 0)">
            //                                             <span class="form-selectgroup-label text-warning">
            //                                                 <i class="fa-solid fa-xmark"></i>
            //                                             </span>
            //                                         </label>    
            //                                     </div>
            //                                 </td>
            //                                 <td>' . $u->nama . '</td>
            //                                 <td><input type="number" name="tinggi[]" id="tinggi' . $request->id[$i] . '" class="form-control" style="width:70px" value="' . $u->tinggi . '" onchange="fetchKar(' . $request->id[$i] . ')" onkeydown = "if (event.keyCode == 13)  fetchKar(' . $request->id[$i] . ')"></td>
            //                                 <td><input type="number" name="berat[]" class="form-control" style="width:70px" value="' . $u->berat . '"></td>
            //                                 <td class="text-center">
            //                                     <input name="butawarna[]" id="butawarna' . $request->id[$i] . '" class="form-check-input" type="checkbox">
            //                                 </td>
            //                                 <td>
            //                                     <input name="mataminus[]" id="mataminus' . $request->id[$i] . '" class="form-check-input" type="checkbox">
            //                                 </td>
            //                                 <td>
            //                                     <input name="sikapbaik[]" id="sikapbaik' . $request->id[$i] . '" class="form-check-input" type="checkbox" checked="true">
            //                                 </td>
            //                                 <td>
            //                                     <input name="jalancepat[]" id="jalancepat' . $request->id[$i] . '" class="form-check-input" type="checkbox" checked="true">
            //                                 </td>
            //                                 <td><span id="status' . $request->id[$i] . '" class="badge bg-green">Diterima</span></td>
            //                                 <td>
            //                                     <select class="form-select" name="diterimasebagai[]">
            //                                         <option>OL</option>
            //                                         <option>PHL</option>
            //                                         <option>Kontrak</option>
            //                                     </select>
            //                                 </td>
            //                             </tr>
            //             ';
            //         }
            //     }
            //     echo '

            //                             <script>
            //                                 function fetchKar(params){
            //                                     var tinggi = $("#tinggi" + params).val();
            //                                     var gender = $("#gender" + params).val();
            //                                     if(gender=="PRIA"){
            //                                         if(tinggi < 160){
            //                                             document.getElementById("status"+ params).innerHTML = "Ditolak";
            //                                             $("#status"+ params).removeClass("bg-green").addClass("bg-red");
            //                                             $("#iconv-" + params).removeAttr("checked");
            //                                             $("#iconx-" + params).attr("checked", true);
            //                                             $("#sst" + params).val("0");
            //                                         } else {
            //                                             document.getElementById("status"+ params).innerHTML = "Diterima";
            //                                             $("#status"+ params).removeClass("bg-red").addClass("bg-green");
            //                                             $("#iconx-" + params).removeAttr("checked");
            //                                             $("#iconv-" + params).attr("checked", true);
            //                                             $("#sst" + params).val("1");
            //                                         }
            //                                     } else if(gender=="WANITA"){
            //                                         if(tinggi < 155){
            //                                             document.getElementById("status"+ params).innerHTML = "Ditolak";
            //                                             $("#status"+ params).removeClass("bg-green").addClass("bg-red");
            //                                             $("#sst" + params).val("0");
            //                                         } else {
            //                                             document.getElementById("status"+ params).innerHTML = "Diterima";
            //                                             $("#status"+ params).removeClass("bg-red").addClass("bg-green");
            //                                             $("#sst" + params).val("1");
            //                                         }
            //                                     }
            //                                 }

            //                                 function status(params, val){
            //                                     var gender = $("#gender" + params).val();
            //                                     var tinggi = $("#tinggi" + params).val();
            //                                     if(gender=="PRIA"){
            //                                         if(val == 1 && tinggi >= 160){
            //                                             document.getElementById("status"+ params).innerHTML = "Diterima";
            //                                             $("#iconx-" + params).removeAttr("checked");
            //                                             $("#iconv-" + params).attr("checked", true);
            //                                             $("#status"+ params).removeClass("bg-red").addClass("bg-green");
            //                                             $("#sst" + params).val("1");

            //                                             $("#butawarna" + params).attr("checked", false);
            //                                             $("#mataminus" + params).attr("checked", false);
            //                                             $("#sikapbaik" + params).attr("checked", true);
            //                                             $("#jalancepat" + params).attr("checked", true);
            //                                         } else if(val == 0){
            //                                             document.getElementById("status"+ params).innerHTML = "Ditolak";
            //                                             $("#iconv-" + params).removeAttr("checked");
            //                                             $("#iconx-" + params).attr("checked", true);
            //                                             $("#status"+ params).removeClass("bg-green").addClass("bg-red");
            //                                             $("#sst" + params).val("0");

            //                                             $("#butawarna" + params).attr("checked", true);
            //                                             $("#mataminus" + params).attr("checked", true);
            //                                             $("#sikapbaik" + params).attr("checked", false);
            //                                             $("#jalancepat" + params).attr("checked", false);
            //                                         }
            //                                     } else if(gender=="WANITA"){
            //                                         if(val == 1 && tinggi >= 155){
            //                                             document.getElementById("status"+ params).innerHTML = "Diterima";
            //                                             $("#iconx-" + params).removeAttr("checked");
            //                                             $("#iconv-" + params).attr("checked", true);
            //                                             $("#status"+ params).removeClass("bg-red").addClass("bg-green");
            //                                             $("#sst" + params).val("1");

            //                                             $("#butawarna" + params).attr("checked", false);
            //                                             $("#mataminus" + params).attr("checked", false);
            //                                             $("#sikapbaik" + params).attr("checked", true);
            //                                             $("#jalancepat" + params).attr("checked", true);
            //                                         } else if(val == 0){
            //                                             document.getElementById("status"+ params).innerHTML = "Ditolak";
            //                                             $("#iconv-" + params).removeAttr("checked");
            //                                             $("#iconx-" + params).attr("checked", true);
            //                                             $("#status"+ params).removeClass("bg-green").addClass("bg-red");
            //                                             $("#sst" + params).val("0");

            //                                             $("#butawarna" + params).attr("checked", true);
            //                                             $("#mataminus" + params).attr("checked", true);
            //                                             $("#sikapbaik" + params).attr("checked", false);
            //                                             $("#jalancepat" + params).attr("checked", false);
            //                                         }
            //                                     }
            //                                 }

            //                             </script>
            //     ';
            // }
            // echo '                  </tbody>
            //                     </table>
            //                 </div>
            //             </div>
            //         </div>
            //     </div>
            //     ';

            for ($i = 0; $i < $jml; $i++) {
                $data = DB::table('penerimaan_lamaran')->where('id', $request->id[$i])->get();
                foreach ($data as $u) {
                    if ($u->diterima == 1) {
                        echo '

                            <div class="row row-cards">
                                <div class="card mb-2 shadow" style="border-color:red">
                                    <div class="card-header">
                                        <h3 class="card-title">' . $u->nama . '</h3>
                                    </div>
                                    <div class="ribbon ribbon-top bg-red">
                                        <i class="fa-solid fa-user-shield"></i>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-vcenter card-table">
                                            <thead>
                                                <tr>
                                                    <th class="w-8">Keterangan</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Sudah Diterima menjadi karyawan</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        ';
                    } else {
                        // input hidden
                        echo '
                            <input type="hidden" id="gender' . $request->id[$i] . '" value="' . strtoupper($u->gender) . '">
                            <input type="hidden" name="idlamaran[]" value="' . $u->id . '">
                            <input type="hidden" name="entitas[]" value="' . $u->entitas . '">
                            <input type="hidden" name="nik[]" value="' . $u->nik . '">
                            <input type="hidden" name="nama[]" value="' . $u->nama . '">
                            <input type="hidden" name="gender[]" value="' . $u->gender . '">
                            <input type="hidden" name="tempat[]" value="' . $u->tempat . '">
                            <input type="hidden" name="tgllahir[]" value="' . $u->tgllahir . '">
                            <input type="hidden" name="sekolah[]" value="' . $u->sekolah . '">
                            <input type="hidden" name="pendidikan[]" value="' . $u->pendidikan . '">
                            <input type="hidden" name="jurusan[]" value="' . $u->jurusan . '">
                            <input type="hidden" name="alamat[]" value="' . $u->alamat . '">
                            <input type="hidden" name="agama[]" value="' . $u->agama . '">
                            <input type="hidden" name="notlp[]" value="' . $u->notlp . '">
                            <input type="hidden" name="posisi[]" value="' . $u->posisi . '">
                            <input type="hidden" name="email[]" value="' . $u->email . '">
                            <input type="hidden" name="keterangan[]" value="' . $u->keterangan . '">
                            <input type="hidden" name="wawancara[]" value="' . $u->wawancara . '">
                            <input type="hidden" name="noformwawancara[]" value="' . $u->noformwawancara . '">
                            <input type="hidden" name="sst[]" id="sst' . $request->id[$i] . '" value="1">
                        ';
                        echo '
                            <div class="row row-cards">
                                <div class="card mb-2 shadow" style="border-color:' . '#' . str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT) . '">
                                    <div class="card-header">
                                        <h3 class="card-title">' . $u->nama . '</h3>
                                    </div>
                                    <div class="ribbon ribbon-top bg-green" id="stts' . $request->id[$i] . '">
                                        <i class="fa-solid fa-user-check"></i>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-vcenter card-table">
                                            <thead>
                                                <tr>
                                                    <th class="w-8">Opsi Cepat</th>
                                                    <th class="w-1">Tinggi</th>
                                                    <th class="w-1">Berat</th>
                                                    <th class="w-1">Buta Warna</th>
                                                    <th class="w-1">Mata Minus</th>
                                                    <th class="w-1">Bersikap Baik</th>
                                                    <th class="w-1">Jalan Cepat</th>
                                                    <th class="w-1"></th>
                                                    <th class="w-8">Penempatan</th>
                                                    <th class="text-center">Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="form-selectgroup">
                                                            <label class="form-selectgroup-item bg-green-lt">
                                                                <input type="radio" name="icons-' . $request->id[$i] . '" id="iconv-' . $request->id[$i] . '" value="check" class="form-selectgroup-input" checked onclick="status(' . $request->id[$i] . ', 1)">
                                                                <span class="form-selectgroup-label text-success">
                                                                    <i class="fa-solid fa-check"></i>
                                                                </span>
                                                            </label>
                                                            <label class="form-selectgroup-item bg-red-lt">
                                                                <input type="radio" name="icons-' . $request->id[$i] . '" id="iconx-' . $request->id[$i] . '" value="xmark" class="form-selectgroup-input" onclick="status(' . $request->id[$i] . ', 0)">
                                                                <span class="form-selectgroup-label text-warning">
                                                                    <i class="fa-solid fa-xmark"></i>
                                                                </span>
                                                            </label>    
                                                        </div>
                                                    </td>
                                                    <td><input type="number" name="tinggi[]" id="tinggi' . $request->id[$i] . '" class="form-control" style="width:70px" value="' . $u->tinggi . '" onchange="fetchKar(' . $request->id[$i] . ')" onkeydown = "if (event.keyCode == 13)  fetchKar(' . $request->id[$i] . ')"></td>
                                                    <td><input type="number" name="berat[]" class="form-control" style="width:70px" value="' . $u->berat . '"></td>
                                                    <td class="text-center">
                                                        <input name="butawarna[]" id="butawarna' . $request->id[$i] . '" class="form-check-input" type="checkbox">
                                                    </td>
                                                    <td>
                                                        <input name="mataminus[]" id="mataminus' . $request->id[$i] . '" class="form-check-input" type="checkbox">
                                                    </td>
                                                    <td>
                                                        <input name="sikapbaik[]" id="sikapbaik' . $request->id[$i] . '" class="form-check-input" type="checkbox" checked="true">
                                                    </td>
                                                    <td>
                                                        <input name="jalancepat[]" id="jalancepat' . $request->id[$i] . '" class="form-check-input" type="checkbox" checked="true">
                                                    </td>
                                                    <td><span id="status' . $request->id[$i] . '" class="badge bg-green">Diterima</span></td>
                                                    <td>
                                                        <select class="form-select" name="diterimasebagai[]">
                                                            <option value="OL">OL</option>
                                                            <option value="PHL">PHL</option>
                                                            <option value="Kontrak">Kontrak</option>
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
                                                            <div class="col-6">
                                                                <input type="date" name="dari[]" class=""  value="' . date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day')) . '">
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="date" name="ke[]" class=""  value="' . date('Y-m-d', strtotime(date('Y-m-d') . ' +3 month')) . '">
                                                            </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                                        
                        ';

                        echo '

                            <script>
                                function fetchKar(params){
                                    var tinggi = $("#tinggi" + params).val();
                                    var gender = $("#gender" + params).val();
                                    if(gender=="PRIA"){
                                        if(tinggi < 160){
                                            document.getElementById("status"+ params).innerHTML = "Ditolak";
                                            $("#status"+ params).removeClass("bg-green").addClass("bg-red");
                                            $("#iconv-" + params).removeAttr("checked");
                                            $("#iconx-" + params).attr("checked", true);
                                            $("#sst" + params).val("0");
                                            $("#stts" + params).html(`<i class="fa-solid fa-user-xmark"></i>`);
                                            $("#stts" + params).removeClass("bg-green");
                                            $("#stts" + params).removeClass("bg-red");
                                            $("#stts" + params).addClass("bg-red");
                                        } else {
                                            document.getElementById("status"+ params).innerHTML = "Diterima";
                                            $("#status"+ params).removeClass("bg-red").addClass("bg-green");
                                            $("#iconx-" + params).removeAttr("checked");
                                            $("#iconv-" + params).attr("checked", true);
                                            $("#sst" + params).val("1");
                                            $("#stts" + params).html(`<i class="fa-solid fa-user-check"></i>`);
                                            $("#stts" + params).removeClass("bg-green");
                                            $("#stts" + params).removeClass("bg-red");
                                            $("#stts" + params).addClass("bg-green");
                                        }
                                    } else if(gender=="WANITA"){
                                        if(tinggi < 155){
                                            document.getElementById("status"+ params).innerHTML = "Ditolak";
                                            $("#status"+ params).removeClass("bg-green").addClass("bg-red");
                                            $("#sst" + params).val("0");
                                            $("#stts" + params).html(`<i class="fa-solid fa-user-xmark"></i>`);
                                            $("#stts" + params).removeClass("bg-green");
                                            $("#stts" + params).removeClass("bg-red");
                                            $("#stts" + params).addClass("bg-red");
                                        } else {
                                            document.getElementById("status"+ params).innerHTML = "Diterima";
                                            $("#status"+ params).removeClass("bg-red").addClass("bg-green");
                                            $("#sst" + params).val("1");
                                            $("#stts" + params).html(`<i class="fa-solid fa-user-check"></i>`);
                                            $("#stts" + params).removeClass("bg-green");
                                            $("#stts" + params).removeClass("bg-red");
                                            $("#stts" + params).addClass("bg-green");
                                        }
                                    }
                                }

                                function status(params, val){
                                    var gender = $("#gender" + params).val();
                                    var tinggi = $("#tinggi" + params).val();
                                    if(gender=="PRIA"){
                                        if(val == 1 && tinggi >= 160){
                                            document.getElementById("status"+ params).innerHTML = "Diterima";
                                            $("#iconx-" + params).removeAttr("checked");
                                            $("#iconv-" + params).attr("checked", true);
                                            $("#status"+ params).removeClass("bg-red").addClass("bg-green");
                                            $("#sst" + params).val("1");
                                            $("#stts" + params).html(`<i class="fa-solid fa-user-check"></i>`);
                                            $("#stts" + params).removeClass("bg-green");
                                            $("#stts" + params).removeClass("bg-red");
                                            $("#stts" + params).addClass("bg-green");

                                            $("#stts" + params).html(`<i class="fa-solid fa-user-check"></i>`);

                                            $("#butawarna" + params).attr("checked", false);
                                            $("#mataminus" + params).attr("checked", false);
                                            $("#sikapbaik" + params).attr("checked", true);
                                            $("#jalancepat" + params).attr("checked", true);
                                        } else if(val == 0){
                                            document.getElementById("status"+ params).innerHTML = "Ditolak";
                                            $("#iconv-" + params).removeAttr("checked");
                                            $("#iconx-" + params).attr("checked", true);
                                            $("#status"+ params).removeClass("bg-green").addClass("bg-red");
                                            $("#sst" + params).val("0");
                                            $("#stts" + params).html(`<i class="fa-solid fa-user-xmark"></i>`);
                                            $("#stts" + params).removeClass("bg-green");
                                            $("#stts" + params).removeClass("bg-red");
                                            $("#stts" + params).addClass("bg-red");

                                            $("#butawarna" + params).attr("checked", true);
                                            $("#mataminus" + params).attr("checked", true);
                                            $("#sikapbaik" + params).attr("checked", false);
                                            $("#jalancepat" + params).attr("checked", false);
                                        }
                                    } else if(gender=="WANITA"){
                                        if(val == 1 && tinggi >= 155){
                                            document.getElementById("status"+ params).innerHTML = "Diterima";
                                            $("#iconx-" + params).removeAttr("checked");
                                            $("#iconv-" + params).attr("checked", true);
                                            $("#status"+ params).removeClass("bg-red").addClass("bg-green");
                                            $("#sst" + params).val("1");
                                            $("#stts" + params).html(`<i class="fa-solid fa-user-check"></i>`);
                                            $("#stts" + params).removeClass("bg-green");
                                            $("#stts" + params).removeClass("bg-red");
                                            $("#stts" + params).addClass("bg-green");

                                            $("#butawarna" + params).attr("checked", false);
                                            $("#mataminus" + params).attr("checked", false);
                                            $("#sikapbaik" + params).attr("checked", true);
                                            $("#jalancepat" + params).attr("checked", true);
                                        } else if(val == 0){
                                            document.getElementById("status"+ params).innerHTML = "Ditolak";
                                            $("#iconv-" + params).removeAttr("checked");
                                            $("#iconx-" + params).attr("checked", true);
                                            $("#status"+ params).removeClass("bg-green").addClass("bg-red");
                                            $("#sst" + params).val("0");
                                            $("#stts" + params).html(`<i class="fa-solid fa-user-xmark"></i>`);
                                            $("#stts" + params).removeClass("bg-green");
                                            $("#stts" + params).removeClass("bg-red");
                                            $("#stts" + params).addClass("bg-red");

                                            $("#butawarna" + params).attr("checked", true);
                                            $("#mataminus" + params).attr("checked", true);
                                            $("#sikapbaik" + params).attr("checked", false);
                                            $("#jalancepat" + params).attr("checked", false);
                                        }
                                    }
                                }

                            </script>
                        ';
                    }
                }
            }
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

    public function storeHasilWawancara(Request $request)
    {
        $request->validate(
            [
                '_token' => 'required',
                'idlamaran' => 'required',
            ],
        );
        $jml = count($request->idlamaran);

        for ($i = 0; $i < $jml; $i++) {
            $check = DB::table('penerimaan_wawancara')
                ->where('idlamaran', $request->idlamaran[$i])
                ->orderBy('noform', 'desc')
                ->limit(1)
                ->update(
                    array(
                        'remember_token' => $request->_token,
                        'tglwawancara' => $request->tglwawancara,
                        'butawarna' => isset($request->butawarna[$i]) ? 1 : 0,
                        'mataminus' => isset($request->mataminus[$i]) ? 1 : 0,
                        'sikapbaik' => isset($request->sikapbaik[$i]) ? 1 : 0,
                        'jalancepat' => isset($request->jalancepat[$i]) ? 1 : 0,
                        'keterangan' => $request->keterangan[$i],
                        'diterima' => $request->sst[$i],
                        'dibuat' => Auth::user()->name,
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );

            DB::table('penerimaan_lamaran')
                ->where('id', $request->idlamaran[$i])
                ->limit(1)
                ->update(
                    array(
                        'remember_token' => $request->_token,
                        'diterima' => $request->sst[$i],
                        'tinggi' => $request->tinggi[$i],
                        'berat' => $request->berat[$i],
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );

            $getDataLam = DB::table('penerimaan_lamaran')->where('id', $request->idlamaran[$i])->limit(1)->get();
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


                $statusditerima = null;
                if ($request->diterimasebagai[$i] == "OL") {
                    $statusditerima = "OL";
                    $perjanjian = 'OL (' . Carbon::parse($request->dari[$i])->format('d/m/Y') . ' s.d. ' . Carbon::parse($request->ke[$i])->format('d/m/Y') . ')';
                    $nmsurat = "Perjanjian Kerja OL";
                    $suratket = "OL";
                } elseif ($request->diterimasebagai[$i] == "PHL") {
                    $statusditerima = "PHL";
                    $perjanjian = 'PHL (' . Carbon::parse($request->dari[$i])->format('d/m/Y') . ' s.d. ' . Carbon::parse($request->ke[$i])->format('d/m/Y') . ')';
                    $nmsurat = "Perjanjian Kerja PHL";
                    $suratket = "PHL";
                } elseif ($request->diterimasebagai[$i] == "Kontrak") {
                    $statusditerima = "Aktif";
                    $perjanjian = 'Kontrak I (' . Carbon::parse($request->dari[$i])->format('d/m/Y') . ' s.d. ' . Carbon::parse($request->ke[$i])->format('d/m/Y') . ')';
                    $nmsurat = "Perjanjian Kontrak";
                    $suratket = "Kontrak I";
                }
                // Add into table karyawan
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
                    'tglmasuk' => $request->dari[$i],
                    'tglaktif' => $request->dari[$i],
                    'perjanjian' => $perjanjian,
                    'gapok' => 100000,
                    'status' => $statusditerima,
                    'keterangan' => $l->keterangan,
                    'tglinput' => date('Y-m-d'),
                    'dibuat' => Auth::user()->name,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                // Add Legalitas
                DB::table('penerimaan_legalitas')->insert([
                    "suratjns" => "PERJANJIAN",
                    "userid" => $kode,
                    "nama" => $l->nama,
                    "inputtgl" => date('Y-m-d'),
                    "legalitastgl" => $request->dari[$i],
                    "tglmasuk" => $request->dari[$i],
                    "tglaw" => $request->dari[$i],
                    "tglak" => $request->ke[$i],
                    "nmsurat" => $nmsurat,
                    "suratket" => $suratket,
                    'dibuat' => Auth::user()->name,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
        // $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
        // if ($check) {
        //     $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
        // }
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
            $tgkeluar = !empty($u->tglkeluar) ? Carbon::parse($u->tglkeluar)->format('d/m/Y') : "";
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
                            <table class="table table-sm table-vcenter card-table table-sm">
                                <tr>
                                    <td>Userid</td>
                                    <td>:</td>
                                    <td>' . $u->userid . '</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Masuk</td>
                                    <td>:</td>
                                    <td>' . Carbon::parse($u->tglmasuk)->format('d/m/Y') . '</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Aktif</td>
                                    <td>:</td>
                                    <td>' . Carbon::parse($u->tglaktif)->format('d/m/Y') . '</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Keluar</td>
                                    <td>:</td>
                                    <td>' . $tgkeluar . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card shadow ">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">No. Map</label>
                                            <input type="hidden" name="id" placeholder="" value="' . $u->id . '" />
                                            <input type="text" class="form-control" name="nomap" placeholder="" value="' . $u->nomap . '" style="border-color:black"  />
                                        </div>
                                        <div class="col">
                                            <label class="form-label">STB</label>
                                            <input type="text" class="form-control" placeholder="" value="' . $u->stb . '" style="border-color:black" disabled readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">KTP</label>
                                    <input type="text" class="form-control" name="nik" placeholder="" value="' . $u->nik . '"
                                        style="border-color:black"  />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" placeholder="" value="' . $u->nama . '"
                                        style="border-color:black"  />
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Gender</label>
                                            <select name="gender" id="gender" class="form-select border-dark">
                                                <option value="' . $u->gender . '" hidden>-- ' . $u->gender . ' --</option>
                                                <option value="PRIA">Pria</option>
                                                <option value="WANITA">Wanita</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Agama</label>
                                            <select name="agama" id="agama" class="form-select border-dark">
                                                <option value="' . $u->agama . '" hidden>-- ' . $u->agama . ' --</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Buddha">Buddha</option>
                                                <option value="Khonghucu">Khonghucu</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Tinggi</label>
                                            <input type="text" class="form-control" name="tinggi" placeholder="" value="' . $u->tinggi . '"
                                                style="border-color:black"  />
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Berat</label>
                                            <input type="text" class="form-control" name="berat" placeholder="" value="' . $u->berat . '"
                                                style="border-color:black"  />
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tempat, Tanggal Lahir</label>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control" name="tempat" placeholder="" value="' . $u->tempat . '" style="border-color:black"  />
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="tgllahir" placeholder="" value="' . $u->tgllahir . '" style="border-color:black" id="datepicker3" />
                                            <script>
                                                window.Litepicker && (new Litepicker({
                                                    element: document.getElementById("datepicker3"),
                                                    buttonText: {
                                                        previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                                                        nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
                                                    },
                                                }));
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Pendidikan</label>
                                            <input type="text" class="form-control" name="pendidikan" placeholder="" value="' . $u->pendidikan . '" style="border-color:black"  />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Jurusan</label>
                                            <input type="text" class="form-control" name="jurusan" placeholder="" value="' . $u->jurusan . '" style="border-color:black"  />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Telepon</label>
                                            <input type="text" class="form-control" name="notlp" placeholder="" value="' . $u->notlp . '" style="border-color:black"  />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Serikat</label>
                                            <input type="text" class="form-control" name="serikat" placeholder="" value="' . $u->serikat . '"
                                                style="border-color:black"  />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow bg-info-lt">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-sm">
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
                                    <td>Libur</td>
                                    <td>:</td>
                                    <td>' . $u->hrlibur . '</td>
                                </tr>
                                <tr>
                                    <td>½ Hari</td>
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
        ';
        }
    }

    public function storeUpdateKaryawan(Request $request)
    {
        $request->validate(
            [
                '_token' => 'required',
            ],
        );

        $check = DB::table('penerimaan_karyawan')
            ->where('id', $request->id)
            ->limit(1)
            ->update(
                array(
                    'nomap' => $request->nomap,
                    'nik' => $request->nik,
                    'nama' => $request->nama,
                    'gender' => $request->gender,
                    'agama' => $request->agama,
                    'tinggi' => $request->tinggi,
                    'berat' => $request->berat,
                    'tempat' => $request->tempat,
                    'tgllahir' => $request->tgllahir,
                    'pendidikan' => $request->pendidikan,
                    'jurusan' => $request->jurusan,
                    'notlp' => $request->notlp,
                    'serikat' => $request->serikat,
                    'updated_at' => date('Y-m-d H:i:s'),
                )
            );
        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data: ' . $request->nama . ' telah berhasil disimpan', 'status' => true);
        }
        return Response()->json($arr);
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
            $nama = $u->nama;
        }
        $judul = "Edit Legalitas " . $nama;
        $penerimaan = "active";
        $legalitas = "active";

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
            'judul' => $judul,
            'penerimaan' => $penerimaan,
            'legalitas' => $legalitas,
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
        $karyawan = DB::table('penerimaan_karyawan')->where('userid', $request->userid)->first();
        if ($request->suratjns == "BASIC") {
            $request->validate(
                [
                    '_token' => 'required',
                    'userid' => 'required',
                    'suratjns' => 'required',
                ],
            );
            // GET IDJOB
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
            // GET IDJOB
            // ================================================================
            // kondisi jika tanggal legalitas kurang dari sama dengan hari ini, 
            // maka eksekusi sekarang, 
            // tapi jika lebih besar dari hari ini maka masuk ke schedule
            // ================================================================
            if ($request->tglaktif <= date('Y-m-d')) {
                $inputLegalitas = DB::table('penerimaan_legalitas')->insert([
                    'remember_token' => $request->_token,
                    'suratjns' => 'BASIC',
                    'userid' => $request->userid,
                    'stb' => $karyawan->stb,
                    'nama' => $karyawan->nama,
                    'inputtgl' => $request->tglinput,
                    'legalitastgl' => $request->tglaktif,
                    'tglmasuk' => $karyawan->tglmasuk,
                    'nmsurat' => $request->nmsurat,
                    'divisi' => $request->divisi,
                    'bagian' => $request->bagian,
                    'jabatan' => $request->jabatan,
                    'grup' => $request->grup,
                    'shift' => $request->shift,
                    'profesi' => $request->profesi,
                    'hrlibur'  => $request->hrlibur,
                    'sethari' => $request->serhari,
                    'keterangan' => $request->keterangan,
                    'id_cron'    => 'Langsung Dibuat',
                    'dibuat' => Auth::user()->name,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                $inputKaryawan = DB::table('penerimaan_karyawan')
                    ->where('userid', $request->userid)
                    ->limit(1)
                    ->update([
                        'entitas' => $request->entitas,
                        'stb' => $karyawan->stb,
                        'divisi' => $request->divisi,
                        'bagian' => $request->bagian,
                        'jabatan' => $request->jabatan,
                        'grup' => $request->grup,
                        'profesi' => $request->profesi,
                        'shift' => $request->shift,
                        'hrlibur'  => $request->hrlibur,
                        'sethari' => $request->sethari,
                        'keterangan' => $request->keterangan,
                        // 'dibuat' => Auth::user()->name,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            } else {
                $inputLegalitas = DB::table('penerimaan_legalitas')->insert([
                    'remember_token' => $request->_token,
                    'suratjns' => 'BASIC',
                    'userid' => $request->userid,
                    'stb' => $karyawan->stb,
                    'nama' => $karyawan->nama,
                    'inputtgl' => $request->tglinput,
                    'legalitastgl' => $request->tglaktif,
                    'tglmasuk' => $karyawan->tglmasuk,
                    'nmsurat' => $request->nmsurat,
                    'divisi' => $request->divisi,
                    'bagian' => $request->bagian,
                    'jabatan' => $request->jabatan,
                    'grup' => $request->grup,
                    'shift' => $request->shift,
                    'profesi' => $request->profesi,
                    'hrlibur'  => $request->hrlibur,
                    'sethari' => $request->serhari,
                    'keterangan' => $request->keterangan,
                    'id_cron'    => $kode,
                    'dibuat' => Auth::user()->name,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                $inputSchedule = DB::table('schedule')->insert([
                    'remember_token' => $request->_token,
                    'entitas' => $request->entitas,
                    'type' => 'Basic',
                    'title' => 'Penambahan Legalitas',
                    'idjob' => $kode,
                    'dbjob' => 'penerimaan_legalitas',
                    'job' => 'add',
                    'datejob' => $request->tglaktif,
                    'nama' => $karyawan->nama,
                    'idemployee' => $request->userid,
                    'dibuat' => Auth::user()->name,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }

            // $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
            $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
            return Response()->json($arr);
        } elseif ($request->suratjns == "PERJANJIAN") {
            // GET IDJOB
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
            // GET IDJOB
            // ================================================================
            // kondisi jika tanggal perjanjian kurang dari sama dengan hari ini, 
            // maka eksekusi sekarang, 
            // tapi jika lebih besar dari hari ini maka masuk ke schedule
            // ================================================================
            if ($request->tglinput <= date('Y-m-d')) {
                $inputLegalitas = DB::table('penerimaan_legalitas')->insert([
                    'remember_token' => $request->_token,
                    'suratjns' => $request->suratjns,
                    'userid' => $request->userid,
                    'nama' => $karyawan->nama,
                    'inputtgl' => date('Y-m-d'),
                    'legalitastgl' => $request->tglinput,
                    'tglaw' => $request->tglawal,
                    'tglak' => $request->tglakhir,
                    'nmsurat' => $request->nmsurat,
                    'suratket' => $request->jnssurat,
                    'sacuti' => $request->cuti,
                    'id_cron'    => 'Langsung Dibuat',
                    'dibuat' => Auth::user()->name,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                // Edit di karyawan
                $editKaryawan = DB::table('penerimaan_karyawan')
                    ->where('userid', $request->userid)
                    ->limit(1)
                    ->update([
                        'tglaktif' => $request->tglawal,
                        'tglkeluar' => $request->tglakhir,
                        'perjanjian' => $request->jnssurat . " (" . $request->tglawal . " s.d. " . $request->tglakhir . ")",
                        'status' => 'Aktif',
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            } else {
                $inputLegalitas = DB::table('penerimaan_legalitas')->insert([
                    'remember_token' => $request->_token,
                    'suratjns' => $request->suratjns,
                    'userid' => $request->userid,
                    'nama' => $karyawan->nama,
                    'inputtgl' => date('Y-m-d'),
                    'legalitastgl' => $request->tglinput,
                    'tglaw' => $request->tglawal,
                    'tglak' => $request->tglakhir,
                    'nmsurat' => $request->nmsurat,
                    'suratket' => $request->jnssurat,
                    'sacuti' => $request->cuti,
                    'id_cron'    => 'Langsung Dibuat',
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                $check = DB::table('schedule')->insert([
                    'remember_token' => $request->_token,
                    'entitas' => $request->entitas,
                    'type' => 'Perjanjian',
                    'title' => 'Penambahan Legalitas Perjanjian',
                    'idjob' => $kode,
                    'dbjob' => 'penerimaan_legalitas',
                    'job' => 'add',
                    'datejob' => $request->tglinput,
                    'nama' => $karyawan->nama,
                    'idemployee' => $request->userid,
                    'dibuat' => Auth::user()->name,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
            // $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
            $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
            return Response()->json($arr);
        } elseif ($request->suratjns == "INTERN") {
            # code...
        } elseif ($request->suratjns == "STATUS") {
            # code...
        }
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
                        Nomor 3 : <h1><a href="javascript:void(0)" onclick="copyContent3()">' . $stbnew3 . '</a></h1>
                    </div>
                </div>
            </div>
            ';
        echo '<i>*Klik STB untuk menyalin</i>';
    }

    public function addModal(Request $request)
    {
        $karyawan = DB::table('penerimaan_karyawan')->where('userid', $request->id)->first();
        $divisi = DB::table('daftar_pospekerjaan')->where('type', '=', 'DIVISI')->get();
        $bagian = DB::table('daftar_pospekerjaan')->where('type', '=', 'BAGIAN')->get();
        $jabatan = DB::table('daftar_pospekerjaan')->where('type', '=', 'JABATAN')->get();
        $grup = DB::table('daftar_pospekerjaan')->where('type', '=', 'GRUP')->get();
        $shift = DB::table('daftar_pospekerjaan')->where('type', '=', 'SHIFT')->get();

        $hari = array("SENIN", "SELASA", "RABU", "KAMIS", "JUMAT", "SABTU", "MINGGU");

        $perjanjian = DB::table('daftar_surat')->where('jenissurat', '=', 'Perjanjian')->get();
        $intern = DB::table('daftar_surat')->where('jenissurat', '=', 'Intern')->get();
        $status = DB::table('daftar_surat')->where('jenissurat', '=', 'Status')->get();

        if ($request->idtipe == "basic") {
            echo '<input type="hidden" name="suratjns" value="BASIC" id="suratjns">';
            echo '<input type="hidden" name="userid" value="' . $request->id . '">';
            echo '
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" name="nama" class="form-control" value="' . $karyawan->nama . '" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                            <label class="form-label">Nama Surat</label>
                            <input type="text" name="nmsurat" class="form-control" value="Surat Deskripsi Pekerjaan" readonly>
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td style="padding-top: 12px;width:130px">Tanggal Input</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglinput" id="datepicker0" class="form-control" value="' . date("Y-m-d") . '"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Tanggal Aktif</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglaktif" id="datepicker1" class="form-control" value="' . date("Y-m-d") . '"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">STB</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="text" name="stb" class="form-control" placeholder="Masukkan STB Karyawan" value="' . $karyawan->stb . '"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Divisi</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="divisi" id="" class="form-select">
                                <option hidden value="">-- Pilih Divisi --</option>';
            foreach ($divisi as $d) {
                echo            '<option value="' . $d->desc . '">' . $d->desc . '</option>';
            }
            echo
            '</select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Bagian</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="bagian" id="" class="form-select">
                                <option hidden value="">-- Pilih Bagian --</option>';
            foreach ($bagian as $b) {
                echo            '<option value="' . $b->desc . '">' . $b->desc . '</option>';
            }
            echo
            '</select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Jabatan</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="jabatan" id="" class="form-select">
                                <option hidden value="">-- Pilih Jabatan --</option>';
            foreach ($jabatan as $j) {
                echo            '<option value="' . $j->desc . '">' . $j->desc . '</option>';
            }
            echo
            '</select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Grup</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="grup" id="" class="form-select">
                                <option hidden value="">-- Pilih Grup --</option>';
            foreach ($grup as $g) {
                echo            '<option value="' . $g->desc . '">' . $g->desc . '</option>';
            }
            echo
            '</select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Jenis Shift</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="shift" id="" class="form-select">
                                <option hidden value="">-- Jenis Shift --</option>';
            foreach ($shift as $s) {
                echo            '<option value="' . $s->desc . '">' . $s->desc . '</option>';
            }
            echo                '</select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Profesi</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="text" name="profesi" class="form-control" placeholder="Profesi Karyawan"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Hari Libur</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="hrlibur" id="" class="form-select">
                                <option hidden value="">-- Hari Libur --</option>';
            foreach ($hari as $h => $v) {
                echo            '<option value="' . $v . '">' . $v . '</option>';
            }
            echo
            '</select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">½ Hari</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="sethari" id="" class="form-select">
                                <option hidden value="">-- ½ Hari --</option>';
            foreach ($hari as $h => $v) {
                echo            '<option value="' . $v . '">' . $v . '</option>';
            }
            echo                '</select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Keterangan</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="text" name="keterangan" class="form-control" placeholder="Masukkan Keterangan tambahan contoh: libur=SENIN,SELASA,KAMIS"></td>
                        </tr>
                    </table>
                </div>
            ';
        } elseif ($request->idtipe == "perjanjian") {
            echo '<input type="hidden" name="suratjns" value="PERJANJIAN" id="suratjns">';
            echo '<input type="hidden" name="userid" value="' . $request->id . '">';
            echo
            '
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" name="nama" class="form-control" value="' . $karyawan->nama . '" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                            <label class="form-label">Nama Surat</label>
                                <select name="nmsurat" id="" class="form-select">
                                <option hidden value="">-- Pilih Nama Surat --</option>';
            foreach ($perjanjian as $pe) {
                echo            '<option value="' . $pe->nmsurat . '">' . $pe->nmsurat . '</option>';
            }
            echo                '</select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                            <label class="form-label">Jenis Surat</label>
                            <input type="text" name="jnssurat" class="form-control" placeholder="Masukkan Jenis Surat">
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td style="padding-top: 12px;width:130px">Tanggal Input</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglinput" class="form-control" value="' . date("Y-m-d") . '"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Tanggal Awal</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglawal" class="form-control" value="' . date("Y-m-d") . '"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Tanggal Akhir</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglakhir" class="form-control" value="' . date("Y-m-d") . '"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Cuti</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="number" name="cuti" min="0" class="form-control" placeholder="Cuti"></td>
                        </tr>
                    </table>
                </div>
            ';
        } elseif ($request->idtipe == "intern") {
            echo '<input type="hidden" name="suratjns" value="INTERN" id="suratjns">';
            echo '<input type="hidden" name="userid" value="' . $request->id . '">';
            echo
            '
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" name="nama" class="form-control" value="' . $karyawan->nama .  '" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                            <label class="form-label">Nama Surat</label>
                                <select name="nmsurat" id="" class="form-select">
                                <option hidden value="">-- Pilih Nama Surat --</option>';
            foreach ($intern as $in) {
                echo            '<option value="' . $in->nmsurat . '">' . $in->nmsurat . '</option>';
            }
            echo                '</select>
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td style="padding-top: 12px;width:130px">Tanggal Internal</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglinternal" class="form-control" value="' . date("Y-m-d") . '"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Keterangan</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="text" name="keterangan" class="form-control" placeholder="Masukkan Keterangan"></td>
                        </tr>
                    </table>
                </div>
            ';
        } elseif ($request->idtipe == "status") {
            echo '<input type="hidden" name="suratjns" value="STATUS" id="suratjns">';
            echo '<input type="hidden" name="userid" value="' . $request->id . '">';
            echo
            '
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" name="nama" class="form-control" value="' . $karyawan->nama . '" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                            <label class="form-label">Nama Surat</label>
                                <select name="nmsurat" id="" class="form-select">
                                <option hidden value="">-- Pilih Nama Surat --</option>';
            foreach ($status as $st) {
                echo            '<option value="' . $st->nmsurat . '">' . $st->nmsurat . '</option>';
            }
            echo                '</select>
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td style="padding-top: 12px;width:130px">Tanggal Status</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglstatus" class="form-control disabled" value="' . date("Y-m-d") . '"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px;width:130px">Keterangan tambahan</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="text" name="keterangan" class="form-control" placeholder="keterangan"></td>
                        </tr>
                    </table>
                </div>
            ';
        }
    }

    // ======================== END LEGALITAS ===========================================================================================
}
