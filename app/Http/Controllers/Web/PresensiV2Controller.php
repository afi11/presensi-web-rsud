<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PresensiCroscheckImport;
use App\Models\PresensiCroscheck;
use App\Models\Pegawai;
use App\Models\Presensi;
use App\Models\Divisi;
use Carbon\Carbon;
use DB;
use App\Exports\HasilPresensi;

class PresensiV2Controller extends Controller
{
    
    public function index()
    {
        $listRuangan = Divisi::join('pegawai', 'pegawai.idDivisi', '=', 'divisi.id')
            ->select('divisi.id', 'divisi.namaDivisi as namaDivisi')
            ->distinct()
            ->orderBy('namaDivisi', 'asc')
            ->get();
        return view('pages.presensi-v2.index', compact('listRuangan'));
    }

    public function show(Request $request, $idDivisi)
    {
        $bulanTahun = $request->bulanTahun;
        $divisi = Divisi::find($idDivisi);
        $pegawai = Pegawai::where('idDivisi', $idDivisi)->get();
        return view('pages.presensi-v2.show', compact('pegawai', 'divisi', 'bulanTahun'));
    }

    public function exportExcel(Request $request, $ruangan)
    {
        $bulanTahun = $request->bulanTahun;
        $waktu = explode("-",$bulanTahun);
        $bulan = $waktu[1];
        $tahun = $waktu[0];
        return Excel::download(new HasilPresensi($ruangan, $bulan, $tahun), 'hasil_presensi_'.$bulanTahun.'.xlsx');
    }

    public function fetchHistoryPresensi(Request $request)
    {
        $bulanTahun = $request->bulanTahun;
        if($bulanTahun != ""){
            $waktu = explode("-",$bulanTahun);
            $bulan = $waktu[1];
            $tahun = $waktu[0];
        }else{
            $bulan = Carbon::now()->format('m');
            $tahun = Carbon::now()->format('Y');
        }
        $logPresensi = Pegawai::where('idDivisi', $request->ruangan)->get();
            
        $data = array();
        $no = 0;
        $fieldTanggal = "tgl";
     
        foreach($logPresensi as $row){
            array_push($data, [
                'kode' => $row->code,
                'nama' => $row->nama,
                'masuk_kerja' => cekStatistikPresensi($row->code, $bulan, $tahun, 'masuk_kerja'),
                'tidak_masuk_kerja' => cekStatistikPresensi($row->code, $bulan, $tahun, 'tidak_masuk_kerja'),
                'jumlah_kerja' => cekStatistikPresensi($row->code, $bulan, $tahun, 'jumlah_kerja'),
                'presentase_kehadiran' => round(cekStatistikPresensi($row->code, $bulan, $tahun, 'presentase_kehadiran'), 2),
                'tgl_1' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_01'),
                'tgl_2' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_02'),
                'tgl_3' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_03'),
                'tgl_4' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_04'),
                'tgl_5' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_05'),
                'tgl_6' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_06'),
                'tgl_7' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_07'),
                'tgl_8' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_08'),
                'tgl_9' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_09'),
                'tgl_10' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_10'),
                'tgl_11' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_11'),
                'tgl_12' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_12'),
                'tgl_13' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_13'),
                'tgl_14' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_14'),
                'tgl_15' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_15'),
                'tgl_16' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_16'),
                'tgl_17' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_17'),
                'tgl_18' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_18'),
                'tgl_19' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_19'),
                'tgl_20' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_20'),
                'tgl_21' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_21'),
                'tgl_22' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_22'),
                'tgl_23' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_23'),
                'tgl_24' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_24'),
                'tgl_25' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_25'),
                'tgl_26' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_26'),
                'tgl_27' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_27'),
                'tgl_28' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_28'),
                'tgl_29' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_29'),
                'tgl_30' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_30'),
                'tgl_31' => getJamMasukPulang($row->code, $bulan, $tahun, 'tgl_31'),
                'TL-1' => sumTelatTLPSW($request->ruangan, $row->code, $bulan, "jam-masuk", 1),
                'TL-2' => sumTelatTLPSW($request->ruangan, $row->code, $bulan, "jam-masuk", 2),
                'TL-3' => sumTelatTLPSW($request->ruangan, $row->code, $bulan, "jam-masuk", 3),
                'TL-4' => sumTelatTLPSW($request->ruangan, $row->code, $bulan, "jam-masuk", 4),
                'TL-1' => sumTelatTLPSW($request->ruangan, $row->code, $bulan, "jam-masuk", 1),
                'TL-2' => sumTelatTLPSW($request->ruangan, $row->code, $bulan, "jam-masuk", 2),
                'TL-3' => sumTelatTLPSW($request->ruangan, $row->code, $bulan, "jam-masuk", 3),
                'TL-4' => sumTelatTLPSW($request->ruangan, $row->code, $bulan, "jam-masuk", 4),
                'PSW-1' => sumTelatTLPSW($request->ruangan, $row->code, $bulan, "jam-pulang", 5),
                'PSW-2' => sumTelatTLPSW($request->ruangan, $row->code, $bulan, "jam-pulang", 6),
                'PSW-3' => sumTelatTLPSW($request->ruangan, $row->code, $bulan, "jam-pulang", 7),
                'PSW-4' => sumTelatTLPSW($request->ruangan, $row->code, $bulan, "jam-pulang", 8),
                'keterangan' => getCroshcekKeterangan($row->code, $bulan, $tahun)
            ]);
        }
        
        return response()->json(["code" => 200, "data" => $data]);
    }

