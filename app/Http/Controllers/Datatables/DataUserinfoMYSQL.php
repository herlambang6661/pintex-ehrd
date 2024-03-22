<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DataUserinfoMYSQL extends Controller
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
            $data = DB::table('access_userinfo')
                ->orderBy('USERID', 'desc')
                ->select('*')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('select_orders', function ($row) {
                    return '';
                })
                ->rawColumns(['select_orders'])
                ->make(true);
        }
        return view('products.03_absensi.userid');
    }
}
