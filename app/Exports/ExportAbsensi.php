<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomChunkSize;

class ExportAbsensi implements FromQuery, ShouldQueue, WithHeadings, WithCustomChunkSize
{
    use Exportable;
    protected $dari, $sampai;

    function __construct($dari, $sampai)
    {
        $this->dari = $dari;
        $this->sampai = $sampai;
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'STB',
            'Nama',
            'Finger In',
            'Finger Out',
            'QJ',
            'JIS',
            'QJNET',
            'Status',
            'Grup',
            'Bagian',
        ];
    }

    public function query()
    {
        return DB::table('absensi_absensi as a')
            ->join('penerimaan_karyawan as k', 'a.userid', '=', 'k.userid')
            ->select('a.tanggal', 'a.stb', 'a.name', 'a.in', 'a.out', 'a.qj', 'a.jis', 'a.qjnet', 'a.sst', 'a.grup', 'a.bagian')
            ->where('k.status', 'LIKE', '%aktif%')
            ->whereBetween('a.tanggal', [$this->dari, $this->sampai])
            ->orderBy('a.tanggal');
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
