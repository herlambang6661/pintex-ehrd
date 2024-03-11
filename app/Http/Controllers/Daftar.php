<?php

namespace App\Http\Controllers;

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
}
