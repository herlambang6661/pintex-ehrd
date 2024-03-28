<?php

namespace App\Http\Controllers\Datatables;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DataEntitas extends Controller
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
            $data = DB::table('daftar_entitas')->orderBy('singkatan')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-bs-target="#modal-edit-entitas" data-bs-toggle="modal" data-id="' . $row->id . '" data-singkatan="' . $row->singkatan . '" data-nama="' . $row->nama . '" data-alamat="' . $row->alamat . '" class="btn btn-outline-info btn-sm btn-icon edit-btn"><i class="fa-solid fa-fw fa-edit"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-bs-toggle="modal" data-id="' . $row->id . '" data-bs-target="#modal-view-entitas" class="btn btn-outline-info btn-sm btn-icon"><i class="fa-solid fa-fw fa-eye"></i></a>';

                    $btn = $btn .  ' <a href="javascript:void(0)" data-toggle="tooltip" data-nama="' . $row->singkatan . '" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-outline-danger btn-sm btn-icon deleteEntitas"><i class="fa-solid fa-fw fa-trash-can"></i></a>';
                    return $btn;
                })
                ->rawColumns(['status', 'action', 'select_orders', 'ttl', 'umur'])
                ->make(true);
        }
        return view('products.01_daftar.daftar_entitas');
    }

    public function destroy($id)
    {
        DB::table('daftar_entitas')->where('id', '=', $id)->delete();

        return response()->json(['success' => 'Record deleted successfully.']);
    }
}
