<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PresensiCroscheck;
use App\Models\Presensi;
use App\Models\Pegawai;
use App\Models\WaktuReguler;
use App\Models\WaktuKerjaShift;
use App\Models\DetailWaktuKerjaShift;
use App\Models\Divisi;
use DB;
use Carbon\Carbon;

class PresensiController extends Controller
{
    
    public function fetchTime(Request $request)
    {
        $getStatus = Pegawai::where('code', $request->pegawaiCode)->first();
        $presensiMasuk = cekPresensiMasuk($request->pegawaiCode);
        // Set untuk presensi jam masuk / jam pulang
        $ambilWaktu = "";
        $tipePresensi = "";
        $isAblePresensi = true;
        if($presensiMasuk != null){
            if($presensiMasuk->statusPresensi == 0){
                $tipePresensi = 'jam-pulang';
            }else{
                $tipePresensi = 'jam-masuk';
            }
            if($getStatus->statusShift == 0){
                $waktu = WaktuReguler::find($presensiMasuk->idWaktuReguler);
                $ambilWaktu = $presensiMasuk->tanggalPresensi." ".$waktu->jam_akhir_pulang;
                $selisih = getDiffTimeByHour($ambilWaktu, Carbon::now());
                if($selisih > 3){
                    $tipePresensi = 'jam-masuk';
                }else{
                    $tipePresensi = 'jam-pulang';
                }
            }else{
                $waktu = DetailWaktuKerjaShift::find($presensiMasuk->idWaktuShift);
                if($waktu != null){
                    $ambilWaktu = $presensiMasuk->tanggalPresensi." ".$waktu->jam_akhir_pulang;
                }
            }
        }else{
            $tipePresensi = 'jam-masuk';
        }

        $presensiPulang = cekPresensiPulang($request->pegawaiCode, $request->activityCode);
        $presensi = Presensi::where('pegawaiCode', $request->pegawaiCode)
            ->select('activityCode', 'idWaktuShift', 'tanggalPresensi', 'statusPresensi')
            ->where('idRuleIzin', null)
            //->where('statusPresensi', 0)
            ->orderBy('created_at', 'DESC')->first();
       
        if($getStatus->statusShift == 0){
            $waktuPresensi = WaktuReguler::where('hariKerja', getNameDay())->first();
            if($tipePresensi == 'jam-masuk'){
                if(getDiffTimeBySecond(Carbon::now(), $waktuPresensi->jam_mulai_masuk) > 0){
                    $isAblePresensi = false;
                }
            }else{
                if(getDiffTimeByMinute(Carbon::now(), $waktuPresensi->jam_awal_pulang) > 90){
                    $isAblePresensi = false;
                }
            }
        }else if($getStatus->statusShift == 1){
            if($tipePresensi == 'jam-pulang'){
                $waktuPresensi = DetailWaktuKerjaShift::where('id',  $presensi->idWaktuShift)
                    ->where('is_active', 1)
                    ->select('id', 
                        'shift',
                        'jam_mulai_masuk', 
                        'jam_akhir_masuk',
                        'jam_awal_pulang',
                        'jam_akhir_pulang')
                    ->get();
                $waktuPresensiShift = DetailWaktuKerjaShift::where('id',  $presensi->idWaktuShift)
                    ->where('is_active', 1)
                    ->select('id', 
                        'shift',
                        'jam_mulai_masuk', 
                        'jam_akhir_masuk',
                        'jam_awal_pulang',
                        'jam_akhir_pulang')
                    ->first();
                if(getDiffTimeByMinute(Carbon::now(), $waktuPresensiShift->jam_awal_pulang) > 90){
                    $isAblePresensi = false;
                }
            }else{
                $waktu = WaktuKerjaShift::join('detail_waktu_kerja_shift', 'detail_waktu_kerja_shift.kodeJamKerja', '=', 'waktu_kerja_shift.kodeJamKerja')
                    ->where('waktu_kerja_shift.id', $getStatus->idJamKerjaShift)
                    ->where('detail_waktu_kerja_shift.is_active', 1)
                    ->select('detail_waktu_kerja_shift.id', 
                        'detail_waktu_kerja_shift.shift',
                        'detail_waktu_kerja_shift.jam_mulai_masuk', 
                        'detail_waktu_kerja_shift.jam_akhir_masuk',
                        'detail_waktu_kerja_shift.jam_awal_pulang',
                        'detail_waktu_kerja_shift.jam_akhir_pulang')
                    ->get();

                $waktuPresensi = array();
                array_push($waktuPresensi, [
                    'id' => null,
                    'shift' => 'Pilih --',
                    'jam_mulai_masuk' => '--:--:--',
                    'jam_akhir_masuk' => '--:--:--',
                    'jam_awal_pulang' => '--:--:--',
                    'jam_akhir_pulang' => '--:--:--'
                ]);
                foreach($waktu as $row){
                    array_push($waktuPresensi, [
                        'id' => $row->id,
                        'shift' => $row->shift,
                        'jam_mulai_masuk' => $row->jam_mulai_masuk,
                        'jam_akhir_masuk' => $row->jam_akhir_masuk,
                        'jam_awal_pulang' => $row->jam_awal_pulang,
                        'jam_akhir_pulang' => $row->jam_akhir_pulang
                    ]);
                }
            }
        }else{
            $waktuPresensi = [];
        }
        if(cekIzin($request->pegawaiCode)){
            $isAblePresensi = false;
        }
        // if(cekLibur($request->pegawaiCode)){
        //     $isAblePresensi = false;
        // }
        return response()->json([
            "code" => 200, 
            "isAblePresensi" => $isAblePresensi,
            "tipePresensi" => $tipePresensi,
            "tipePegawai" => $getStatus->statusShift,
            "presensiMasuk" => $presensiMasuk != null ? $presensiMasuk->jamMasuk : null,
            "telatMasuk" => $presensiMasuk != null ? $presensiMasuk->telatMasuk : null,
            "presensiPulang" => $presensiPulang != null ?  $presensiPulang->jamPulang : null,
            "jarakPresensiPulang" =>  $presensiPulang != null ? getHourFromDateTime($presensiPulang->lewatPulang) : null,
            "activityCode" => $tipePresensi == "jam-masuk" ? null : $presensi,
            "data" => $waktuPresensi,
        ]);
    }

