<?php

namespace App\Http\Controllers\Datatables;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DataPayroll extends Controller
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
        if ($request->bulan) {
            $bulan = $request->bulan;
        } else {
            $bulan = date('m');
        }
        if ($request->tahun) {
            $tahun = substr($request->tahun, -2);
        } else {
            $tahun = date('y');
        }
        if ($request->ajax()) {
            $data = DB::table('administrasi_payroll')
                ->selectRaw('
                            id, stb, nama, gapok, level, prestasi, tjabat, bank, rekening, pot_bpjs_jkk, pot_bpjs_jkm, pot_bpjs_jp, pot_bpjs_jht, pot_bpjs_ks, pot_bpjs_ksAdd, potongan_absen, potongan_infaq, potongan_koperasi, potongan_pinjaman
                            ')
                ->where('periode', '=', $tahun . $bulan)
                ->orderBy('nama', 'asc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="#viewKaryawan" data-bs-toggle="modal" data-toggle="tooltip" data-placement="top" title="Lihat Detail Data Karyawan" data-item="' . $row->nama . '" data-id="' . $row->id . '" class="btn btn-sm btn-info btn-icon"><i class="fa-solid fa-user-pen"></i></a>';
                    // $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Hapus Karyawan" data-noform="' . $row->id . '" data-nama="' . $row->nama . '" data-id="' . $row->id . '" class="btn btn-sm btn-red btn-icon deleteKaryawan"><i class="fa-solid fa-trash-can"></i></a>';
                    return $btn;
                })
                ->addColumn('level', function ($row) {
                    $btn = '<a href="" class="editableLevel" data-type="text" data-name="level" data-pk="' . $row->id . '">' . $row->level . '</a>';
                    return $btn;
                })
                ->addColumn('gbruto', function ($row) {
                    $res = $row->gapok + $row->prestasi + $row->tjabat;
                    return $res;
                })
                ->addColumn('potbpjs', function ($row) {
                    $res = $row->pot_bpjs_jkk + $row->pot_bpjs_jkm + $row->pot_bpjs_jp + $row->pot_bpjs_jht + $row->pot_bpjs_ks + $row->pot_bpjs_ksAdd;
                    return $res;
                })
                ->addColumn('potlain', function ($row) {
                    $res = $row->potongan_absen + $row->potongan_infaq + $row->potongan_koperasi + $row->potongan_pinjaman;
                    return $res;
                })
                ->addColumn('potabs', function ($row) {
                    $bruto = $row->gapok + $row->prestasi + $row->tjabat;
                    $res = - (($row->potongan_absen / 25) * $bruto);
                    return $res;
                })
                ->addColumn('gnetto', function ($row) {
                    $res = ($row->gapok + $row->prestasi + $row->tjabat) + ($row->pot_bpjs_jht + $row->pot_bpjs_jp + $row->pot_bpjs_ks) + ($row->potongan_absen + $row->potongan_infaq + $row->potongan_koperasi + $row->potongan_pinjaman);
                    return $res;
                })
                ->addColumn('pembulatan', function ($row) {
                    $res = ($row->gapok + $row->prestasi + $row->tjabat) + ($row->pot_bpjs_jht + $row->pot_bpjs_jp + $row->pot_bpjs_ks) + ($row->potongan_absen + $row->potongan_infaq + $row->potongan_koperasi + $row->potongan_pinjaman);
                    $res = ceil($res);
                    if (substr($res, -3) > 499) {
                        $result = round($res, -3);
                    } else {
                        $result = round($res, -3) + 1000;
                    }
                    return $result;
                })
                ->editColumn('select_orders', function ($row) {
                    return '';
                })
                ->rawColumns(['action', 'select_orders', 'level'])
                ->make(true);
        }
        return view('products.04_administrasi.payroll');
    }
}
