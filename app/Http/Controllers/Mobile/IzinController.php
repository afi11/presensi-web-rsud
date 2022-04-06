<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\PresensiCroscheck;
use App\Models\RuleIzin;
use Carbon\Carbon;
use DB;

class IzinController extends Controller
{

    public function showIzin($izin)
    {
        $fileIzin = $izin;
        return view('pages.file_izin.index', compact('fileIzin'));
    }

    public function fetchRuleIzin(Request $request)
    {
        $ijin = array();
        array_push($ijin, [
            'id' => 0,
            'namaIzin' => 'Pilih --'
        ]);
        $ruleIzin = RuleIzin::all();
        $presensi = Presensi::where('pegawaiCode', $request->pegawaiCode)
            ->select('activityCode')
            ->where('statusIzin', null)
            ->orderBy('created_at', 'DESC')->first();
        if($presensi != null){
            $activityCode = $presensi->activityCode;
        }else{
            $activityCode = null;
        }
        foreach($ruleIzin as $row){
            array_push($ijin, [
                'id' => $row->id,
                'namaIzin' => $row->namaIzin
            ]);
        }
        return response()->json(["code" => 200, "data" => $ijin, "activityCode" => $activityCode]);
    }

    public function fetchRuleIzin2(Request $request)
    {
        $ijin = array();
        array_push($ijin, [
            'id' => 0,
            'namaIzin' => 'Pilih --'
        ]);
        $ruleIzin = RuleIzin::all();
        $presensi = Presensi::where('pegawaiCode', $request->pegawaiCode)
            ->select('activityCode')
            ->where('jamMasuk', '<>',null)
            ->where('keteranganIzin', 'PULANG CEPAT')
            ->orderBy('created_at', 'DESC')->first();
        if($presensi != null){
            $activityCode = $presensi->activityCode;
        }else{
            $activityCode = null;
        }
        foreach($ruleIzin as $row){
            array_push($ijin, [
                'id' => $row->id,
                'namaIzin' => $row->namaIzin
            ]);
        }
        return response()->json(["code" => 200, "data" => $ijin, "activityCode" => $activityCode]);
    }

    public function fetchHistoryIzin(Request $request)
    {
        $izins = Presensi::join('rule-izin', 'rule-izin.id', '=', 'presensi.idRuleIzin')
            ->join('pegawai', 'pegawai.code', '=', 'presensi.pegawaiCode')
            ->join('divisi', 'divisi.id', '=', 'pegawai.idDivisi')
            ->where('presensi.pegawaiCode', $request->pegawaiCode)
            ->where('presensi.tanggalMulaiIzin', '<>', null)
            ->where('presensi.tanggalAkhirIzin',  '<>', null)
            ->select('presensi.*', 'rule-izin.namaIzin', 'pegawai.nama', 'divisi.namaDivisi')
            ->orderBy('presensi.created_at', 'desc')
            ->get();
        return response()->json(["code" => 200, "data" => $izins]);
    }
    
    public function sendIzin(Request $request)
    {
        if($request->fileIzin != ""){
            $tipeFile = $request->tipefile;
            $tipe = "";
            if($tipeFile == "application/pdf"){
                $tipe = ".pdf";
            }else if($tipeFile == "image/jpeg"){
                $tipe = ".jpg";
            }else{
                $tipe = ".png";
            }
            $fileName = Carbon::now()->format('Y-m-d').'-'.\Illuminate\Support\Str::random(10).$tipe;
            $path = public_path().'/files/izin/';
            file_put_contents($path.$fileName,base64_decode($request->fileIzin));
        }

        $kode = getKodePresensi();
        DB::transaction(function() use ($request, $kode, $fileName) {
            if($request->idRuleIzin == 4){
                Presensi::where('activityCode', $request->activityCode)
                    ->update([
                        'statusPresensi' => 1,
                        'statusIzin' => 1,
                        'keteranganIzin' => 'PULANG CEPAT'
                    ]);
                Presensi::create([
                    'activityCode' => $kode,
                    'pegawaiCode' => $request->pegawaiCode,
                    'idRuleIzin' => $request->idRuleIzin,
                    'keteranganIzin' => $request->keteranganIzin,
                    'tanggalMulaiIzin' => $request->tanggalMulaiIzin,
                    'tanggalAkhirIzin' => $request->tanggalAkhirIzin,
                    'tipeWaktu' => $request->tipeWaktu,
                    'dokumenPendukung' => $fileName,
                    'statusIzin' => 0,
                    'statusPresensi' => 1
                ]);
            }else{
                Presensi::create([
                    'activityCode' => $kode,
                    'pegawaiCode' => $request->pegawaiCode,
                    'idRuleIzin' => $request->idRuleIzin,
                    'keteranganIzin' => $request->keteranganIzin,
                    'tanggalMulaiIzin' => $request->tanggalMulaiIzin,
                    'tanggalAkhirIzin' => $request->tanggalAkhirIzin,
                    'tipeWaktu' => $request->tipeWaktu,
                    'dokumenPendukung' => $fileName,
                    'statusIzin' => 0,
                    'statusPresensi' => 1
                ]);
            }   
        });
        return response()->json(["code" => 200, "message" => "Berhasil mengajukan izin"]);
    }