    public function prosesSinkronisasi(Request $request)
    {
        DB::transaction(function() use ($request) {
            $waktu = explode("-", $request->bulan);
            $result = Excel::toArray(new PresensiCroscheckImport($waktu[1], $waktu[0]), $request->file('file_sinkronisasi'));
            $tidakCocok = 0;
            $ketTidakCocok = "Tanggal ";
            foreach($result[0] as $row){
                $hariLibur = 0;
                $masukKerja = 0;
                $tipePegawai = Pegawai::where('code', $row['kode_pegawai'])->first();
                $getid = PresensiCroscheck::where('tahun', $waktu[0])
                        ->where('bulan', $waktu[1])
                        ->where('pegawaiCode', $row['kode_pegawai'])
                        ->first();
                if($getid != null){
                    if($getid->status == 1){
                        $presensiSinkronUlang = PresensiCroscheck::find($getid->id);
                        $presensiSinkronUlang->keterangan = null;
                        $presensiSinkronUlang->hasil_tgl_01 = null;
                        $presensiSinkronUlang->hasil_tgl_02 = null;
                        $presensiSinkronUlang->hasil_tgl_03 = null;
                        $presensiSinkronUlang->hasil_tgl_04 = null;
                        $presensiSinkronUlang->hasil_tgl_05 = null;
                        $presensiSinkronUlang->hasil_tgl_06 = null;
                        $presensiSinkronUlang->hasil_tgl_07 = null;
                        $presensiSinkronUlang->hasil_tgl_08 = null;
                        $presensiSinkronUlang->hasil_tgl_09 = null;
                        $presensiSinkronUlang->hasil_tgl_10 = null;
                        $presensiSinkronUlang->hasil_tgl_11 = null;
                        $presensiSinkronUlang->hasil_tgl_12 = null;
                        $presensiSinkronUlang->hasil_tgl_13 = null;
                        $presensiSinkronUlang->hasil_tgl_14 = null;
                        $presensiSinkronUlang->hasil_tgl_15 = null;
                        $presensiSinkronUlang->hasil_tgl_16 = null;
                        $presensiSinkronUlang->hasil_tgl_17 = null;
                        $presensiSinkronUlang->hasil_tgl_18 = null;
                        $presensiSinkronUlang->hasil_tgl_19 = null;
                        $presensiSinkronUlang->hasil_tgl_20 = null;
                        $presensiSinkronUlang->hasil_tgl_21 = null;
                        $presensiSinkronUlang->hasil_tgl_22 = null;
                        $presensiSinkronUlang->hasil_tgl_23 = null;
                        $presensiSinkronUlang->hasil_tgl_24 = null;
                        $presensiSinkronUlang->hasil_tgl_25 = null;
                        $presensiSinkronUlang->hasil_tgl_26 = null;
                        $presensiSinkronUlang->hasil_tgl_27 = null;
                        $presensiSinkronUlang->hasil_tgl_28 = null;
                        $presensiSinkronUlang->hasil_tgl_29 = null;
                        $presensiSinkronUlang->hasil_tgl_30 = null;
                        $presensiSinkronUlang->hasil_tgl_31 = null;
                        $presensiSinkronUlang->save();
                    }
                    $presensiSinkron = PresensiCroscheck::find($getid->id);
                }
                $lamaHari = hitungJumlahHari($waktu[1],$waktu[0]);
                if(strtoupper($row['1']) == "A" && $presensiSinkron->tgl_01 == null){
                    $presensiSinkron->hasil_tgl_01 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_01)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['1']) == "X"){
                    $presensiSinkron->hasil_tgl_01 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['1']) != crosCekPresensi($presensiSinkron->tgl_01)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_01 = 'X';
                    $ketTidakCocok .= " 1,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_01) != 1){
                    $presensiSinkron->hasil_tgl_01 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_01)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_01) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['2']) == "A" && $presensiSinkron->tgl_02 == null){
                    $presensiSinkron->hasil_tgl_02 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_02)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['2']) == "X"){
                    $presensiSinkron->hasil_tgl_02 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['2']) != crosCekPresensi($presensiSinkron->tgl_02)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_02 = 'X';
                    $ketTidakCocok .= " 2,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_02) != 1){
                    $presensiSinkron->hasil_tgl_02 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_02)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_02) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['3']) == "A" && $presensiSinkron->tgl_03 == null ){
                    $presensiSinkron->hasil_tgl_03 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_03)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['3']) == "X"){
                    $presensiSinkron->hasil_tgl_03 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['3']) != crosCekPresensi($presensiSinkron->tgl_03)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_03 = 'X';
                    $ketTidakCocok .= " 3,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_03) != 1){
                    $presensiSinkron->hasil_tgl_03 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_03)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_03) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['4']) == "A" && $presensiSinkron->tgl_04 == null ){
                    $presensiSinkron->hasil_tgl_04 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_04)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['4']) == "X"){
                    $presensiSinkron->hasil_tgl_04 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['4']) != crosCekPresensi($presensiSinkron->tgl_04)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_04 = 'X';
                    $ketTidakCocok .= " 4,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_04) != 1){
                    $presensiSinkron->hasil_tgl_04 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_04)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_04) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['5']) == "A" && $presensiSinkron->tgl_05 == null ){
                    $presensiSinkron->hasil_tgl_05 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_05)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['5']) == "X"){
                    $presensiSinkron->hasil_tgl_05 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['5']) != crosCekPresensi($presensiSinkron->tgl_05)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_05 = 'X';
                    $ketTidakCocok .= " 5,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_05) != 1){
                    $presensiSinkron->hasil_tgl_05 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_05)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_05) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['6']) == "A" && $presensiSinkron->tgl_06 == null ){
                    $presensiSinkron->hasil_tgl_06 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_06)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['6']) == "X"){
                    $presensiSinkron->hasil_tgl_06 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['6']) != crosCekPresensi($presensiSinkron->tgl_06)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_06 = 'X';
                    $ketTidakCocok .= " 6,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_06) != 1){
                    $presensiSinkron->hasil_tgl_06 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_06)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_06) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['7']) == "A" && $presensiSinkron->tgl_07 == null ){
                    $presensiSinkron->hasil_tgl_06 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_07)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['7']) == "X"){
                    $presensiSinkron->hasil_tgl_07 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['7']) != crosCekPresensi($presensiSinkron->tgl_07)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_07 = 'X';
                    $ketTidakCocok .= " 7,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_07) != 1){
                    $presensiSinkron->hasil_tgl_07 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_07)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_07) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['8']) == "A" && $presensiSinkron->tgl_08 == null ){
                    $presensiSinkron->hasil_tgl_08 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_08)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['8']) == "X"){
                    $presensiSinkron->hasil_tgl_08 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['8']) != crosCekPresensi($presensiSinkron->tgl_08)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_08 = 'X';
                    $ketTidakCocok .= " 8,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_08) != 1){
                    $presensiSinkron->hasil_tgl_08 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_08)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_08) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['9']) == "A" && $presensiSinkron->tgl_09 == null ){
                    $presensiSinkron->hasil_tgl_09 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_09)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['9']) == "X"){
                    $presensiSinkron->hasil_tgl_09 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['9']) != crosCekPresensi($presensiSinkron->tgl_09)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_09 = 'X';
                    $ketTidakCocok .= " 9,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_09) != 1){
                    $presensiSinkron->hasil_tgl_09 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_09)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_09) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['10']) == "A" && $presensiSinkron->tgl_10 == null ){
                    $presensiSinkron->hasil_tgl_10 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_10)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['10']) == "X"){
                    $presensiSinkron->hasil_tgl_10 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['10']) != crosCekPresensi($presensiSinkron->tgl_10)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_10 = 'X';
                    $ketTidakCocok .= " 10,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_10) != 1){
                    $presensiSinkron->hasil_tgl_10 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_10)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_10) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['11']) == "A" && $presensiSinkron->tgl_11 == null ){
                    $presensiSinkron->hasil_tgl_11 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_11)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['11']) == "X"){
                    $presensiSinkron->hasil_tgl_11 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['11']) != crosCekPresensi($presensiSinkron->tgl_11)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_11 = 'X';
                    $ketTidakCocok .= " 11,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_11) != 1){
                    $presensiSinkron->hasil_tgl_11 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_11)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_11) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['12']) == "A" && $presensiSinkron->tgl_12 == null ){
                    $presensiSinkron->hasil_tgl_12 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_12)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['12']) == "X"){
                    $presensiSinkron->hasil_tgl_12 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['12']) != crosCekPresensi($presensiSinkron->tgl_12)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_12 = 'X';
                    $ketTidakCocok .= " 12,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_12) != 1){
                    $presensiSinkron->hasil_tgl_12 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_12)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_12) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['13']) == "A" && $presensiSinkron->tgl_13 == null ){
                    $presensiSinkron->hasil_tgl_13 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_13)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['13']) == "X"){
                    $presensiSinkron->hasil_tgl_13 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['13']) != crosCekPresensi($presensiSinkron->tgl_13)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_13 = 'X';
                    $ketTidakCocok .= " 13,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_13) != 1){
                    $presensiSinkron->hasil_tgl_13 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_13)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_13) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['14']) == "A" && $presensiSinkron->tgl_14 == null ){
                    $presensiSinkron->hasil_tgl_14 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_14)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['14']) == "X"){
                    $presensiSinkron->hasil_tgl_14 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['14']) != crosCekPresensi($presensiSinkron->tgl_14)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_14 = 'X';
                    $ketTidakCocok .= " 14,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_14) != 1){
                    $presensiSinkron->hasil_tgl_14 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_14)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_14) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['15']) == "A" && $presensiSinkron->tgl_15 == null ){
                    $presensiSinkron->hasil_tgl_15 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_15)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['15']) == "X"){
                    $presensiSinkron->hasil_tgl_15 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['15']) != crosCekPresensi($presensiSinkron->tgl_15)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_15 = 'X';
                    $ketTidakCocok .= " 15,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_15) != 1){
                    $presensiSinkron->hasil_tgl_15 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_15)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_15) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['16']) == "A" && $presensiSinkron->tgl_16 == null ){
                    $presensiSinkron->hasil_tgl_16 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_16)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['16']) == "X"){
                    $presensiSinkron->hasil_tgl_16 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['16']) != crosCekPresensi($presensiSinkron->tgl_16)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_16 = 'X';
                    $ketTidakCocok .= " 16,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_16) != 1){
                    $presensiSinkron->hasil_tgl_16 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_16)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_16) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['17']) == "A" && $presensiSinkron->tgl_17 == null ){
                    $presensiSinkron->hasil_tgl_17 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_17)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['17']) == "X"){
                    $presensiSinkron->hasil_tgl_17 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['17']) != crosCekPresensi($presensiSinkron->tgl_17)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_17 = 'X';
                    $ketTidakCocok .= " 17,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_17) != 1){
                    $presensiSinkron->hasil_tgl_17 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_17)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_17) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['18']) == "A" && $presensiSinkron->tgl_18 == null ){
                    $presensiSinkron->hasil_tgl_18 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_18)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['18']) == "X"){
                    $presensiSinkron->hasil_tgl_18 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['18']) != crosCekPresensi($presensiSinkron->tgl_18)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_18 = 'X';
                    $ketTidakCocok .= " 18,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_18) != 1){
                    $presensiSinkron->hasil_tgl_18 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_18)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_18) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['19']) == "A" && $presensiSinkron->tgl_19 == null ){
                    $presensiSinkron->hasil_tgl_19 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_19)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['19']) == "X"){
                    $presensiSinkron->hasil_tgl_19 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['19']) != crosCekPresensi($presensiSinkron->tgl_19)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_19 = 'X';
                    $ketTidakCocok .= " 19,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_19) != 1){
                    $presensiSinkron->hasil_tgl_19 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_19)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_19) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['20']) == "A" && $presensiSinkron->tgl_20 == null ){
                    $presensiSinkron->hasil_tgl_20 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_20)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['20']) == "X"){
                    $presensiSinkron->hasil_tgl_20 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['20']) != crosCekPresensi($presensiSinkron->tgl_20)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_20 = 'X';
                    $ketTidakCocok .= " 20,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_20) != 1){
                    $presensiSinkron->hasil_tgl_20 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_20)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_20) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['21']) == "A" && $presensiSinkron->tgl_21 == null ){
                    $presensiSinkron->hasil_tgl_21 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_21)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['21']) == "X"){
                    $presensiSinkron->hasil_tgl_21 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['21']) != crosCekPresensi($presensiSinkron->tgl_21)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_21 = 'X';
                    $ketTidakCocok .= " 21,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_21) != 1){
                    $presensiSinkron->hasil_tgl_21 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_21)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_21) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['22']) == "A" && $presensiSinkron->tgl_22 == null ){
                    $presensiSinkron->hasil_tgl_22 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_22)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['22']) == "X"){
                    $presensiSinkron->hasil_tgl_22 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['22']) != crosCekPresensi($presensiSinkron->tgl_22)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_22 = 'X';
                    $ketTidakCocok .= " 22,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_22) != 1){
                    $presensiSinkron->hasil_tgl_22 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_22)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_22) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['23']) == "A" && $presensiSinkron->tgl_23 == null ){
                    $presensiSinkron->hasil_tgl_23 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_23)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['23']) == "X"){
                    $presensiSinkron->hasil_tgl_23 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['23']) != crosCekPresensi($presensiSinkron->tgl_23)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_23 = 'X';
                    $ketTidakCocok .= " 23,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_23) != 1){
                    $presensiSinkron->hasil_tgl_23 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_23)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_23) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['24']) == "A" && $presensiSinkron->tgl_24 == null ){
                    $presensiSinkron->hasil_tgl_24 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_24)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['24']) == "X"){
                    $presensiSinkron->hasil_tgl_24 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['24']) != crosCekPresensi($presensiSinkron->tgl_24)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_24 = 'X';
                    $ketTidakCocok .= " 24,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_24) != 1){
                    $presensiSinkron->hasil_tgl_24 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_24)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_24) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['25']) == "A" && $presensiSinkron->tgl_25 == null ){
                    $presensiSinkron->hasil_tgl_25 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_25)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['25']) == "X"){
                    $presensiSinkron->hasil_tgl_25 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['25']) != crosCekPresensi($presensiSinkron->tgl_25)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_25 = 'X';
                    $ketTidakCocok .= " 25,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_25) != 1){
                    $presensiSinkron->hasil_tgl_25 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_25)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_25) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['26']) == "A" && $presensiSinkron->tgl_26 == null ){
                    $presensiSinkron->hasil_tgl_26 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_26)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['26']) == "X"){
                    $presensiSinkron->hasil_tgl_26 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['26']) != crosCekPresensi($presensiSinkron->tgl_26)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_26 = 'X';
                    $ketTidakCocok .= " 26,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_26) != 1){
                    $presensiSinkron->hasil_tgl_26 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_26)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_26) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if(strtoupper($row['27']) == "A" && $presensiSinkron->tgl_27 == null ){
                    $presensiSinkron->hasil_tgl_27 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_27)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['27']) == "X"){
                    $presensiSinkron->hasil_tgl_27 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['27']) != crosCekPresensi($presensiSinkron->tgl_27)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_27 = 'X';
                    $ketTidakCocok .= " 27,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_27) != 1){
                    $presensiSinkron->hasil_tgl_27 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_27)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_27) == 1){
                    $masukKerja = $masukKerja + 1;
                }

               if(strtoupper($row['28']) == "A" && $presensiSinkron->tgl_28 == null ){
                    $presensiSinkron->hasil_tgl_28 = 'A';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_28)
                        ->update([
                            "idRuleTelatMasuk" => 4,
                            "telatMasuk" => '01:30:00',
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(strtoupper($row['28']) == "X"){
                    $presensiSinkron->hasil_tgl_28 = 'LIBUR';
                    $hariLibur = $hariLibur + 1;
                }elseif(strtoupper($row['28']) != crosCekPresensi($presensiSinkron->tgl_28)){
                    $tidakCocok = $tidakCocok + 1;
                    $presensiSinkron->hasil_tgl_28 = 'X';
                    $ketTidakCocok .= " 28,";
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_28) != 1){
                    $presensiSinkron->hasil_tgl_28 = 'PSW-4';
                    $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_28)
                        ->update([
                            "idRuleLewatPulang" => 8,
                            "lewatPulang" => '01:30:00'
                        ]);
                }elseif(cekPresensiLengkap($presensiSinkron->tgl_28) == 1){
                    $masukKerja = $masukKerja + 1;
                }

                if($lamaHari > 28){
                    if(strtoupper($row['29']) == "A" && $presensiSinkron->tgl_29 == null ){
                        $presensiSinkron->hasil_tgl_29 = 'A';
                        $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_29)
                            ->update([
                                "idRuleTelatMasuk" => 4,
                                "telatMasuk" => '01:30:00',
                                "idRuleLewatPulang" => 8,
                                "lewatPulang" => '01:30:00'
                            ]);
                    }elseif(strtoupper($row['29']) == "X"){
                        $presensiSinkron->hasil_tgl_29 = 'LIBUR';
                        $hariLibur = $hariLibur + 1;
                    }elseif(strtoupper($row['29']) != crosCekPresensi($presensiSinkron->tgl_29)){
                        $tidakCocok = $tidakCocok + 1;
                        $presensiSinkron->hasil_tgl_29 = 'X';
                        $ketTidakCocok .= " 29,";
                    }elseif(cekPresensiLengkap($presensiSinkron->tgl_29) != 1){
                        $presensiSinkron->hasil_tgl_29 = 'PSW-4';
                        $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_29)
                            ->update([
                                "idRuleLewatPulang" => 8,
                                "lewatPulang" => '01:30:00'
                            ]);
                    }elseif(cekPresensiLengkap($presensiSinkron->tgl_29) == 1){
                        $masukKerja = $masukKerja + 1;
                    }    

                    if(strtoupper($row['30']) == "A" && $presensiSinkron->tgl_30 == null ){
                        $presensiSinkron->hasil_tgl_30 = 'A';
                        $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_30)
                            ->update([
                                "idRuleTelatMasuk" => 4,
                                "telatMasuk" => '01:30:00',
                                "idRuleLewatPulang" => 8,
                                "lewatPulang" => '01:30:00'
                            ]);
                    }elseif(strtoupper($row['30']) == "X"){
                        $presensiSinkron->hasil_tgl_30 = 'LIBUR';
                        $hariLibur = $hariLibur + 1;
                    }elseif(strtoupper($row['30']) != crosCekPresensi($presensiSinkron->tgl_30)){
                        $tidakCocok = $tidakCocok + 1;
                        $presensiSinkron->hasil_tgl_30 = 'X';
                        $ketTidakCocok .= " 30,";
                    }elseif(cekPresensiLengkap($presensiSinkron->tgl_30) != 1){
                        $presensiSinkron->hasil_tgl_30 = 'PSW-4';
                        $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_30)
                            ->update([
                                "idRuleLewatPulang" => 8,
                                "lewatPulang" => '01:30:00'
                            ]);
                    }elseif(cekPresensiLengkap($presensiSinkron->tgl_30) == 1){
                        $masukKerja = $masukKerja + 1;
                    }

                    if($lamaHari > 30){
                        if(strtoupper($row['31']) == "A" && $presensiSinkron->tgl_31 == null ){
                            $presensiSinkron->hasil_tgl_31 = 'A';
                            $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_31)
                                ->update([
                                    "idRuleTelatMasuk" => 4,
                                    "telatMasuk" => '01:30:00',
                                    "idRuleLewatPulang" => 8,
                                    "lewatPulang" => '01:30:00'
                                ]);
                        }elseif(strtoupper($row['31']) == "X"){
                            $presensiSinkron->hasil_tgl_31 = 'LIBUR';
                            $hariLibur = $hariLibur + 1;
                        }elseif(strtoupper($row['31']) != crosCekPresensi($presensiSinkron->tgl_31)){
                            $tidakCocok = $tidakCocok + 1;
                            $presensiSinkron->hasil_tgl_31 = 'X';
                            $ketTidakCocok .= " 31,";
                        }elseif(cekPresensiLengkap($presensiSinkron->tgl_31) != 1){
                            $presensiSinkron->hasil_tgl_31 = 'PSW-4';
                            $presensi = Presensi::where('activityCode', $presensiSinkron->tgl_31)
                                ->update([
                                    "idRuleLewatPulang" => 8,
                                    "lewatPulang" => '01:30:00'
                                ]);
                        }elseif(cekPresensiLengkap($presensiSinkron->tgl_31) == 1){
                            $masukKerja = $masukKerja + 1;
                        }
                    }
                }
                $jumlahKerja = $lamaHari - $hariLibur;
                $presensiSinkron->jumlah_kerja = $jumlahKerja;
                $presensiSinkron->masuk_kerja = $masukKerja;
                $presensiSinkron->tidak_masuk_kerja = $jumlahKerja - $masukKerja;
                $presensiSinkron->presentase_kehadiran = (($masukKerja / $jumlahKerja) * 100);
                $presensiSinkron->status = 1;
                $presensiSinkron->keterangan = 'Terdapat '.$tidakCocok.' data yang tidak sama '.$ketTidakCocok;
                $presensiSinkron->save(); 
                $tidakCocok = 0;
                $ketTidakCocok = "Tanggal ";
                $jumlahKerja = 0;
                $hariLibur = 0;
                $masukKerja = 0;
            }
        });
        return redirect()->back()->with('success', 'Sinkronisasi Hasil Presensi Berhasil');
    }

}