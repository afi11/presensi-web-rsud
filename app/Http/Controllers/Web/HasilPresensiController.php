<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\Divisi;
use App\Models\Pegawai;

class HasilPresensiController extends Controller
{
    
    public function index()
    {
        $listRuangan = Divisi::join('pegawai', 'pegawai.idDivisi', '=', 'divisi.id')
            ->select('divisi.id', 'divisi.namaDivisi as namaDivisi')
            ->distinct()
            ->orderBy('namaDivisi', 'asc')
            ->get();
        return view('pages.hasil_presensi.index', compact('listRuangan'));
    }

    public function show($idDivisi)
    {
        $divisi = Divisi::find($idDivisi);
        $pegawai = Pegawai::where('idDivisi', $idDivisi)->get();
        return view('pages.hasil_presensi.show', compact('pegawai', 'divisi'));
    }

    public function viewRecordPresensi($kodePegawai)
    {
        $pegawai = Pegawai::where('code', $kodePegawai)->first();
        return view('pages.hasil_presensi.record', compact('pegawai'));
    }

    public function fetchRecordPresensi($kodePegawai)
    {
        $presensi = Presensi::leftJoin('rule_telat as telat1', 'telat1.id', '=', 'presensi.idRuleTelatMasuk')
            ->where('pegawaiCode', $kodePegawai)
            ->where('presensi.jamMasuk', '<>', null)
            ->orWhere('presensi.jamPulang', '<>', null)
            ->orderBy('presensi.tanggalPresensi', 'desc')
            ->select('presensi.*', 'telat1.namaRuleTelat as statusTelatMasuk')
            ->get();
        return response()->json(["code" => 200, "data" => $presensi]);
    }

}
