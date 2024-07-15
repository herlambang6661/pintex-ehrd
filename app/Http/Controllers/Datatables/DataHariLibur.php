<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


class DataHariLibur extends Controller
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
            $data = DB::table('daftar_hari_libur_nasional')->orderBy('tanggal', 'desc')->where('tahun', $request->tahun)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('tanggal', function ($row) {
                    $tgl = Carbon::parse($row->tanggal)->format('d/m/Y');
                    return $tgl;
                })
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="prosesLibnas/' . $row->id . '"  onclick="return loading();" class="btn btn-outline-info btn-sm btn-icon"><i class="fa-solid fa-rotate"></i></a>';
                    $btn = $btn . ' <a href="kembalikanLibnas/' . $row->tanggal . '" class="btn btn-outline-warning btn-sm btn-icon edit-btn"><i class="fa-solid fa-rotate-left"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-nama="' . $row->tanggal . '" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-outline-danger btn-sm btn-icon deletePos"><i class="fa-solid fa-fw fa-trash-can"></i></a>';
                    return $btn;
                })
                ->rawColumns(['tanggal', 'action',])
                ->make(true);
        }
        return view('products.01_daftar.hari_libur_nasional');
    }

    public function destroy($id)
    {
        DB::table('daftar_hari_libur_nasional')->where('id', '=', $id)->delete();

        return response()->json(['success' => 'Record deleted successfully.']);
    }
}
