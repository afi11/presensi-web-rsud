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

    public function fetchRuleIzin()
    {
        $ruleIzin = RuleIzin::select('id', 'namaIzin')->get();
        return response()->json(["code" => 200, "data" => $ruleIzin]);
    }

    public function fetchHistoryIzin(Request $request)
    {
        $izins = Presensi::join('rule-izin', 'rule-izin.id', '=', 'presensi.idRuleIzin')
            ->where('presensi.pegawaiCode', $request->pegawaiCode)
            ->where('presensi.tanggalMulaiIzin', '<>', null)
            ->where('presensi.tanggalAkhirIzin',  '<>', null)
            ->select('presensi.*', 'rule-izin.namaIzin')
            ->orderBy('presensi.created_at', 'desc')
            ->get();
        return response()->json(["code" => 200, "data" => $izins]);
    }
    
    public function sendIzin(Request $request)
    {
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

        $kode = getKodePresensi();
        DB::transaction(function() use ($request, $kode, $fileName) {
            Presensi::create([
                'activityCode' => $kode,
                'pegawaiCode' => $request->pegawaiCode,
                'idRuleIzin' => $request->idRuleIzin,
                'keteranganIzin' => $request->keteranganIzin,
                'tanggalMulaiIzin' => $request->tanggalMulaiIzin,
                'tanggalAkhirIzin' => $request->tanggalAkhirIzin,
                'tipeWaktu' => $request->tipeWaktu,
                'dokumenPendukung' => $fileName,
                'statusIzin' => 1,
                'statusPresensi' => 1
            ]);
    
            $listTanggalCuti = getDatesFromRange($request->tanggalMulaiIzin, $request->tanggalAkhirIzin);
            for($i = 0; $i < count($listTanggalCuti); $i++){
                $bulan = Carbon::parse($listTanggalCuti[$i])->format('m');
                $tanggal = Carbon::parse($listTanggalCuti[$i])->format('d');
                $tahun = Carbon::parse($listTanggalCuti[$i])->format('Y');
                $fieldTanggal = "tgl_".$tanggal;
                $cekCrosCheck =  PresensiCroscheck::where('pegawaiCode', $request->pegawaiCode)
                    ->where('bulan', $bulan)
                    ->where('tahun', $tahun)
                    ->count();
                if($cekCrosCheck > 0){
                    PresensiCroscheck::where('pegawaiCode', $request->pegawaiCode)
                        ->where('bulan', $bulan)
                        ->where('tahun', $tahun)
                        ->update([
                            $fieldTanggal => $kode
                        ]); 
                }else{
                    PresensiCroscheck::create([
                        "pegawaiCode" => $request->pegawaiCode,
                        "bulan" => $bulan,
                        "tahun" => $tahun,
                        $fieldTanggal => $kode
                    ]);
                }
            }
        });
        return response()->json(["code" => 200, "message" => "Berhasil mengajukan izin"]);
    }

}
