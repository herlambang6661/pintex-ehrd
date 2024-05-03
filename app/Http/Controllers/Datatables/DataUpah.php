<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


class DataUpah extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('daftar_upah')->orderBy('jenis')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-bs-target="#modal-edit-upah" data-bs-toggle="modal" data-id="' . $row->id . '" data-jenis="' . $row->jenis . '" data-nominal="' . $row->nominal . '" class="btn btn-outline-info btn-sm btn-icon edit-btn"><i class="fa-solid fa-fw fa-edit"></i></a>';

                    return $btn;
                })
                ->rawColumns(['status', 'action', 'select_orders', 'ttl', 'umur'])
                ->make(true);
        }
        return view('products.01_daftar.upah');
    }

    public function destroy($id)
    {
        DB::table('daftar_upah')->where('id', '=', $id)->delete();

        return response()->json(['success' => 'Record deleted succussfully']);
    }
}
