<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportExcelPayroll implements ToCollection, WithBatchInserts, WithChunkReading, WithStartRow
{
    use RemembersChunkOffset;

    public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // belum jadi !

            $cekPayroll = DB::table('administrasi_payrolldtl')
                ->where('periode', '=', $row[0])
                ->where('stb', '=', $row[1])
                ->first();
            if ($cekPayroll) {
                // Data Ditemukan, update data yang ada
                DB::table('administrasi_payrolldtl')->where('periode', '=', $row[0])->where('stb', '=', $row[1])  // find your user by their email
                    ->update(
                        array(
                            'koperasi' => $row[3],
                            'pinjaman' => $row[4],
                            'updated_at' => date('Y-m-d H:i:s'),
                        )
                    );
                // update data yang ada di payroll untuk perhitungan gaji
                DB::table('administrasi_payroll')->where('periode', '=', $row[0])->where('stb', '=', $row[1])  // find your user by their email
                    ->update(
                        array(
                            'potongan_koperasi' => $row[3],
                            'potongan_pinjaman' => $row[4],
                            'updated_at' => date('Y-m-d H:i:s'),
                        )
                    );
            } else {
                // Data Tidak Ditemukan, Buat data baru
                DB::table('administrasi_payrolldtl')
                    ->insert(
                        [
                            'periode' => $row[0],
                            'stb' => $row[1],
                            'nama' => $row[2],
                            'koperasi' => $row[3],
                            'pinjaman' => $row[4],
                            'dibuat' => Auth::user()->name,
                            'created_at' => date('Y-m-d H:i:s'),
                        ]
                    );

                // update data yang ada di payroll untuk perhitungan gaji
                DB::table('administrasi_payroll')->where('periode', '=', $row[0])->where('stb', '=', $row[1])  // find your user by their email
                    ->update(
                        array(
                            'potongan_koperasi' => $row[3],
                            'potongan_pinjaman' => $row[4],
                            'updated_at' => date('Y-m-d H:i:s'),
                        )
                    );
            }
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