    public function batalIzin($kode)
    {
        DB::transaction(function() use ($kode) {
            Presensi::where('activityCode', $kode)
                ->update([
                    'statusPresensi' => 0,
                    'statusIzin' => 3,
                ]);
        });
        return response()->json(["code" => 200, "message" => "Berhasil membatalkan izin"]);
    }

    public function updateIzin(Request $request, $kode)
    {
        $fileName = "";
        if($request->fileIzin != ""){
            $tipeFile = $request->tipefile;
            $tipe = "";
            if($tipeFile == "application/pdf"){
                $tipe = ".pdf";
            }else if($tipeFile == "image/jpeg"){
                $tipe = ".jpg";
            }else{
                $tipe = ".png";
            }
            $fileName = Carbon::now()->format('Y-m-d').'-'.\Illuminate\Support\Str::random(10).$tipe;
            $path = public_path().'/files/izin/';
            file_put_contents($path.$fileName,base64_decode($request->fileIzin));
        }

        DB::transaction(function() use ($request, $kode, $fileName) {
            if($request->activityCode != null){
                Presensi::where('activityCode',$request->activityCode)
                    ->update([
                        'idRuleIzin' => null,
                        'statusPresensi' => 0,
                        'statusIzin' => null,
                    ]);
                Presensi::where('activityCode',$kode)
                    ->update([
                        'idRuleIzin' => $request->idRuleIzin,
                        'keteranganIzin' => $request->keteranganIzin,
                        'tanggalMulaiIzin' => $request->tanggalMulaiIzin,
                        'tanggalAkhirIzin' => $request->tanggalAkhirIzin,
                        'tipeWaktu' => $request->tipeWaktu,
                        'dokumenPendukung' => $fileName,
                    ]);
            }else{
                if($request->idRuleIzin == 4){
                    Presensi::where('activityCode', $request->activityCode)
                        ->update([
                            'statusPresensi' => 1,
                            'statusIzin' => 1,
                            'keteranganIzin' => 'PULANG CEPAT'
                        ]);
                    if($request->fileIzin != ""){
                        Presensi::where('activityCode',$kode)
                            ->update([
                                'idRuleIzin' => $request->idRuleIzin,
                                'keteranganIzin' => $request->keteranganIzin,
                                'tanggalMulaiIzin' => $request->tanggalMulaiIzin,
                                'tanggalAkhirIzin' => $request->tanggalAkhirIzin,
                                'tipeWaktu' => $request->tipeWaktu,
                                'dokumenPendukung' => $fileName,
                            ]);
                    }else{
                        Presensi::where('activityCode',$kode)
                            ->update([
                                'idRuleIzin' => $request->idRuleIzin,
                                'keteranganIzin' => $request->keteranganIzin,
                                'tanggalMulaiIzin' => $request->tanggalMulaiIzin,
                                'tanggalAkhirIzin' => $request->tanggalAkhirIzin,
                                'tipeWaktu' => $request->tipeWaktu,
                            ]);
                    }
                }else{
                    if($request->fileIzin != ""){
                        Presensi::where('activityCode',$kode)
                            ->update([
                                'idRuleIzin' => $request->idRuleIzin,
                                'keteranganIzin' => $request->keteranganIzin,
                                'tanggalMulaiIzin' => $request->tanggalMulaiIzin,
                                'tanggalAkhirIzin' => $request->tanggalAkhirIzin,
                                'tipeWaktu' => $request->tipeWaktu,
                                'dokumenPendukung' => $fileName,
                            ]);
                    }else{
                        Presensi::where('activityCode',$kode)
                            ->update([
                                'idRuleIzin' => $request->idRuleIzin,
                                'keteranganIzin' => $request->keteranganIzin,
                                'tanggalMulaiIzin' => $request->tanggalMulaiIzin,
                                'tanggalAkhirIzin' => $request->tanggalAkhirIzin,
                                'tipeWaktu' => $request->tipeWaktu,
                            ]);
                    }
                }   
            }
        });
        return response()->json(["code" => 200, "message" => "Berhasil mengubah izin"]);
    }

}
