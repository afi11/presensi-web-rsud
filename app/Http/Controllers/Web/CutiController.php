<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\Pegawai;
use App\Models\Divisi;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $listRuangan = Divisi::join('pegawai', 'pegawai.idDivisi', '=', 'divisi.id')
            ->select('divisi.id', 'divisi.namaDivisi as namaDivisi')
            ->distinct()
            ->orderBy('namaDivisi', 'asc')
            ->get();
        return view('pages.cuti.index', compact('listRuangan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idDivisi)
    {
        $divisi = Divisi::find($idDivisi);
        $pegawai = Pegawai::where('idDivisi', $idDivisi)->get();
        return view('pages.cuti.show', compact('pegawai', 'divisi'));
    }

    public function showCuti($code)
    {
        $pegawai = Pegawai::where('code', $code)->first();
        $izins = Presensi::join('rule-izin', 'rule-izin.id', '=', 'presensi.idRuleIzin')
            ->where('presensi.pegawaiCode', $code)
            ->where('presensi.tanggalMulaiIzin', '<>', null)
            ->where('presensi.tanggalAkhirIzin',  '<>', null)
            ->select('presensi.*', 'rule-izin.namaIzin')
            ->orderBy('presensi.created_at', 'desc')
            ->get();
        return view('pages.cuti.show_cuti', compact('izins', 'pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
