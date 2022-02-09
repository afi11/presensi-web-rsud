<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\JadwalImport;

class JadwalSheetImport implements WithMultipleSheets 
{
    private $ruanganId;

    public function __construct($ruanganId)
    {
        $this->ruanganId = $ruanganId; 
    }
   
    public function sheets(): array
    {
        $jumlah = getJumlahPegawai($this->ruanganId);
        $array = array();
        for($i = 0; $i < $jumlah; $i++){
            $array[] = new JadwalImport();
        }
        return $array;
    }
}