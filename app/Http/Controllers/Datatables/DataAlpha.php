<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


class DataAlpha extends Controller
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
            if ($request->jns == "alpa") {
                $data = DB::table('absensi_absensi as a')
                    ->select('a.*', 'a.id as idabsensi', 'k.jabatan', 'k.bagian', 'k.profesi')
                    ->join('penerimaan_karyawan as k', 'a.userid', '=', 'k.userid')
                    ->where('a.sst', '=', 'A')
                    ->whereNull('a.koreksi')
                    ->where('a.stb', 'NOT LIKE', '%PHL-%')
                    ->where('a.stb', 'NOT LIKE', '%OL-%')
                    ->where('k.status', 'LIKE', '%Aktif%')
                    ->whereBetween('a.tanggal', [$request->dari, $request->sampai])
                    ->orderBy('a.bagian', 'asc')
                    ->orderBy('a.grup', 'asc')
                    ->orderBy('a.name', 'asc')
                    ->get();
            } elseif ($request->jns == "f1f2") {
                $data = DB::table('absensi_absensi as a')
                    ->select('a.*', 'a.id as idabsensi', 'k.jabatan', 'k.bagian', 'k.profesi')
                    ->join('penerimaan_karyawan as k', 'a.userid', '=', 'k.userid')
                    ->whereNull('a.koreksi')
                    ->whereIn('a.sst', ['F1', 'F2', '½'])
                    ->where('a.stb', 'NOT LIKE', '%PHL-%')
                    ->where('a.stb', 'NOT LIKE', '%OL-%')
                    ->where('k.status', 'LIKE', '%Aktif%')
                    ->whereBetween('a.tanggal', [$request->dari, $request->sampai])
                    ->orderBy('a.bagian', 'asc')
                    ->orderBy('a.grup', 'asc')
                    ->orderBy('a.name', 'asc')
                    ->get();
            }

            // $data = DB::table('penerimaan_karyawan')
            //     // ->where('status', 'like', $sst)
            //     ->orderBy('nama', 'asc')
            //     ->get();

            return DataTables::of($data)
                ->addIndexColumn()

                // ->addColumn('action', function ($row) {
                //     $btn = ' <a href="#viewKaryawan" data-bs-toggle="modal" data-toggle="tooltip" data-placement="top" title="Lihat Detail Data Karyawan" data-item="' . $row->nama . '" data-id="' . $row->id . '" class="btn btn-sm btn-outline-info btn-icon"><i class="fa-solid fa-eye"></i></a>';
                //     $btn = $btn . ' <a href="karyawan/edit/' . $row->id . '" data-toggle="tooltip" data-placement="top" title="Edit" data-noform="' . $row->id . '" data-nama="' . $row->nama . '" data-id="' . $row->id . '" class="btn btn-sm btn-outline-orange btn-icon editKaryawan"><i class="fa-solid fa-pen-to-square"></i></a>';
                //     return $btn;
                // })
                ->editColumn('select_orders', function ($row) {
                    return '';
                })
                ->editColumn('hari', function ($row) {
                    date_default_timezone_set('Asia/Jakarta');
                    $hari = strtoupper(Carbon::parse($row->tanggal)->isoFormat('dddd'));
                    return $hari;
                })
                ->rawColumns(['hari', 'action'])
                ->make(true);
        }
        return view('products.03_absensi.alpa');
    }
}