    public function sendPresensi(Request $request)
    {
        DB::transaction(function() use ($request) {
            $tipePresensi = $request->tipePresensi;
            if($tipePresensi == 'jam-masuk'){
                $presensi = new Presensi();
                $statusJamPresensi = 0;
            }else{
                $getIdPresensi = Presensi::where('activityCode', $request->activityCode)->first();
                $presensi = Presensi::find($getIdPresensi->id);
                $statusJamPresensi = 1;
            }
            $tipeWaktu = $request->tipeWaktu;
            $waktuPresensiUser = $request->waktuPresensiUser;
            $kodePresensi = "";
            if($tipePresensi == 'jam-masuk'){
                $kodePresensi = getKodePresensi();
                $presensi->jamMasuk = $request->waktuPresensiUser;
                $presensi->statusPresensi = 0;
                $jamTelatMasuk = getHitungTelat($request->waktuKerja, $waktuPresensiUser);
                $presensi->telatMasuk = $jamTelatMasuk;
                if($jamTelatMasuk != "00:00:00"){
                    $telatMenit = getDiffTimeByMinute($request->waktuKerja, $waktuPresensiUser);
                    $presensi->idRuleTelatMasuk = cekTelatMasukPulang('jam-masuk', $telatMenit);
                }
                $presensi->jarakJamMasuk = $request->jarakPresensi;
                $presensi->latJamMasuk = $request->latitudePresensi;
                $presensi->longJamMasuk  = $request->longitudePresensi;
                $presensi->activityCode =  $kodePresensi;
                $presensi->tanggalPresensi = Carbon::now()->format('Y-m-d');
            }else if($tipePresensi == 'jam-pulang'){
                $kodePresensi = $request->activityCode;
                $presensi->jamPulang = $request->waktuPresensiUser;
                $jamLewatPulang = getHitungTelat($request->waktuKerja, $waktuPresensiUser);
                $presensi->statusPresensi = 1;
                $presensi->activityCode = $request->activityCode;
                $presensi->lewatPulang = $jamLewatPulang;
                $presensi->jarakJamPulang = $request->jarakPresensi;
                $presensi->latJamPulang = $request->latitudePresensi;
                $presensi->longJamPulang  = $request->longitudePresensi;
                if($jamLewatPulang != "00:00:00"){
                    $telatMenit = getDiffTimeByMinute($request->waktuKerja, $waktuPresensiUser);
                    if($telatMenit < 0){
                        $telatMenit = abs($telatMenit);
                        $presensi->idRuleLewatPulang = cekTelatMasukPulang('jam-pulang', $telatMenit);
                    }else if($telatMenit >= 91){
                        $presensi->idRuleLewatPulang = cekPalingTelatPulang();
                    }
                }
            }
        
            $presensi->pegawaiCode = $request->pegawaiCode;
            if($tipeWaktu == 'shift'){
                $presensi->idWaktuShift = $request->idWaktu;
                $presensi->tipeWaktu = $request->waktuShift;
            }else{
                $presensi->idWaktuReguler = $request->idWaktu;
            }
           
            if($statusJamPresensi == 0){
                $tanggal = Carbon::now()->format('d');
                $bulan = Carbon::now()->format('m');
                $tahun = Carbon::now()->format('Y');
            }else{
                $tanggal = Carbon::parse($presensi->tanggalPresensi)->format('d');
                $bulan = Carbon::parse($presensi->tanggalPresensi)->format('m');
                $tahun = Carbon::parse($presensi->tanggalPresensi)->format('Y');
            }
            $fieldTanggal = "tgl_".$tanggal;

            $presensi->save(); // Simpan presensi masuk atau pulang

            $cekInsertJadwal = PresensiCroscheck::where('pegawaiCode', $request->pegawaiCode)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun)
                ->count();
            if($cekInsertJadwal > 0){
                PresensiCroscheck::where('pegawaiCode', $request->pegawaiCode)
                    ->where('bulan', $bulan)
                    ->where('tahun', $tahun)
                    ->update([
                        $fieldTanggal => $kodePresensi
                    ]);
            }else{
                PresensiCroscheck::create([
                    "pegawaiCode" => $request->pegawaiCode,
                    "idDivisi" => getRuanganId($request->pegawaiCode),
                    "bulan" => $bulan,
                    "tahun" => $tahun,
                    $fieldTanggal => $kodePresensi
                ]);
            }
        });
        return response()->json(["code" => 200, 
            "message" => "Berhasil melakukan presensi"
        ]);
    }

    public function fetchAllHistoryPresensi(Request $request)
    {
        if($request->tglAwal != "" && $request->tglAkhir != ""){
            $presensi = Presensi::leftJoin('rule_telat_v2 as telat1', 'telat1.id', '=', 'presensi.idRuleTelatMasuk')
                ->leftJoin('rule_telat_v2 as telat2', 'telat2.id', '=', 'presensi.idRuleLewatPulang')
                ->where('presensi.pegawaiCode', $pegawaiCode)
                ->whereYear('presensi.created_at', Carbon::now()->format('Y'))
                ->whereBetween('presensi.tanggalPresensi', [
                    $request->tglAwal,  $request->tglAkhir
                ])
                ->orderBy('presensi.created_at', 'desc')
                ->select('presensi.tanggalPresensi', 'presensi.idRuleTelatMasuk', 'presensi.idRuleLewatPulang',
                    'presensi.jamMasuk', 'presensi.jamPulang', 'telat1.nameTelat as telatMasuk', 'telat2.nameTelat as telatPulang'
                )
                ->get();
        }else{
            $presensi = Presensi::leftJoin('rule_telat_v2 as telat1', 'telat1.id', '=', 'presensi.idRuleTelatMasuk')
                ->leftJoin('rule_telat_v2 as telat2', 'telat2.id', '=', 'presensi.idRuleLewatPulang')
                ->where('presensi.pegawaiCode', $pegawaiCode)
                ->whereYear('presensi.created_at', Carbon::now()->format('Y'))
                ->where('presensi.tanggalPresensi', '<>', null)
                ->orderBy('presensi.created_at', 'desc')
                ->select('presensi.tanggalPresensi', 'presensi.idRuleTelatMasuk', 'presensi.idRuleLewatPulang',
                    'presensi.jamMasuk', 'presensi.jamPulang', 'telat1.nameTelat as telatMasuk', 'telat2.nameTelat as telatPulang'
                )
                ->get();
        }
        return response()->json(["code" => 200, "data" => $presensi]);
    }

    public function fetchHistoryPresensi(Request $request)
    {
        $pegawaiCode = $request->pegawaiCode;
        $filter = $request->filter;
        if($filter == 'minggu'){
            $countTelat = Presensi::where('pegawaiCode', $pegawaiCode)
                ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->where('idRuleTelatMasuk', '<>', null)
                ->orWhere('idRuleLewatPulang', '<>', null)
                ->where('tanggalPresensi', '<>', null)
                ->count();
            $countTepat = Presensi::where('pegawaiCode', $pegawaiCode)
                ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->where('tanggalPresensi', '<>', null)
                ->where('idRuleTelatMasuk', null)
                ->where('idRuleLewatPulang', null)
                ->count();
            $presensi = Presensi::leftJoin('rule_telat_v2 as telat1', 'telat1.id', '=', 'presensi.idRuleTelatMasuk')
                ->leftJoin('rule_telat_v2 as telat2', 'telat2.id', '=', 'presensi.idRuleLewatPulang')
                ->where('presensi.pegawaiCode', $pegawaiCode)
                ->whereBetween('presensi.created_at', [
                    Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()
                ])
                ->where('presensi.tanggalPresensi', '<>', null)
                ->orderBy('presensi.created_at', 'desc')
                ->select('presensi.tanggalPresensi', 'presensi.idRuleTelatMasuk', 'presensi.idRuleLewatPulang',
                    'presensi.jamMasuk', 'presensi.jamPulang', 'telat1.nameTelat as telatMasuk', 'telat2.nameTelat as telatPulang'
                )
                ->get();
        }else if($filter == 'bulan'){
            $countTelat = Presensi::where('pegawaiCode', $pegawaiCode)
                ->whereMonth('created_at', Carbon::now()->format('m'))
                ->where('idRuleTelatMasuk', '<>', null)
                ->orWhere('idRuleLewatPulang', '<>', null)
                ->where('tanggalPresensi', '<>', null)
                ->count();
            $countTepat = Presensi::where('pegawaiCode', $pegawaiCode)
                ->whereMonth('created_at', Carbon::now()->format('m'))
                ->where('idRuleTelatMasuk', null)
                ->where('idRuleLewatPulang', null)
                ->where('tanggalPresensi', '<>', null)
                ->count();
            $presensi = Presensi::leftJoin('rule_telat_v2 as telat1', 'telat1.id', '=', 'presensi.idRuleTelatMasuk')
                ->leftJoin('rule_telat_v2 as telat2', 'telat2.id', '=', 'presensi.idRuleLewatPulang')
                ->where('presensi.pegawaiCode', $pegawaiCode)
                ->whereMonth('presensi.created_at', Carbon::now()->format('m'))
                ->where('presensi.tanggalPresensi', '<>', null)
                ->orderBy('presensi.created_at', 'desc')
                ->select('presensi.tanggalPresensi', 'presensi.idRuleTelatMasuk', 'presensi.idRuleLewatPulang',
                    'presensi.jamMasuk', 'presensi.jamPulang', 'telat1.nameTelat as telatMasuk', 'telat2.nameTelat as telatPulang'
                )
                ->get();
        }
        return response()->json(["code" => 200, "tepatWaktu" => $countTepat, "telatWaktu" => $countTelat, "data" => $presensi]);     
    }

}