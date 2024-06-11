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
        if (!empty($request->dari)) {
            $dari = $request->dari;
        } else {
            $dari = date('Y-m-d');
        }
        // Set Sampai tanggal
        if (!empty($request->sampai)) {
            $sampai = $request->sampai;
        } else {
            $sampai = date('Y-m-d');
        }
        // jika request ajax, ambil data
        if ($request->ajax()) {
            $data = DB::table('absensi_absensi')
                ->select(DB::raw('
                    absensi_absensi.id, 
                    absensi_absensi.tanggal, 
                    absensi_absensi.stb, 
                    absensi_absensi.`name`, 
                    absensi_absensi.`shift`, 
                    absensi_absensi.`grup`, 
                    absensi_absensi.`sst`, 
                    DATE_FORMAT(`in`, "%H:%i:%s") as `in`,
                    DATE_FORMAT(`out`, "%H:%i:%s") as `out`,
                    absensi_absensi.bagian,
                    (
                    CASE 
                        WHEN DATE_FORMAT(`in`, "%H:%i:%s") > "06:45:00" AND DATE_FORMAT(`in`, "%H:%i:%s") < "07:30:00" AND absensi_absensi.`shift` = "SHIFT" AND absensi_absensi.`bagian` = "KEAMANAN" THEN "TERLAMBAT"
                        WHEN DATE_FORMAT(`in`, "%H:%i:%s") > "14:45:00" AND DATE_FORMAT(`in`, "%H:%i:%s") < "15:30:00" AND absensi_absensi.`shift` = "SHIFT" AND absensi_absensi.`bagian` = "KEAMANAN" THEN "TERLAMBAT"
                        WHEN DATE_FORMAT(`in`, "%H:%i:%s") > "22:45:00" AND DATE_FORMAT(`in`, "%H:%i:%s") < "23:30:00" AND absensi_absensi.`shift` = "SHIFT" AND absensi_absensi.`bagian` = "KEAMANAN" THEN "TERLAMBAT"
                        WHEN DATE_FORMAT(`in`, "%H:%i:%s") > "07:45:00" AND DATE_FORMAT(`in`, "%H:%i:%s") < "08:30:00" AND absensi_absensi.`shift` = "NON SHIFT" AND absensi_absensi.`bagian` = "KEAMANAN" THEN "TERLAMBAT"
                                
                        WHEN DATE_FORMAT(`in`, "%H:%i:%s") > "06:45:00" AND DATE_FORMAT(`in`, "%H:%i:%s") < "07:30:00" AND absensi_absensi.`shift` = "SHIFT" THEN "TERLAMBAT"
                        WHEN DATE_FORMAT(`in`, "%H:%i:%s") > "14:45:00" AND DATE_FORMAT(`in`, "%H:%i:%s") < "15:30:00" AND absensi_absensi.`shift` = "SHIFT" THEN "TERLAMBAT"
                        WHEN DATE_FORMAT(`in`, "%H:%i:%s") > "22:45:00" AND DATE_FORMAT(`in`, "%H:%i:%s") < "23:30:00" AND absensi_absensi.`shift` = "SHIFT" THEN "TERLAMBAT"
                        WHEN DATE_FORMAT(`in`, "%H:%i:%s") > "07:45:00" AND DATE_FORMAT(`in`, "%H:%i:%s") < "08:30:00" AND absensi_absensi.`shift` = "NON SHIFT" THEN "TERLAMBAT"
                        ELSE null
                    END) AS keteranganAbsen
                '))
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
