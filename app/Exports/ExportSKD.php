<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportSKD implements FromQuery, ShouldQueue, WithHeadings
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
            'Surat',
            'Status',
            'Keterangan',
            'Bagian',
            'Grup',
            'Ket. ACC',
        ];
    }

    public function query()
    {
        return DB::table('absensi_komunikasiacc as a')
            ->join('penerimaan_karyawan as k', 'a.userid', '=', 'k.userid')
            ->select('a.tanggal', 'k.stb', 'a.nama', 'a.suratid', 'a.sst', 'a.keterangan', 'k.bagian', 'k.grup', 'a.ket_acc')
            ->where('sst', '=', 'S')
            ->whereBetween('a.tanggal', [$this->dari, $this->sampai])->orderBy('a.tanggal');
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
