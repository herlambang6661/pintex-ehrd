<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DataTHR extends Controller
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
        if ($request->tahun) {
            $tahun = $request->tahun;
        } else {
            $tahun = date('y');
        }
        if ($request->ajax()) {
            $data = DB::table('administrasi_tunjanganhariraya')
                ->where('periode', '=', $tahun)
                ->orderBy('nama', 'asc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="#viewKaryawan" data-bs-toggle="modal" data-toggle="tooltip" data-placement="top" title="Lihat Detail Data Karyawan" data-item="' . $row->nama . '" data-id="' . $row->id . '" class="btn btn-sm btn-info btn-icon"><i class="fa-solid fa-user-pen"></i></a>';
                    return $btn;
                })

                ->editColumn('select_orders', function ($row) {
                    return '';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('products.04_administrasi.thr');
    }
}
