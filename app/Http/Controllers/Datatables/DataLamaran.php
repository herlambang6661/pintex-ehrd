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
            if ($request->dari) {
                $dari = $request->dari;
            } else {
                $dari = date('Y-m-01');
            }

            if ($request->sampai) {
                $sampai = $request->sampai;
            } else {
                $sampai = date('Y-m-d');
            }
            $data = DB::table('penerimaan_lamaran')
                ->whereBetween('tglinput', [$dari, $sampai])
                ->orderBy('id', 'desc')
                ->get();
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
                ->addColumn('umur', function ($row) {
                    $umur = Carbon::parse($row->tgllahir)->age;

                    return $umur;
                })
                ->editColumn('select_orders', function ($row) {
                    return '';
                })

                ->addColumn('action', function ($row) {
                    $btn = ' <a href="javascript:void(0)" data-bs-toggle="modal" data-id="' . $row->id . '" data-bs-target="#modal-view" class="btn btn-outline-info btn-sm btn-icon"><i class="fa-solid fa-fw fa-eye"></i></a>';
                    // $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-nama="' . $row->nama . '" data-id="' . $row->id . '" data-wawancara="' . $row->wawancara . '" data-original-title="Delete" class="btn btn-outline-danger btn-sm btn-icon deleteLamaran"><i class="fa-solid fa-fw fa-trash-can"></i></a>';
                    return $btn;
                })
                ->rawColumns(['status', 'action', 'select_orders', 'ttl', 'umur'])
                ->make(true);
        }
        return view('products.02_penerimaan.lamaran');
    }

    public function destroy($id)
    {
        // pr_01daftarentitas::find($id)->delete();
        DB::table('penerimaan_lamaran')->where('id', '=', $id)->delete();

        return response()->json(['success' => 'Record deleted successfully.']);
    }
}
