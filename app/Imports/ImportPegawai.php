<?php

namespace App\Imports;

use App\Models\Pegawai;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportPegawai implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
           return new Pegawai([
                'code' => $row['code'],
                'nik' => $row['nik'],
                'nama' => $row['nama'],
                'gender' => $row['gender'],
                'alamat' => $row['alamat'],
                'idDivisi' => getIdDivisi($row['divisi']),
                'jabatan' => $row['jabatan'],
                'status' => 'kontrak'
            ]);
            // return Pegawai::where('code', $row['code'])->update([
            //     "jabatan" => $row['jabatan']
            // ]);
            // return new User([
            //     'pegawai_code' => $row['pegawai_code'],
            //     'username' => $row['pegawai_code'],
            //     'password' => bcrypt($row['pegawai_code']),
            //     'password_hint' => 'Sama dengan kode pegawai',
            //     'role' => 'pegawai'
            // ]);
        
    }
}
