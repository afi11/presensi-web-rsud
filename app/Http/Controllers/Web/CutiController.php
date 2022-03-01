<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\Pegawai;
use App\Models\Divisi;
use App\Models\PresensiCroscheck;
use Carbon\Carbon;
use DB;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $izins = Presensi::join('rule-izin', 'rule-izin.id', '=', 'presensi.idRuleIzin')
            ->join('pegawai', 'pegawai.code', '=', 'presensi.pegawaiCode')
            ->where('presensi.tanggalMulaiIzin', '<>', null)
            ->where('presensi.tanggalAkhirIzin',  '<>', null)
            ->select('presensi.*', 'rule-izin.namaIzin', 'pegawai.nama')
            ->orderBy('presensi.statusIzin', 'asc')
            ->get();
        return view('pages.cuti.index', compact('izins'));
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
    public function show($activityCode)
    {
        $izin = Presensi::join('rule-izin', 'rule-izin.id', '=', 'presensi.idRuleIzin')
            ->join('pegawai', 'pegawai.code', '=', 'presensi.pegawaiCode')
            ->where('presensi.activityCode', $activityCode)
            ->select('presensi.*', 'rule-izin.namaIzin', 'pegawai.nama', 'pegawai.nik')
            ->orderBy('presensi.statusIzin', 'desc')
            ->first();
        return view('pages.cuti.show', compact('izin'));
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
        DB::transaction(function() use ($request, $id) {
            $presensi = Presensi::find($id);
            $presensi->statusIzin = $request->statusIzin;
            $presensi->save();

            $listTanggalCuti = getDatesFromRange($presensi->tanggalMulaiIzin, $presensi->tanggalAkhirIzin);
            for($i = 0; $i < count($listTanggalCuti); $i++){
                $bulan = Carbon::parse($listTanggalCuti[$i])->format('m');
                $tanggal = Carbon::parse($listTanggalCuti[$i])->format('d');
                $tahun = Carbon::parse($listTanggalCuti[$i])->format('Y');
                $fieldTanggal = "tgl_".$tanggal;
                $cekCrosCheck =  PresensiCroscheck::where('pegawaiCode', $presensi->pegawaiCode)
                    ->where('bulan', $bulan)
                    ->where('tahun', $tahun)
                    ->count();
                if($cekCrosCheck > 0){
                    PresensiCroscheck::where('pegawaiCode', $presensi->pegawaiCode)
                        ->where('bulan', $bulan)
                        ->where('tahun', $tahun)
                        ->update([
                            $fieldTanggal => $presensi->activityCode
                        ]); 
                }else{
                    PresensiCroscheck::create([
                        "pegawaiCode" => $presensi->pegawaiCode,
                        "bulan" => $bulan,
                        "tahun" => $tahun,
                        $fieldTanggal => $presensi->activityCode
                    ]);
                }
            } 
        });
        return redirect('pengajuan_cuti')->with('success', 'Status Cuti / Izin Sudah Diubah');
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
