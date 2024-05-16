<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DataCuti extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // if (Auth::user()->admin == '1') {
            //     $unit = 'UNIT 1';
            //     $data = DB::table('penerimaan_legalitas AS l')
            //         ->join('penerimaan_karyawan AS k', 'l.userid', '=', 'k.userid')
            //         ->where('l.suratjns', 'like', '%perjanjian%')
            //         ->where('k.bagian', 'like', '%' . $unit . '%')
            //         ->where('l.sacuti', '>', '0')
            //         ->where('l.tglaw', '<=', date('Y-m-d'))
            //         ->where('l.tglak', '>=', date('Y-m-d'))
            //         ->orderBy('l.nama', 'asc')
            //         ->get();
            // } elseif (Auth::user()->admin == '2') {
            //     $unit = 'UNIT 2';
            //     $data = DB::table('penerimaan_legalitas AS l')
            //         ->join('penerimaan_karyawan AS k', 'l.userid', '=', 'k.userid')
            //         ->where('l.suratjns', 'like', '%perjanjian%')
            //         ->where('k.bagian', 'like', '%' . $unit . '%')
            //         ->where('l.sacuti', '>', '0')
            //         ->where('l.tglaw', '<=', date('Y-m-d'))
            //         ->where('l.tglak', '>=', date('Y-m-d'))
            //         ->orderBy('l.nama', 'asc')
            //         ->get();
            // }

            $data = DB::table('penerimaan_legalitas AS l')
                ->join('penerimaan_karyawan AS k', 'l.userid', '=', 'k.userid')
                ->where('l.suratjns', 'like', '%perjanjian%')
                ->where('l.sacuti', '>', '0')
                ->where('l.tglaw', '<=', date('Y-m-d'))
                ->where('l.tglak', '>=', date('Y-m-d'))
                ->orderBy('l.nama', 'asc')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('cutiTerpakai', function ($row) {
                    $data = DB::table('absensi_komunikasiitm')
                        ->where('userid', '=', $row->userid)
                        ->where('sst', '=', 'C')
                        ->where('tanggal', '>=', $row->tglaw)
                        ->where('tanggal', '<=', $row->tglak)
                        ->count();
                    return $data;
                })
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="#viewCuti" data-bs-toggle="modal" data-toggle="tooltip" data-placement="top" title="Lihat Detail Cuti Karyawan" data-item="' . $row->nama . '" data-id="' . $row->userid . '" class="btn btn-sm btn-info btn-icon"><i class="fa-solid fa-eye"></i></a>';
                    return $btn;
                })
                ->rawColumns(['status', 'action', 'cutiTerpakai',])
                ->make(true);
        }
        return view('products.03_absensi.cuti');
    }
}
