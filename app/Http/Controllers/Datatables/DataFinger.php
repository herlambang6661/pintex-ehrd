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
        if ($request->ajax()) {
            $data = DB::table('absensi_absensi')
                ->where('stb', 'NOT LIKE', '%PHL-%')
                ->where('stb', 'NOT LIKE', '%OL-%')
                ->whereBetween('tanggal', [$request->dari, $request->sampai])
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('hari', function ($row) {
                    return strtoupper(Carbon::parse($row->tanggal)->isoFormat('dddd'));
                })
                ->rawColumns(['hari'])
                ->make(true);
        }
        return view('products.03_absensi.absensifingerprint');
    }
}
