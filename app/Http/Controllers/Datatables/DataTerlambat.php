<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DataTerlambat extends Controller
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
        // Set Dari tanggal
        if ($request->dari) {
            $dari = $request->dari;
        } else {
            $dari = date('Y-m-d');
        }
        // Set Sampai tanggal
        if ($request->sampai) {
            $sampai = $request->sampai;
        } else {
            $sampai = date('Y-m-d');
        }
        // jika request ajax, ambil data
        if ($request->ajax()) {
            $data = DB::table('absensi_absensi')
                ->whereBetween('tanggal', [$dari, $sampai])
                ->orderBy('name', 'asc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modal-view" class="btn btn-outline-info btn-sm btn-icon"><i class="fa-solid fa-fw fa-eye"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action',])
                ->make(true);
            return view($data);
        }
    }
}