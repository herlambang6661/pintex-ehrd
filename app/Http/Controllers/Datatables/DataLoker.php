<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DataLoker extends Controller
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
            $data = DB::connection('mysql_karir')
                ->table('tb_posisi_lamaran')
                ->orderBy('posisi', 'asc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                // ->editColumn('select_orders', function ($row) {
                //     return '';
                // })

                ->addColumn('action', function ($row) {
                    $btn = ' <a href="#viewKaryawan" data-bs-toggle="modal" data-toggle="tooltip" data-placement="top" title="Lihat Detail Data Karyawan" data-item="' . $row->posisi . '" data-id="' . $row->id_posisi . '" class="btn btn-sm btn-info btn-icon"><i class="fa-solid fa-user-pen"></i></a>';
                    return $btn;
                })
                ->rawColumns(['status', 'action', 'select_orders', 'ttl', 'umur'])
                ->make(true);
        }
        return view('products.01_daftar.loker');
    }
}
