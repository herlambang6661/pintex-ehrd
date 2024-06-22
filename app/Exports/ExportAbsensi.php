<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ExportAbsensi implements FromQuery, ShouldQueue
{
    use Exportable;
    protected $dari, $sampai;

    function __construct($dari, $sampai)
    {
        $this->dari = $dari;
        $this->sampai = $sampai;
    }

    public function query()
    {
        return DB::table('absensi_absensi as a')
            ->select('tanggal', 'stb', 'name', 'in', 'out', 'qj', 'jis', 'qjnet', 'sst', 'grup', 'bagian')
            ->whereBetween('a.tanggal', [$this->dari, $this->sampai])->orderBy('name');
        // return $data;
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
