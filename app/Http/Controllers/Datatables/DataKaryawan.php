<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DataKaryawan extends Controller
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

            $data = DB::table('penerimaan_karyawan')
                ->where('status', 'like', $sst)
                ->orderBy('nama', 'asc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $btn = ' <a href="#viewKaryawan" data-bs-toggle="modal" data-toggle="tooltip" data-placement="top" title="Lihat Detail Data Karyawan" data-item="' . $row->nama . '" data-id="' . $row->id . '" class="btn btn-sm btn-outline-info btn-icon"><i class="fa-solid fa-eye"></i></a>';
                    $btn = $btn . ' <a href="karyawan/edit/' . $row->id . '" data-toggle="tooltip" data-placement="top" title="Edit" data-noform="' . $row->id . '" data-nama="' . $row->nama . '" data-id="' . $row->id . '" class="btn btn-sm btn-outline-orange btn-icon editKaryawan"><i class="fa-solid fa-pen-to-square"></i></a>';
                    return $btn;
                })

                ->addColumn('pas', function ($row) {
                    if (file_exists(public_path() . '/photo/pas/' . $row->userid . '.jpg')) {
                        return "<b class='text-success'>Sudah</b>";
                    } else {
                        return "<b class='text-danger'>Belum</b>";
                    }
                })

                ->editColumn('ktp', function ($row) {
                    if (file_exists(public_path() . '/photo/ktp/' . $row->userid . '.jpg')) {
                        return "<b class='text-success'>Sudah</b>";
                    } else {
                        return "<b class='text-danger'>Belum</b>";
                    }
                })

                ->addColumn('bpjs_jkk', function ($row) {
                    $btn = ($row->bpjs_jkk == "1") ? '<i class="fa-solid fa-check text-success"></i>' : '<i class="fa fa-xmark"></i>';
                    return $btn;
                })
                ->addColumn('bpjs_jkm', function ($row) {
                    $btn = ($row->bpjs_jkm == "1") ? '<i class="fa-solid fa-check text-success"></i>' : '<i class="fa fa-xmark"></i>';
                    return $btn;
                })
                ->addColumn('bpjs_jp', function ($row) {
                    $btn = ($row->bpjs_jp == "1") ? '<i class="fa-solid fa-check text-success"></i>' : '<i class="fa fa-xmark"></i>';
                    return $btn;
                })
                ->addColumn('bpjs_jht', function ($row) {
                    $btn = ($row->bpjs_jht == "1") ? '<i class="fa-solid fa-check text-success"></i>' : '<i class="fa fa-xmark"></i>';
                    return $btn;
                })
                ->addColumn('bpjs_ks', function ($row) {
                    $btn = ($row->bpjs_ks == "1") ? '<i class="fa-solid fa-check text-success"></i>' : '<i class="fa fa-xmark"></i>';
                    return $btn;
                })


                ->addColumn('copystb', function ($row) {
                    $btn = '<a href="javascript:void(0)" onclick="copyContent(' . $row->stb . ')">' . $row->stb . '</a>';
                    $btn = $btn . '<p id="stbText' . $row->stb . '" hidden>' . $row->stb . '</p>';
                    return $btn;
                })

                ->addColumn('actionBPJS', function ($row) {
                    $btn = ' <a href="#editBPJS" data-bs-toggle="modal" data-toggle="tooltip" data-placement="top" title="Lihat Detail Data BPJS Karyawan" data-item="' . $row->nama . '" data-id="' . $row->id . '" class="btn btn-sm btn-info btn-icon"><i class="fa-solid fa-user-pen"></i></a>';
                    return $btn;
                })
                ->rawColumns(['status', 'action', 'actionBPJS', 'select_orders', 'ttl', 'umur', 'bpjs_jkk', 'bpjs_jkm', 'bpjs_jp', 'bpjs_jht', 'bpjs_ks', 'copystb', 'pas', 'ktp'])
                ->make(true);
        }
        return view('products.02_penerimaan.wawancara');
    }
}
