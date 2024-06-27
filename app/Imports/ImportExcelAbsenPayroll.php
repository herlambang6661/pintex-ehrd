<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;

class ImportExcelAbsenPayroll implements ToCollection, WithBatchInserts, WithChunkReading, WithStartRow
{
    use RemembersChunkOffset;

    public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            // update data yang ada di payroll untuk perhitungan gaji
            DB::table('administrasi_payroll')->where('periode', '=', $row[0])->where('stb', '=', $row[1])  // find your user by their email
                ->update(
                    array(
                        'potongan_absen_input' => $row[3],
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
                );
        }
    }

    // public function uniqueBy()
    // {
    //     return ['PERIODE'];
    // }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function headingRow(): int
    {
        return 2;
    }
}
