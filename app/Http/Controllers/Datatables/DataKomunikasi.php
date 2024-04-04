<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DataKomunikasi extends Controller
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
            $data = DB::table('absensi_komunikasiitm AS b')
                ->select('b.id', 'b.noform', 'b.tanggal', 'b.nama', 'b.suratid', 'b.sst', 'b.keterangan', 'b.statussurat')
                // ->join('absensi_komunikasiitm AS b', 'a.noform', '=', 'b.noform')
                ->whereBetween('b.tanggal', [date('Y-m-01'), date('Y-m-t')])
                ->orderBy('b.id', 'desc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('tanggal', function ($row) {
                    $tgl = Carbon::parse($row->tanggal)->format('d/m/Y');
                    return $tgl;
                })

                ->addColumn('statussurat', function ($row) {
                    if ($row->statussurat == 'PENGAJUAN') {
                        $statussur = '<span class="badge bg-blue text-blue-fg">' . $row->statussurat . '</span>';
                    } else {
                        $statussur = '<span class="badge bg-dark text-blue-fg">' . $row->statussurat . '</span>';
                    }
                    return $statussur;
                })

                ->addColumn('action', function ($row) {
                    if ($row->statussurat == "PENGAJUAN") {
                        $btn = ' <a href="komunikasi/printKomunikasi/' . $row->noform . '" target="_blank" data-toggle="tooltip" data-placement="top" title="Print Surat Komunikasi" data-id="' . $row->id . '" class="btn btn-sm btn-info btn-icon"><i class="fa-solid fa-print"></i></a>';
                        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Hapus Karyawan" data-noform="' . $row->id . '" data-id="' . $row->id . '" class="btn btn-sm btn-red btn-icon deleteKaryawan"><i class="fa-solid fa-trash-can"></i></a>';
                        return $btn;
                    } else {
                        $btn = ' <a href="komunikasi/printKomunikasi/' . $row->noform . '" target="_blank" data-toggle="tooltip" data-placement="top" title="Print Surat Komunikasi" data-id="' . $row->id . '" class="btn btn-sm btn-info btn-icon"><i class="fa-solid fa-print"></i></a>';
                        return $btn;
                    }
                })
                ->rawColumns(['action', 'statussurat'])
                ->make(true);
        }
        return view('products.03_absensi.komunikasi');
    }
}
