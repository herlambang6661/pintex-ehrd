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
    protected $description = 'Command ini akan menjalankan legalitas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        date_default_timezone_set('Asia/Jakarta');
        $checkLegalitas = DB::table('penerimaan_legalitas')->where('legalitastgl', '=', date('Y-m-d'))->get();
        try {
            foreach ($checkLegalitas as $key) {
                // ============================================================  BASIC  ============================================================
                if ($key->suratjns == 'BASIC') {
                    DB::table('penerimaan_karyawan')
                        ->where('userid', $key->userid)
                        ->limit(1)
                        ->update(
                            array(
                                'stb' => $key->stb,
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
                    Log::info($key->suratjns . " Berhasil di jalankan ( " . $key->nmsurat . " ). USERID: " . $key->userid . " (" . $key->nama . "). IDCRON: " . $key->id_cron . ". Date: " . date('Y-m-d H:i:s'));
                }
                // ============================================================  PERJANJIAN  ============================================================
                if ($key->suratjns == 'PERJANJIAN') {
                    if ($key->nmsurat == 'Perjanjian Kerja PHL') {
                        DB::table('penerimaan_karyawan')
                            ->where('userid', $key->userid)
                            ->limit(1)
                            ->update(
                                array(
                                    'tglaktif' => $key->tglaw,
                                    'tglkeluar' => $key->tglak,
                                    'perjanjian' => $key->suratket . " (" . $key->tglaw . " s.d. " . $key->tglak . ")",
                                    'status' => 'PHL',
                                    'updated_at' => date('Y-m-d H:i:s'),
                                )
                            );
                    } elseif ($key->nmsurat == 'Perjanjian Kontrak') {
                        DB::table('penerimaan_karyawan')
                            ->where('userid', $key->userid)
                            ->limit(1)
                            ->update(
                                array(
                                    'tglaktif' => $key->tglaw,
                                    'tglkeluar' => $key->tglak,
                                    'perjanjian' => $key->suratket . " (" . $key->tglaw . " s.d. " . $key->tglak . ")",
                                    'status' => 'aktif',
                                    'updated_at' => date('Y-m-d H:i:s'),
                                )
                            );
                    } else {
                        DB::table('penerimaan_karyawan')
                            ->where('userid', $key->userid)
                            ->limit(1)
                            ->update(
                                array(
                                    'tglaktif' => $key->tglaw,
                                    'tglkeluar' => $key->tglak,
                                    'perjanjian' => $key->suratket . " (" . $key->tglaw . " s.d. " . $key->tglak . ")",
                                    'updated_at' => date('Y-m-d H:i:s'),
                                )
                            );
                    }
                    Log::info($key->suratjns . " Berhasil di jalankan ( " . $key->nmsurat . " ). USERID: " . $key->userid . " (" . $key->nama . "). IDCRON: " . $key->id_cron . ". Date: " . date('Y-m-d H:i:s'));
                }
                // ============================================================  INTERN  ============================================================
                if ($key->suratjns == 'INTERN') {
                    DB::table('penerimaan_karyawan')
                        ->where('userid', $key->userid)
                        ->limit(1)
                        ->update(
                            array(
                                'tglinternal' => $key->legalitastgl,
                                'internal' => $key->nmsurat . " " . $key->keterangan,
                                'updated_at' => date('Y-m-d H:i:s'),
                            )
                        );
                    Log::info($key->suratjns . " Berhasil di jalankan ( " . $key->nmsurat . " ). USERID: " . $key->userid . " (" . $key->nama . "). IDCRON: " . $key->id_cron . ". Date: " . date('Y-m-d H:i:s'));
                }
                // ============================================================  STATUS  ============================================================
                if ($key->suratjns == 'STATUS') {
                    DB::table('penerimaan_karyawan')
                        ->where('userid', $key->userid)
                        ->limit(1)
                        ->update(
                            array(
                                'status' => $key->nmsurat . " - " . $key->legalitastgl,
                                'updated_at' => date('Y-m-d H:i:s'),
                            )
                        );
                    Log::info($key->suratjns . " Berhasil di jalankan ( " . $key->nmsurat . " ). USERID: " . $key->userid . " (" . $key->nama . "). IDCRON: " . $key->id_cron . ". Date: " . date('Y-m-d H:i:s'));
                }
            }
        } catch (\Exception $e) {
            Log::error("Cron job Gagal di jalankan " . $e);
        }
    }
}
