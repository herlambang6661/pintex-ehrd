<?php

namespace App\Http\Controllers\Datatables;

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
            $data = DB::table('daftar_hari_libur_nasional')->orderBy('tanggal')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-bs-target="#modal-edit-liburnas" data-bs-toggle="modal" data-id="' . $row->id . '" data-entitas="' . $row->entitas . '" data-tanggal="' . $row->tanggal . '" data-libur_nasional="' . $row->libur_nasional . '" data-sumber_ketentuan="' . $row->sumber_ketentuan . '" data-keterangan="' . $row->keterangan . '" class="btn btn-outline-info btn-sm btn-icon edit-btn"><i class="fa-solid fa-fw fa-edit"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-bs-toggle="modal" data-id="' . $row->id . '" data-bs-target="#modal-view-liburnas" class="btn btn-outline-info btn-sm btn-icon"><i class="fa-solid fa-fw fa-eye"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-nama="' . $row->tanggal . '" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-outline-danger btn-sm btn-icon deletePos"><i class="fa-solid fa-fw fa-trash-can"></i></a>';
                    return $btn;
                })
                ->rawColumns(['status', 'action', 'select_orders', 'ttl', 'umur'])
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
