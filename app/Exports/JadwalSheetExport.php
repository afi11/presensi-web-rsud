<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Models\Pegawai;
use App\Exports\JadwalExport;

class JadwalSheetExport implements WithMultipleSheets
{
    use Exportable;
    
    private $ruanganId;
    private $bulan;
    private $tahun;

    public function __construct($ruanganId, $bulan, $tahun)
    {
        $this->ruanganId = $ruanganId; 
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function sheets(): array
    {
        $pegawai = Pegawai::where('ruangan_id', $this->ruanganId)->get();
        $sheets = [];
        foreach($pegawai as $row){
            $sheets[] = new JadwalExport($row->code, $row->nama_pegawai, $this->ruanganId, $this->bulan, $this->tahun);
        }

        return $sheets;
    }
}
