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
                    $btn = ' <a href="javascript:void(0)" data-bs-toggle="modal" data-id="' . $row->id . '" data-bs-target="#modal-view" class="btn btn-outline-info btn-sm btn-icon"><i class="fa-solid fa-fw fa-eye"></i></a>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-id="' . $row->id . '" data-bs-target="#modal-view-foto" class="btn btn-outline-danger btn-sm btn-icon"><i class="fa-solid fa-camera-retro"></i></a>
                    ';
                    // $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-nama="' . $row->nama . '" data-id="' . $row->id . '" data-wawancara="' . $row->wawancara . '" data-original-title="Delete" class="btn btn-outline-danger btn-sm btn-icon deleteLamaran"><i class="fa-solid fa-fw fa-trash-can"></i></a>';
                    return $btn;
                })

                // ->addColumn('foto_pas', function ($row) {
                //     $dataKandidat = KandidatModel::where('ktp', $row->nik)->first();
                //     $PasFotoUrl = $dataKandidat ? 'https://karir.pintex.co.id/storage/biodata/pas/' . $dataKandidat->foto_pas : 'default_image_path';

                //     if ($dataKandidat && !empty($dataKandidat->foto_pas)) {
                //         $iconSvg = '
                //         <a href="' . $PasFotoUrl . '" target="_blank">
                //         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>
                //         </a>';
                //     } else {
                //         $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>';
                //     }

                //     return $iconSvg;
                // })
                // ->addColumn('foto_ktp', function ($row) {
                //     $dataKandidat = KandidatModel::where('ktp', $row->nik)->first();
                //     $FotoKtpUrl = $dataKandidat ? 'https://karir.pintex.co.id/storage/biodata/ktp/' . $dataKandidat->foto_ktp : 'default_image_path';

                //     if ($dataKandidat && !empty($dataKandidat->foto_ktp)) {
                //         $iconSvg = '
                //         <a href="' . $FotoKtpUrl . '" target="_blank">
                //         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>
                //         </a>';
                //     } else {
                //         $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>';
                //     }

                //     return $iconSvg;
                // })
                // ->addColumn('foto_kk', function ($row) {
                //     $dataKandidat = KandidatModel::where('ktp', $row->nik)->first();
                //     $FotoKkUrl = $dataKandidat ? 'https://karir.pintex.co.id/storage/biodata/kk/' . $dataKandidat->foto_kk : 'default_image_path';

                //     if ($dataKandidat && !empty($dataKandidat->foto_kk)) {
                //         $iconSvg = '
                //         <a href="' . $FotoKkUrl . '" target="_blank">
                //         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>
                //         </a>';
                //     } else {
                //         $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>';
                //     }

                //     return $iconSvg;
                // })
                // ->addColumn('foto_ijazah', function ($row) {
                //     $dataKandidat = KandidatModel::where('ktp', $row->nik)->first();
                //     $FotoIjazahUrl = $dataKandidat ? 'https://karir.pintex.co.id/storage/biodata/ijazah/' . $dataKandidat->foto_ijazah : 'default_image_path';

                //     if ($dataKandidat && !empty($dataKandidat->foto_ijazah)) {
                //         $iconSvg = '
                //         <a href="' . $FotoIjazahUrl . '" target="_blank">
                //         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>
                //         </a>';
                //     } else {
                //         $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>';
                //     }

                //     return $iconSvg;
                // })
                // ->addColumn('foto_suratsehat', function ($row) {
                //     $dataKandidat = KandidatModel::where('ktp', $row->nik)->first();
                //     $FotoSuratSehatpUrl = $dataKandidat ? 'https://karir.pintex.co.id/storage/biodata/suratsehat/' . $dataKandidat->foto_suratsehat : 'default_image_path';

                //     if ($dataKandidat && !empty($dataKandidat->foto_suratsehat)) {
                //         $iconSvg = '
                //         <a href="' . $FotoSuratSehatpUrl . '" target="_blank">
                //         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>
                //         </a>';
                //     } else {
                //         $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>';
                //     }

                //     return $iconSvg;
                // })
                // ->addColumn('file_cv', function ($row) {
                //     $dataKandidat = KandidatModel::where('ktp', $row->nik)->first();
                //     $FileCvUrl = $dataKandidat ? 'https://karir.pintex.co.id/storage/biodata/cv/' . $dataKandidat->file_cv : 'default_image_path';

                //     if ($dataKandidat && !empty($dataKandidat->file_cv)) {
                //         $iconSvg = '
                //         <a href="' . $FileCvUrl . '" target="_blank">
                //         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>
                //         </a>';
                //     } else {
                //         $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>';
                //     }

                //     return $iconSvg;
                // })
                // ->addColumn('file_pengalaman', function ($row) {
                //     $dataKandidat = KandidatModel::where('ktp', $row->nik)->first();
                //     $FilePengalamanUrl = $dataKandidat ? 'https://karir.pintex.co.id/storage/biodata/pengalaman/' . $dataKandidat->file_pengalaman : 'default_image_path';

                //     if ($dataKandidat && !empty($dataKandidat->file_pengalaman)) {
                //         $iconSvg = '
                //         <a href="' . $FilePengalamanUrl . '" target="_blank">
                //         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>
                //         </a>';
                //     } else {
                //         $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>';
                //     }

                //     return $iconSvg;
                // })
                // ->addColumn('file_sima', function ($row) {
                //     $dataKandidat = KandidatModel::where('ktp', $row->nik)->first();
                //     $filesimAUrl = $dataKandidat ? 'https://karir.pintex.co.id/storage/biodata/sima/' . $dataKandidat->file_sima : 'default_image_path';

                //     if ($dataKandidat && !empty($dataKandidat->file_sima)) {
                //         $iconSvg = '
                //         <a href="' . $filesimAUrl . '" target="_blank">
                //         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>
                //         </a>';
                //     } else {
                //         $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>';
                //     }

                //     return $iconSvg;
                // })
                // ->addColumn('file_simb', function ($row) {
                //     $dataKandidat = KandidatModel::where('ktp', $row->nik)->first();
                //     $filesimBUrl = $dataKandidat ? 'https://karir.pintex.co.id/storage/biodata/simb/' . $dataKandidat->file_simb : 'default_image_path';

                //     if ($dataKandidat && !empty($dataKandidat->file_simb)) {
                //         $iconSvg = '
                //         <a href="' . $filesimBUrl . '" target="_blank">
                //         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>
                //         </a>';
                //     } else {
                //         $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>';
                //     }

                //     return $iconSvg;
                // })
                // ->addColumn('file_simb2', function ($row) {
                //     $dataKandidat = KandidatModel::where('ktp', $row->nik)->first();
                //     $filesimB2Url = $dataKandidat ? 'https://karir.pintex.co.id/storage/biodata/simb2/' . $dataKandidat->file_simb2 : 'default_image_path';

                //     if ($dataKandidat && !empty($dataKandidat->file_simb2)) {
                //         $iconSvg = '
                //         <a href="' . $filesimB2Url . '" target="_blank">
                //         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>
                //         </a>';
                //     } else {
                //         $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>';
                //     }

                //     return $iconSvg;
                // })
                // ->addColumn('file_sio', function ($row) {
                //     $dataKandidat = KandidatModel::where('ktp', $row->nik)->first();
                //     $fileSioUrl = $dataKandidat ? 'https://karir.pintex.co.id/storage/biodata/sio/' . $dataKandidat->file_sio : 'default_image_path';

                //     if ($dataKandidat && !empty($dataKandidat->file_sio)) {
                //         $iconSvg = '
                //         <a href="' . $fileSioUrl . '" target="_blank">
                //         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>
                //         </a>';
                //     } else {
                //         $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-script"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" /></svg>';
                //     }

                //     return $iconSvg;
                // })
                ->rawColumns(['status', 'action', 'select_orders', 'ttl', 'umur'])
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
