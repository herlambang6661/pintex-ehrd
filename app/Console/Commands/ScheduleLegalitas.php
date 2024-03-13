<?php

namespace App\Console\Commands;

use Throwable;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ScheduleLegalitas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'legalitas:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        date_default_timezone_set('Asia/Jakarta');
        $checkLegalitas = DB::table('penerimaan_legalitas')->where('legalitastgl', '=', date('Y-m-d'))->get();
        try {
            foreach ($checkLegalitas as $key) {
                if ($key->suratjns == 'BASIC') {
                    DB::table('penerimaan_karyawan')
                        ->where('userid', $key->userid)
                        ->limit(1)
                        ->update(
                            array(
                                'stb' => $key->stb,
                                'tglmasuk' => $key->tglmasuk,
                                'tglaktif' => $key->tglaw,
                                'tglkeluar' => $key->tglak,
                                'divisi' => $key->divisi,
                                'bagian' => $key->bagian,
                                'jabatan' => $key->jabatan,
                                'grup' => $key->grup,
                                'profesi' => $key->profesi,
                                'shift' => $key->shift,
                                'hrlibur' => $key->hrlibur,
                                'sethari' => $key->sethari,
                                'keterangan' => $key->keterangan,
                                'updated_at' => date('Y-m-d H:i:s'),
                            )
                        );
                    Log::info("Cron job Berhasil di jalankan " . date('Y-m-d H:i:s'));
                }
            }
        } catch (\Exception $e) {
            Log::error("Cron job Gagal di jalankan " . $e);
        }
    }
}
