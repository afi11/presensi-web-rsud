<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\JadwalSheetImport;
use App\Exports\JadwalExport;
use App\Exports\JadwalSheetExport;
use App\Models\Jadwal;
use App\Models\Ruangan;
use App\Models\Pegawai;
use Carbon\Carbon;

class JadwalController extends Controller
{
    
    public function index()
    {
        $ruangan = Ruangan::all();
        return view('pages.jadwal.index', compact('ruangan'));
    }

    public function create($ruanganId)
    {
        $ruangan = Ruangan::find($ruanganId);
        return view('pages.jadwal.import_export_jadwal', compact('ruangan'));
    }

    public function fetchJadwal($ruanganId)
    {
        $jadwal = Jadwal::join('pegawai', 'pegawai.code','=', 'jadwal.pegawai_code')
            ->join('tipe_shift', 'tipe_shift.kode_shift', '=', 'jadwal.shift_jadwal_id')
            ->where('jadwal.ruangan_jadwal_id', $ruanganId)
            ->get();
        return response()->json(["data" => $jadwal]);
    }

    public function import(Request $request)
    {
        $import = Excel::import(new JadwalSheetImport("2"), $request->file('jadwalImport'));
        return redirect('jadwal')->with('success','Berhasil Mengimport data jadwal presensi');
    }

    public function export(Request $request)
    {
        $idRuangan = $request->id_ruangan;
        $month = substr($request->month,5);
        $year = Carbon::now()->year;
        return Excel::download(new JadwalSheetExport($idRuangan, $month, $year), 'jadwalexports_2_2022.xlsx');
    }

}
