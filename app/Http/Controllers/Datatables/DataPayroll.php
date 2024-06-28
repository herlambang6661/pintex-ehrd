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
                            id, periode, stb, nama, gapok, level, prestasi, tjabat, bank, rekening, pot_bpjs_jkk, pot_bpjs_jkm, pot_bpjs_jp, pot_bpjs_jht, pot_bpjs_ks, pot_bpjs_ksAdd, potongan_absen, potongan_infaq, potongan_koperasi, potongan_pinjaman, potongan_absen_fix, potongan_absen_rp
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
                    // $btn = '<a href="" class="editableLevel" data-type="text" data-name="level" data-pk="' . $row->id . '">' . $row->level . '</a>';
                    return $row->level;
                })
                ->addColumn('gbruto', function ($row) {
                    $res = $row->gapok + $row->prestasi + $row->tjabat;
                    return $res;
                })
                ->addColumn('potbpjs', function ($row) {
                    $res = $row->pot_bpjs_jkk + $row->pot_bpjs_jkm + $row->pot_bpjs_jp + $row->pot_bpjs_jht + $row->pot_bpjs_ks + $row->pot_bpjs_ksAdd;
                    return $res;
                })
                ->addColumn('totpot', function ($row) {
                    $bpjs = $row->pot_bpjs_jkk + $row->pot_bpjs_jkm + $row->pot_bpjs_jp + $row->pot_bpjs_jht + $row->pot_bpjs_ks + $row->pot_bpjs_ksAdd;
                    $infaqkoperasi = $row->potongan_koperasi + $row->potongan_infaq;
                    $res = $bpjs + $infaqkoperasi + $row->potongan_absen_rp + $row->potongan_pinjaman;
                    return $res;
                })
                ->addColumn('potabs', function ($row) {
                    $bruto = $row->gapok + $row->prestasi + $row->tjabat;
                    $res = - (($row->potongan_absen_fix / 25) * $bruto);
                    return $res;
                })
                ->addColumn('gnetto', function ($row) {
                    $bruto = $row->gapok + $row->prestasi + $row->tjabat;
                    $bpjs = $row->pot_bpjs_jkk + $row->pot_bpjs_jkm + $row->pot_bpjs_jp + $row->pot_bpjs_jht + $row->pot_bpjs_ks + $row->pot_bpjs_ksAdd;
                    $infaqkoperasi = $row->potongan_koperasi + $row->potongan_infaq + $row->potongan_pinjaman;
                    $potongan = $bpjs + $infaqkoperasi + $row->potongan_absen_rp;

                    $res = $bruto + $potongan;
                    return $res;
                })
                ->addColumn('pembulatan', function ($row) {
                    $res = ($row->gapok + $row->prestasi + $row->tjabat) + ($row->pot_bpjs_jht + $row->pot_bpjs_jp + $row->pot_bpjs_ks) + ($row->potongan_absen_rp + $row->potongan_infaq + $row->potongan_koperasi + $row->potongan_pinjaman);
                    $res = ceil($res);
                    if (substr($res, -3) > 499) {
                        $result = round($res, -2);
                    } else {
                        $result = round($res, -2) + 100;
                    }
                    return $result;
                })
                ->addColumn('opsiEditLevelKaryawan', function ($row) {
                    $result = '
                        <a href="#editKaryawan" data-bs-toggle="modal"
                            data-toggle="tooltip" data-placement="top"
                            title="Edit Data Karyawan" data-item="' . $row->nama . '"
                            data-id="' . $row->id . '"
                            class="btn btn-sm btn-outline-info btn-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                <path
                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                <path d="M16 5l3 3" />
                            </svg>
                        </a>';
                    return $result;
                })

                ->editColumn('select_orders', function ($row) {
                    return '';
                })
                ->rawColumns(['action', 'select_orders', 'level', 'opsiEditLevelKaryawan'])
                ->make(true);
        }
        return view('products.04_administrasi.payroll');
    }
}
