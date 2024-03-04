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
}
