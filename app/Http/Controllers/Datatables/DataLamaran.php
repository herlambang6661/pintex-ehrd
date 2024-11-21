<?php

namespace App\Http\Controllers\Datatables;

use App\Models\KandidatModel;
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

            if ($request->wawancara == '1') {
                $wawancara = 1;
            } elseif ($request->wawancara == '0') {
                $wawancara = 0;
            } else {
                $wawancara = "";
            }

            $data = DB::table('penerimaan_lamaran')
                ->where('tglinput', '>=', $dari)
                ->where('tglinput', '<=', $sampai)
                ->where('wawancara', 'like', '%' . $wawancara . '%')
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

                ->addColumn('foto_pas', function ($row) {
                    // $dataKandidat = KandidatModel::where('ktp', $row->nik)->first();
                    return '
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>
                        ';
                })
                ->addColumn('foto_ktp', function ($row) {
                    return '<a href="#" class="btn btn-icon btn-outline-dark btn-sm"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg></a>';
                })
                ->addColumn('foto_kk', function ($row) {
                    return '<a href="#" class="btn btn-icon btn-outline-dark btn-sm"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg></a>';
                })
                ->addColumn('foto_ijazah', function ($row) {
                    return '<a href="#" class="btn btn-icon btn-outline-dark btn-sm"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg></a>';
                })
                ->addColumn('foto_suratsehat', function ($row) {
                    return '<a href="#" class="btn btn-icon btn-outline-dark btn-sm"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg></a>';
                })
                ->addColumn('file_cv', function ($row) {
                    return '<a href="#" class="btn btn-icon btn-outline-dark btn-sm"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg></a>';
                })
                ->addColumn('file_pengalaman', function ($row) {
                    return '<a href="#" class="btn btn-icon btn-outline-dark btn-sm"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg></a>';
                })
                ->addColumn('file_sima', function ($row) {
                    return '<a href="#" class="btn btn-icon btn-outline-dark btn-sm"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg></a>';
                })
                ->addColumn('file_simb', function ($row) {
                    return '<a href="#" class="btn btn-icon btn-outline-dark btn-sm"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg></a>';
                })
                ->addColumn('file_simb2', function ($row) {
                    return '<a href="#" class="btn btn-icon btn-outline-dark btn-sm"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg></a>';
                })
                ->addColumn('file_sio', function ($row) {
                    return '<a href="#" class="btn btn-icon btn-outline-dark btn-sm"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg></a>';
                })
                ->rawColumns(['status', 'action', 'select_orders', 'ttl', 'umur', 'foto_pas', 'foto_ktp', 'foto_kk', 'file_simb', 'foto_ijazah', 'foto_suratsehat', 'file_pengalaman', 'file_cv', 'file_sima', 'file_simb2', 'file_sio'])
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
