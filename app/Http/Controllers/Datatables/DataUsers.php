<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DataUsers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('daftar_users')->orderBy('name')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-bs-target="#modal-edit-users" data-bs-toggle="modal" data-id="' . $row->id . '" data-name="' . $row->name . '" data-group="' . $row->group . '" data-level="' . $row->level . '" class="btn btn-outline-success btn-sm btn-icon edit-btn"><i class="fa-solid fa-fw fa-edit"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-nama="' . $row->name . '" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-outline-danger btn-sm btn-icon deleteUsers"><i class="fa-solid fa-fw fa-trash-can"></i></a>';
                    return $btn;
                })
                ->rawColumns(['status', 'action', 'select_orders', 'ttl', 'umur'])
                ->make(true);
        }
        return view('products.01_daftar.shift');
    }

    public function destroy($id)
    {
        DB::table('daftar_users')->where('id', '=', $id)->delete();
        return response()->json(['success' => 'Record deleted succesfully']);
    }
}
