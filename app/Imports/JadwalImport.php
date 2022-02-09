<?php

namespace App\Imports;

use App\Models\Jadwal;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JadwalImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        return new Jadwal([
            "ruangan_jadwal_id" => $row["ruangan_code"],
            "pegawai_code" => $row["pegawai_code"],
            "shift_jadwal_id" => $row["shift"],
            "tanggal" => $row["tahun"]."-".$row["bulan"]."-".$row["tanggal"]
        ]);
    }

}