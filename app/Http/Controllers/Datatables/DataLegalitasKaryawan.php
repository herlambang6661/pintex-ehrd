<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DataLegalitasKaryawan extends Controller
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
            if ($request->status) {
                if ($request->status == '*') {
                    $sst = '%%';
                } else {
                    $sst = '%' . $request->status . '%';
                }
            } else {
                $sst = '%Aktif%';
            }

            if ($request->bagian) {
                if ($request->bagian == '*') {
                    $bagian = '%%';
                } else {
                    $bagian = '%' . $request->bagian . '%';
                }
            } else {
                $bagian = '%%';
            }

            if ($request->grup) {
                if ($request->grup == '*') {
                    $grup = '%%';
                } else {
                    $grup = '%' . $request->grup . '%';
                }
            } else {
                $grup = '%%';
            }

            if ($request->shift) {
                if ($request->shift == '*') {
                    $shift = '%%';
                } else {
                    $shift = '%' . $request->shift . '%';
                }
            } else {
                $shift = '%%';
            }

            $data = DB::table('penerimaan_karyawan')
                ->where('status', 'like', $sst)
                ->where('bagian', 'like', $bagian)
                ->where('grup', 'like', $grup)
                ->where('shift', 'like', $shift)
                ->orderBy('nama', 'asc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('ttl', function ($row) {
                    if ($row->tglmasuk) {
                        $tgl_indo = Carbon::createFromFormat('Y-m-d', $row->tglmasuk)->format('d/m/Y');
                    } else {
                        $tgl_indo = '';
                    }
                    return $tgl_indo;
                })
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="legalitas/edit/' . $row->userid . '" data-toggle="tooltip" data-placement="top" title="Edit Data Legalitas Karyawan" class="btn btn-sm btn-info btn-icon"><i class="fa-solid fa-file-signature"></i></a>';
                    return $btn;
                })
                ->rawColumns(['status', 'action', 'select_orders', 'ttl', 'umur'])
                ->make(true);
        }
        return view('products.02_penerimaan.legalitas');
    }
}
