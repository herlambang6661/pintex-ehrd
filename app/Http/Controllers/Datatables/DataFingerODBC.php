<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DataFingerODBC extends Controller
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

            $data = DB::connection('odbc')
                ->table('CHECKINOUT')
                ->where('CHECKTIME', '>=', date('Y-m-18') . ' 00:00:00')
                ->where('CHECKTIME', '<=', date('Y-m-d', strtotime(date('Y-m-d') . "+1 days")) . ' 00:00:00')
                ->orderBy('CHECKTIME', 'desc')
                ->select('*')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('select_orders', function ($row) {
                    return '';
                })
                // ->addColumn('action', function ($row) {
                //     $btn = ' <a href="#viewKaryawan" data-bs-toggle="modal" data-toggle="tooltip" data-placement="top" title="Lihat Detail Data Karyawan" data-item="' . $row->nama . '" data-id="' . $row->id . '" class="btn btn-sm btn-info btn-icon"><i class="fa-solid fa-user-pen"></i></a>';
                //     $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Hapus Karyawan" data-noform="' . $row->id . '" data-nama="' . $row->nama . '" data-id="' . $row->id . '" class="btn btn-sm btn-red btn-icon deleteKaryawan"><i class="fa-solid fa-trash-can"></i></a>';
                //     return $btn;
                // })
                ->rawColumns(['select_orders'])
                ->make(true);
        }
        return view('products.03_absensi.checkinout');
    }
}
