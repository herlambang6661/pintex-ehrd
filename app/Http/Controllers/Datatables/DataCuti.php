<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

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
            $data = DB::table('penerimaan_legalitas')
                ->where('suratjns', 'like', '%perjanjian%')
                ->where('sacuti', '>', '0')
                ->where('tglaw', '<=', date('Y-m-d'))
                ->where('tglak', '>=', date('Y-m-d'))
                ->orderBy('nama', 'asc')
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
