<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use App\Models\Presensi;
use App\Models\Divisi;
use App\Models\PresensiCroscheck;

class HasilPresensi implements FromView, ShouldAutoSize, WithTitle
{

    private $ruangan;
    private $bulan;
    private $tahun;

    public function __construct($ruangan, $bulan, $tahun)
    {
        $this->ruangan = $ruangan; 
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function view(): View
    {
        $logPresensi = PresensiCroscheck::where('presensi_croscheck.bulan', $this->bulan)
            ->where('presensi_croscheck.tahun', $this->tahun)
            ->where('presensi_croscheck.idDivisi', $this->ruangan)
            ->get();

        return view('pages.sinkronisasi_presensi.export-excel', [
            'logPresensi' => $logPresensi,
            'ruangan' => Divisi::find($this->ruangan),
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
        ]);
    }

    public function title(): string
    {
        return "Hasil Presensi";
    }
}
