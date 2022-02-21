<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\RuleIzin;
use Carbon\Carbon;

class IzinController extends Controller
{

    public function fetchRuleIzin()
    {
        $ruleIzin = RuleIzin::select('id', 'namaIzin')->get();
        return response()->json(["code" => 200, "data" => $ruleIzin]);
    }
    
    public function sendIzin(Request $request)
    {
        $tipeFile = $request->tipefile;
        $tipe = "";
        if($tipeFile == "application/pdf"){
            $tipe = ".pdf";
        }else if($tipeFile == "image/jpeg"){
            $tipe = ".jpg";
        }
        $fileName = Carbon::now()->format('Y-m-d').'-'.\Illuminate\Support\Str::random(10).$tipe;
        $path = public_path().'/files/izin/';
        file_put_contents($path.$fileName,base64_decode($request->fileIzin));

        $kode = getKodePresensi();
        Presensi::create([
            'activityCode' => $kode,
            'pegawaiCode' => $request->pegawaiCode,
            'idRuleIzin' => $request->idRuleIzin,
            'tanggalPresensi' => Carbon::now()->format('Y-m-d'),
            'keteranganIzin' => $request->keteranganIzin,
            'tanggalMulaiIzin' => $request->tanggalMulaiIzin,
            'tanggalAkhirIzin' => $request->tanggalAkhirIzin,
            'dokumenPendukung' => $fileName,
            'statusIzin' => 1,
            'statusPresensi' => 1
        ]);

        return response()->json(["code" => 200, "message" => "Berhasil Mengajukan Izin"]);
    }

}
