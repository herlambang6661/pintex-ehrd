<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ScheduleKomunikasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'komunikasi:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command ini mengupdate table komunikasi';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        date_default_timezone_set('Asia/Jakarta');
        try {
            $start = new Carbon('first day of last month');
            $end = date('Y-m-d');
            $checkKomunikasi = DB::table('absensi_komunikasiacc')->where('cron', '=', '0')->whereBetween('tanggal', [$start, $end])->orderBy('tanggal', 'desc')->get();
            foreach ($checkKomunikasi as $key) {
                // ============================================================  BASIC  ============================================================
                DB::table('absensi_absensi')
                    ->where('userid', $key->userid)
                    ->where('tanggal', $key->tanggal)
                    ->update(
                        array(
                            'sst' => $key->sst,
                            'updated_at' => date('Y-m-d H:i:s'),
                        )
                    );
                Log::info($key->suratid . " Berhasil di jalankan. a/n " . $key->nama . " ( " . $key->stb . " ). Date: " . date('Y-m-d H:i:s'));
            }
        } catch (\Exception $e) {
            Log::error("Cron job Komunikasi Gagal di jalankan. " . $e);
        }
    }
}
