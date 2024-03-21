<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DBLokal extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mesinfinger()
    {
        $judul = "DB Lokal";
        $absensi = "active";
        $list = "active";

        // $playlist = DB::connection('odbc')
        //     ->table('USERINFO')
        //     ->join('CHECKINOUT', 'USERINFO.USERID', '=', 'CHECKINOUT.USERID')
        //     ->where('CHECKTIME', ["07/07/2023 00:00:00", "08/08/2023 06:00:00"])
        //     ->select('*')
        //     ->get();

        return view('products/03_absensi.mesinfinger', [
            'judul' => $judul,
            'absensi' => $absensi,
            'list' => $list,
            // 'playlist' => $playlist,
        ]);
    }
    public function daftarfinger()
    {
        $judul = "Daftar Finger";
        $absensi = "active";
        $list = "active";

        return view('products/03_absensi.userid', [
            'judul' => $judul,
            'absensi' => $absensi,
            'list' => $list,
        ]);
    }
}
