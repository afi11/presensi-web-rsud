<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Presensi;
use App\Models\Pegawai;
use App\Models\WaktuReguler;
use App\Models\WaktuShift;
use App\Models\Divisi;
use DB;
use Carbon\Carbon;

class PresensiController extends Controller
{
    
    public function fetchTime(Request $request)
    {
        $presensiMasuk = cekPresensiMasuk($request->pegawaiCode);
        $presensiPulang = cekPresensiPulang($request->pegawaiCode, $request->activityCode);
        $presensi = Presensi::where('pegawaiCode', $request->pegawaiCode)
            ->select('activityCode')
            ->where('statusPresensiPulang', 0)
            ->orderBy('created_at', 'DESC')->first();
        $getStatus = Pegawai::where('code', $request->pegawaiCode)->first();
        if($getStatus->statusShift == 0){
            $waktuPresensi = WaktuReguler::where('hariKerja', getNameDay())->first();
        }else if($getStatus->statusShift == 1){
            $waktuPresensi = WaktuShift::where('idDivisi', $getStatus->idDivisi)->first();
        }else{
            $waktuPresensi = [];
        }
        return response()->json([
            "code" => 200, 
            "tipePegawai" => $getStatus->statusShift,
            "presensiMasuk" => $presensiMasuk != null ? $presensiMasuk->jamPresensi : null,
            "telatMasuk" => $presensiMasuk != null ? $presensiMasuk->telatMasuk : null,
            "presensiPulang" => $presensiPulang != null ?  $presensiPulang->jamPresensi : null,
            "jarakPresensiPulang" =>  $presensiPulang != null ? getHourFromDateTime($presensiPulang->jarakWaktuPulang) : null,
            "activityCode" => $presensi,
            "data" => $waktuPresensi
        ]);
    }

    public function sendPresensi(Request $request)
    {
        $presensi = new Presensi();
        $tipeWaktu = $request->tipeWaktu;
        $tipePresensi = $request->tipePresensi;
        $waktuPresensiUser = $request->waktuPresensiUser;
        $presensi->jamPresensi = $waktuPresensiUser;
        if($tipePresensi == 'jam-masuk'){
            $presensi->statusPresensiPulang = 0;
            $presensi->tipePresensi = 'jam-masuk';
            $jamTelatMasuk = getHitungTelat($request->waktuKerja, $waktuPresensiUser);
            $presensi->telatMasuk = $jamTelatMasuk;
            if($jamTelatMasuk != "00:00:00"){
                $telatMenit = getDiffTimeByMinute($request->waktuKerja, $waktuPresensiUser);
                $presensi->idRuleTelat = getStatusTelat('jam-masuk', $telatMenit);
            }
            $presensi->activityCode = getKodePresensi();
        }else if($tipePresensi == 'jam-pulang'){
            $presensi->statusPresensiPulang = 1;
            $presensi->tipePresensi = 'jam-pulang';
            $presensi->activityCode = $request->activityCode;
            $presensi->jarakWaktuPulang = getHitungTelat($request->waktuKerja, $waktuPresensiUser);
        }
       
        $presensi->pegawaiCode = $request->pegawaiCode;
        if($tipeWaktu == 'shift'){
            $presensi->idWaktuShift = $request->idWaktu;
        }else{
            $presensi->idWaktuReguler = $request->idWaktu;
        }
        $presensi->jarakPresensi = $request->jarakPresensi;
        $presensi->latitudePresensi = $request->latitudePresensi;
        $presensi->longitudePresensi = $request->longitudePresensi;
        $presensi->tanggalPresensi = Carbon::now()->format('Y-m-d');
        $presensi->save();
        return response()->json(["code" => 200, 
            "message" => "Berhasil melakukan presensi",
        ]);
    }

    public function fetchHistoryPresensi(Request $request)
    {
        $pegawaiCode = $request->pegawaiCode;
        $presensi = Presensi::leftJoin('presensi as presensi2', 'presensi2.activityCode', '=', 'presensi.activityCode')
            ->where('presensi.tipePresensi', 'jam-masuk')
            ->where('presensi2.tipePresensi', 'jam-pulang')
            ->orWhere('presensi.statusPresensiPulang', 0)
            ->select('presensi.jamPresensi as jamMasuk', 'presensi.telatMasuk as telatMasuk',
                'presensi2.jamPresensi as jamPulang')
            ->get();
        return response()->json(["code" => 200, "data" => $presensi]);     
    }

}