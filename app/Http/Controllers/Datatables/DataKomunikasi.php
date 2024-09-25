<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
            // Set Dari tanggal
            if ($request->dari) {
                $dari = $request->dari;
            } else {
                $dari = date('Y-01-01');
            }
            // Set Sampai tanggal
            if ($request->sampai) {
                $sampai = $request->sampai;
            } else {
                $sampai = date('Y-m-d');
            }

            // if (Auth::user()->admin == '1') {
            //     $unit = 'UNIT 1';
            //     $data = DB::table('absensi_komunikasiitm AS b')
            //         ->select('b.id', 'b.noform', 'b.tanggal', 'b.nama', 'b.suratid', 'b.sst', 'b.keterangan', 'b.statussurat')
            //         ->join('penerimaan_karyawan AS k', 'b.userid', '=', 'k.userid')
            //         ->where('k.bagian', '=', $unit)
            //         ->whereBetween('b.tanggal', [date('Y-m-01'), date('Y-m-t')])
            //         ->orderBy('b.id', 'desc')
            //         ->get();
            // } elseif (Auth::user()->admin == '2') {
            //     $unit = 'UNIT 2';
            //     $data = DB::table('absensi_komunikasiitm AS b')
            //         ->select('b.id', 'b.noform', 'b.tanggal', 'b.nama', 'b.suratid', 'b.sst', 'b.keterangan', 'b.statussurat')
            //         ->join('penerimaan_karyawan AS k', 'b.userid', '=', 'k.userid')
            //         ->where('k.bagian', '=', $unit)
            //         ->whereBetween('b.tanggal', [date('Y-m-01'), date('Y-m-t')])
            //         ->orderBy('b.id', 'desc')
            //         ->get();
            // } elseif (Auth::user()->admin == '3') {
            //     $unit = 'GUDANG';
            //     $data = DB::table('absensi_komunikasiitm AS b')
            //         ->select('b.id', 'b.noform', 'b.tanggal', 'b.nama', 'b.suratid', 'b.sst', 'b.keterangan', 'b.statussurat')
            //         ->join('penerimaan_karyawan AS k', 'b.userid', '=', 'k.userid')
            //         ->where('k.bagian', '=', $unit)
            //         ->whereBetween('b.tanggal', [date('Y-m-01'), date('Y-m-t')])
            //         ->orderBy('b.id', 'desc')
            //         ->get();
            // }

            if (Auth::user()->admin != 'ALL') {
                $data = DB::table('absensi_komunikasiitm AS b')
                    ->select('b.id', 'b.noform', 'b.tanggal', 'a.tanggal as tanggalform', 'b.tanggal2', 'b.nama', 'b.suratid', 'b.sst', 'b.keterangan', 'b.statussurat', 'c.stb', 'c.bagian', 'c.grup')
                    ->leftjoin('absensi_komunikasi AS a', 'b.noform', '=', 'a.noform')
                    ->leftjoin('penerimaan_karyawan AS c', 'b.userid', '=', 'c.userid')
                    ->whereBetween('b.tanggal', [$dari, $sampai])
                    ->where('b.dibuat', '=', Auth::user()->name)
                    ->orderBy('b.id', 'desc')
                    ->get();
            } else {
                $data = DB::table('absensi_komunikasiitm AS b')
                    ->select('b.id', 'b.noform', 'b.tanggal', 'a.tanggal as tanggalform', 'b.tanggal2', 'b.nama', 'b.suratid', 'b.sst', 'b.keterangan', 'b.statussurat', 'c.stb', 'c.bagian', 'c.grup')
                    ->leftjoin('absensi_komunikasi AS a', 'b.noform', '=', 'a.noform')
                    ->leftjoin('penerimaan_karyawan AS c', 'b.userid', '=', 'c.userid')
                    ->whereBetween('b.tanggal', [$dari, $sampai])
                    ->orderBy('b.id', 'desc')
                    ->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('tanggal', function ($row) {
                    $tgl = Carbon::parse($row->tanggal)->format('d/m/Y');
                    return $tgl;
                })
                ->addColumn('thari', function ($row) {
                    $diff = 1 + Carbon::parse($row->tanggal)->diffInDays($row->tanggal2);
                    return $diff;
                })
                ->addColumn('tanggalKomunikasi', function ($row) {
                    if ($row->tanggal == $row->tanggal2) {
                        $tgl = Carbon::parse($row->tanggal)->format('d/m/Y');
                    } else {
                        $tgl = Carbon::parse($row->tanggal)->format('d') . "-" . Carbon::parse($row->tanggal2)->format('d/m/Y');
                    }
                    return $tgl;
                })
                ->addColumn('tanggalform', function ($row) {
                    $tgl = Carbon::parse($row->tanggalform)->format('d/m/Y');
                    return $tgl;
                })

                ->addColumn('statussurat', function ($row) {
                    if ($row->statussurat == 'PENGAJUAN') {
                        $statussur = '<span class="badge bg-blue text-blue-fg">' . $row->statussurat . '</span>';
                    } elseif ($row->statussurat == 'ACC') {
                        $statussur = '<span class="badge bg-green text-blue-fg">' . $row->statussurat . '</span>';
                    } elseif ($row->statussurat == 'REJECT') {
                        $statussur = '<span class="badge bg-red text-blue-fg">' . $row->statussurat . '</span>';
                    } else {
                        $statussur = '<span class="badge bg-dark text-blue-fg">' . $row->statussurat . '</span>';
                    }
                    return $statussur;
                })

                ->addColumn('action', function ($row) {
                    if ($row->statussurat == "PENGAJUAN") {
                        $btn = ' <a href="komunikasi/printKomunikasi/' . $row->noform . '" target="_blank" data-toggle="tooltip" data-placement="top" title="Print Surat Komunikasi" data-id="' . $row->id . '" class="btn btn-sm btn-info btn-icon"><i class="fa-solid fa-print"></i></a>';
                        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-nama="' . $row->nama . '" data-id="' . $row->id . '" data-noform="' . $row->noform . '" data-suratid="' . $row->suratid . '" data-keterangan="' . $row->keterangan . '" data-original-title="Delete" class="btn btn-danger btn-sm btn-icon deletePos"><i class="fa-solid fa-fw fa-trash-can"></i></a>';
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

    public function destroy($id)
    {
        // pr_01daftarentitas::find($id)->delete();
        DB::table('absensi_komunikasiitm')->where('id', '=', $id)->delete();

        return response()->json(['success' => 'Record deleted successfully.']);
    }
}
