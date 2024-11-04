<?php

namespace App\Http\Controllers;

use App\Models\KandidatModel;
use App\Models\Loker;
use Carbon\Carbon;
use Nette\Utils\Image;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\PenerimaanLowongan;

class Penerimaan extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Jakarta');
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    }

    // ======================== START LOWONGAN ==============================================================================================

    public function lowongan()
    {
        $judul = "Lowongan";
        $penerimaan = "active";
        $lowongan = "active";

        $loker = Loker::simplePaginate(6);

        return view('products.02_penerimaan.lowongan', [
            'judul' => $judul,
            'penerimaan' => $penerimaan,
            'lowongan' => $lowongan,
            'loker' => $loker,
        ]);
    }
    public function addLowongan()
    {
        $judul = "Tambah Lowongan";
        $penerimaan = "active";
        $lowongan = "active";
        return view('products/02_penerimaan.lowonganAdd', [
            'judul' => $judul,
            'penerimaan' => $penerimaan,
            'lowongan' => $lowongan
        ]);
    }

    function storeLowongan(Request $request)
    {
        $request->validate(
            [
                '_token' => 'required',
                'entitas' => 'required',
                'lowongan' => 'required',
                'pendidikan' => 'required',
                'requirement' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'entitas.required' => 'Entitas Diperlukan',
                'lowongan.required' => 'Lowongan Diperlukan',
                'pendidikan.required' => 'Pendidikan Diperlukan',
                'requirement.required' => 'Requirement Diperlukan',
                'image.image' => 'File yang diunggah harus berupa gambar',
                'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
                'image.max' => 'Ukuran gambar maksimal 2MB',
            ]
        );

        try {
            // Generate a random filename for the image
            $randomFileName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();

            // Store the uploaded image in the storage directory
            $imagePath = $request->file('image')->storeAs('', $randomFileName, 'public');

            $check = DB::table('penerimaan_lowongan')->insert([
                'entitas' => $request->entitas,
                'unlimited' => $request->tdkadatgl,
                'tgl_buka' => $request->tglbuka,
                'tgl_tutup' => $request->tgltutup,
                'posisi' => $request->lowongan,
                'pendidikan' => $request->pendidikan,
                'sima' => $request->simA,
                'simb' => $request->simB,
                'simb2' => $request->simB2,
                'sio' => $request->sio,
                'image' => $imagePath,
                'deskripsi' => $request->requirement,
                'release' => 0,
                'dibuat' => Auth::user()->name,
                'created_at' => now(),
            ]);

            return redirect()->route('penerimaan.lowongan')->with('success', 'Lowongan Pekerjaan Berhasil Dibuat, silahkan mengaktifkan untuk Loker bisa dilihat oleh kandidat');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'Error with : ' . $e->getMessage());
        }
    }


    public function editLowongan($id)
    {
        $judul = "Edit Lowongan";
        $penerimaan = "active";
        $lowongan = "active";

        $lwn = PenerimaanLowongan::findOrFail($id);
        return view('products.02_penerimaan.lowonganEdit', [
            'judul' => $judul,
            'penerimaan' => $penerimaan,
            'lowongan' => $lowongan,
            'lwn' => $lwn
        ]);
    }

    public function updateLowongan(Request $request, $id)
    {
        $request->validate(
            [
                '_token' => 'required',
                'entitas' => 'required',
                'lowongan' => 'required',
                'pendidikan' => 'required',
                'requirement' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Ubah menjadi nullable
            ],
            [
                'entitas.required' => 'Entitas Diperlukan',
                'lowongan.required' => 'Lowongan Diperlukan',
                'pendidikan.required' => 'Pendidikan Diperlukan',
                'requirement.required' => 'Requirement Diperlukan',
                'image.image' => 'File yang diunggah harus berupa gambar',
                'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
                'image.max' => 'Ukuran gambar maksimal 2MB',
            ]
        );

        try {
            $lowongan = DB::table('penerimaan_lowongan')->where('id', $id)->first();

            if (!$lowongan) {
                return redirect()->back()->with('error', 'Lowongan tidak ditemukan.');
            }

            $imagePath = $lowongan->image;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('', $imageName, 'public');
                $imagePath = $imageName;
            }

            DB::table('penerimaan_lowongan')->where('id', $id)->update([
                'entitas' => $request->entitas,
                'unlimited' => $request->tdkadatgl,
                'tgl_buka' => $request->tglbuka,
                'tgl_tutup' => $request->tgltutup,
                'posisi' => $request->lowongan,
                'pendidikan' => $request->pendidikan,
                'sima' => $request->simA,
                'simb' => $request->simB,
                'simb2' => $request->simB2,
                'sio' => $request->sio,
                'image' => $imagePath,
                'deskripsi' => $request->requirement,
                'dibuat' => Auth::user()->name,
                'updated_at' => now(),
            ]);

            return redirect()->route('penerimaan.lowongan')->with('success', 'Lowongan Pekerjaan Berhasil Diperbarui.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'Error with : ' . $e->getMessage());
        }
    }

    public function updateRelease($id)
    {
        $loker = Loker::find($id);
        if (!$loker) {
            return redirect()->back()->with('error', 'Loker tidak ditemukan');
        }
        $loker->release = $loker->release == 1 ? 0 : 1;
        $loker->save();
        return redirect()->back()->with('success', 'Status release berhasil diubah');
    }

    public function destroyLowongan(Request $request, $id)
    {
        try {
            $lowongan = DB::table('penerimaan_lowongan')->where('id', $id)->first();
            if (!$lowongan) {
                return redirect()->back()->with('error', 'Lowongan tidak ditemukan.');
            }
            if ($lowongan->image) {
                Storage::disk('public')->delete($lowongan->image);
            }
            DB::table('penerimaan_lowongan')->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Lowongan Pekerjaan Berhasil Dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // ======================== END LOWONGAN ==============================================================================================

    // ======================== START LAMARAN ==============================================================================================
    public function lamaran()
    {
        $judul = "Lamaran";
        $penerimaan = "active";
        $lamaran = "active";

        return view('products/02_penerimaan.lamaran', [
            'judul' => $judul,
            'penerimaan' => $penerimaan,
            'lamaran' => $lamaran
        ]);
    }

    //Proses wawancara by Whatsapp Gatewayy Fonnte
    public function byWhatsappWawancaraa(Request $request)
    {
        \Carbon\Carbon::setLocale('id');

        // generate noform
        $noform = date('y') . "00000";
        // GET NOFORM
        $checknoform = DB::table('penerimaan_wawancara')->orderBy('noform', 'desc')->first();
        $noform = $checknoform->noform ?? $noform;

        $y = substr($noform, 0, 2);
        if (date('y') == $y) {
            $noUrut = substr($noform, 2, 5);
            $na = $noUrut + 1;
            $char = date('y');
            $kodeSurat = $char . sprintf("%05s", $na);
        } else {
            $kodeSurat = date('y') . "00001";
        }
        // generate noform

        $candidates = $request->candidates;
        $tglwawancara = $request->tglwawancara;
        $jamwawancara = $request->jamwawancara;
        $posisi = $request->posisi;
        $catatan = $request->catatan;

        foreach ($candidates as $candidate) {
            $dataLamaran = DB::table('penerimaan_lamaran')->where('id', $candidate['id'])->first();
            DB::table('penerimaan_lamaran')
                ->where('id', $candidate['id'])
                ->update(['wawancara' => 1]);

            $curl = curl_init();
            $token = 'f2XeVMEgV2Aqh!KHkZLF';

            $hari = \Carbon\Carbon::parse($tglwawancara)->isoFormat('dddd');
            $message = "🌟 Selamat Siang, {$candidate['name']} 🌟\n\n"
                . "Dengan ini kami sampaikan dari pihak HRD PT. Pintex\n"
                . "Ingin mengundang saudara/i agar turut hadir dalam seleksi wawancara untuk *$posisi*.\n\n"
                . "Seleksi wawancara ini akan diadakan pada:\n\n"
                . "Hari   : $hari\n"
                . "Tanggal: " . date('d F Y', strtotime($tglwawancara)) . "\n"
                . "Pukul  : " . date('H:i', strtotime($jamwawancara)) . " WIB\n"
                . "Tempat : PT Pintex Jl Raya Cirebon-Bandung Km 12 Plumbon-Cirebon Jawa Barat 45155.\n\n"
                . "Catatan:\n"
                . "$catatan\n"
                . "Diharapkan seluruh peserta yang menerima pesan ini untuk mengkonfirmasi kehadiran dengan format balasan: Nama-hadir/ tidak hadir.\n\n"
                . "Contoh: Kade_hadir.\n\n"
                . "Terima kasih,\n"
                . "HRD PT PINTEX\n\n";

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $candidate['notlp'],
                    'message' => $message,
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ' . $token,
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            if (!$response) {
                return response()->json(['error' => 'Gagal mengirim pesan WhatsApp'], 500);
            }
        }

        // Simpan ke dalam tabel penerimaan_wawancara
        try {
            DB::table('penerimaan_wawancara')->insert([
                'idlamaran' => $candidate['id'],
                'noform' => $kodeSurat,
                'nama' => $dataLamaran->nama,
                'tglwawancara' => $tglwawancara,
                'jamwawancara' => $request->input('jamwawancara'),
                'posisi' => $posisi,
                'catatan' => $catatan,
                'user' => $request->input('user', 'Kartika Dewi'),
                'diterima' => 0,
                'butawarna' => 0,
                'mataminus' => 0,
                'sikapbaik' => 0,
                'jalancepat' => 0,
                'dibuat' => Auth::user()->nama,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json(['success' => 'Proses wawancara berhasil']);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['error' => 'Gagal menyimpan data wawancara'], 500);
        }
    }


    public function scanner()
    {
        return view('products/02_penerimaan.scanner');
    }

    public function storeLamaran(Request $request)
    {
        $request->validate(
            [
                '_token' => 'required',
                'entitas' => 'required',
                'nik' => 'required|unique:penerimaan_lamaran,nik',
                'nama' => 'required',
                'gender' => 'required',
                'tempat' => 'required',
                'tanggallahir' => 'required',
                'pendidikan' => 'required',
                'jurusan' => 'required',
                'alamat' => 'required',
                'agama' => 'required',
                'tinggi' => 'required',
                'berat' => 'required',
                'notlp' => 'required',
                'posisi' => 'required',
            ],
            [
                'nik.unique' => 'Nomor NIK: ' . $request->nik . ' sudah ada, Cek kembali inputan anda',
            ]
        );

        $check = DB::table('penerimaan_lamaran')->insert([
            'remember_token' => $request->_token,
            'entitas' => $request->entitas,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'gender' => $request->gender,
            'tempat' => $request->tempat,
            'tgllahir' => $request->tanggallahir,
            'pendidikan' => $request->pendidikan,
            'jurusan' => $request->jurusan,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'tinggi' => $request->tinggi,
            'berat' => $request->berat,
            'notlp' => $request->notlp,
            'posisi' => $request->posisi,
            'email' => $request->email,
            'wawancara' => 0,
            'diterima' => 0,
            'keterangan' => $request->keterangan,
            'tglinput' => date('Y-m-d'),
            'dibuat' => Auth::user()->name,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data: ' . $request->nama . ' telah berhasil disimpan', 'status' => true);
        }
        return Response()->json($arr);
    }

    public function checkLamaran(Request $request)
    {
        if (empty($request->id)) {
            echo '<center><iframe src="https://lottie.host/embed/94d605b9-2cc4-4d11-809a-7f41357109b0/OzwBgj9bHl.json" width="300px" height="300px"></iframe></center>';
            echo "<center>Tidak ada data yang dipilih</center>";
        } else {
            $jml = count($request->id);

            echo '<div class="table-responsive">';
            echo '<div class="space-y">';

            // echo "      <table class='table table-bordered table-sm text-nowrap'>
            //                 <tr>
            //                     <td><b>No</b></td>
            //                     <td><b>NIK</b></td>
            //                     <td><b>Nama</b></td>
            //                     <td><b>Pendidikan</b></td>
            //                     <td><b>Jurusan</b></td>
            //                     <td><b>Tinggi</b></td>
            //                     <td><b>Berat</b></td>
            //                     <td><b>Telp</b></td>
            //                     <td><b>Keterangan</b></td>
            //                 </tr>";
            for ($i = 0; $i < $jml; $i++) {
                $data = DB::table('penerimaan_lamaran')->where('id', $request->id[$i])->get();
                foreach ($data as $u) {
                    if ($u->wawancara == 1) {
                        echo  '<input type="hidden" name="idlamaran[]" value="' . $u->id . '" >';
                        echo  '<input type="hidden" name="nama[]" value="' . $u->nama . '" >';
                        echo '
                        <div class="card shadow border-warning">
                            <div class="row g-0">
                                <div class="col-auto">
                                    <div class="card-body">
                                        <div class="avatar avatar-md shadow" style="background-image: url(./static/jobs/job-1.jpg)"></div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card-body ps-0">
                                        <div class="row">
                                        <div class="col">
                                            <h3 class="mb-0"><a href="#">' . $u->nama . '</a></h3>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md">
                                            <div class="mt-3 list-inline list-inline-dots mb-0 text-secondary d-sm-block d-none">
                                                <div class="list-inline-item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8"></path><path d="M13 7l0 .01"></path><path d="M17 7l0 .01"></path><path d="M17 11l0 .01"></path><path d="M17 15l0 .01"></path></svg>
                                                    ' . $u->pendidikan . '
                                                </div>
                                                <div class="list-inline-item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11"></path><path d="M9 7l4 0"></path><path d="M9 11l4 0"></path></svg>
                                                    ' . $u->nik . '
                                                </div>
                                                <div class="list-inline-item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline icon-tabler-phone" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                                                    ' . $u->notlp . '
                                                </div>
                                                </div>
                                                <div class="mt-3 list mb-0 text-secondary d-block d-sm-none">
                                                <div class="list-item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8"></path><path d="M13 7l0 .01"></path><path d="M17 7l0 .01"></path><path d="M17 11l0 .01"></path><path d="M17 15l0 .01"></path></svg>
                                                    ' . $u->pendidikan . '
                                                </div>
                                                <div class="list-item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11"></path><path d="M9 7l4 0"></path><path d="M9 11l4 0"></path></svg>
                                                    ' . $u->nik . '
                                                </div>
                                                <div class="list-item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline icon-tabler-phone" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                                                    ' . $u->notlp . '
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="mt-3 badges">
                                                <a href="#" class="badge badge-outline bg-red fw-normal badge-pill">Sudah Pernah Di Wawancara</a>
                                                <a href="#" class="badge badge-outline text-secondary fw-normal badge-pill">' . $u->posisi . '</a>
                                                <a href="#" class="badge badge-outline text-secondary fw-normal badge-pill">' . $u->jurusan . '</a>
                                                <a href="#" class="badge badge-outline text-secondary fw-normal badge-pill">Tinggi: ' . $u->tinggi . '</a>
                                                <a href="#" class="badge badge-outline text-secondary fw-normal badge-pill">Berat: ' . $u->berat . '</a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ';
                    } else {
                        echo  '<input type="hidden" name="idlamaran[]" value="' . $u->id . '" >';
                        echo  '<input type="hidden" name="nama[]" value="' . $u->nama . '" >';
                        echo '
                        <div class="card shadow border-green">
                            <div class="row g-0">
                                <div class="col-auto">
                                <div class="card-body">
                                    <div class="avatar avatar-md shadow" style="background-image: url(./static/jobs/job-1.jpg)"></div>
                                </div>
                                </div>
                                <div class="col">
                                <div class="card-body ps-0">
                                    <div class="row">
                                    <div class="col">
                                        <h3 class="mb-0"><a href="#">' . $u->nama . '</a></h3>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md">
                                        <div class="mt-3 list-inline list-inline-dots mb-0 text-secondary d-sm-block d-none">
                                            <div class="list-inline-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8"></path><path d="M13 7l0 .01"></path><path d="M17 7l0 .01"></path><path d="M17 11l0 .01"></path><path d="M17 15l0 .01"></path></svg>
                                                ' . $u->pendidikan . '
                                            </div>
                                            <div class="list-inline-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11"></path><path d="M9 7l4 0"></path><path d="M9 11l4 0"></path></svg>
                                                ' . $u->nik . '
                                            </div>
                                            <div class="list-inline-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline icon-tabler-phone" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                                                ' . $u->notlp . '
                                            </div>
                                            </div>
                                            <div class="mt-3 list mb-0 text-secondary d-block d-sm-none">
                                            <div class="list-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8"></path><path d="M13 7l0 .01"></path><path d="M17 7l0 .01"></path><path d="M17 11l0 .01"></path><path d="M17 15l0 .01"></path></svg>
                                                ' . $u->pendidikan . '
                                            </div>
                                            <div class="list-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11"></path><path d="M9 7l4 0"></path><path d="M9 11l4 0"></path></svg>
                                                ' . $u->nik . '
                                            </div>
                                            <div class="list-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline icon-tabler-phone" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                                                ' . $u->notlp . '
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="mt-3 badges">
                                            <a href="#" class="badge badge-outline text-secondary fw-normal badge-pill">' . $u->posisi . '</a>
                                            <a href="#" class="badge badge-outline text-secondary fw-normal badge-pill">' . $u->jurusan . '</a>
                                            <a href="#" class="badge badge-outline text-secondary fw-normal badge-pill">Tinggi: ' . $u->tinggi . '</a>
                                            <a href="#" class="badge badge-outline text-secondary fw-normal badge-pill">Berat: ' . $u->berat . '</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                }
            }
            echo '      </div>  
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Wawancara</label>
                                <input type="date" class="form-control" name="tglwawancara" value="' . date("Y-m-d") . '">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Jam Wawancara</label>
                                <input type="time" class="form-control" name="jamwawancara" value="09:30">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Posisi</label>
                                <input type="text" class="form-control" name="posisi" placeholder="Isi posisi">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">User <i>(Optional)</i></label>
                                <input type="text" class="form-control" name="user" placeholder="User yang ikut mewawancarai" value="Kartika Dewi, ">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Catatan Tambahan</label>
                                <textarea class="form-control" name="catatan" placeholder="Isi catatan tambahan"></textarea>
                            </div>
                        </div>
                    </div>';
        }
        // return $result;
    }

    public function storeChecklistLamaran(Request $request)
    {
        $request->validate(
            [
                '_token' => 'required',
                'idlamaran' => 'required',
            ],
        );
        $jml = count($request->idlamaran);

        $noform = date('y') . "00000";
        // // GET NOFORM
        $checknoform = DB::table('penerimaan_wawancara')->orderBy('noform', 'desc')->limit('1')->get();
        foreach ($checknoform as $key) {
            $noform = $key->noform;
        }
        $y = substr($noform, 0, 2);
        if (date('y') == $y) {
            $noUrut = substr($noform, 2, 5);
            $na = $noUrut + 1;
            $char = date('y');
            $kodeSurat = $char . sprintf("%05s", $na);
        } else {
            $kodeSurat = date('y') . "00001";
        }

        for ($i = 0; $i < $jml; $i++) {
            $check = DB::table('penerimaan_lamaran')
                ->where('id', $request->idlamaran[$i])
                ->limit(1)
                ->update(
                    array(
                        'remember_token' => $request->_token,
                        'wawancara' => 1,
                        'noformwawancara' => $kodeSurat,
                        'dibuat' => Auth::user()->name,
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );

            // GET NOFORM
            DB::table('penerimaan_wawancara')->insert([
                'remember_token' => $request->_token,
                'idlamaran' => $request->idlamaran[$i],
                'noform' => $kodeSurat,
                'nama' => $request->nama[$i],
                'tglwawancara' => $request->tglwawancara,
                'user' => $request->user,
                'dibuat' => Auth::user()->name,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);

            $product = DB::table('penerimaan_wawancara')->orderBy('id', 'desc')->limit('1')->get();
            foreach ($product as $key) {
                $noform = $key->noform;
            }
            $arr = array('val' => $noform);
        }
        return Response()->json($arr);
    }

    public function printLamaran($id)
    {
        $check = DB::table('penerimaan_wawancara')
            ->join('penerimaan_lamaran', 'penerimaan_wawancara.idlamaran', '=', 'penerimaan_lamaran.id')
            ->where('noform', $id)
            ->get();
        // dd($check);
        return view('products/02_penerimaan.print', ['getData' => $check, 'noform' => $id,]);
    }

    public function editKaryawan($id)
    {
        $getKaryawan = DB::table('penerimaan_karyawan')->where('id', $id)->first();

        $judul = "Edit Data " . $getKaryawan->nama;
        $penerimaan = "active";
        $karyawan = "active";

        return view('products/02_penerimaan.scanner', [
            'getKaryawan' => $getKaryawan,
            'nama' => $getKaryawan->nama,
            'judul' => $judul,
            'penerimaan' => $penerimaan,
            'karyawan' => $karyawan,
        ]);
    }

    public function listLamaran(Request $request)
    {
        $data = DB::table('penerimaan_lamaran')->where('id', $request->id)->first();
        $kandidat = KandidatModel::where('ktp', $data->nik)->first();
        echo '
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-1 py-1">
                            <img class="rounded-circle mt-5 img-thumbnail" width="150px"
                                src="https://karir.pintex.co.id/storage/biodata/pas/' . $kandidat->foto_pas . '">
                            <span class="font-weight-bold">' . $data->nama . '</span>
                            <span class="text-black-50">' . $data->email . '</span>
                            <span class="text-blue-50">
                                <a href="https://wa.me/62' . $data->notlp . '" target="_blank" rel="noopener noreferrer">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-whatsapp"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" /><path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" /></svg>
                                    ' . $data->notlp . '
                                </a>
                            </span>
                            <span> </span>
                        </div>
                    </div>
                    <div class="col-md-5 border-right">
                        <div class="p-1 py-1">
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label class="labels">NIK KTP</label>
                                    <input type="text" class="form-control" value="' . $data->nik . '">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label class="labels">Nama Kandidat</label>
                                    <input type="text" class="form-control" value="' . $data->nama . '">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label class="labels">No. Tlp</label>
                                    <input type="text" class="form-control" value="' . $data->notlp . '">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label class="labels">Gender</label>
                                    <input type="text" class="form-control" value="' . $data->gender . '">
                                </div>
                                <div class="col-md-8">
                                    <label class="labels">Email</label>
                                    <input type="text" class="form-control" value="' . $data->email . '">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="labels">Tempat</label>
                                    <input type="text" class="form-control" value="' . $data->tempat . '">
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Tanggal Lahir</label>
                                    <input type="text" class="form-control" value="' . $data->tgllahir . '">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Posisi</label>
                                <input type="text" class="form-control" value="' . $data->posisi . '">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Keterangan</label>
                                <input type="text" class="form-control" value="' . $data->keterangan . '">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">Pendidikan</label>
                                <input type="text" class="form-control" value="' . $data->pendidikan . '">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Jurusan</label>
                                <input type="text" class="form-control" value="' . $data->jurusan . '">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">Tinggi Badan</label>
                                <input type="text" class="form-control" value="' . $data->tinggi . '">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Berat Badan</label>
                                <input type="text" class="form-control" value="' . $data->berat . '">
                            </div>
                        </div>
                    </div>
                </div>
            ';
    }
    // ======================== END LAMARAN ==============================================================================================
    // ======================== START WAWANCARA ==========================================================================================

    public function wawancara()
    {
        $judul = "Wawancara";
        $penerimaan = "active";
        $wawancara = "active";
        return view('products/02_penerimaan.wawancara', ['judul' => $judul, 'penerimaan' => $penerimaan, 'wawancara' => $wawancara]);
    }

    public function cancelWawancara(Request $request)
    {
        $check = DB::table('penerimaan_lamaran')
            ->where('id', $request->id)
            ->limit(1)
            ->update(
                array(
                    'remember_token' => $request->_token,
                    'wawancara' => 0,
                    'dibuat' => Auth::user()->name,
                    'updated_at' => date('Y-m-d H:i:s'),
                )
            );

        DB::table('penerimaan_wawancara')
            ->where('idlamaran', '=', $request->id)
            ->where('noform', '=', $request->noform)
            ->orderBy('id', 'desc')
            ->limit('1')
            ->delete();

        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data telah berhasil dikembalikan ke lamaran', 'status' => true);
        }
        return Response()->json($arr);
    }

    public function prosesWawancara(Request $request)
    {
        if (empty($request->id)) {
            echo '<center><iframe src="https://lottie.host/embed/94d605b9-2cc4-4d11-809a-7f41357109b0/OzwBgj9bHl.json" width="300px" height="300px"></iframe></center>';
            echo "<center>Tidak ada data yang dipilih</center>";
        } else {
            $jml = count($request->id);
            echo '<div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pelaksanaan Wawancara</label>
                            <input type="date" class="form-control" name="tglwawancara" value="' . date("Y-m-d") . '">
                        </div>
                    </div>
                </div>';
            // echo '<div class="row row-cards text-center">
            //         <div class="col-lg-12">
            //             <div class="table-responsive" style="height:350px">
            //                 <div class="border border-dark shadow">
            //                     <table class="table table-vcenter card-table table-sm table-striped table-hover">
            //                         <thead class="text-center border border-dark">
            //                             <tr>
            //                                 <th class="w-8">Opsi Cepat</th>
            //                                 <th>Nama</th>
            //                                 <th class="w-1">Tinggi</th>
            //                                 <th class="w-1">Berat</th>
            //                                 <th class="w-1">Buta Warna</th>
            //                                 <th class="w-1">Mata Minus</th>
            //                                 <th class="w-1">Bersikap Baik</th>
            //                                 <th class="w-1">Jalan Cepat</th>
            //                                 <th class="w-1"></th>
            //                                 <th class="w-8">Status</th>
            //                             </tr>
            //                         </thead>
            //                         <tbody class="border border-dark">';
            // for ($i = 0; $i < $jml; $i++) {
            //     $data = DB::table('penerimaan_lamaran')->where('id', $request->id[$i])->get();
            //     foreach ($data as $u) {
            //         if ($u->diterima == 1) {
            //             echo '
            //                 <div class="col-md-4 col-lg-12">
            //                     <div class="card shadow bg-red-lt">
            //                         <div class="card-body p-4 text-center">
            //                             <span class="avatar avatar-xl mb-3 rounded" style="background-image: url(./static/avatars/000m.jpg); width:200px; height:200px;"></span>
            //                             <h3 class="m-0 mb-1"><a href="#">' . $u->nama . '</a></h3>
            //                             <div class="text-secondary">' . $u->posisi . '</div>
            //                             <div class="mt-3">
            //                             <span class="badge bg-danger">Sudah Diterima Sebagai Karyawan</span>
            //                             </div>
            //                         </div>
            //                     </div>
            //                 </div>
            //             ';
            //         } else {
            //             // input hidden
            //             echo '
            //                             <input type="hidden" id="gender' . $request->id[$i] . '" value="' . strtoupper($u->gender) . '">
            //                             <input type="hidden" name="idlamaran[]" value="' . $u->id . '">
            //                             <input type="hidden" name="entitas[]" value="' . $u->entitas . '">
            //                             <input type="hidden" name="nik[]" value="' . $u->nik . '">
            //                             <input type="hidden" name="nama[]" value="' . $u->nama . '">
            //                             <input type="hidden" name="gender[]" value="' . $u->gender . '">
            //                             <input type="hidden" name="tempat[]" value="' . $u->tempat . '">
            //                             <input type="hidden" name="tgllahir[]" value="' . $u->tgllahir . '">
            //                             <input type="hidden" name="sekolah[]" value="' . $u->sekolah . '">
            //                             <input type="hidden" name="pendidikan[]" value="' . $u->pendidikan . '">
            //                             <input type="hidden" name="jurusan[]" value="' . $u->jurusan . '">
            //                             <input type="hidden" name="alamat[]" value="' . $u->alamat . '">
            //                             <input type="hidden" name="agama[]" value="' . $u->agama . '">
            //                             <input type="hidden" name="notlp[]" value="' . $u->notlp . '">
            //                             <input type="hidden" name="posisi[]" value="' . $u->posisi . '">
            //                             <input type="hidden" name="email[]" value="' . $u->email . '">
            //                             <input type="hidden" name="keterangan[]" value="' . $u->keterangan . '">
            //                             <input type="hidden" name="wawancara[]" value="' . $u->wawancara . '">
            //                             <input type="hidden" name="noformwawancara[]" value="' . $u->noformwawancara . '">
            //                             <input type="hidden" name="sst[]" id="sst' . $request->id[$i] . '" value="1">
            //             ';
            //             echo '
            //                             <tr>
            //                                 <td>
            //                                     <div class="form-selectgroup">
            //                                         <label class="form-selectgroup-item bg-green-lt">
            //                                             <input type="radio" name="icons-' . $request->id[$i] . '" id="iconv-' . $request->id[$i] . '" value="check" class="form-selectgroup-input" checked onclick="status(' . $request->id[$i] . ', 1)">
            //                                             <span class="form-selectgroup-label text-success">
            //                                                 <i class="fa-solid fa-check"></i>
            //                                             </span>
            //                                         </label>
            //                                         <label class="form-selectgroup-item bg-red-lt">
            //                                             <input type="radio" name="icons-' . $request->id[$i] . '" id="iconx-' . $request->id[$i] . '" value="xmark" class="form-selectgroup-input" onclick="status(' . $request->id[$i] . ', 0)">
            //                                             <span class="form-selectgroup-label text-warning">
            //                                                 <i class="fa-solid fa-xmark"></i>
            //                                             </span>
            //                                         </label>    
            //                                     </div>
            //                                 </td>
            //                                 <td>' . $u->nama . '</td>
            //                                 <td><input type="number" name="tinggi[]" id="tinggi' . $request->id[$i] . '" class="form-control" style="width:70px" value="' . $u->tinggi . '" onchange="fetchKar(' . $request->id[$i] . ')" onkeydown = "if (event.keyCode == 13)  fetchKar(' . $request->id[$i] . ')"></td>
            //                                 <td><input type="number" name="berat[]" class="form-control" style="width:70px" value="' . $u->berat . '"></td>
            //                                 <td class="text-center">
            //                                     <input name="butawarna[]" id="butawarna' . $request->id[$i] . '" class="form-check-input" type="checkbox">
            //                                 </td>
            //                                 <td>
            //                                     <input name="mataminus[]" id="mataminus' . $request->id[$i] . '" class="form-check-input" type="checkbox">
            //                                 </td>
            //                                 <td>
            //                                     <input name="sikapbaik[]" id="sikapbaik' . $request->id[$i] . '" class="form-check-input" type="checkbox" checked="true">
            //                                 </td>
            //                                 <td>
            //                                     <input name="jalancepat[]" id="jalancepat' . $request->id[$i] . '" class="form-check-input" type="checkbox" checked="true">
            //                                 </td>
            //                                 <td><span id="status' . $request->id[$i] . '" class="badge bg-green">Diterima</span></td>
            //                                 <td>
            //                                     <select class="form-select" name="diterimasebagai[]">
            //                                         <option>OL</option>
            //                                         <option>PHL</option>
            //                                         <option>Kontrak</option>
            //                                     </select>
            //                                 </td>
            //                             </tr>
            //             ';
            //         }
            //     }
            //     echo '

            //                             <script>
            //                                 function fetchKar(params){
            //                                     var tinggi = $("#tinggi" + params).val();
            //                                     var gender = $("#gender" + params).val();
            //                                     if(gender=="PRIA"){
            //                                         if(tinggi < 160){
            //                                             document.getElementById("status"+ params).innerHTML = "Ditolak";
            //                                             $("#status"+ params).removeClass("bg-green").addClass("bg-red");
            //                                             $("#iconv-" + params).removeAttr("checked");
            //                                             $("#iconx-" + params).attr("checked", true);
            //                                             $("#sst" + params).val("0");
            //                                         } else {
            //                                             document.getElementById("status"+ params).innerHTML = "Diterima";
            //                                             $("#status"+ params).removeClass("bg-red").addClass("bg-green");
            //                                             $("#iconx-" + params).removeAttr("checked");
            //                                             $("#iconv-" + params).attr("checked", true);
            //                                             $("#sst" + params).val("1");
            //                                         }
            //                                     } else if(gender=="WANITA"){
            //                                         if(tinggi < 155){
            //                                             document.getElementById("status"+ params).innerHTML = "Ditolak";
            //                                             $("#status"+ params).removeClass("bg-green").addClass("bg-red");
            //                                             $("#sst" + params).val("0");
            //                                         } else {
            //                                             document.getElementById("status"+ params).innerHTML = "Diterima";
            //                                             $("#status"+ params).removeClass("bg-red").addClass("bg-green");
            //                                             $("#sst" + params).val("1");
            //                                         }
            //                                     }
            //                                 }

            //                                 function status(params, val){
            //                                     var gender = $("#gender" + params).val();
            //                                     var tinggi = $("#tinggi" + params).val();
            //                                     if(gender=="PRIA"){
            //                                         if(val == 1 && tinggi >= 160){
            //                                             document.getElementById("status"+ params).innerHTML = "Diterima";
            //                                             $("#iconx-" + params).removeAttr("checked");
            //                                             $("#iconv-" + params).attr("checked", true);
            //                                             $("#status"+ params).removeClass("bg-red").addClass("bg-green");
            //                                             $("#sst" + params).val("1");

            //                                             $("#butawarna" + params).attr("checked", false);
            //                                             $("#mataminus" + params).attr("checked", false);
            //                                             $("#sikapbaik" + params).attr("checked", true);
            //                                             $("#jalancepat" + params).attr("checked", true);
            //                                         } else if(val == 0){
            //                                             document.getElementById("status"+ params).innerHTML = "Ditolak";
            //                                             $("#iconv-" + params).removeAttr("checked");
            //                                             $("#iconx-" + params).attr("checked", true);
            //                                             $("#status"+ params).removeClass("bg-green").addClass("bg-red");
            //                                             $("#sst" + params).val("0");

            //                                             $("#butawarna" + params).attr("checked", true);
            //                                             $("#mataminus" + params).attr("checked", true);
            //                                             $("#sikapbaik" + params).attr("checked", false);
            //                                             $("#jalancepat" + params).attr("checked", false);
            //                                         }
            //                                     } else if(gender=="WANITA"){
            //                                         if(val == 1 && tinggi >= 155){
            //                                             document.getElementById("status"+ params).innerHTML = "Diterima";
            //                                             $("#iconx-" + params).removeAttr("checked");
            //                                             $("#iconv-" + params).attr("checked", true);
            //                                             $("#status"+ params).removeClass("bg-red").addClass("bg-green");
            //                                             $("#sst" + params).val("1");

            //                                             $("#butawarna" + params).attr("checked", false);
            //                                             $("#mataminus" + params).attr("checked", false);
            //                                             $("#sikapbaik" + params).attr("checked", true);
            //                                             $("#jalancepat" + params).attr("checked", true);
            //                                         } else if(val == 0){
            //                                             document.getElementById("status"+ params).innerHTML = "Ditolak";
            //                                             $("#iconv-" + params).removeAttr("checked");
            //                                             $("#iconx-" + params).attr("checked", true);
            //                                             $("#status"+ params).removeClass("bg-green").addClass("bg-red");
            //                                             $("#sst" + params).val("0");

            //                                             $("#butawarna" + params).attr("checked", true);
            //                                             $("#mataminus" + params).attr("checked", true);
            //                                             $("#sikapbaik" + params).attr("checked", false);
            //                                             $("#jalancepat" + params).attr("checked", false);
            //                                         }
            //                                     }
            //                                 }

            //                             </script>
            //     ';
            // }
            // echo '                  </tbody>
            //                     </table>
            //                 </div>
            //             </div>
            //         </div>
            //     </div>
            //     ';

            for ($i = 0; $i < $jml; $i++) {
                $data = DB::table('penerimaan_lamaran')->where('id', $request->id[$i])->get();
                foreach ($data as $u) {
                    if ($u->diterima == 1) {
                        echo '

                            <div class="row row-cards">
                                <div class="card mb-2 shadow" style="border-color:red">
                                    <div class="card-header">
                                        <h3 class="card-title">' . $u->nama . '</h3>
                                    </div>
                                    <div class="ribbon ribbon-top bg-red">
                                        <i class="fa-solid fa-user-shield"></i>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-vcenter card-table">
                                            <thead>
                                                <tr>
                                                    <th class="w-8">Keterangan</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Sudah Diterima menjadi karyawan</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        ';
                    } else {
                        // input hidden
                        echo '
                            <input type="hidden" id="gender' . $request->id[$i] . '" value="' . strtoupper($u->gender) . '">
                            <input type="hidden" name="idlamaran[]" value="' . $u->id . '">
                            <input type="hidden" name="entitas[]" value="' . $u->entitas . '">
                            <input type="hidden" name="nik[]" value="' . $u->nik . '">
                            <input type="hidden" name="nama[]" value="' . $u->nama . '">
                            <input type="hidden" name="gender[]" value="' . $u->gender . '">
                            <input type="hidden" name="tempat[]" value="' . $u->tempat . '">
                            <input type="hidden" name="tgllahir[]" value="' . $u->tgllahir . '">
                            <input type="hidden" name="sekolah[]" value="' . $u->sekolah . '">
                            <input type="hidden" name="pendidikan[]" value="' . $u->pendidikan . '">
                            <input type="hidden" name="jurusan[]" value="' . $u->jurusan . '">
                            <input type="hidden" name="alamat[]" value="' . $u->alamat . '">
                            <input type="hidden" name="agama[]" value="' . $u->agama . '">
                            <input type="hidden" name="notlp[]" value="' . $u->notlp . '">
                            <input type="hidden" name="posisi[]" value="' . $u->posisi . '">
                            <input type="hidden" name="email[]" value="' . $u->email . '">
                            <input type="hidden" name="keterangan[]" value="' . $u->keterangan . '">
                            <input type="hidden" name="wawancara[]" value="' . $u->wawancara . '">
                            <input type="hidden" name="noformwawancara[]" value="' . $u->noformwawancara . '">
                            <input type="hidden" name="sst[]" id="sst' . $request->id[$i] . '" value="1">
                        ';
                        echo '
                            <div class="row row-cards">
                                <div class="card mb-2 shadow" style="border-color:' . '#' . str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT) . '">
                                    <div class="card-header">
                                        <h3 class="card-title">' . $u->nama . '</h3>
                                    </div>
                                    <div class="ribbon ribbon-top bg-green" id="stts' . $request->id[$i] . '">
                                        <i class="fa-solid fa-user-check"></i>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-vcenter card-table">
                                            <thead>
                                                <tr>
                                                    <th class="w-8">Opsi Cepat</th>
                                                    <th class="w-1">Tinggi</th>
                                                    <th class="w-1">Berat</th>
                                                    <th class="w-1">Buta Warna</th>
                                                    <th class="w-1">Mata Minus</th>
                                                    <th class="w-1">Bersikap Baik</th>
                                                    <th class="w-1">Jalan Cepat</th>
                                                    <th class="w-1"></th>
                                                    <th class="w-8">Penempatan</th>
                                                    <th class="text-center">Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="form-selectgroup">
                                                            <label class="form-selectgroup-item bg-green-lt">
                                                                <input type="radio" name="icons-' . $request->id[$i] . '" id="iconv-' . $request->id[$i] . '" value="check" class="form-selectgroup-input" checked onclick="status(' . $request->id[$i] . ', 1)">
                                                                <span class="form-selectgroup-label text-success">
                                                                    <i class="fa-solid fa-check"></i>
                                                                </span>
                                                            </label>
                                                            <label class="form-selectgroup-item bg-red-lt">
                                                                <input type="radio" name="icons-' . $request->id[$i] . '" id="iconx-' . $request->id[$i] . '" value="xmark" class="form-selectgroup-input" onclick="status(' . $request->id[$i] . ', 0)">
                                                                <span class="form-selectgroup-label text-warning">
                                                                    <i class="fa-solid fa-xmark"></i>
                                                                </span>
                                                            </label>    
                                                        </div>
                                                    </td>
                                                    <td><input type="number" name="tinggi[]" id="tinggi' . $request->id[$i] . '" class="form-control" style="width:70px" value="' . $u->tinggi . '" onchange="fetchKar(' . $request->id[$i] . ')" onkeydown = "if (event.keyCode == 13)  fetchKar(' . $request->id[$i] . ')"></td>
                                                    <td><input type="number" name="berat[]" class="form-control" style="width:70px" value="' . $u->berat . '"></td>
                                                    <td class="text-center">
                                                        <input name="butawarna[]" id="butawarna' . $request->id[$i] . '" class="form-check-input" type="checkbox">
                                                    </td>
                                                    <td>
                                                        <input name="mataminus[]" id="mataminus' . $request->id[$i] . '" class="form-check-input" type="checkbox">
                                                    </td>
                                                    <td>
                                                        <input name="sikapbaik[]" id="sikapbaik' . $request->id[$i] . '" class="form-check-input" type="checkbox" checked="true">
                                                    </td>
                                                    <td>
                                                        <input name="jalancepat[]" id="jalancepat' . $request->id[$i] . '" class="form-check-input" type="checkbox" checked="true">
                                                    </td>
                                                    <td><span id="status' . $request->id[$i] . '" class="badge bg-green">Diterima</span></td>
                                                    <td>
                                                        <select class="form-select" name="diterimasebagai[]">
                                                            <option value="OL">OL</option>
                                                            <option value="PHL">PHL</option>
                                                            <option value="Kontrak">Kontrak</option>
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
                                                            <div class="col-6">
                                                                <input type="date" name="dari[]" class=""  value="' . date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day')) . '">
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="date" name="ke[]" class=""  value="' . date('Y-m-d', strtotime(date('Y-m-d') . ' +3 month')) . '">
                                                            </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                                        
                        ';

                        echo '

                            <script>
                                function fetchKar(params){
                                    var tinggi = $("#tinggi" + params).val();
                                    var gender = $("#gender" + params).val();
                                    if(gender=="PRIA"){
                                        if(tinggi < 160){
                                            document.getElementById("status"+ params).innerHTML = "Ditolak";
                                            $("#status"+ params).removeClass("bg-green").addClass("bg-red");
                                            $("#iconv-" + params).removeAttr("checked");
                                            $("#iconx-" + params).attr("checked", true);
                                            $("#sst" + params).val("0");
                                            $("#stts" + params).html(`<i class="fa-solid fa-user-xmark"></i>`);
                                            $("#stts" + params).removeClass("bg-green");
                                            $("#stts" + params).removeClass("bg-red");
                                            $("#stts" + params).addClass("bg-red");
                                        } else {
                                            document.getElementById("status"+ params).innerHTML = "Diterima";
                                            $("#status"+ params).removeClass("bg-red").addClass("bg-green");
                                            $("#iconx-" + params).removeAttr("checked");
                                            $("#iconv-" + params).attr("checked", true);
                                            $("#sst" + params).val("1");
                                            $("#stts" + params).html(`<i class="fa-solid fa-user-check"></i>`);
                                            $("#stts" + params).removeClass("bg-green");
                                            $("#stts" + params).removeClass("bg-red");
                                            $("#stts" + params).addClass("bg-green");
                                        }
                                    } else if(gender=="WANITA"){
                                        if(tinggi < 155){
                                            document.getElementById("status"+ params).innerHTML = "Ditolak";
                                            $("#status"+ params).removeClass("bg-green").addClass("bg-red");
                                            $("#sst" + params).val("0");
                                            $("#stts" + params).html(`<i class="fa-solid fa-user-xmark"></i>`);
                                            $("#stts" + params).removeClass("bg-green");
                                            $("#stts" + params).removeClass("bg-red");
                                            $("#stts" + params).addClass("bg-red");
                                        } else {
                                            document.getElementById("status"+ params).innerHTML = "Diterima";
                                            $("#status"+ params).removeClass("bg-red").addClass("bg-green");
                                            $("#sst" + params).val("1");
                                            $("#stts" + params).html(`<i class="fa-solid fa-user-check"></i>`);
                                            $("#stts" + params).removeClass("bg-green");
                                            $("#stts" + params).removeClass("bg-red");
                                            $("#stts" + params).addClass("bg-green");
                                        }
                                    }
                                }

                                function status(params, val){
                                    var gender = $("#gender" + params).val();
                                    var tinggi = $("#tinggi" + params).val();
                                    if(gender=="PRIA"){
                                        if(val == 1 && tinggi >= 160){
                                            document.getElementById("status"+ params).innerHTML = "Diterima";
                                            $("#iconx-" + params).removeAttr("checked");
                                            $("#iconv-" + params).attr("checked", true);
                                            $("#status"+ params).removeClass("bg-red").addClass("bg-green");
                                            $("#sst" + params).val("1");
                                            $("#stts" + params).html(`<i class="fa-solid fa-user-check"></i>`);
                                            $("#stts" + params).removeClass("bg-green");
                                            $("#stts" + params).removeClass("bg-red");
                                            $("#stts" + params).addClass("bg-green");

                                            $("#stts" + params).html(`<i class="fa-solid fa-user-check"></i>`);

                                            $("#butawarna" + params).attr("checked", false);
                                            $("#mataminus" + params).attr("checked", false);
                                            $("#sikapbaik" + params).attr("checked", true);
                                            $("#jalancepat" + params).attr("checked", true);
                                        } else if(val == 0){
                                            document.getElementById("status"+ params).innerHTML = "Ditolak";
                                            $("#iconv-" + params).removeAttr("checked");
                                            $("#iconx-" + params).attr("checked", true);
                                            $("#status"+ params).removeClass("bg-green").addClass("bg-red");
                                            $("#sst" + params).val("0");
                                            $("#stts" + params).html(`<i class="fa-solid fa-user-xmark"></i>`);
                                            $("#stts" + params).removeClass("bg-green");
                                            $("#stts" + params).removeClass("bg-red");
                                            $("#stts" + params).addClass("bg-red");

                                            $("#butawarna" + params).attr("checked", true);
                                            $("#mataminus" + params).attr("checked", true);
                                            $("#sikapbaik" + params).attr("checked", false);
                                            $("#jalancepat" + params).attr("checked", false);
                                        }
                                    } else if(gender=="WANITA"){
                                        if(val == 1 && tinggi >= 155){
                                            document.getElementById("status"+ params).innerHTML = "Diterima";
                                            $("#iconx-" + params).removeAttr("checked");
                                            $("#iconv-" + params).attr("checked", true);
                                            $("#status"+ params).removeClass("bg-red").addClass("bg-green");
                                            $("#sst" + params).val("1");
                                            $("#stts" + params).html(`<i class="fa-solid fa-user-check"></i>`);
                                            $("#stts" + params).removeClass("bg-green");
                                            $("#stts" + params).removeClass("bg-red");
                                            $("#stts" + params).addClass("bg-green");

                                            $("#butawarna" + params).attr("checked", false);
                                            $("#mataminus" + params).attr("checked", false);
                                            $("#sikapbaik" + params).attr("checked", true);
                                            $("#jalancepat" + params).attr("checked", true);
                                        } else if(val == 0){
                                            document.getElementById("status"+ params).innerHTML = "Ditolak";
                                            $("#iconv-" + params).removeAttr("checked");
                                            $("#iconx-" + params).attr("checked", true);
                                            $("#status"+ params).removeClass("bg-green").addClass("bg-red");
                                            $("#sst" + params).val("0");
                                            $("#stts" + params).html(`<i class="fa-solid fa-user-xmark"></i>`);
                                            $("#stts" + params).removeClass("bg-green");
                                            $("#stts" + params).removeClass("bg-red");
                                            $("#stts" + params).addClass("bg-red");

                                            $("#butawarna" + params).attr("checked", true);
                                            $("#mataminus" + params).attr("checked", true);
                                            $("#sikapbaik" + params).attr("checked", false);
                                            $("#jalancepat" + params).attr("checked", false);
                                        }
                                    }
                                }

                            </script>
                        ';
                    }
                }
            }
        }
        // return $result;
    }

    public function checkWawancara(Request $request)
    {
        if (empty($request->id)) {
            echo '<center><iframe src="https://lottie.host/embed/94d605b9-2cc4-4d11-809a-7f41357109b0/OzwBgj9bHl.json" width="300px" height="300px"></iframe></center>';
            echo "<center>Tidak ada data yang dipilih</center>";
        } else {
            $jml = count($request->id);
            echo '<div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pelaksanaan Wawancara</label>
                            <input type="date" class="form-control" name="tglwawancara" value="' . date("Y-m-d") . '">
                        </div>
                    </div>
                </div>';
            echo '<div class="row row-cards">';
            for ($i = 0; $i < $jml; $i++) {
                $data = DB::table('penerimaan_lamaran')->where('id', $request->id[$i])->get();
                foreach ($data as $u) {
                    if ($u->diterima == 1) {
                        echo '
                            <div class="col-md-4 col-lg-4">
                                <div class="card shadow bg-red-lt">
                                    <div class="card-body p-4 text-center">
                                        <span class="avatar avatar-xl mb-3 rounded" style="background-image: url(./static/avatars/000m.jpg); width:200px; height:200px;"></span>
                                        <h3 class="m-0 mb-1"><a href="#">' . $u->nama . '</a></h3>
                                        <div class="text-secondary">' . $u->posisi . '</div>
                                        <div class="mt-3">
                                        <span class="badge bg-danger">Sudah Diterima Sebagai Karyawan</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        ';
                    } else {
                        echo '
                        
                            <div class="col-md-4 col-lg-4">
                                <div class="card shadow">
                                    <div class="card-body p-4 text-center bg-green-lt">
                                        <span class="avatar avatar-xl mb-3 rounded" style="background-image: url(./static/avatars/000m.jpg); width:200px; height:200px;"></span>
                                        <h3 class="m-0 mb-1"><a href="#">' . $u->nama . '</a></h3>
                                        <div class="text-secondary">' . $u->posisi . '</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="form-label">Hasil Wawancara</div>
                                            <input type="hidden" name="id[]" value="' . $u->id . '" >
                                            <input type="hidden" name="nama[]" value="' . $u->nama . '" >
                                            <div>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="butawarna[]" value="1">
                                                    <span class="form-check-label">Buta Warna</span>
                                                </label>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="bersikapbaik[]" checked="true" value="1">
                                                    <span class="form-check-label">Bersikap Baik</span>
                                                </label>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="berlaricepat[]" checked="true" value="1">
                                                    <span class="form-check-label">Berlari Cepat</span>
                                                </label>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="diterima[]" checked="true" value="1">
                                                    <span class="form-check-label"><b>Diterima Sbg Karyawan</b></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Aktual Tinggi</label>
                                            <input type="number" class="form-control" name="tinggi[]" min="100" value="' . $u->tinggi . '">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Aktual Berat</label>
                                            <input type="number" class="form-control" name="berat[]" min="10" value="' . $u->berat . '">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Catatan Hasil Wawancara</label>
                                            <input type="text" class="form-control" name="keterangan[]" placeholder="Keterangan Tambahan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }
            }
            echo '  </div>';
        }
        // return $result;
    }

    public function checkWawancaraX(Request $request)
    {
        if (empty($request->id)) {
            echo '<center><iframe src="https://lottie.host/embed/94d605b9-2cc4-4d11-809a-7f41357109b0/OzwBgj9bHl.json" width="300px" height="300px"></iframe></center>';
            echo "<center>Tidak ada data yang dipilih</center>";
        } else {
            $jml = count($request->id);
            echo '<div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pelaksanaan Wawancara</label>
                            <input type="date" class="form-control" name="tglwawancara" value="' . date("Y-m-d") . '">
                        </div>
                    </div>
                </div>';
            echo '<div class="row row-cards">';
            for ($i = 0; $i < $jml; $i++) {
                $data = DB::table('penerimaan_lamaran')->where('id', $request->id[$i])->get();
                foreach ($data as $u) {
                    if ($u->diterima == 1) {
                        echo '
                            <div class="col-md-4 col-lg-4">
                                <div class="card shadow bg-red-lt">
                                    <div class="card-body p-4 text-center">
                                        <span class="avatar avatar-xl mb-3 rounded" style="background-image: url(./static/avatars/000m.jpg); width:200px; height:200px;"></span>
                                        <h3 class="m-0 mb-1"><a href="#">' . $u->nama . '</a></h3>
                                        <div class="text-secondary">' . $u->posisi . '</div>
                                        <div class="mt-3">
                                        <span class="badge bg-danger">Sudah Diterima Sebagai Karyawan</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        ';
                    } else {
                        echo '
                        
                            <div class="col-md-4 col-lg-4">
                                <div class="card shadow">
                                    <div class="card-body p-4 text-center">
                                        <span class="avatar avatar-xl mb-3 rounded" style="background-image: url(./static/avatars/000m.jpg); width:200px; height:200px;"></span>
                                        <h3 class="m-0 mb-1"><a href="#">' . $u->nama . '</a></h3>
                                        <div class="text-secondary">' . $u->posisi . '</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="form-label">Hasil Wawancara</div>
                                            <input type="hidden" name="id[]" value="' . $u->id . '" >
                                            <input type="hidden" name="nama[]" value="' . $u->nama . '" >
                                            <input type="hidden" name="diterima[]" value="2" >
                                            <div>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="butawarna[]" checked="true" value="1">
                                                    <span class="form-check-label">Buta Warna</span>
                                                </label>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="bersikapbaik[]" value="1">
                                                    <span class="form-check-label">Bersikap Baik</span>
                                                </label>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="berlaricepat[]" value="1">
                                                    <span class="form-check-label">Berlari Cepat</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Aktual Tinggi</label>
                                            <input type="number" class="form-control" name="tinggi[]" min="100" value="' . $u->tinggi . '">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Aktual Berat</label>
                                            <input type="number" class="form-control" name="berat[]" min="10" value="' . $u->berat . '">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Catatan Hasil Wawancara</label>
                                            <input type="text" class="form-control" name="keterangan[]" placeholder="Keterangan Tambahan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }
            }
            echo '  </div>';
        }
        // return $result;
    }

    public function storeChecklistWawancara(Request $request)
    {
        $request->validate(
            [
                '_token' => 'required',
                'id' => 'required',
            ],
        );
        $jml = count($request->id);

        for ($i = 0; $i < $jml; $i++) {
            $check = DB::table('penerimaan_wawancara')
                ->where('idlamaran', $request->id[$i])
                ->orderBy('noform', 'desc')
                ->limit(1)
                ->update(
                    array(
                        'remember_token' => $request->_token,
                        'tglwawancara' => $request->tglwawancara,
                        'butawarna' => isset($request->butawarna[$i]) ? $request->butawarna[$i] : 0,
                        'sikapbaik' => isset($request->bersikapbaik[$i]) ? $request->bersikapbaik[$i] : 0,
                        'laricepat' => isset($request->berlaricepat[$i]) ? $request->berlaricepat[$i] : 0,
                        'keterangan' => $request->keterangan[$i],
                        'diterima' => isset($request->diterima[$i]) ? $request->diterima[$i] : 0,
                        'dibuat' => Auth::user()->name,
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );

            DB::table('penerimaan_lamaran')
                ->where('id', $request->id[$i])
                ->limit(1)
                ->update(
                    array(
                        'remember_token' => $request->_token,
                        'diterima' => isset($request->diterima[$i]) ? $request->diterima[$i] : 0,
                        'tinggi' => $request->tinggi[$i],
                        'berat' => $request->berat[$i],
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );

            $getDataLam = DB::table('penerimaan_lamaran')->where('id', $request->id[$i])->limit(1)->get();
            $getGapok = DB::table('daftar_upah')->where('jenis', 'gapok')->first();
            foreach ($getDataLam as $l) {

                // GET PHL
                $noform = "0";
                $checknoform = DB::table('penerimaan_karyawan')
                    // ->where('stb', 'like', '%PHL%')
                    ->orderBy('userid', 'desc')
                    ->limit('1')
                    ->get();
                foreach ($checknoform as $key) {
                    $noform = $key->userid;
                }
                if ($noform != "0") {
                    $na = $noform + 1;
                    $kode = $na;
                } else {
                    $kode = "1";
                }
                // GET PHL

                DB::table('penerimaan_karyawan')->insert([
                    'remember_token' => $request->_token,
                    'entitas' => $l->entitas,
                    'nik' => $l->nik,
                    'userid' => $kode,
                    'nama' => $l->nama,
                    'gender' => $l->gender,
                    'tempat' => $l->tempat,
                    'tgllahir' => $l->tgllahir,
                    'pendidikan' => $l->pendidikan,
                    'jurusan' => $l->jurusan,
                    'alamat' => $l->alamat,
                    'agama' => $l->agama,
                    'tinggi' => $l->tinggi,
                    'berat' => $l->berat,
                    'notlp' => $l->notlp,
                    'email' => $l->email,

                    'gapok' => $getGapok->nominal,
                    'status' => 'OL',
                    'keterangan' => $l->keterangan,
                    'tglinput' => date('Y-m-d'),
                    'dibuat' => Auth::user()->name,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
        }
        return Response()->json($arr);
    }

    public function storeHasilWawancara(Request $request)
    {
        $request->validate(
            [
                '_token' => 'required',
                'idlamaran' => 'required',
            ],
        );
        $jml = count($request->idlamaran);

        for ($i = 0; $i < $jml; $i++) {
            $check = DB::table('penerimaan_wawancara')
                ->where('idlamaran', $request->idlamaran[$i])
                ->orderBy('noform', 'desc')
                ->limit(1)
                ->update(
                    array(
                        'remember_token' => $request->_token,
                        'tglwawancara' => $request->tglwawancara,
                        'butawarna' => isset($request->butawarna[$i]) ? 1 : 0,
                        'mataminus' => isset($request->mataminus[$i]) ? 1 : 0,
                        'sikapbaik' => isset($request->sikapbaik[$i]) ? 1 : 0,
                        'jalancepat' => isset($request->jalancepat[$i]) ? 1 : 0,
                        'keterangan' => $request->keterangan[$i],
                        'diterima' => $request->sst[$i],
                        'dibuat' => Auth::user()->name,
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );

            DB::table('penerimaan_lamaran')
                ->where('id', $request->idlamaran[$i])
                ->limit(1)
                ->update(
                    array(
                        'remember_token' => $request->_token,
                        'diterima' => $request->sst[$i],
                        'tinggi' => $request->tinggi[$i],
                        'berat' => $request->berat[$i],
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );

            $getDataLam = DB::table('penerimaan_lamaran')->where('id', $request->idlamaran[$i])->limit(1)->get();
            $getGapok = DB::table('daftar_upah')->where('jenis', 'gapok')->first();
            foreach ($getDataLam as $l) {

                // GET PHL
                $noform = "0";
                $checknoform = DB::table('penerimaan_karyawan')
                    // ->where('stb', 'like', '%PHL%')
                    ->orderBy('userid', 'desc')
                    ->limit('1')
                    ->get();
                foreach ($checknoform as $key) {
                    $noform = $key->userid;
                }
                if ($noform != "0") {
                    $na = $noform + 1;
                    $kode = $na;
                } else {
                    $kode = "1";
                }
                // GET PHL

                $statusditerima = null;
                if ($request->diterimasebagai[$i] == "OL") {
                    // GET STB OL
                    $checknostb = DB::table('penerimaan_karyawan')
                        ->where('stb', 'like', '%OL%')
                        ->orderBy('userid', 'desc')
                        ->first();
                    if ($checknostb) {
                        $nostb =  substr($checknostb->stb, -3, 3);
                    } else {
                        $nostb = "000";
                    }
                    // if ($nostb != "000") {
                    $ns = $nostb + 1;
                    $kodestb = "OL-" . sprintf("%03s", $ns);
                    // } else {
                    // $kodestb = "OL-001";
                    // }
                    // GET STB OL
                    $statusditerima = "OL";
                    $perjanjian = 'OL (' . Carbon::parse($request->dari[$i])->format('d/m/Y') . ' s.d. ' . Carbon::parse($request->ke[$i])->format('d/m/Y') . ')';
                    $nmsurat = "Perjanjian Kerja OL";
                    $suratket = "OL";
                } elseif ($request->diterimasebagai[$i] == "PHL") {
                    // GET STB PHL
                    // $nostb = "001";
                    $checknostb = DB::table('penerimaan_karyawan')
                        ->where('stb', 'like', '%PHL%')
                        ->orderBy('userid', 'desc')
                        ->first();
                    if ($checknostb) {
                        $nostb =  substr($checknostb->stb, -3, 3);
                    } else {
                        $nostb = "000";
                    }
                    // $nostb =  substr($checknostb->stb, -3, 3);
                    // if ($nostb != "001") {
                    $ns = $nostb + 1;
                    $kodestb = "PHL-" . sprintf("%03s", $ns);
                    // } else {
                    // $kodestb = "PHL-001";
                    // }
                    // GET STB PHL
                    $statusditerima = "PHL";
                    $perjanjian = 'PHL (' . Carbon::parse($request->dari[$i])->format('d/m/Y') . ' s.d. ' . Carbon::parse($request->ke[$i])->format('d/m/Y') . ')';
                    $nmsurat = "Perjanjian Kerja PHL";
                    $suratket = "PHL";
                } elseif ($request->diterimasebagai[$i] == "Kontrak") {
                    $kodestb = "0";
                    $statusditerima = "aktif";
                    $perjanjian = 'Kontrak Baru (' . Carbon::parse($request->dari[$i])->format('d/m/Y') . ' s.d. ' . Carbon::parse($request->ke[$i])->format('d/m/Y') . ')';
                    $nmsurat = "Perjanjian Kontrak";
                    $suratket = "Kontrak I";
                }
                // Add into table karyawan
                DB::table('penerimaan_karyawan')->insert([
                    'remember_token' => $request->_token,
                    'entitas' => $l->entitas,
                    'nik' => $l->nik,
                    'userid' => $kode,
                    'stb' => $kodestb,
                    'nama' => $l->nama,
                    'gender' => $l->gender,
                    'tempat' => $l->tempat,
                    'tgllahir' => $l->tgllahir,
                    'pendidikan' => $l->pendidikan,
                    'jurusan' => $l->jurusan,
                    'alamat' => $l->alamat,
                    'agama' => $l->agama,
                    'tinggi' => $l->tinggi,
                    'berat' => $l->berat,
                    'notlp' => $l->notlp,
                    'email' => $l->email,
                    'tglmasuk' => $request->dari[$i],
                    'tglaktif' => $request->dari[$i],
                    'perjanjian' => $perjanjian,
                    'gapok' => $getGapok->nominal,
                    'status' => $statusditerima,
                    'keterangan' => $l->keterangan,
                    'tglinput' => date('Y-m-d'),
                    'dibuat' => Auth::user()->name,
                    'nomap' => ' ',
                    'level' => ' ',
                    'divisi' => ' ',
                    'bagian' => ' ',
                    'jabatan' => ' ',
                    'grup' => ' ',
                    'profesi' => ' ',
                    'shift' => ' ',
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                // Add Legalitas
                DB::table('penerimaan_legalitas')->insert([
                    "suratjns" => "PERJANJIAN",
                    "userid" => $kode,
                    "nama" => $l->nama,
                    "inputtgl" => date('Y-m-d'),
                    "legalitastgl" => $request->dari[$i],
                    "tglmasuk" => $request->dari[$i],
                    "tglaw" => $request->dari[$i],
                    "tglak" => $request->ke[$i],
                    "nmsurat" => $nmsurat,
                    "suratket" => $suratket,
                    'dibuat' => Auth::user()->name,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
        // $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
        // if ($check) {
        //     $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
        // }
        return Response()->json($arr);
    }

    // ======================== END WAWANCARA ============================================================================================
    // ======================== START KARYAWAN =========================================================================================

    public function karyawan()
    {
        $judul = "Karyawan";
        $penerimaan = "active";
        $karyawan = "active";
        return view('products/02_penerimaan.karyawan', ['judul' => $judul, 'penerimaan' => $penerimaan, 'karyawan' => $karyawan]);
    }

    public function listKaryawan(Request $request)
    {
        $data = DB::table('penerimaan_karyawan')->where('id', $request->id)->get();
        foreach ($data as $u) {
            $link = url('photo/pas/' . $u->userid);
            $ktp = url('photo/ktp/' . $u->userid);
            $tgkeluar = !empty($u->tglkeluar) ? Carbon::parse($u->tglkeluar)->format('d/m/Y') : "";
            echo '
            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="shadow" style="padding: 0px 0px 0px 0px">
                            <div class="col-lg-12">
                                <a data-fslightbox="gallery" href="' . $link . '.jpg">
                                    <div class="img-responsive rounded-3 border"
                                        style="background-image: url(' . $link . '.jpg)">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="shadow" style="padding: 0px 0px 0px 0px">
                            <div class="col-lg-12">
                                <a data-fslightbox="gallery" href="' . $ktp . '.jpg">
                                    <div class="img-responsive rounded-3 border"
                                        style="background-image: url(' . $ktp . '.jpg)">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card shadow bg-info-lt mb-3">
                        <div class="table-responsive">
                            <table class="table table-sm table-vcenter card-table table-sm">
                                <tr>
                                    <td>Userid</td>
                                    <td>:</td>
                                    <td>' . $u->userid . '</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Masuk</td>
                                    <td>:</td>
                                    <td>' . Carbon::parse($u->tglmasuk)->format('d/m/Y') . '</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Aktif</td>
                                    <td>:</td>
                                    <td>' . Carbon::parse($u->tglaktif)->format('d/m/Y') . '</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Keluar</td>
                                    <td>:</td>
                                    <td>' . $tgkeluar . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card shadow bg-green-lt">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">No. Map</label>
                                            <input type="hidden" name="id" placeholder="" value="' . $u->id . '" />
                                            <input type="hidden" name="userid" placeholder="" value="' . $u->userid . '" />
                                            <input type="text" class="form-control" name="nomap" placeholder="" value="' . $u->nomap . '" disabled style="border-color:black"  />
                                        </div>
                                        <div class="col">
                                            <label class="form-label">STB</label>
                                            <input type="text" class="form-control" placeholder="" value="' . $u->stb . '" style="border-color:black" disabled readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">KTP</label>
                                    <input type="text" class="form-control" name="nik" placeholder="" value="' . $u->nik . '" disabled
                                        style="border-color:black"  />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" placeholder="" value="' . $u->nama . '" disabled
                                        style="border-color:black"  />
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Gender</label>
                                            <select name="gender" id="gender" class="form-select border-dark" disabled>
                                                <option value="' . $u->gender . '" hidden>-- ' . $u->gender . ' --</option>
                                                <option value="PRIA">Pria</option>
                                                <option value="WANITA">Wanita</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Agama</label>
                                            <select name="agama" id="agama" class="form-select border-dark" disabled>
                                                <option value="' . $u->agama . '" hidden>-- ' . $u->agama . ' --</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Buddha">Buddha</option>
                                                <option value="Khonghucu">Khonghucu</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Tinggi</label>
                                            <input type="text" class="form-control" name="tinggi" placeholder="" value="' . $u->tinggi . '" disabled
                                                style="border-color:black"  />
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Berat</label>
                                            <input type="text" class="form-control" name="berat" placeholder="" value="' . $u->berat . '" disabled
                                                style="border-color:black"  />
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tempat, Tanggal Lahir</label>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control" name="tempat" placeholder="" value="' . $u->tempat . '" style="border-color:black" disabled />
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="tgllahir" placeholder="" value="' . $u->tgllahir . '" style="border-color:black" id="datepicker3" disabled />
                                            <script>
                                                window.Litepicker && (new Litepicker({
                                                    element: document.getElementById("datepicker3"),
                                                    buttonText: {
                                                        previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                                                        nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
                                                    },
                                                }));
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <div class="row">
                                        <div class="col">
                                            <textarea name="alamat" class="form-control border border-dark" id="alamat" cols="30" rows="10" disabled>' . $u->alamat . '</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Pendidikan</label>
                                            <input type="text" class="form-control" name="pendidikan" placeholder="" value="' . $u->pendidikan . '" style="border-color:black" disabled />
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Jurusan</label>
                                            <input type="text" class="form-control" name="jurusan" placeholder="" value="' . $u->jurusan . '" style="border-color:black" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Telepon</label>
                                            <input type="text" class="form-control" name="notlp" placeholder="" value="' . $u->notlp . '" style="border-color:black" disabled />
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Serikat</label>
                                            <input type="text" class="form-control" name="serikat" placeholder="" value="' . $u->serikat . '" disabled
                                                style="border-color:black"  />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow bg-info-lt">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-sm">
                                <tr>
                                    <td width="70px">Divisi</td>
                                    <td>:</td>
                                    <td>' . $u->divisi . '</td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td>:</td>
                                    <td>' . $u->jabatan . '</td>
                                </tr>
                                <tr>
                                    <td>Bagian</td>
                                    <td>:</td>
                                    <td>' . $u->bagian . '</td>
                                </tr>
                                <tr>
                                    <td>Grup</td>
                                    <td>:</td>
                                    <td>' . $u->grup . '</td>
                                </tr>
                                <tr>
                                    <td>Shift</td>
                                    <td>:</td>
                                    <td>' . $u->shift . '</td>
                                </tr>
                                <tr>
                                    <td>Profesi</td>
                                    <td>:</td>
                                    <td>' . $u->profesi . '</td>
                                </tr>
                                <tr>
                                    <td>Libur</td>
                                    <td>:</td>
                                    <td>' . $u->hrlibur . '</td>
                                </tr>
                                <tr>
                                    <td>½ Hari</td>
                                    <td>:</td>
                                    <td>' . $u->sethari . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="card shadow bg-warning-lt">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Surat Internal</label>
                                <h3>' . $u->internal . '</h3>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Surat Perjanjian</label>
                                <h3>' . $u->perjanjian . '</h3>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status Karyawan</label>
                                <h3>' . $u->status . '</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ';
        }
    }

    public function storeUpdateKaryawan(Request $request)
    {
        $request->validate(
            [
                '_token' => 'required',
            ],
        );

        // if ($request->file('image')) {
        // $fileName = $request->userid . '.' . $request->image->extension();
        // $request->image->storeAs('public/photo', $fileName);
        // }

        $check = DB::table('penerimaan_karyawan')
            ->where('id', $request->id)
            ->limit(1)
            ->update(
                array(
                    'nomap' => $request->nomap,
                    'nik' => $request->nik,
                    'nama' => $request->nama,
                    'gender' => $request->gender,
                    'agama' => $request->agama,
                    'tinggi' => $request->tinggi,
                    'berat' => $request->berat,
                    'tempat' => $request->tempat,
                    'tgllahir' => $request->tgllahir,
                    'pendidikan' => $request->pendidikan,
                    'jurusan' => $request->jurusan,
                    'notlp' => $request->notlp,
                    'serikat' => $request->serikat,
                    'updated_at' => date('Y-m-d H:i:s'),
                )
            );

        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data: ' . $request->nama . ' telah berhasil disimpan', 'status' => true);
        }
        return Response()->json($arr);
    }

    public function imageStore(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $image_path = $request->file('image')->store('image', 'public');

        $data = Image::create([
            'image' => $image_path,
        ]);

        return response($data, Response::HTTP_CREATED);
    }

    public function karyawaneditdata(Request $request)
    {
        $editKaryawan = DB::table('penerimaan_karyawan')
            ->where('userid', $request->userid)
            ->limit(1)
            ->update([
                'nomap' => $request->nomap,
                'bankrek' => $request->rekening,
                'nik' => $request->nik,
                'nama' => $request->nama,
                'gender' => $request->gender,
                'agama' => $request->agama,
                'tinggi' => $request->tinggi,
                'berat' => $request->berat,
                'tempat' => $request->tempat,
                'tgllahir' => $request->tgllahir,
                'pendidikan' => $request->pendidikan,
                'alamat' => $request->alamat,
                'jurusan' => $request->jurusan,
                'notlp' => $request->notlp,
                'serikat' => $request->serikat,
                'email' => $request->email,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        if ($editKaryawan) {
            return redirect('/penerimaan/karyawan/edit/' . $request->id)->with('successEdit', 'Data Berhasil Diubah.');
        }
    }

    // ======================== END KARYAWAN ===========================================================================================
    // ======================== START LEGALITAS =========================================================================================

    public function legalitas()
    {
        $judul = "Legalitas";
        $penerimaan = "active";
        $legalitas = "active";

        $basic = DB::table('daftar_surat')->where('jenissurat', '=', 'Basic')->get();
        $bagian = DB::table('daftar_pospekerjaan')->where('type', '=', 'BAGIAN')->get();
        $grup = DB::table('daftar_pospekerjaan')->where('type', '=', 'GRUP')->get();
        $shift = DB::table('daftar_pospekerjaan')->where('type', '=', 'SHIFT')->get();
        return view('products/02_penerimaan.legalitas', [
            'basic' => $basic,
            'judul' => $judul,
            'penerimaan' => $penerimaan,
            'legalitas' => $legalitas,
            'bagian' => $bagian,
            'grup' => $grup,
            'shift' => $shift,
        ]);
    }

    public function uploadMassalLegalitas()
    {
        $judul = "Upload Massal";
        $penerimaan = "active";
        $legalitas = "active";

        return view('products/02_penerimaan.massupload', [
            'judul' => $judul,
            'penerimaan' => $penerimaan,
            'legalitas' => $legalitas
        ]);
    }

    public function exportLegalitas()
    {
        $file_path = public_path('file_excel/ContohUploadLegalitas.xlsx');

        return response()->download($file_path);
    }

    public function legalEdit($id)
    {
        $data = DB::table('penerimaan_karyawan')->where('userid', $id)->limit(1)->get();
        foreach ($data as $u) {
            $userid = $u->userid;
            $nama = $u->nama;
        }
        $judul = "Edit Legalitas " . $nama;
        $penerimaan = "active";
        $legalitas = "active";

        $p_divisi = DB::table('daftar_pospekerjaan')->where('type', 'like', '%DIVISI%')->orderBy('desc', 'asc')->get();
        $p_bagian = DB::table('daftar_pospekerjaan')->where('type', 'like', '%BAGIAN%')->orderBy('desc', 'asc')->get();
        $p_jabatan = DB::table('daftar_pospekerjaan')->where('type', 'like', '%JABATAN%')->orderBy('desc', 'asc')->get();
        $p_grup = DB::table('daftar_pospekerjaan')->where('type', 'like', '%GRUP%')->orderBy('desc', 'asc')->get();
        $p_shift = DB::table('daftar_pospekerjaan')->where('type', 'like', '%SHIFT%')->orderBy('desc', 'asc')->get();

        $j_perjanjian = DB::table('daftar_surat')->where('jenissurat', 'like', '%Perjanjian%')->orderBy('nmsurat', 'asc')->get();
        $j_internal = DB::table('daftar_surat')->where('jenissurat', 'like', '%Intern%')->orderBy('nmsurat', 'asc')->get();
        $j_status = DB::table('daftar_surat')->where('jenissurat', 'like', '%Status%')->orderBy('nmsurat', 'asc')->get();

        return view('products/02_penerimaan.legalitasEdit', [
            'judul' => $judul,
            'penerimaan' => $penerimaan,
            'legalitas' => $legalitas,
            'getKar' => $data,
            // 'basic' => $basic,
            // 'perjanjian' => $perjanjian,
            // 'intern' => $intern,
            // 'status' => $status,
            'p_divisi' => $p_divisi,
            'p_bagian' => $p_bagian,
            'p_jabatan' => $p_jabatan,
            'p_grup' => $p_grup,
            'p_shift' => $p_shift,
            'j_perjanjian' => $j_perjanjian,
            'j_internal' => $j_internal,
            'j_status' => $j_status,
            'iduntukphl' => $id,
        ]);
    }

    public function storedataLegalitas(Request $request)
    {
        $karyawan = DB::table('penerimaan_karyawan')->where('userid', $request->userid)->first();
        if ($request->suratjns == "BASIC") {
            $request->validate(
                [
                    '_token' => 'required',
                    'userid' => 'required',
                    'suratjns' => 'required',
                ],
            );
            // GET IDJOB
            $noform = date('y') . "00000";
            $checknoform = DB::table('schedule')->orderBy('idjob', 'desc')->limit('1')->get();
            foreach ($checknoform as $key) {
                $noform = $key->idjob;
            }
            $y = substr($noform, 0, 2);
            if (date('y') == $y) {
                $noUrut = substr($noform, 2, 5);
                $na = $noUrut + 1;
                $char = date('y');
                $kode = $char . sprintf("%05s", $na);
            } else {
                $kode = date('y') . "00001";
            }
            // GET IDJOB
            // ================================================================
            // kondisi jika tanggal legalitas kurang dari sama dengan hari ini, 
            // maka eksekusi sekarang, 
            // tapi jika lebih besar dari hari ini maka masuk ke schedule
            // ================================================================
            if ($request->tglaktif <= date('Y-m-d')) {
                $inputLegalitas = DB::table('penerimaan_legalitas')->insert([
                    'remember_token' => $request->_token,
                    'suratjns' => $request->suratjns,
                    'userid' => $request->userid,
                    'stb' => $request->stb,
                    'nama' => $karyawan->nama,
                    'inputtgl' => $request->tglinput,
                    'legalitastgl' => $request->tglaktif,
                    'tglmasuk' => $request->tglmasuk,
                    'nmsurat' => $request->nmsurat,
                    'divisi' => $request->divisi,
                    'bagian' => $request->bagian,
                    'jabatan' => $request->jabatan,
                    'grup' => $request->grup,
                    'shift' => $request->shift,
                    'profesi' => $request->profesi,
                    'hrlibur'  => $request->hrlibur,
                    'sethari' => $request->serhari,
                    'keterangan' => $request->keterangan,
                    'id_cron'    => 'Langsung Dibuat',
                    'dibuat' => Auth::user()->name,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                $inputKaryawan = DB::table('penerimaan_karyawan')
                    ->where('userid', $request->userid)
                    ->limit(1)
                    ->update([
                        'entitas' => 'PINTEX',
                        'stb' => $request->stb,
                        'tglmasuk' => $request->tglmasuk,
                        'divisi' => $request->divisi,
                        'bagian' => $request->bagian,
                        'jabatan' => $request->jabatan,
                        'grup' => $request->grup,
                        'profesi' => $request->profesi,
                        'shift' => $request->shift,
                        'hrlibur'  => $request->hrlibur,
                        'sethari' => $request->sethari,
                        'keterangan' => $request->keterangan,
                        // 'dibuat' => Auth::user()->name,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            } else {
                $inputLegalitas = DB::table('penerimaan_legalitas')->insert([
                    'remember_token' => $request->_token,
                    'suratjns' => $request->suratjns,
                    'userid' => $request->userid,
                    'stb' => $request->stb,
                    'nama' => $karyawan->nama,
                    'inputtgl' => $request->tglinput,
                    'legalitastgl' => $request->tglaktif,
                    'tglmasuk' => $request->tglmasuk,
                    'nmsurat' => $request->nmsurat,
                    'divisi' => $request->divisi,
                    'bagian' => $request->bagian,
                    'jabatan' => $request->jabatan,
                    'grup' => $request->grup,
                    'shift' => $request->shift,
                    'profesi' => $request->profesi,
                    'hrlibur'  => $request->hrlibur,
                    'sethari' => $request->serhari,
                    'keterangan' => $request->keterangan,
                    'id_cron'    => $kode,
                    'dibuat' => Auth::user()->name,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                $inputSchedule = DB::table('schedule')->insert([
                    'remember_token' => $request->_token,
                    'entitas' => $request->entitas,
                    'type' => 'Basic',
                    'title' => 'Penambahan Legalitas',
                    'idjob' => $kode,
                    'dbjob' => 'penerimaan_legalitas',
                    'job' => 'add',
                    'datejob' => $request->tglaktif,
                    'nama' => $karyawan->nama,
                    'idemployee' => $request->userid,
                    'dibuat' => Auth::user()->name,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
            // $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
            $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
            return Response()->json($arr);
        } elseif ($request->suratjns == "PERJANJIAN") {
            // GET IDJOB
            $noform = date('y') . "00000";
            $checknoform = DB::table('schedule')->orderBy('idjob', 'desc')->limit('1')->get();
            foreach ($checknoform as $key) {
                $noform = $key->idjob;
            }
            $y = substr($noform, 0, 2);
            if (date('y') == $y) {
                $noUrut = substr($noform, 2, 5);
                $na = $noUrut + 1;
                $char = date('y');
                $kode = $char . sprintf("%05s", $na);
            } else {
                $kode = date('y') . "00001";
            }
            // GET IDJOB
            // ================================================================
            // kondisi jika tanggal perjanjian kurang dari sama dengan hari ini, 
            // maka eksekusi sekarang, 
            // tapi jika lebih besar dari hari ini maka masuk ke schedule
            // ================================================================
            if ($request->tglawal <= date('Y-m-d')) {
                $inputLegalitas = DB::table('penerimaan_legalitas')->insert([
                    'remember_token' => $request->_token,
                    'suratjns' => $request->suratjns,
                    'userid' => $request->userid,
                    'nama' => $karyawan->nama,
                    'inputtgl' => date('Y-m-d'),
                    'legalitastgl' => $request->tglawal,
                    'tglaw' => $request->tglawal,
                    'tglak' => $request->tglakhir,
                    'nmsurat' => $request->nmsurat,
                    'suratket' => $request->jnssurat,
                    'sacuti' => $request->cuti,
                    'id_cron'    => 'Langsung Dibuat',
                    'dibuat' => Auth::user()->name,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                // Edit di karyawan
                $editKaryawan = DB::table('penerimaan_karyawan')
                    ->where('userid', $request->userid)
                    ->limit(1)
                    ->update([
                        'tglaktif' => $request->tglawal,
                        'tglkeluar' => $request->tglakhir,
                        'perjanjian' => $request->jnssurat . " (" . $request->tglawal . " s.d. " . $request->tglakhir . ")",
                        'status' => 'Aktif',
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            } else {
                $inputLegalitas = DB::table('penerimaan_legalitas')->insert([
                    'remember_token' => $request->_token,
                    'suratjns' => $request->suratjns,
                    'userid' => $request->userid,
                    'nama' => $karyawan->nama,
                    'inputtgl' => date('Y-m-d'),
                    'legalitastgl' => $request->tglawal,
                    'tglaw' => $request->tglawal,
                    'tglak' => $request->tglakhir,
                    'nmsurat' => $request->nmsurat,
                    'suratket' => $request->jnssurat,
                    'sacuti' => $request->cuti,
                    'id_cron'    => 'Langsung Dibuat',
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                $check = DB::table('schedule')->insert([
                    'remember_token' => $request->_token,
                    'entitas' => $request->entitas,
                    'type' => 'Perjanjian',
                    'title' => 'Penambahan Legalitas Perjanjian',
                    'idjob' => $kode,
                    'dbjob' => 'penerimaan_legalitas',
                    'job' => 'add',
                    'datejob' => $request->tglawal,
                    'nama' => $karyawan->nama,
                    'idemployee' => $request->userid,
                    'dibuat' => Auth::user()->name,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
            // $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
            $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
            return Response()->json($arr);
        } elseif ($request->suratjns == "INTERN") {
            $inputLegalitas = DB::table('penerimaan_legalitas')->insert([
                'remember_token' => $request->_token,
                'suratjns' => $request->suratjns,
                'userid' => $request->userid,
                'nama' => $karyawan->nama,
                'inputtgl' => date('Y-m-d'),
                'legalitastgl' => $request->tglinternal,
                'nmsurat' => $request->nmsurat,
                'suratket' => $request->nmsurat,
                'keterangan' => $request->keterangan,
                'id_cron'    => 'Langsung Dibuat',
                'dibuat' => Auth::user()->name,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $intern = DB::table('penerimaan_karyawan')->where('userid', $request->userid)->first();
            // Edit di karyawan
            if ($intern->internal) {
                if ($request->tglinternal <= $intern->tglinternal) {
                    // do nothing
                } else {
                    $editKaryawan = DB::table('penerimaan_karyawan')
                        ->where('userid', $request->userid)
                        ->limit(1)
                        ->update([
                            'tglinternal' => $request->tglinternal,
                            'internal' => $request->nmsurat . " " . $request->keterangan,
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                }
            } else {
                $editKaryawan = DB::table('penerimaan_karyawan')
                    ->where('userid', $request->userid)
                    ->limit(1)
                    ->update([
                        'tglinternal' => $request->tglinternal,
                        'internal' => $request->nmsurat . " " . $request->keterangan,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            }
            // $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
            $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
            return Response()->json($arr);
        } elseif ($request->suratjns == "STATUS") {
            $inputLegalitas = DB::table('penerimaan_legalitas')->insert([
                'remember_token' => $request->_token,
                'suratjns' => $request->suratjns,
                'userid' => $request->userid,
                'nama' => $karyawan->nama,
                'inputtgl' => date('Y-m-d'),
                'legalitastgl' => $request->tglstatus,
                'nmsurat' => $request->nmsurat,
                'suratket' => $request->keterangan,
                'id_cron'    => 'Langsung Dibuat',
                'dibuat' => Auth::user()->name,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            // Edit di karyawan
            if ($request->nmsurat == "Surat Cuti Melahirkan") {
                $status = "(Aktif) " . $request->nmsurat . " - " . $request->tglstatus;
            } else {
                $status = $request->nmsurat . " - " . $request->tglstatus;
            }
            $editKaryawan = DB::table('penerimaan_karyawan')
                ->where('userid', $request->userid)
                ->limit(1)
                ->update([
                    'status' => $status,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            // $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
            $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
            return Response()->json($arr);
        } elseif ($request->suratjns == "CUTI") {
            // GET IDJOB
            $noform = date('y') . "00000";
            $checknoform = DB::table('schedule')->orderBy('idjob', 'desc')->limit('1')->get();
            foreach ($checknoform as $key) {
                $noform = $key->idjob;
            }
            $y = substr($noform, 0, 2);
            if (date('y') == $y) {
                $noUrut = substr($noform, 2, 5);
                $na = $noUrut + 1;
                $char = date('y');
                $kode = $char . sprintf("%05s", $na);
            } else {
                $kode = date('y') . "00001";
            }
            // GET IDJOB
            $inputLegalitas = DB::table('penerimaan_legalitas')->insert([
                'remember_token' => $request->_token,
                'suratjns' => $request->suratjns,
                'nmsurat' => $request->nmsurat,
                'suratket' => $request->suratket,
                'userid' => $request->userid,
                'nama' => $karyawan->nama,
                'inputtgl' => date('Y-m-d'),
                'legalitastgl' => date('Y-m-d'),
                'tglaw' => $request->tglawal,
                'tglak' => $request->tglakhir,
                'sacuti' => $request->cuti,
                'id_cron'    => 'Langsung Dibuat',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            // $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
            $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
            return Response()->json($arr);
        }
    }

    public function storedataEditLegalitas(Request $request)
    {
        $legalitas = DB::table('penerimaan_legalitas')->where('id', $request->idlegalitas)->first();
        $latest_legalitas = DB::table('penerimaan_legalitas')->where('suratjns', $request->suratjns)->latest()->first();
        if ($request->suratjns == "BASIC") {
            $request->validate(
                [
                    '_token' => 'required',
                    'idlegalitas' => 'required',
                    'suratjns' => 'required',
                ],
            );
            // ================================================================
            // kondisi jika tanggal legalitas kurang dari sama dengan hari ini, 
            // maka eksekusi sekarang, 
            // tapi jika lebih besar dari hari ini maka masuk ke schedule
            // ================================================================
            if ($request->idlegalitas == $latest_legalitas->id) {
                $updateLegalitas = DB::table('penerimaan_legalitas')
                    ->where('id', $request->idlegalitas)
                    ->limit(1)
                    ->update([
                        'suratjns' => $request->suratjns,
                        'userid' => $request->userid,
                        'stb' => $request->stb,
                        'inputtgl' => $request->tglinput,
                        'legalitastgl' => $request->tglaktif,
                        'tglmasuk' => $request->tglmasuk,
                        'nmsurat' => $request->nmsurat,
                        'divisi' => $request->divisi,
                        'bagian' => $request->bagian,
                        'jabatan' => $request->jabatan,
                        'grup' => $request->grup,
                        'shift' => $request->shift,
                        'profesi' => $request->profesi,
                        'hrlibur'  => $request->hrlibur,
                        'sethari' => $request->sethari,
                        'keterangan' => $request->keterangan,
                        'id_cron'    => 'Updated',
                        'dibuat' => Auth::user()->name,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                $inputKaryawan = DB::table('penerimaan_karyawan')
                    ->where('userid', $request->userid)
                    ->limit(1)
                    ->update([
                        'entitas' => 'PINTEX',
                        'stb' => $request->stb,
                        'divisi' => $request->divisi,
                        'bagian' => $request->bagian,
                        'jabatan' => $request->jabatan,
                        'grup' => $request->grup,
                        'profesi' => $request->profesi,
                        'shift' => $request->shift,
                        'hrlibur'  => $request->hrlibur,
                        'sethari' => $request->sethari,
                        'keterangan' => $request->keterangan,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            } else {
                $updateLegalitas = DB::table('penerimaan_legalitas')
                    ->where('id', $request->idlegalitas)
                    ->limit(1)
                    ->update([
                        'suratjns' => $request->suratjns,
                        'userid' => $request->userid,
                        'stb' => $request->stb,
                        'inputtgl' => $request->tglinput,
                        'legalitastgl' => $request->tglaktif,
                        'tglmasuk' => $request->tglmasuk,
                        'nmsurat' => $request->nmsurat,
                        'divisi' => $request->divisi,
                        'bagian' => $request->bagian,
                        'jabatan' => $request->jabatan,
                        'grup' => $request->grup,
                        'shift' => $request->shift,
                        'profesi' => $request->profesi,
                        'hrlibur'  => $request->hrlibur,
                        'sethari' => $request->sethari,
                        'keterangan' => $request->keterangan,
                        'id_cron'    => 'Updated',
                        'dibuat' => Auth::user()->name,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            }
            // $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
            $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
            return Response()->json($arr);
        } elseif ($request->suratjns == "PERJANJIAN") {
            $request->validate(
                [
                    '_token' => 'required',
                    'idlegalitas' => 'required',
                    'nmsurat' => 'required',
                    'jnssurat' => 'required',
                    'tglawal' => 'required',
                    'tglakhir' => 'required',
                ],
            );
            // ========================================================
            // Kondisi jika id data yang diedit adalah id yang terbaru,
            // maka data karyawan juga akan diedit
            // ========================================================
            if ($request->idlegalitas == $latest_legalitas->id) {
                $updateLegalitas = DB::table('penerimaan_legalitas')
                    ->where('id', $request->idlegalitas)
                    ->limit(1)
                    ->update([
                        'nmsurat' => $request->nmsurat,
                        'suratjns' => $request->jnssurat,
                        'tglaw' => $request->tglawal,
                        'tglak' => $request->tglakhir,
                        'sacuti' => $request->cuti,
                        'id_cron'    => 'Updated',
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                // Edit di karyawan
                $editKaryawan = DB::table('penerimaan_karyawan')
                    ->where('userid', $request->userid)
                    ->limit(1)
                    ->update([
                        'tglaktif' => $request->tglawal,
                        'tglkeluar' => $request->tglakhir,
                        'perjanjian' => $request->jnssurat . " (" . $request->tglawal . " s.d. " . $request->tglakhir . ")",
                        'status' => 'Aktif',
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            } else {
                $updateLegalitas = DB::table('penerimaan_legalitas')
                    ->where('id', $request->idlegalitas)
                    ->limit(1)
                    ->update([
                        'nmsurat' => $request->nmsurat,
                        'suratket' => $request->jnssurat,
                        'suratjns' => $request->suratjns,
                        'tglaw' => $request->tglawal,
                        'tglak' => $request->tglakhir,
                        'sacuti' => $request->cuti,
                        'id_cron'    => 'Updated',
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            }
            // $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
            $arr = array('msg' => 'Data telah berhasil diubah', 'status' => true);
            return Response()->json($arr);
        } elseif ($request->suratjns == "INTERN") {
            $request->validate(
                [
                    '_token' => 'required',
                    'idlegalitas' => 'required',
                    'nmsurat' => 'required',
                    'tglinternal' => 'required',
                    'keterangan' => 'required',
                ],
            );
            // ========================================================
            // Kondisi jika id data yang diedit adalah id yang terbaru,
            // maka data karyawan juga akan diedit
            // ========================================================
            if ($request->idlegalitas == $latest_legalitas->id) {
                $updateLegalitas = DB::table('penerimaan_legalitas')
                    ->where('id', $request->idlegalitas)
                    ->limit(1)
                    ->update([
                        'nmsurat' => $request->nmsurat,
                        'legalitastgl' => $request->tglinternal,
                        'keterangan' => $request->keterangan,
                        'id_cron'    => 'Updated',
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                $editKaryawan = DB::table('penerimaan_karyawan')
                    ->where('userid', $request->userid)
                    ->limit(1)
                    ->update([
                        'tglinternal' => $request->tglinternal,
                        'internal' => $request->nmsurat . " " . $request->keterangan,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            } else {
                $updateLegalitas = DB::table('penerimaan_legalitas')
                    ->where('id', $request->idlegalitas)
                    ->limit(1)
                    ->update([
                        'nmsurat' => $request->nmsurat,
                        'legalitastgl' => $request->tglinternal,
                        'keterangan' => $request->keterangan,
                        'id_cron'    => 'Updated',
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            }

            // $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
            $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
            return Response()->json($arr);
        } elseif ($request->suratjns == "STATUS") {
            $request->validate(
                [
                    '_token' => 'required',
                    'idlegalitas' => 'required',
                    'nmsurat' => 'required',
                    'tglstatus' => 'required',
                    'keterangan' => 'required',
                ],
            );
            // ========================================================
            // Kondisi jika id data yang diedit adalah id yang terbaru,
            // maka data karyawan juga akan diedit
            // ========================================================
            if ($request->idlegalitas == $latest_legalitas->id) {
                $updateLegalitas = DB::table('penerimaan_legalitas')
                    ->where('id', $request->idlegalitas)
                    ->limit(1)
                    ->update([
                        'nmsurat' => $request->nmsurat,
                        'legalitastgl' => $request->tglstatus,
                        'keterangan' => $request->keterangan,
                        'suratket' => $request->keterangan,
                        'id_cron'    => 'Updated',
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                // Edit di karyawan
                if ($request->nmsurat == "Surat Cuti Melahirkan") {
                    $status = "(Aktif) " . $request->nmsurat . " - " . $request->tglstatus;
                } else {
                    $status = $request->nmsurat . " - " . $request->tglstatus;
                }
                $editKaryawan = DB::table('penerimaan_karyawan')
                    ->where('userid', $request->userid)
                    ->limit(1)
                    ->update([
                        'status' => $status,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            } else {
                $updateLegalitas = DB::table('penerimaan_legalitas')
                    ->where('id', $request->idlegalitas)
                    ->limit(1)
                    ->update([
                        'nmsurat' => $request->nmsurat,
                        'legalitastgl' => $request->tglstatus,
                        'keterangan' => $request->keterangan,
                        'id_cron'    => 'Updated',
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            }
            // $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
            $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
            return Response()->json($arr);
        } elseif ($request->suratjns == "CUTI") {
            $request->validate(
                [
                    '_token' => 'required',
                    'tglawal' => 'required',
                    'tglakhir' => 'required',
                    'cuti' => 'required',
                ],
            );
            $updateLegalitas = DB::table('penerimaan_legalitas')
                ->where('id', $request->idlegalitas)
                ->limit(1)
                ->update([
                    'tglaw' => $request->tglawal,
                    'tglak' => $request->tglakhir,
                    'sacuti' => $request->cuti,
                    'id_cron'    => 'Updated',
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            // $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
            $arr = array('msg' => 'Data telah berhasil diproses', 'status' => true);
            return Response()->json($arr);
        }
    }

    public function listStb(Request $request)
    {
        $data = DB::table('penerimaan_karyawan')
            ->where('stb', 'like', '1' . date('y') . '%')
            ->orderBy('stb', 'desc')
            ->limit(1)
            ->get();
        $data2 = DB::table('penerimaan_karyawan')
            ->where('stb', 'like', '2' . date('y') . '%')
            ->orderBy('stb', 'desc')
            ->limit(1)
            ->get();
        $data3 = DB::table('penerimaan_karyawan')
            ->where('stb', 'like', '3' . date('y') . '%')
            ->orderBy('stb', 'desc')
            ->limit(1)
            ->get();

        echo 'Berikut Urutan STB yang dapat digunakan : <br>';
        foreach ($data as $u) {
            $stbnew = $u->stb + 1;
            echo '<p>1. Awalan 1 Terakhir dipakai oleh : ' . $u->nama . ' => ' . $u->stb . '</p>';
        }
        foreach ($data2 as $u2) {
            $stbnew2 = $u2->stb + 1;
            echo '<p>2. Awalan 2 Terakhir dipakai oleh : ' . $u2->nama . ' => ' . $u2->stb . '</p>';
        }
        foreach ($data3 as $u3) {
            $stbnew3 = $u3->stb + 1;
            echo '<p>3. Awalan 3 Terakhir dipakai oleh : ' . $u3->nama . ' => ' . $u3->stb . '</p>';
        }
        echo '
            <p id="myText" hidden>' . $stbnew . '</p>
            <p id="myText2" hidden>' . $stbnew2 . '</p>
            <p id="myText3" hidden>' . $stbnew3 . '</p>
            <script>
                let text = document.getElementById("myText").innerHTML;
                let text2 = document.getElementById("myText2").innerHTML;
                let text3 = document.getElementById("myText3").innerHTML;
                const copyContent = async () => {
                    try {
                        await navigator.clipboard.writeText(text);
                        console.log("Content copied to clipboard");
                        $("#modal-stb").modal("hide");
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            title: "STB ' . $stbnew . ' Berhasil Disalin ke Clipboard",
                        });

                    } catch (err) {
                        console.error("Failed to copy: ", err);
                    }
                }
                const copyContent2 = async () => {
                    try {
                        await navigator.clipboard.writeText(text2);
                        console.log("Content copied to clipboard");
                        $("#modal-stb").modal("hide");
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            title: "STB ' . $stbnew2 . ' Berhasil Disalin ke Clipboard",
                        });
                    } catch (err) {
                        console.error("Failed to copy: ", err);
                    }
                }
                const copyContent3 = async () => {
                    try {
                        await navigator.clipboard.writeText(text3);
                        console.log("Content copied to clipboard");
                        $("#modal-stb").modal("hide");
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            title: "STB ' . $stbnew3 . ' Berhasil Disalin ke Clipboard",
                        });
                    } catch (err) {
                        console.error("Failed to copy: ", err);
                    }
                }
            </script>
            <div class="row">
                <div class="col">
                    <div class="alert alert-important alert-success" role="alert">
                        Nomor 1 : <h1><a href="javascript:void(0)" onclick="copyContent()">' . $stbnew . '</a></h1>
                    </div>
                </div>
                <div class="col">
                    <div class="alert alert-important alert-success" role="alert">
                        Nomor 2 : <h1><a href="javascript:void(0)" onclick="copyContent2()">' . $stbnew2 . '</a></h1>
                    </div>
                </div>
                <div class="col">
                    <div class="alert alert-important alert-success" role="alert">
                        Nomor 3 : <h1><a href="javascript:void(0)" onclick="copyContent3()">' . $stbnew3 . '</a></h1>
                    </div>
                </div>
            </div>
            ';
        echo '<i>*Klik STB untuk menyalin</i>';
    }

    public function getTableBasic(Request $request)
    {
        $basic = DB::table('penerimaan_legalitas')->where('userid', $request->userid)->where('suratjns', 'like', '%basic%')->orderBy('legalitastgl', 'asc')->get();

        echo '
            <div class="table-responsive">
                <table
                    class="table table-sm table-bordered table-striped table-hover table-vcenter text-nowrap border border-green"
                    id="tb_basic">
                    <thead>
                        <tr>
                            <th class="w-1"></th>
                            <th class="text-center">Tgl Masuk</th>
                            <th class="text-center">Tgl Aktif</th>
                            <th class="text-center">Nama Surat</th>
                            <th class="text-center">STB</th>
                            <th class="text-center">Divisi</th>
                            <th class="text-center">Bagian</th>
                            <th class="text-center">Jabatan</th>
                            <th class="text-center">Grup</th>
                            <th class="text-center">Jns. Shift</th>
                            <th class="text-center">Profesi</th>
                            <th class="text-center">Libur</th>
                            <th class="text-center">½ Hari</th>
                            <th class="text-center">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($basic as $bas => $b) {
            echo '
                        <tr>
                            <td class="text-center" style="padding: 2px 2px 2px 2px">
                                <button type="button" class="btn btn-sm btn-info btn-icon btn-edit" data-id="' . $b->id . '" data-idtipe="basic" data-userid="' . $b->userid . '" data-nama="' . $b->nmsurat . '" data-tipe="Basic Information"><i class="fa-solid fa-edit"></i></button>
                                <button type="button" class="btn btn-sm btn-danger btn-icon btn-delete" data-id="' . $b->id . '" data-userid="' . $b->userid . '" data-nama="' . $b->nmsurat . '" data-tipe="' . $b->suratjns . '" data-url="basicdelete"><i class="fa-solid fa-trash-can"></i></button>
                            </td>
                            <td class="text-end">' . date('d/m/Y', strtotime($b->tglmasuk)) . '</td>
                            <td class="text-end">' . date('d/m/Y', strtotime($b->legalitastgl)) . '</td>
                            <td>' . $b->nmsurat . '</td>
                            <td>' . $b->stb . '</td>
                            <td>' . $b->divisi . '</td>
                            <td>' . $b->bagian . '</td>
                            <td>' . $b->jabatan . '</td>
                            <td>' . $b->grup . '</td>
                            <td>' . $b->shift . '</td>
                            <td>' . $b->profesi . '</td>
                            <td>' . $b->hrlibur . '</td>
                            <td>' . $b->sethari . '</td>
                            <td>' . $b->keterangan . '</td>
                        </tr>';
        }
        echo        '</tbody>
                </table>
            </div>
        ';
    }

    public function getTablePerjanjian(Request $request)
    {
        $perjanjian = DB::table('penerimaan_legalitas')->where('userid', $request->userid)->where('suratjns', 'like', '%perjanjian%')->orderBy('legalitastgl', 'asc')->get();

        echo '
            <div class="table-responsive">
                <table
                    class="table table-sm table-hover table-bordered table-vcenter card-table text-nowrap border border-purple"
                    id="tb_per">
                    <thead>
                        <tr>
                            <th class="w-1"></th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Nama Surat</th>
                            <th class="text-center">Jenis Surat</th>
                            <th class="text-center">Awal</th>
                            <th class="text-center">Akhir</th>
                            <th class="text-center">Cuti</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($perjanjian as $per => $p) {
            echo '
                        <tr>
                            <td class="text-center" style="padding: 2px 2px 2px 2px">
                                <button type="button" class="btn btn-sm btn-info btn-icon btn-edit" data-id="' . $p->id . '" data-idtipe="perjanjian" data-userid="' . $p->userid . '" data-nama="' . $p->nmsurat . '" data-tipe="Perjanjian"><i class="fa-solid fa-edit"></i></button>
                                <button type="button" class="btn btn-sm btn-danger btn-icon btn-delete" data-id="' . $p->id . '" data-userid="' . $p->userid . '" data-nama="' . $p->nmsurat . '" data-tipe="' . $p->suratjns . '" data-url="perjanjiandelete"><i class="fa-solid fa-trash-can"></i></button>
                            </td>
                            <td class="text-end">' . date('d/m/Y', strtotime($p->legalitastgl)) . '</td>
                            <td>' . $p->nmsurat . '</td>
                            <td>' . $p->suratket . '</td>
                            <td>' . date('d/m/Y', strtotime($p->tglaw))  . '</td>
                            <td>' . date('d/m/Y', strtotime($p->tglak))  . '</td>
                            <td>' . $p->sacuti . '</td>
                        </tr>';
        }
        echo        '</tbody>
                </table>
            </div>
        ';
    }

    public function getTableInternal(Request $request)
    {
        $intern = DB::table('penerimaan_legalitas')->where('userid', $request->userid)->where('suratjns', 'like', '%intern%')->orderBy('legalitastgl', 'asc')->get();

        echo '
            <div class="table-responsive">
                <table class="table table-sm table-hover table-bordered table-vcenter card-table text-nowrap border border-teal" id="tb_int">
                    <thead>
                        <tr>
                            <th class="w-0 text-center" style="padding: 2px 2px 2px 2px"></th>
                            <th class="text-center">Tanggal</th>
                            <th>Nama Surat</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($intern as $int => $i) {
            echo '
                        <tr>
                            <td class="text-center" style="padding: 2px 2px 2px 2px">
                                <button type="button" class="btn btn-sm btn-info btn-icon btn-edit" data-id="' . $i->id . '" data-idtipe="intern" data-userid="' . $i->userid . '" data-nama="' . $i->nmsurat . '" data-tipe="Internal"><i class="fa-solid fa-edit"></i></button>
                                <button type="button" class="btn btn-sm btn-danger btn-icon btn-delete" data-id="' . $i->id . '" data-userid="' . $i->userid . '" data-nama="' . $i->nmsurat . '" data-tipe="' . $i->suratjns . '" data-url="internaldelete"><i class="fa-solid fa-trash-can"></i></button>
                            </td>
                            <td class="text-center">' . date('d/m/Y', strtotime($i->legalitastgl)) . '</td>
                            <td>' . $i->suratket . '</td>
                            <td>' . $i->keterangan . '</td>
                        </tr>';
        }
        echo        '</tbody>
                </table>
            </div>
        ';
    }

    public function getTableStatus(Request $request)
    {
        $status = DB::table('penerimaan_legalitas')->where('userid', $request->userid)->where('suratjns', 'like', '%status%')->orderBy('legalitastgl', 'asc')->get();

        echo '
            <div class="table-responsive">
                <table class="table table-sm table-hover table-bordered table-vcenter card-table text-nowrap border border-pink" id="tb_stt">
                        <thead>
                            <tr>
                                <th class="w-1"></th>
                                <th>Tanggal</th>
                                <th>Nama Surat</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                    <tbody>';
        foreach ($status as $stt => $s) {
            echo '
                        <tr>
                            <td class="text-center" style="padding: 2px 2px 2px 2px">
                                <button type="button" class="btn btn-sm btn-info btn-icon btn-edit" data-id="' . $s->id . '" data-idtipe="status" data-userid="' . $s->userid . '" data-nama="' . $s->nmsurat . '" data-tipe="Status"><i class="fa-solid fa-edit"></i></button>
                                <button type="button" class="btn btn-sm btn-danger btn-icon btn-delete" data-id="' . $s->id . '" data-userid="' . $s->userid . '" data-nama="' . $s->nmsurat . '" data-tipe="' . $s->suratjns . '" data-url="statusdelete"><i class="fa-solid fa-trash-can"></i></button>
                            </td>
                            <td class="text-end">' . date('d/m/Y', strtotime($s->legalitastgl)) . '</td>
                            <td>' . $s->nmsurat . '</td>
                            <td>' . $s->suratket . '</td>
                        </tr>';
        }
        echo        '</tbody>
                </table>
            </div>
        ';
    }

    public function getTableCuti(Request $request)
    {
        $perjanjian = DB::table('penerimaan_legalitas')->where('userid', $request->userid)->where('suratjns', 'like', '%cuti%')->orderBy('legalitastgl', 'asc')->get();

        echo '
            <div class="table-responsive">
                <table
                    class="table table-sm table-hover table-bordered table-vcenter card-table text-nowrap border border-purple"
                    id="tb_per">
                    <thead>
                        <tr>
                            <th class="w-1"></th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Nama Surat</th>
                            <th class="text-center">Jenis Surat</th>
                            <th class="text-center">Awal</th>
                            <th class="text-center">Akhir</th>
                            <th class="text-center">Qty</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($perjanjian as $per => $p) {
            echo '
                        <tr>
                            <td class="text-center" style="padding: 2px 2px 2px 2px">
                                <button type="button" class="btn btn-sm btn-info btn-icon btn-edit" data-id="' . $p->id . '" data-idtipe="cuti" data-userid="' . $p->userid . '" data-nama="' . $p->nmsurat . '" data-tipe="Cuti Dispensasi"><i class="fa-solid fa-edit"></i></button>
                                <button type="button" class="btn btn-sm btn-danger btn-icon btn-delete" data-id="' . $p->id . '" data-userid="' . $p->userid . '" data-nama="' . $p->nmsurat . '" data-tipe="' . $p->suratjns . '" data-url="perjanjiandelete"><i class="fa-solid fa-trash-can"></i></button>
                            </td>
                            <td class="text-end">' . date('d/m/Y', strtotime($p->legalitastgl)) . '</td>
                            <td>' . $p->nmsurat . '</td>
                            <td>' . $p->suratket . '</td>
                            <td>' . date('d/m/Y', strtotime($p->tglaw))  . '</td>
                            <td>' . date('d/m/Y', strtotime($p->tglak))  . '</td>
                            <td>' . $p->sacuti . '</td>
                        </tr>';
        }
        echo        '</tbody>
                </table>
            </div>
        ';
    }

    public function addModal(Request $request)
    {
        $karyawan = DB::table('penerimaan_karyawan')->where('userid', $request->id)->first();
        $sebelumnya_perjanjian = DB::table('penerimaan_legalitas')->where('userid', $request->id)->where('suratjns', 'perjanjian')->orderBy('legalitastgl', 'desc')->first();
        $divisi = DB::table('daftar_pospekerjaan')->where('type', '=', 'DIVISI')->get();
        $bagian = DB::table('daftar_pospekerjaan')->where('type', '=', 'BAGIAN')->get();
        $jabatan = DB::table('daftar_pospekerjaan')->where('type', '=', 'JABATAN')->get();
        $grup = DB::table('daftar_pospekerjaan')->where('type', '=', 'GRUP')->get();
        $shift = DB::table('daftar_pospekerjaan')->where('type', '=', 'SHIFT')->get();

        $hari = array("SENIN", "SELASA", "RABU", "KAMIS", "JUMAT", "SABTU", "MINGGU");

        $perjanjian = DB::table('daftar_surat')->where('jenissurat', '=', 'Perjanjian')->get();
        $intern = DB::table('daftar_surat')->where('jenissurat', '=', 'Intern')->get();
        $status = DB::table('daftar_surat')->where('jenissurat', '=', 'Status')->get();

        if ($request->idtipe == "basic") {
            $last = DB::table('penerimaan_legalitas')
                ->where('suratjns', 'Basic')
                ->where('userid', $request->id)
                ->orderBy('inputtgl', 'desc')
                ->first();
            if (DB::table('penerimaan_legalitas')->where('suratjns', 'Basic')->where('userid', $request->id)->exists()) {
                echo '<input type="hidden" name="suratjns" value="BASIC" id="suratjns">';
                echo '<input type="hidden" name="userid" value="' . $request->id . '">';
                echo '
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" name="nama" class="form-control cursor-not-allowed" readonly value="' . $karyawan->nama . '" readonly required="true">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                            <label class="form-label">Nama Surat</label>
                            <input type="text" name="nmsurat" class="form-control cursor-not-allowed" readonly value="Surat Deskripsi Pekerjaan" readonly required="true">
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td style="padding-top: 12px;width:130px">Tanggal Input</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglinput" id="datepicker0" class="form-control" value="' . $last->inputtgl . '" required="true"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Tanggal Surat</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglaktif" id="datepicker1" class="form-control" value="' . $last->legalitastgl . '" required="true"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Tanggal Masuk Karyawan</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglmasuk" class="form-control" value="' . $last->tglmasuk . '" required="true"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">STB</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="text" name="stb" id="stb" class="form-control" placeholder="Masukkan STB Karyawan" value="' . $karyawan->stb . '" required="true"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Divisi</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="divisi" id="divisi" class="form-select" required="true">
                                    <option hidden value="' . $karyawan->divisi . '">-- ' . $karyawan->divisi . ' --</option>';
                foreach ($divisi as $d) {
                    echo '
                                    <option value="' . $d->desc . '">' . $d->desc . '</option>';
                }
                echo '
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Bagian</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="bagian" id="" class="form-select" required="true">
                                    <option hidden value="' . $karyawan->bagian . '">-- ' . $karyawan->bagian . ' --</option>';
                foreach ($bagian as $b) {
                    echo '
                                    <option value="' . $b->desc . '">' . $b->desc . '</option>';
                }
                echo '
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Jabatan</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="jabatan" id="" class="form-select" required="true">
                                    <option hidden value="' . $karyawan->jabatan . '">-- ' . $karyawan->jabatan . ' --</option>';
                foreach ($jabatan as $j) {
                    echo '
                                    <option value="' . $j->desc . '">' . $j->desc . '</option>';
                }
                echo '
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Grup</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="grup" id="" class="form-select" required="true">
                                    <option hidden value="' . $karyawan->grup . '">-- ' . $karyawan->grup . ' --</option>';
                foreach ($grup as $g) {
                    echo '
                                    <option value="' . $g->desc . '">' . $g->desc . '</option>';
                }
                echo '
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Jenis Shift</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="shift" id="" class="form-select" required="true">
                                    <option hidden value="' . $karyawan->shift . '">-- ' . $karyawan->shift . ' --</option>';
                foreach ($shift as $s) {
                    echo '
                                    <option value="' . $s->desc . '">' . $s->desc . '</option>';
                }
                echo '
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Profesi</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="text" name="profesi" class="form-control" placeholder="Profesi Karyawan" value="' . $karyawan->profesi . '" required="true"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Hari Libur</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="hrlibur" id="" class="form-select" required="true">
                                    <option hidden value="' . $karyawan->hrlibur . '">-- ' . $karyawan->hrlibur . ' --</option>';
                foreach ($hari as $h => $v) {
                    echo '
                                    <option value="' . $v . '">' . $v . '</option>';
                }
                echo '
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">½ Hari</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="sethari" id="" class="form-select">
                                    <option hidden value="' . $karyawan->sethari . '">-- ' . $karyawan->sethari . ' --</option>';
                foreach ($hari as $h => $v) {
                    echo '
                                    <option value="' . $v . '">' . $v . '</option>';
                }
                echo '
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Keterangan</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="text" name="keterangan" class="form-control" value="' . $karyawan->keterangan . '" placeholder="Masukkan Keterangan tambahan contoh: libur=SENIN,SELASA,KAMIS"></td>
                        </tr>
                    </table>
                </div>';
            } else {
                echo '<input type="hidden" name="suratjns" value="BASIC" id="suratjns">';
                echo '<input type="hidden" name="userid" value="' . $request->id . '">';
                echo '
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" name="nama" class="form-control" value="' . $karyawan->nama . '" readonly required="true">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                            <label class="form-label">Nama Surat</label>
                            <input type="text" name="nmsurat" class="form-control" value="Surat Deskripsi Pekerjaan" readonly required="true">
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td style="padding-top: 12px;width:130px">Tanggal Input</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglinput" id="datepicker0" class="form-control" value="' . date("Y-m-d") . '" required="true"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Tanggal Aktif Surat</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglaktif" id="datepicker1" class="form-control" value="' . date("Y-m-d") . '" required="true"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Tanggal Masuk</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglmasuk" class="form-control" value="' . date("Y-m-d") . '" required="true"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">STB</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="text" name="stb" id="stb" class="form-control" placeholder="Masukkan STB Karyawan" value="' . $karyawan->stb . '" required="true"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Divisi</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="divisi" id="divisi" class="form-select" required="true">
                                    <option hidden value="">-- Pilih Divisi --</option>';
                foreach ($divisi as $d) {
                    echo '
                                    <option value="' . $d->desc . '">' . $d->desc . '</option>';
                }
                echo '
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Bagian</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="bagian" id="" class="form-select" required="true">
                                    <option hidden value="">-- Pilih Bagian --</option>';
                foreach ($bagian as $b) {
                    echo '
                                    <option value="' . $b->desc . '">' . $b->desc . '</option>';
                }
                echo '
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Jabatan</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="jabatan" id="" class="form-select" required="true">
                                    <option hidden value="">-- Pilih Jabatan --</option>';
                foreach ($jabatan as $j) {
                    echo '
                                    <option value="' . $j->desc . '">' . $j->desc . '</option>';
                }
                echo '
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Grup</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="grup" id="" class="form-select" required="true">
                                    <option hidden value="">-- Pilih Grup --</option>';
                foreach ($grup as $g) {
                    echo '
                                    <option value="' . $g->desc . '">' . $g->desc . '</option>';
                }
                echo '
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Jenis Shift</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="shift" id="" class="form-select" required="true">
                                    <option hidden value="">-- Jenis Shift --</option>';
                foreach ($shift as $s) {
                    echo '
                                    <option value="' . $s->desc . '">' . $s->desc . '</option>';
                }
                echo '
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Profesi</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="text" name="profesi" class="form-control" placeholder="Profesi Karyawan" required="true"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Hari Libur</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="hrlibur" id="" class="form-select" required="true">
                                    <option hidden value="">-- Hari Libur --</option>';
                foreach ($hari as $h => $v) {
                    echo '
                                    <option value="' . $v . '">' . $v . '</option>';
                }
                echo '
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">½ Hari</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="sethari" id="" class="form-select">
                                    <option hidden value="">-- ½ Hari --</option>';
                foreach ($hari as $h => $v) {
                    echo '
                                    <option value="' . $v . '">' . $v . '</option>';
                }
                echo '
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Keterangan</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="text" name="keterangan" class="form-control" placeholder="Masukkan Keterangan tambahan contoh: libur=SENIN,SELASA,KAMIS"></td>
                        </tr>
                    </table>
                </div>';
            }
        } elseif ($request->idtipe == "perjanjian") {
            echo '<input type="hidden" name="suratjns" value="PERJANJIAN" id="suratjns">';
            echo '<input type="hidden" name="userid" value="' . $request->id . '">';
            echo '<div class="modal-body">';
            if ($sebelumnya_perjanjian) {
                echo '
                    <table class="table table-sm table-bordered bg-blue-lt text-white text-center">
                        <thead>
                            <tr>
                                <td colspan="4"> Perjanjian Terakhir : ' . $sebelumnya_perjanjian->suratket . '</td>
                            </tr>
                            <tr>
                                <td>Awal</td>
                                <td>Akhir</td>
                                <td>Cuti</td>
                            </tr>
                        </thead>
                        <tr>
                            <td>' . Carbon::parse($sebelumnya_perjanjian->tglaw)->format('d/m/Y') . '</td>
                            <td>' . Carbon::parse($sebelumnya_perjanjian->tglak)->format('d/m/Y') . '</td>
                            <td>' . $sebelumnya_perjanjian->sacuti . '</td>
                        </tr>
                    </table>';
            }
            echo '
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" name="nama" class="form-control cursor-not-allowed" readonly value="' . $karyawan->nama . '" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                            <label class="form-label">Nama Surat</label>
                                <select name="nmsurat" id="nmsurat" class="form-select" onchange="setJenis()">
                                <option hidden value="">-- Pilih Nama Surat --</option>';
            foreach ($perjanjian as $pe) {
                echo            '<option value="' . $pe->nmsurat . '">' . $pe->nmsurat . '</option>';
            }
            echo                '</select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                            <label class="form-label">Jenis Surat</label>
                            <input type="text" name="jnssurat" id="jnssurat" class="form-control" placeholder="Masukkan Jenis Surat">
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td style="padding-top: 12px">Tanggal Awal</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglawal" class="form-control" value="' . (!empty($sebelumnya_perjanjian->tglak) ? date('Y-m-d', strtotime($sebelumnya_perjanjian->tglak . ' +1 day')) : date('Y-m-d')) . '"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Tanggal Akhir</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglakhir" class="form-control" value="' . (!empty($sebelumnya_perjanjian->tglak) ? date('Y-m-d', strtotime($sebelumnya_perjanjian->tglak . ' +1 day')) : date('Y-m-d')) . '"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Cuti</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="number" name="cuti" min="0" class="form-control" placeholder="Cuti"></td>
                        </tr>
                    </table>
                    
                    <script>
                        function setJenis(){
                            var jns = $("#nmsurat").val();
                            console.log(jns);
                            if(jns=="Perjanjian Kerja OL"){
                                $("#jnssurat").val("OL");
                            } else if(jns=="Perjanjian Kerja PHL"){
                                $("#jnssurat").val("PHL");
                            }  else if(jns=="Perjanjian Kontrak"){
                                $("#jnssurat").val("Kontrak Baru");
                            }   else if(jns=="Perjanjian Magang"){
                                $("#jnssurat").val("Magang");
                            }  
                        }
                    </script>
                </div>
            ';
        } elseif ($request->idtipe == "intern") {
            echo '<input type="hidden" name="suratjns" value="INTERN" id="suratjns">';
            echo '<input type="hidden" name="userid" value="' . $request->id . '">';
            echo
            '
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" name="nama" class="form-control" value="' . $karyawan->nama .  '" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                            <label class="form-label">Nama Surat</label>
                                <select name="nmsurat" id="" class="form-select">
                                <option hidden value="">-- Pilih Nama Surat --</option>';
            foreach ($intern as $in) {
                echo            '<option value="' . $in->nmsurat . '">' . $in->nmsurat . '</option>';
            }
            echo                '</select>
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td style="padding-top: 12px;width:130px">Tanggal Internal</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglinternal" class="form-control" value="' . date("Y-m-d") . '"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Keterangan</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="text" name="keterangan" class="form-control" placeholder="Masukkan Keterangan"></td>
                        </tr>
                    </table>
                </div>
            ';
        } elseif ($request->idtipe == "status") {
            echo '<input type="hidden" name="suratjns" value="STATUS" id="suratjns">';
            echo '<input type="hidden" name="userid" value="' . $request->id . '">';
            echo
            '
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" name="nama" class="form-control" value="' . $karyawan->nama . '" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                            <label class="form-label">Nama Surat</label>
                                <select name="nmsurat" id="" class="form-select">
                                <option hidden value="">-- Pilih Nama Surat --</option>';
            foreach ($status as $st) {
                echo            '<option value="' . $st->nmsurat . '">' . $st->nmsurat . '</option>';
            }
            echo                '</select>
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td style="padding-top: 12px;width:130px">Tanggal Status</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglstatus" class="form-control disabled" value="' . date("Y-m-d") . '"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px;width:130px">Keterangan tambahan</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="text" name="keterangan" class="form-control" placeholder="keterangan"></td>
                        </tr>
                    </table>
                </div>
            ';
        } elseif ($request->idtipe == "cuti") {
            echo '<input type="hidden" name="suratjns" value="CUTI" id="suratjns">';
            echo '<input type="hidden" name="nmsurat" value="Cuti Dispensasi" id="nmsurat">';
            echo '<input type="hidden" name="suratket" value="Cuti Dispensasi Diluar Cuti Tahunan" id="suratket">';
            echo '<input type="hidden" name="userid" value="' . $request->id . '">';
            echo
            '
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" name="nama" class="form-control" value="' . $karyawan->nama . '" readonly>
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td style="padding-top: 12px">Tanggal Awal</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglawal" class="form-control" value="' . date("Y-m-d") . '"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Tanggal Akhir</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglakhir" class="form-control" value="' . date("Y-m-d") . '"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Banyak Cuti</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="number" name="cuti" min="0" value="5" class="form-control" placeholder="Cuti"></td>
                        </tr>
                    </table>
                </div>
            ';
        }
    }

    public function editModal(Request $request)
    {
        // $karyawan = DB::table('penerimaan_karyawan')->where('userid', $request->userid)->first();
        $kontrak = DB::table('penerimaan_legalitas')->where('id', $request->id)->first();

        $divisi = DB::table('daftar_pospekerjaan')->where('type', '=', 'DIVISI')->get();
        $bagian = DB::table('daftar_pospekerjaan')->where('type', '=', 'BAGIAN')->get();
        $jabatan = DB::table('daftar_pospekerjaan')->where('type', '=', 'JABATAN')->get();
        $grup = DB::table('daftar_pospekerjaan')->where('type', '=', 'GRUP')->get();
        $shift = DB::table('daftar_pospekerjaan')->where('type', '=', 'SHIFT')->get();

        $hari = array("SENIN", "SELASA", "RABU", "KAMIS", "JUMAT", "SABTU", "MINGGU");

        $perjanjian = DB::table('daftar_surat')->where('jenissurat', '=', 'Perjanjian')->get();
        $intern = DB::table('daftar_surat')->where('jenissurat', '=', 'Intern')->get();
        $status = DB::table('daftar_surat')->where('jenissurat', '=', 'Status')->get();

        if ($request->idtipe == "basic") {
            echo '<input type="hidden" name="suratjns" value="BASIC" id="suratjnsEdit">';
            echo '<input type="hidden" name="idlegalitas" value="' . $request->id . '">';
            echo '<input type="hidden" name="userid" value="' . $kontrak->userid . '">';
            echo '
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" name="nama" class="form-control" value="' . $kontrak->nama . '" readonly required="true">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                            <label class="form-label">Nama Surat</label>
                            <input type="text" name="nmsurat" class="form-control" value="Surat Deskripsi Pekerjaan" readonly required="true">
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td style="padding-top: 12px;width:130px">Tanggal Input</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglinput" id="datepicker0" class="form-control" value="' . $kontrak->inputtgl . '" required="true"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px;font-size:13px">Tanggal Aktif Surat</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglaktif" id="datepicker1" class="form-control" value="' . $kontrak->legalitastgl . '" required="true"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Tanggal Masuk</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglmasuk" class="form-control" value="' . $kontrak->tglmasuk . '" required="true"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">STB</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="text" name="stb" id="stb" class="form-control" placeholder="Masukkan STB Karyawan" value="' . $kontrak->stb . '" required="true"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Divisi</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="divisi" id="divisi" class="form-select" required="true">
                                <option hidden value="' . $kontrak->divisi . '">-- ' . $kontrak->divisi . ' --</option>';
            foreach ($divisi as $d) {
                echo            '<option value="' . $d->desc . '">' . $d->desc . '</option>';
            }
            echo
            '</select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Bagian</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="bagian" id="" class="form-select" required="true">
                                <option hidden value="' . $kontrak->bagian . '">-- ' . $kontrak->bagian . ' --</option>';
            foreach ($bagian as $b) {
                echo            '<option value="' . $b->desc . '">' . $b->desc . '</option>';
            }
            echo
            '</select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Jabatan</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="jabatan" id="" class="form-select" required="true">
                                <option hidden value="' . $kontrak->jabatan . '">-- ' . $kontrak->jabatan . ' --</option>';
            foreach ($jabatan as $j) {
                echo            '<option value="' . $j->desc . '">' . $j->desc . '</option>';
            }
            echo
            '</select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Grup</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="grup" id="" class="form-select" required="true">
                                <option hidden value="' . $kontrak->grup . '">-- ' . $kontrak->grup . ' --</option>';
            foreach ($grup as $g) {
                echo            '<option value="' . $g->desc . '">' . $g->desc . '</option>';
            }
            echo
            '</select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Jenis Shift</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="shift" id="" class="form-select" required="true">
                                <option hidden value="' . $kontrak->shift . '">-- ' . $kontrak->shift . ' --</option>';
            foreach ($shift as $s) {
                echo            '<option value="' . $s->desc . '">' . $s->desc . '</option>';
            }
            echo                '</select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Profesi</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="text" name="profesi" class="form-control" placeholder="Profesi Karyawan" required="true" value="' . $kontrak->profesi . '"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Hari Libur</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="hrlibur" id="" class="form-select" required="true">
                                <option hidden value="' . $kontrak->hrlibur . '">-- ' . $kontrak->hrlibur . ' --</option>';
            foreach ($hari as $h => $v) {
                echo            '<option value="' . $v . '">' . $v . '</option>';
            }
            echo
            '</select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">½ Hari</td>
                            <td style="padding-top: 12px">:</td>
                            <td>
                                <select name="sethari" id="" class="form-select">
                                <option hidden value="' . $kontrak->sethari . '">-- ' . $kontrak->sethari . ' --</option>';
            foreach ($hari as $h => $v) {
                echo            '<option value="' . $v . '">' . $v . '</option>';
            }
            echo                '</select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Keterangan</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="text" name="keterangan" value="' . $kontrak->keterangan . '" class="form-control" placeholder="Masukkan Keterangan tambahan contoh: libur=SENIN,SELASA,KAMIS"></td>
                        </tr>
                    </table>
                </div>
            ';
        } elseif ($request->idtipe == "perjanjian") {

            echo '<input type="hidden" name="suratjns" value="PERJANJIAN" id="suratjns">';
            echo '<input type="hidden" name="idlegalitas" value="' . $request->id . '">';
            echo '<input type="hidden" name="userid" value="' . $request->id . '">';
            echo
            '
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" name="nama" class="form-control" value="' . $kontrak->nama . '" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                            <label class="form-label">Nama Surat</label>
                                <select name="nmsurat" id="nmsurat" class="form-select" onchange="setJenis()">
                                <option hidden value="' . $kontrak->nmsurat . '" selected>-- ' . $kontrak->nmsurat . ' --</option>';
            foreach ($perjanjian as $pe) {
                echo            '<option value="' . $pe->nmsurat . '">' . $pe->nmsurat . '</option>';
            }
            echo                '</select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                            <label class="form-label">Jenis Surat</label>
                            <input type="text" name="jnssurat" id="jnssurat" class="form-control" placeholder="Masukkan Jenis Surat" value="' . $kontrak->suratket . '">
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td style="padding-top: 12px">Tanggal Awal</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglawal" class="form-control" value="' . $kontrak->tglaw . '"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Tanggal Akhir</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglakhir" class="form-control" value="' . $kontrak->tglak . '"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Cuti</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="number" name="cuti" min="0" class="form-control" placeholder="Cuti" value="' . $kontrak->sacuti . '"></td>
                        </tr>
                    </table>
                    
                    <script>
                        function setJenis(){
                            var jns = $("#nmsurat").val();
                            console.log(jns);
                            if(jns=="Perjanjian Kerja OL"){
                                $("#jnssurat").val("OL");
                            } else if(jns=="Perjanjian Kerja PHL"){
                                $("#jnssurat").val("PHL");
                            }  else if(jns=="Perjanjian Kontrak"){
                                $("#jnssurat").val("Kontrak Baru");
                            }   else if(jns=="Perjanjian Magang"){
                                $("#jnssurat").val("Magang");
                            }  
                        }
                    </script>
                </div>
            ';
        } elseif ($request->idtipe == "intern") {
            echo '<input type="hidden" name="suratjns" value="INTERN" id="suratjns">';
            echo '<input type="hidden" name="idlegalitas" value="' . $request->id . '">';
            echo '<input type="hidden" name="userid" value="' . $request->id . '">';
            echo
            '
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" name="nama" class="form-control" value="' . $kontrak->nama .  '" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                            <label class="form-label">Nama Surat</label>
                                <select name="nmsurat" id="" class="form-select">
                                <option hidden value="' . $kontrak->nmsurat .  '">-- ' . $kontrak->nmsurat .  ' --</option>';
            foreach ($intern as $in) {
                echo            '<option value="' . $in->nmsurat . '">' . $in->nmsurat . '</option>';
            }
            echo                '</select>
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td style="padding-top: 12px;width:130px">Tanggal Internal</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglinternal" class="form-control" value="' . $kontrak->legalitastgl . '"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Keterangan</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="text" name="keterangan" class="form-control" placeholder="Masukkan Keterangan" value="' . $kontrak->keterangan . '"></td>
                        </tr>
                    </table>
                </div>
            ';
        } elseif ($request->idtipe == "status") {
            echo '<input type="hidden" name="suratjns" value="STATUS" id="suratjns">';
            echo '<input type="hidden" name="idlegalitas" value="' . $request->id . '">';
            echo '<input type="hidden" name="userid" value="' . $request->id . '">';
            echo
            '
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" name="nama" class="form-control" value="' . $kontrak->nama . '" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                            <label class="form-label">Nama Surat</label>
                                <select name="nmsurat" id="" class="form-select">
                                <option hidden value="' . $kontrak->nmsurat . '">-- ' . $kontrak->nmsurat . ' --</option>';
            foreach ($status as $st) {
                echo            '<option value="' . $st->nmsurat . '">' . $st->nmsurat . '</option>';
            }
            echo                '</select>
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td style="padding-top: 12px;width:130px">Tanggal Status</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglstatus" class="form-control disabled" value="' . $kontrak->legalitastgl . '"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px;width:130px">Keterangan tambahan</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="text" name="keterangan" class="form-control" placeholder="keterangan" value="' . $kontrak->suratket . '"></td>
                        </tr>
                    </table>
                </div>
            ';
        } elseif ($request->idtipe == "cuti") {
            echo '<input type="hidden" name="suratjns" value="CUTI" id="suratjns">';
            echo '<input type="hidden" name="nmsurat" value="Cuti Dispensasi" id="nmsurat">';
            echo '<input type="hidden" name="suratket" value="Cuti Dispensasi Diluar Cuti Tahunan" id="suratket">';
            echo '<input type="hidden" name="idlegalitas" value="' . $request->id . '">';
            echo '<input type="hidden" name="userid" value="' . $request->id . '">';
            echo
            '
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" name="nama" class="form-control" value="' . $kontrak->nama . '" readonly>
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td style="padding-top: 12px">Tanggal Awal</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglawal" class="form-control" value="' . $kontrak->tglaw . '"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Tanggal Akhir</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="date" name="tglakhir" class="form-control" value="' . $kontrak->tglak . '"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 12px">Banyak Cuti</td>
                            <td style="padding-top: 12px">:</td>
                            <td><input type="number" name="cuti" min="0" value="5" class="form-control" placeholder="Cuti" value="' . $kontrak->sacuti . '"></td>
                        </tr>
                    </table>
                </div>
            ';
        }
    }

    public function basicdelete(Request $request)
    {
        DB::table('penerimaan_legalitas')->where('id', $request->id)->delete();

        return response()->json(['success' => 'User Deleted Successfully!']);
    }
    public function perjanjiandelete(Request $request)
    {
        DB::table('penerimaan_legalitas')->where('id', $request->id)->delete();
        $perjanjian = DB::table('penerimaan_legalitas')->where('userid', $request->userid)->where('suratjns', 'like', '%perjanjian%')->orderBy('legalitastgl', 'desc')->first();

        if ($perjanjian) {
            $per = $perjanjian->suratket . " (" . $perjanjian->tglaw . " s.d. " . $perjanjian->tglak . ")";
        } else {
            $per = null;
        }

        $editKaryawan = DB::table('penerimaan_karyawan')
            ->where('userid', $request->userid)
            ->limit(1)
            ->update([
                'perjanjian' => $per,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return response()->json(['success' => 'User Deleted Successfully!']);
    }
    public function internaldelete(Request $request)
    {
        DB::table('penerimaan_legalitas')->where('id', $request->id)->delete();
        $intern = DB::table('penerimaan_legalitas')->where('userid', $request->userid)->where('suratjns', 'like', '%intern%')->orderBy('legalitastgl', 'desc')->first();

        if ($intern) {
            $getDateInternal = $intern->legalitastgl;
            $getInternal = $intern->nmsurat . " - " . $intern->keterangan;
        } else {
            $getDateInternal = null;
            $getInternal = null;
        }
        $editKaryawan = DB::table('penerimaan_karyawan')
            ->where('userid', $request->userid)
            ->limit(1)
            ->update([
                'tglinternal' => $getDateInternal,
                'internal' => $getInternal,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return response()->json(['success' => 'User Deleted Successfully!']);
    }
    public function statusdelete(Request $request)
    {
        DB::table('penerimaan_legalitas')->where('id', $request->id)->delete();
        $status = DB::table('penerimaan_legalitas')->where('userid', $request->userid)->where('suratjns', 'like', '%status%')->orderBy('legalitastgl', 'desc')->first();

        if ($status) {
            if ($status->nmsurat == "Surat Cuti Melahirkan") {
                $getStatus = "(Aktif) " . $status->nmsurat . " - " . $status->legalitastgl;
            } else {
                $getStatus = $status->nmsurat . " - " . $status->legalitastgl;
            }
        } else {
            $getStatus = "Aktif";
        }
        $editKaryawan = DB::table('penerimaan_karyawan')
            ->where('userid', $request->userid)
            ->limit(1)
            ->update([
                'status' => $getStatus,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return response()->json(['success' => 'User Deleted Successfully!']);
    }

    // ======================== END LEGALITAS ===========================================================================================

}
