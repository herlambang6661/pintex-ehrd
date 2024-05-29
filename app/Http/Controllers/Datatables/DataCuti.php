<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

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
            if (Auth::user()->admin == '1') {
                $unit = 'UNIT 1';
                $data = DB::table('penerimaan_legalitas AS l')
                    ->select(
                        "k.userid, k.stb, k.nama, "
                    )
                    ->join('penerimaan_karyawan AS k', 'l.userid', '=', 'k.userid')
                    ->where('k.bagian', 'like', '%personalia%')
                    ->where('l.suratjns', 'like', '%perjanjian%')
                    ->where('l.sacuti', '>', '0')
                    ->where('l.tglaw', '<=', date('Y-m-d'))
                    ->where('l.tglak', '>=', date('Y-m-d'))
                    ->orderBy('l.nama', 'asc')
                    ->get();
            } elseif (Auth::user()->admin == '2') {
                $unit = 'UNIT 2';
                $data = DB::table('penerimaan_legalitas AS l')
                    ->join('penerimaan_karyawan AS k', 'l.userid', '=', 'k.userid')
                    ->where('l.suratjns', 'like', '%perjanjian%')
                    ->where('l.sacuti', '>', '0')
                    ->where('l.tglaw', '<=', date('Y-m-d'))
                    ->where('l.tglak', '>=', date('Y-m-d'))
                    ->orderBy('l.nama', 'asc')
                    ->get();
            } elseif (Auth::user()->admin == '3') {
                $unit = 'GUDANG';
                $data = DB::table('penerimaan_legalitas AS l')
                    ->join('penerimaan_karyawan AS k', 'l.userid', '=', 'k.userid')
                    ->where('l.suratjns', 'like', '%perjanjian%')
                    ->where('l.sacuti', '>', '0')
                    ->where('l.tglaw', '<=', date('Y-m-d'))
                    ->where('l.tglak', '>=', date('Y-m-d'))
                    ->orderBy('l.nama', 'asc')
                    ->get();
            } else {
                $data = DB::table('penerimaan_karyawan as k')
                    // ->select('k.userid', 'k.stb', 'k.nama')
                    ->select(DB::raw(
                        "k.userid, k.stb, k.nama, 
                        (SELECT l.tglaw FROM penerimaan_legalitas l WHERE l.userid = k.userid ORDER BY l.tglaw DESC LIMIT 1 ) AS tglawal,
                        (SELECT l.tglak FROM penerimaan_legalitas l WHERE l.userid = k.userid ORDER BY l.tglaw DESC LIMIT 1 ) AS tglakhir,
                        (SELECT l.sacuti FROM penerimaan_legalitas l WHERE l.userid = k.userid AND l.suratjns = 'perjanjian' ORDER BY l.id DESC LIMIT 1 ) AS sacuti,
                        (SELECT COUNT(o.sst) FROM absensi_komunikasiacc o WHERE o.userid = k.userid AND o.sst = 'C' AND o.tanggal >= tglawal AND o.tanggal <= tglakhir ) AS cutiterpakai"
                    ))
                    ->where('k.bagian', 'like', '%personalia%')
                    ->where('k.status', 'like', '%aktif%')
                    ->get();
            }

            // $data = DB::table('penerimaan_legalitas AS l')
            //     ->join('penerimaan_karyawan AS k', 'l.userid', '=', 'k.userid')
            //     ->where('l.suratjns', 'like', '%perjanjian%')
            //     ->where('l.sacuti', '>', '0')
            //     ->where('l.tglaw', '<=', date('Y-m-d'))
            //     ->where('l.tglak', '>=', date('Y-m-d'))
            //     ->orderBy('l.nama', 'asc')
            //     ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="#viewCuti" data-bs-toggle="modal" data-toggle="tooltip" data-placement="top" title="Lihat Detail Cuti Karyawan" data-item="' . $row->nama . '" data-id="' . $row->userid . '" class="btn btn-sm btn-info btn-icon"><i class="fa-solid fa-eye"></i></a>';
                    return $btn;
                })
                ->addColumn('sisacuti', function ($row) {
                    $res = $row->sacuti - $row->cutiterpakai;
                    return $res;
                })
                ->rawColumns(['sisacuti', 'action',])
                ->make(true);
        }
        return view('products.03_absensi.cuti');
    }
}
