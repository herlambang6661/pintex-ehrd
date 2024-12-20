<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ScheduleUpdateDataCuti extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'datacuti:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command ini mengupdate Data Cuti Karyawan';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        date_default_timezone_set('Asia/Jakarta');

        $karyawan = DB::table('penerimaan_karyawan')->where('status', 'like', '%Aktif%')->get();
        for ($i = 0; $i < $karyawan->count(); $i++) {
            if ($karyawan[$i]->custom_cuti > 0) {
                $dataLegalitas = DB::table('penerimaan_legalitas')
                    ->where('userid', $karyawan[$i]->userid)
                    ->where('sacuti', '>', 0)
                    ->where('suratjns', 'like', '%cuti%')
                    ->where('tglaw', '<', date('Y-m-d'))
                    ->where('tglak', '>', date('Y-m-d'))
                    ->orderBy('legalitastgl', 'desc')
                    ->first();
                $update = DB::table('penerimaan_karyawan')
                    ->where('userid', $karyawan[$i]->userid)
                    ->update(
                        array(
                            'cutiaktif' => empty($dataLegalitas->sacuti) ? 0 : $dataLegalitas->sacuti,
                            'tgl_awalcuti' => empty($dataLegalitas->tglaw) ? null : $dataLegalitas->tglaw,
                            'tgl_akhircuti' => empty($dataLegalitas->tglak) ? null : $dataLegalitas->tglak,
                        )
                    );
            } else {
                $dataLegalitas = DB::table('penerimaan_legalitas')
                    ->where('userid', $karyawan[$i]->userid)
                    ->where('sacuti', '>', 0)
                    ->where('suratjns', 'like', '%perjanjian%')
                    ->where('tglaw', '<', date('Y-m-d'))
                    ->where('tglak', '>', date('Y-m-d'))
                    ->orderBy('legalitastgl', 'desc')
                    ->first();
                $update = DB::table('penerimaan_karyawan')
                    ->where('userid', $karyawan[$i]->userid)
                    ->update(
                        array(
                            'cutiaktif' => empty($dataLegalitas->sacuti) ? 0 : $dataLegalitas->sacuti,
                            'tgl_awalcuti' => empty($dataLegalitas->tglaw) ? null : $dataLegalitas->tglaw,
                            'tgl_akhircuti' => empty($dataLegalitas->tglak) ? null : $dataLegalitas->tglak,
                        )
                    );
            }
        }
    }
}
