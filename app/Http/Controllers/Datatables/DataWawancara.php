<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DataWawancara extends Controller
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
            $data = DB::table('penerimaan_lamaran as a')
                ->join('penerimaan_wawancara as b', 'a.id', '=', 'b.idlamaran')
                ->select('b.noform', 'a.*')
                ->where('a.wawancara', 1)
                ->orderBy('a.id', 'desc')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    if ($row->diterima == 1) {
                        $ww = '<span class="badge bg-green text-blue-fg">Diterima</span>';
                    } elseif ($row->diterima == 2) {
                        $ww = '<span class="badge bg-red text-orange-fg">Ditolak</span>';
                    } else {
                        $ww = '<span class="badge bg-secondary text-orange-fg">Belum</span>';
                    }
                    return $ww;
                })
                ->addColumn('ttl', function ($row) {
                    $tgl_indo = Carbon::createFromFormat('Y-m-d', $row->tgllahir)->format('d/m/Y');
                    $ttl = $row->tempat . ', ' . $tgl_indo;
                    return $ttl;
                })
                ->addColumn('umur', function ($row) {
                    $umur = Carbon::parse($row->tgllahir)->age;

                    return $umur;
                })
                ->editColumn('select_orders', function ($row) {
                    return '';
                })

                ->addColumn('action', function ($row) {
                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip" data-item="' . $row->nik . '" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-sm btn-outline-info btn-icon deleteProduct"><i class="fa-solid fa-fw fa-eye"></i></a>
                   <a href="javascript:void(0)" data-toggle="tooltip" data-item="' . $row->nik . '" data-id="' . $row->id . '" data-noform="' . $row->noform . '" data-original-title="Print" class="btn btn-sm btn-outline-success btn-icon printButton" target="_blank">
                    <i class="fa-solid fa-fw fa-print"></i>
                    </a>
                    ';
                    // $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-noform="' . $row->noformwawancara . '" data-nama="' . $row->nama . '" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-sm btn-outline-warning btn-icon cancelWawancara"><i class="fa-solid fa-arrow-rotate-left"></i></a>';
                    // $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" class="btn btn-outline-green btn-icon"><i class="fa-solid fa-check"></i></a>';
                    // $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" class="btn btn-outline-red btn-icon"><i class="fa-solid fa-xmark"></i></a>';
                    return $btn;
                })
                ->rawColumns(['status', 'action', 'select_orders', 'ttl', 'umur'])
                ->make(true);
            dd($noform);
        }
        return view('products.02_penerimaan.wawancara');
    }
}
