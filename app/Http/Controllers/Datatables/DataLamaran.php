<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DataLamaran extends Controller
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
            $data = DB::table('penerimaan_lamaran')->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    if ($row->wawancara == 1) {
                        $ww = '<span class="badge bg-blue text-blue-fg">Sudah</span>';
                    } else {
                        $ww = '<span class="badge bg-orange text-orange-fg">Belum</span>';
                    }
                    return $ww;
                })
                ->addColumn('ttl', function ($row) {
                    $tgl_indo = Carbon::createFromFormat('Y-m-d', $row->tgllahir)->format('d/m/Y');
                    $ttl = $row->tempat . ', ' . $tgl_indo;
                    return $ttl;
                })
                ->editColumn('select_orders', static function ($row) {
                    return '';
                })

                // ->addColumn('action', function ($row) {
                //     $btn = ' <a href="javascript:void(0)" data-toggle="tooltip" data-item="' . $row->nik . '" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-outline-info btn-icon deleteProduct"><i class="fa-solid fa-fw fa-eye"></i></a>';
                //     $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-noform="' . $row->nik . '" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-outline-danger btn-icon deleteContract"><i class="fa-solid fa-fw fa-trash-can"></i></a>';
                //     return $btn;
                // })
                ->rawColumns(['status', 'select_orders', 'ttl'])
                ->make(true);
        }
        return view('products.02_penerimaan.lamaran');
    }
}
