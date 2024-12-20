<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DataACCKomunikasi extends Controller
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
            // Set Dari tanggal
            if ($request->dari) {
                $dari = $request->dari;
            } else {
                $dari = date('Y-m-01');
            }
            // Set Sampai tanggal
            if ($request->sampai) {
                $sampai = $request->sampai;
            } else {
                $sampai = date('Y-m-d');
            }
            $data = DB::table('absensi_komunikasi AS b')
                // ->select('b.id', 'b.noform', 'b.tanggal', 'b.nama', 'b.suratid', 'b.sst', 'b.keterangan', 'b.statussurat')
                ->whereBetween('b.tanggal', [$dari, $sampai])
                // ->where('statussurat', 'PENGAJUAN')
                ->orderBy('b.id', 'desc')
                ->get();
            // $data = DB::table('absensi_komunikasi AS b')
            // ->whereBetween('b.tanggal', [$dari, $sampai])
            // ->orderBy('b.id', 'desc')
            // ->get();
            return DataTables::of($data)
                ->addIndexColumn()

                ->editColumn('select_orders', function ($row) {
                    return '';
                })

                ->addColumn('tanggal', function ($row) {
                    $tgl = Carbon::parse($row->tanggal)->format('d/m/Y');
                    return $tgl;
                })
                ->addColumn('list', function ($row) {
                    $list = DB::table('absensi_komunikasiitm')->select('nama')->where('noform', $row->noform)->get();
                    // return $list->count() . ' Item : ' . implode(', ', $list->pluck('nama' . 'tanggal')->toArray());
                    // return $list->count() . ' Item : ' . $list->implode('nama', ', ')->limit(50);
                    return $list->count() . ' Item : ' . $list->implode('nama', ', ');
                })

                // ->addColumn('statussurat', function ($row) {
                //     if ($row->statussurat == 'PENGAJUAN') {
                //         $statussur = '<span class="badge bg-blue text-blue-fg">' . $row->statussurat . '</span>';
                //     } else {
                //         $statussur = '<span class="badge bg-dark text-blue-fg">' . $row->statussurat . '</span>';
                //     }
                //     return $statussur;
                // })

                // ->addColumn('action', function ($row) {
                //     if ($row->statussurat == "PENGAJUAN") {
                //         $btn = ' <a href="komunikasi/printKomunikasi/' . $row->noform . '" target="_blank" data-toggle="tooltip" data-placement="top" title="Print Surat Komunikasi" data-id="' . $row->id . '" class="btn btn-sm btn-info btn-icon"><i class="fa-solid fa-print"></i></a>';
                //         $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Hapus Karyawan" data-noform="' . $row->id . '" data-id="' . $row->id . '" class="btn btn-sm btn-red btn-icon deleteKaryawan"><i class="fa-solid fa-trash-can"></i></a>';
                //         return $btn;
                //     } else {
                //         $btn = ' <a href="komunikasi/printKomunikasi/' . $row->noform . '" target="_blank" data-toggle="tooltip" data-placement="top" title="Print Surat Komunikasi" data-id="' . $row->id . '" class="btn btn-sm btn-info btn-icon"><i class="fa-solid fa-print"></i></a>';
                //         return $btn;
                //     }
                // })
                ->rawColumns(['action', 'statussurat', 'select_orders', 'list'])
                ->make(true);
        }
        return view('products.03_absensi.komunikasi');
    }
}
