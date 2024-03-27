<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DataPos extends Controller
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
            $data = DB::table('daftar_pospekerjaan')->orderBy('entitas')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-bs-target="#modal-edit" data-bs-toggle="modal" data-id="' . $row->id . '" data-entitas="' . $row->entitas . '" data-type="' . $row->type . '" data-desc="' . $row->desc . '" class="btn btn-outline-info btn-sm btn-icon edit-btn"><i class="fa-solid fa-fw fa-edit"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-bs-toggle="modal" data-id="' . $row->id . '" data-bs-target="#modal-view-pos" class="btn btn-outline-info btn-sm btn-icon"><i class="fa-solid fa-fw fa-eye"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-nama="' . $row->entitas . '" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-outline-danger btn-sm btn-icon deletePos"><i class="fa-solid fa-fw fa-trash-can"></i></a>';
                    return $btn;
                })
                ->rawColumns(['status', 'action', 'select_orders', 'ttl', 'umur'])
                ->make(true);
        }
        return view('products.01_daftar.pos_pekerjaan');
    }

    public function destroy($id)
    {
        DB::table('daftar_pospekerjaan')->where('id', '=', $id)->delete();

        return response()->json(['success' => 'Record deleted successfully.']);
    }
}
