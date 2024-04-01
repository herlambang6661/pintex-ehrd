<?php

namespace App\Http\Controllers\Datatables;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


class DataShift extends Controller
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
            $data = DB::table('daftar_shift')->orderBy('shift')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-bs-target="#modal-edit-shift" data-bs-toggle="modal" data-id="' . $row->id . '" data-entitas="' . $row->entitas . '" data-shift="' . $row->shift . '" data-jenis="' . $row->jenis . '" data-in="' . $row->in . '" data-out="' . $row->out . '" data-keterangan="' . $row->keterangan . '" data-in_rest="' . $row->in_rest . '" data-out_rest="' . $row->out_rest . '" class="btn btn-outline-success btn-sm btn-icon edit-btn"><i class="fa-solid fa-fw fa-edit"></i></a>';


                    $btn = $btn . ' <a href="javascript:void(0)" data-bs-toggle="modal" data-id="' . $row->id . '" data-bs-target="#modal-view-shift" class="btn btn-outline-info btn-sm btn-icon"><i class="fa-solid fa-fw fa-eye"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-nama="' . $row->shift . '" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-outline-danger btn-sm btn-icon deleteShift"><i class="fa-solid fa-fw fa-trash-can"></i></a>';
                    return $btn;
                })
                ->rawColumns(['status', 'action', 'select_orders', 'ttl', 'umur'])
                ->make(true);
        }
        return view('products.01_daftar.shift');
    }

    public function destroy($id)
    {
        DB::table('daftar_shift')->where('id', '=', $id)->delete();

        return response()->json(['success' => 'Record deleted successfully.']);
    }
}
