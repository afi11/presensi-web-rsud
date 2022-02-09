<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use App\Models\Ruangan;
use App\Models\Pegawai;

class JadwalExport implements FromView, ShouldAutoSize, WithTitle
{
    private $pegawaiId;
    private $pegawaiName;
    private $ruanganId;
    private $bulan;
    private $tahun;

    public function __construct($pegawaiId, $pegawaiName, $ruanganId, $bulan, $tahun)
    {
        $this->pegawaiId = $pegawaiId;
        $this->pegawaiName = $pegawaiName;
        $this->ruanganId = $ruanganId; 
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }
    
    public function view(): View
    {
        return view('pages.jadwal.export_format_jadwal', [
            'pegawai' => Pegawai::where('code', $this->pegawaiId)->first(),
            'ruangan' => Ruangan::find($this->ruanganId),
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
        ]);
    }

    public function title(): string
    {
        return $this->pegawaiName;
    }

}
