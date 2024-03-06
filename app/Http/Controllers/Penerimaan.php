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

    // ======================== START LAMARAN ==============================================================================================
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
        return view('products/02_penerimaan.print');
    }
    // ======================== END LAMARAN ==============================================================================================
    // ======================== START WAWANCARA ============================================================================================

    public function wawancara()
    {
        return view('products/02_penerimaan.wawancara');
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
                            <label class="form-label">Tanggal Wawancara</label>
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
                        echo  '<input type="hidden" name="idlamaran[]" value="' . $u->id . '" >';
                        echo  '<input type="hidden" name="nama[]" value="' . $u->nama . '" >';
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
                                            <div>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox">
                                                    <span class="form-check-label">Buta Warna</span>
                                                </label>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" checked="true">
                                                    <span class="form-check-label">Bersikap Baik</span>
                                                </label>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" checked="true">
                                                    <span class="form-check-label">Berlari Cepat</span>
                                                </label>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" checked="true">
                                                    <span class="form-check-label"><b>Diterima Sbg Karyawan</b></span>
                                                </label>
                                            </div>
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
    // ======================== END WAWANCARA ==============================================================================================
}
