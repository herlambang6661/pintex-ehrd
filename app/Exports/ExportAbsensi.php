<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ExportAbsensi implements FromCollection, WithBatchInserts, WithChunkReading
{
    protected $dari, $sampai;

    function __construct($dari, $sampai)
    {
        $this->dari = $dari;
        $this->sampai = $sampai;
    }

    public function collection()
    {
        $data = DB::table('absensi_absensi as a')
            ->whereBetween('a.tanggal', [$this->dari, $this->sampai])->get();
        return $data;
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
