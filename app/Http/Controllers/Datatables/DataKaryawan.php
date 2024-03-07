<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DataKaryawan extends Controller
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
            $data = DB::table('penerimaan_karyawan')
                ->where('status', 'like', '%Aktif%')
                ->orderBy('nama', 'asc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                // ->editColumn('select_orders', function ($row) {
                //     return '';
                // })

                ->addColumn('action', function ($row) {
                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip" data-item="' . $row->nik . '" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-outline-info btn-icon deleteProduct"><i class="fa-solid fa-fw fa-eye"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-noform="' . $row->id . '" data-nama="' . $row->nama . '" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-outline-warning btn-icon cancelWawancara"><i class="fa-solid fa-arrow-rotate-left"></i></a>';
                    // $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" class="btn btn-outline-green btn-icon"><i class="fa-solid fa-check"></i></a>';
                    // $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" class="btn btn-outline-red btn-icon"><i class="fa-solid fa-xmark"></i></a>';
                    return $btn;
                })
                ->rawColumns(['status', 'action', 'select_orders', 'ttl', 'umur'])
                ->make(true);
        }
        return view('products.02_penerimaan.wawancara');
    }
}
