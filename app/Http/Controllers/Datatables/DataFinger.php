<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DataFinger extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Jakarta');
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if ($request->dari) {
        //     $dari = $request->dari;
        // } else {
        //     $dari = date('Y-m-d');
        // }
        // if ($request->sampai) {
        //     $sampai = $request->sampai;
        // } else {
        //     $sampai = date('Y-m-d');
        // }
        if ($request->ajax()) {
            $data = DB::table('access_checkinout as a')
                ->orderByDesc('CHECKTIME')
                ->limit(7000)
                ->get();
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
