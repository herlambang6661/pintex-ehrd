<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ScheduleKaryawanUmum extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'karyawanumum:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command ini mengupdate table absensi karyawan umum';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        date_default_timezone_set('Asia/Jakarta');
        $start = new Carbon('first day of last month');
        $end = date('Y-m-d');
        $checkUmum = DB::table('absensi_absensi')->where('bagian', '=', 'UMUM')->whereBetween('tanggal', [$start, $end])->orderBy('tanggal', 'desc')->get();
        foreach ($checkUmum as $key) {
            DB::table('absensi_absensi')
                ->where('id', $key->id)
                ->where('bagian', '=', 'UMUM')
                ->update(
                    array(
                        'sst' => "H",
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );
        }
    }
}
