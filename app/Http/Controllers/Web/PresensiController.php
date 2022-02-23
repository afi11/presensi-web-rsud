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

class PresensiController extends Controller
{
    
    public function crosCheckView()
    {
        return view('pages.croscheck.index_croscheck');
    }

    public function index()
    {
        $listRuangan = Divisi::join('pegawai', 'pegawai.idDivisi', '=', 'divisi.id')
            ->select('divisi.id', 'divisi.namaDivisi as namaDivisi')
            ->distinct()
            ->orderBy('namaDivisi', 'asc')
            ->get();
        return view('pages.sinkronisasi_presensi.index', compact('listRuangan'));
    }

    public function show(Request $request, $idDivisi)
    {
        $bulanTahun = $request->bulanTahun;
        $divisi = Divisi::find($idDivisi);
        $pegawai = Pegawai::where('idDivisi', $idDivisi)->get();
        return view('pages.sinkronisasi_presensi.show', compact('pegawai', 'divisi', 'bulanTahun'));
    }

    public function viewRecordPresensi($kodePegawai)
    {
        $pegawai = Pegawai::where('code', $kodePegawai)->first();
        return view('pages.sinkronisasi_presensi.record', compact('pegawai'));
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
        $logPresensi = PresensiCroscheck::where('presensi_croscheck.bulan', $bulan)
            ->where('presensi_croscheck.tahun', $tahun)
            ->where('presensi_croscheck.idDivisi', $request->ruangan)
            ->get();
       
        $data = array();
        $no = 0;
        $fieldTanggal = "tgl";
        foreach($logPresensi as $row){
            array_push($data, [
                'kode' => $row->pegawaiCode,
                'nama' => getPegawaiName($row->pegawaiCode),
                'tgl_1' => getJamMasukPulang($row->tgl_1).'<br/>'.$row->hasil_tgl_01,
                'tgl_2' => getJamMasukPulang($row->tgl_2).'<br/>'.$row->hasil_tgl_02,
                'tgl_3' => getJamMasukPulang($row->tgl_3).'<br/>'.$row->hasil_tgl_03,
                'tgl_4' => getJamMasukPulang($row->tgl_4).'<br/>'.$row->hasil_tgl_04,
                'tgl_5' => getJamMasukPulang($row->tgl_5).'<br/>'.$row->hasil_tgl_05,
                'tgl_6' => getJamMasukPulang($row->tgl_6).'<br/>'.$row->hasil_tgl_06,
                'tgl_7' => getJamMasukPulang($row->tgl_7).'<br/>'.$row->hasil_tgl_07,
                'tgl_8' => getJamMasukPulang($row->tgl_8).'<br/>'.$row->hasil_tgl_08,
                'tgl_9' => getJamMasukPulang($row->tgl_9).'<br/>'.$row->hasil_tgl_09,
                'tgl_10' => getJamMasukPulang($row->tgl_10).'<br/>'.$row->hasil_tgl_10,
                'tgl_11' => getJamMasukPulang($row->tgl_11).'<br/>'.$row->hasil_tgl_11,
                'tgl_12' => getJamMasukPulang($row->tgl_12).'<br/>'.$row->hasil_tgl_12,
                'tgl_13' => getJamMasukPulang($row->tgl_13).'<br/>'.$row->hasil_tgl_13,
                'tgl_14' => getJamMasukPulang($row->tgl_14).'<br/>'.$row->hasil_tgl_14,
                'tgl_15' => getJamMasukPulang($row->tgl_15).'<br/>'.$row->hasil_tgl_15,
                'tgl_16' => getJamMasukPulang($row->tgl_16).'<br/>'.$row->hasil_tgl_16,
                'tgl_17' => getJamMasukPulang($row->tgl_17).'<br/>'.$row->hasil_tgl_17,
                'tgl_18' => getJamMasukPulang($row->tgl_18).'<br/>'.$row->hasil_tgl_18,
                'tgl_19' => getJamMasukPulang($row->tgl_19).'<br/>'.$row->hasil_tgl_19,
                'tgl_20' => getJamMasukPulang($row->tgl_20).'<br/>'.$row->hasil_tgl_20,
                'tgl_21' => getJamMasukPulang($row->tgl_21).'<br/>'.$row->hasil_tgl_21,
                'tgl_22' => getJamMasukPulang($row->tgl_22).'<br/>'.$row->hasil_tgl_22,
                'tgl_23' => getJamMasukPulang($row->tgl_23).'<br/>'.$row->hasil_tgl_23,
                'tgl_24' => getJamMasukPulang($row->tgl_24).'<br/>'.$row->hasil_tgl_24,
                'tgl_25' => getJamMasukPulang($row->tgl_25).'<br/>'.$row->hasil_tgl_25,
                'tgl_26' => getJamMasukPulang($row->tgl_26).'<br/>'.$row->hasil_tgl_26,
                'tgl_27' => getJamMasukPulang($row->tgl_27).'<br/>'.$row->hasil_tgl_27,
                'tgl_28' => getJamMasukPulang($row->tgl_28).'<br/>'.$row->hasil_tgl_28,
                'tgl_29' => getJamMasukPulang($row->tgl_29).'<br/>'.$row->hasil_tgl_29,
                'tgl_30' => getJamMasukPulang($row->tgl_30).'<br/>'.$row->hasil_tgl_30,
                'tgl_31' => getJamMasukPulang($row->tgl_31).'<br/>'.$row->hasil_tgl_31,
                'telatMasuk' => sumTelatMasuk($request->ruangan, $row->pegawaiCode, $bulan),
                'lewatPulang' => sumLewatPulang($request->ruangan, $row->pegawaiCode, $bulan),
                'keterangan' => $row->keterangan
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
            foreach($result[0] as $row){
                $tipePegawai = Pegawai::where('code', $row['kode_pegawai'])->first();
                $getid = PresensiCroscheck::where('tahun', $waktu[0])
                        ->where('bulan', $waktu[1])
                        ->where('pegawaiCode', $row['kode_pegawai'])
                        ->first();
                $presensiSinkron = PresensiCroscheck::find($getid->id);
                $lamaHari = hitungJumlahHari($waktu[1],$waktu[0]);
                
                    if(strtoupper($row['1']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_01 == null && strtoupper($row['1']) == 'P' 
                                || $presensiSinkron->tgl_01 != null && strtoupper($row['1']) == 'X'
                                || $presensiSinkron->tgl_01 == null && strtoupper($row['1']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_01 = 'X';
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_01 == null || $presensiSinkron->tgl_01 != null && strtoupper($row['1']) == 'X'
                                || $presensiSinkron->tgl_01 == null && strtoupper($row['1']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_01 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_01) != strtoupper($row['1'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_01 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_01 ='X';
                    }

                    if(strtoupper($row['2']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_02 == null && strtoupper($row['2']) == 'P' 
                                || $presensiSinkron->tgl_02 != null && strtoupper($row['2']) == 'X'
                                || $presensiSinkron->tgl_02 == null && strtoupper($row['2']) =='C' ){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_02 = 'X';
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_02 == null || $presensiSinkron->tgl_02 != null && strtoupper($row['2']) == 'X'
                                || $presensiSinkron->tgl_02 == null && strtoupper($row['2']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_02 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_02) != strtoupper($row['2'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_02 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_02 ='X';
                    }

                    if(strtoupper($row['3']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_03 == null && strtoupper($row['3']) == 'P' 
                                || $presensiSinkron->tgl_03 != null && strtoupper($row['3']) == 'X'
                                || $presensiSinkron->tgl_03 == null && strtoupper($row['3']) =='C' ){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_03 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_03 == null || $presensiSinkron->tgl_03 != null && strtoupper($row['3']) == 'X'
                                || $presensiSinkron->tgl_03 == null && strtoupper($row['3']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_03 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_03) != strtoupper($row['3'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_03 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_03 ='X';
                    }

                    if(strtoupper($row['4']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_04 == null && strtoupper($row['4']) == 'P' 
                                || $presensiSinkron->tgl_04 != null && strtoupper($row['4']) == 'X'
                                || $presensiSinkron->tgl_04 == null && strtoupper($row['4']) =='C' ){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_04 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_04 == null || $presensiSinkron->tgl_04 != null && strtoupper($row['4']) == 'X'
                                || $presensiSinkron->tgl_04 == null && strtoupper($row['4']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_04 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_04) != strtoupper($row['4'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_04 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_04 ='X';
                    }
                    
                    if(strtoupper($row['5']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_05 == null && strtoupper($row['5']) == 'P' 
                                || $presensiSinkron->tgl_05 != null && strtoupper($row['5']) == 'X'
                                || $presensiSinkron->tgl_05 == null && strtoupper($row['5']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_05 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_05 == null || $presensiSinkron->tgl_05 != null && strtoupper($row['5']) == 'X'
                                || $presensiSinkron->tgl_05 == null && strtoupper($row['5']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_05 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_05) != strtoupper($row['5'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_05 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_05 ='X';
                    }
                
                    if(strtoupper($row['6']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_06 == null && strtoupper($row['6']) == 'P' 
                                || $presensiSinkron->tgl_06 != null && strtoupper($row['6']) == 'X'
                                || $presensiSinkron->tgl_06 == null && strtoupper($row['6']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_06 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_06 == null || $presensiSinkron->tgl_06 != null && strtoupper($row['6']) == 'X'
                                || $presensiSinkron->tgl_06 == null && strtoupper($row['6']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_06 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_06) != strtoupper($row['6'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_06 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_06 ='X';
                    }
                    
                    if(strtoupper($row['7']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_07 == null && strtoupper($row['7']) == 'P' 
                                || $presensiSinkron->tgl_07 != null && strtoupper($row['7']) == 'X'
                                || $presensiSinkron->tgl_07 == null && strtoupper($row['7']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_07 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_07 == null || $presensiSinkron->tgl_07 != null && strtoupper($row['7']) == 'X'
                                || $presensiSinkron->tgl_07 == null && strtoupper($row['7']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_07 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_07) != strtoupper($row['7'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_07 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_07 ='X';
                    }
                    
                    if(strtoupper($row['8']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_08 == null && strtoupper($row['8']) == 'P' 
                                || $presensiSinkron->tgl_08 != null && strtoupper($row['8']) == 'X'
                                || $presensiSinkron->tgl_08 == null && strtoupper($row['8']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_08 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_08 == null || $presensiSinkron->tgl_08 != null && strtoupper($row['8']) == 'X'
                                || $presensiSinkron->tgl_08 == null && strtoupper($row['8']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_08 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_08) != strtoupper($row['8'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_08 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_08 ='X';
                    }
                
                    if(strtoupper($row['9']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_09 == null && strtoupper($row['9']) == 'P' 
                                || $presensiSinkron->tgl_09 != null && strtoupper($row['9']) == 'X'
                                || $presensiSinkron->tgl_09 == null && strtoupper($row['9']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_09 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_09 == null || $presensiSinkron->tgl_09 != null && strtoupper($row['9']) == 'X'
                                || $presensiSinkron->tgl_09 == null && strtoupper($row['9']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_09 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_09) != strtoupper($row['9'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_09 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_09 ='X';
                    }

                    if(strtoupper($row['10']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_10 == null && strtoupper($row['10']) == 'P' 
                                || $presensiSinkron->tgl_10 != null && strtoupper($row['10']) == 'X'
                                || $presensiSinkron->tgl_10 == null && strtoupper($row['10']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_10 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_10 == null || $presensiSinkron->tgl_10 != null && strtoupper($row['10']) == 'X'
                                || $presensiSinkron->tgl_10 == null && strtoupper($row['10']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_10 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_10) != strtoupper($row['10'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_10 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_10 ='X';
                    }
                
                    if(strtoupper($row['11']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_11 == null && strtoupper($row['11']) == 'P' 
                                || $presensiSinkron->tgl_11 != null && strtoupper($row['11']) == 'X'
                                || $presensiSinkron->tgl_11 == null && strtoupper($row['11']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_11 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_11 == null || $presensiSinkron->tgl_11 != null && strtoupper($row['11']) == 'X'
                                || $presensiSinkron->tgl_11 == null && strtoupper($row['11']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_11 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_11) != strtoupper($row['11'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_11 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_11 ='X';
                    }

                    if(strtoupper($row['12']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_12 == null && strtoupper($row['12']) == 'P' 
                                || $presensiSinkron->tgl_12 != null && strtoupper($row['12']) == 'X'
                                || $presensiSinkron->tgl_12 == null && strtoupper($row['12']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_12 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_12 == null || $presensiSinkron->tgl_12 != null && strtoupper($row['12']) == 'X'
                                || $presensiSinkron->tgl_12 == null && strtoupper($row['12']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_12 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_12) != strtoupper($row['12'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_12 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_12 ='X';
                    } 

                    if(strtoupper($row['13']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_13 == null && strtoupper($row['13']) == 'P' 
                                || $presensiSinkron->tgl_13 != null && strtoupper($row['13']) == 'X'
                                || $presensiSinkron->tgl_13 == null && strtoupper($row['13']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_13 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_13 == null || $presensiSinkron->tgl_13 != null && strtoupper($row['13']) == 'X'
                                || $presensiSinkron->tgl_13 == null && strtoupper($row['13']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_13 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_13) != strtoupper($row['13'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_13 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_13 ='X';
                    }

                    if(strtoupper($row['14']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_14 == null && strtoupper($row['14']) == 'P' 
                                || $presensiSinkron->tgl_14 != null && strtoupper($row['14']) == 'X'
                                || $presensiSinkron->tgl_14 == null && strtoupper($row['14']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_14 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_14 == null || $presensiSinkron->tgl_14 != null && strtoupper($row['14']) == 'X'
                                || $presensiSinkron->tgl_14 == null && strtoupper($row['14']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_14 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_14) != strtoupper($row['14'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_14 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_14 ='X';
                    }

                    if(strtoupper($row['15']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_15 == null && strtoupper($row['15']) == 'P' 
                                || $presensiSinkron->tgl_15 != null && strtoupper($row['15']) == 'X'
                                || $presensiSinkron->tgl_15 == null && strtoupper($row['15']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_15 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_15 == null || $presensiSinkron->tgl_15 != null && strtoupper($row['15']) == 'X'
                                || $presensiSinkron->tgl_15 == null && strtoupper($row['15']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_15 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_15) != strtoupper($row['15'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_15 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_15 ='X';
                    }
                
                    if(strtoupper($row['16']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_16 == null && strtoupper($row['16']) == 'P' 
                                || $presensiSinkron->tgl_16 != null && strtoupper($row['16']) == 'X'
                                || $presensiSinkron->tgl_16 == null && strtoupper($row['16']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_16 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_16 == null || $presensiSinkron->tgl_16 != null && strtoupper($row['16']) == 'X'
                                || $presensiSinkron->tgl_16 == null && strtoupper($row['16']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_16 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_16) != strtoupper($row['16'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_16 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_16 ='X';
                    }
                
                    if(strtoupper($row['17']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_17 == null && strtoupper($row['17']) == 'P' 
                                || $presensiSinkron->tgl_17 != null && strtoupper($row['17']) == 'X'
                                || $presensiSinkron->tgl_17 == null && strtoupper($row['17']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_17 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_17 == null || $presensiSinkron->tgl_17 != null && strtoupper($row['17']) == 'X'
                                || $presensiSinkron->tgl_17 == null && strtoupper($row['17']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_17 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_17) != strtoupper($row['17'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_17 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_17 ='X';
                    }

                    if(strtoupper($row['18']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_18 == null && strtoupper($row['18']) == 'P' 
                                || $presensiSinkron->tgl_18 != null && strtoupper($row['18']) == 'X'
                                || $presensiSinkron->tgl_18 == null && strtoupper($row['18']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_18 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_18 == null || $presensiSinkron->tgl_18 != null && strtoupper($row['18']) == 'X'
                                || $presensiSinkron->tgl_18 == null && strtoupper($row['18']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_18 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_18) != strtoupper($row['18'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_18 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_18 ='X';
                    }
                    
                    if(strtoupper($row['19']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_19 == null && strtoupper($row['19']) == 'P' 
                                || $presensiSinkron->tgl_19 != null && strtoupper($row['19']) == 'X'
                                || $presensiSinkron->tgl_19 == null && strtoupper($row['19']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_19 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_19 == null || $presensiSinkron->tgl_19 != null && strtoupper($row['19']) == 'X'
                                || $presensiSinkron->tgl_19 == null && strtoupper($row['19']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_19 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_19) != strtoupper($row['19'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_19 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_19 ='X';
                    }
                
                    if(strtoupper($row['20']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_20 == null && strtoupper($row['20']) == 'P' 
                                || $presensiSinkron->tgl_20 != null && strtoupper($row['20']) == 'X'
                                || $presensiSinkron->tgl_20 == null && strtoupper($row['20']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_20 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_20 == null || $presensiSinkron->tgl_20 != null && strtoupper($row['20']) == 'X'
                                || $presensiSinkron->tgl_20 == null && strtoupper($row['20']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_20 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_20) != strtoupper($row['20'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_20 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_20 ='X';
                    }
                
                    if(strtoupper($row['21']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_21 == null && strtoupper($row['21']) == 'P' 
                                || $presensiSinkron->tgl_21 != null && strtoupper($row['21']) == 'X'
                                || $presensiSinkron->tgl_21 == null && strtoupper($row['21']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_21 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_21 == null || $presensiSinkron->tgl_21 != null && strtoupper($row['21']) == 'X'
                                || $presensiSinkron->tgl_21 == null && strtoupper($row['21']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_21 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_21) != strtoupper($row['21'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_21 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_21 ='X';
                    }
                
                    if(strtoupper($row['22']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_22 == null && strtoupper($row['22']) == 'P' 
                                || $presensiSinkron->tgl_22 != null && strtoupper($row['22']) == 'X'
                                || $presensiSinkron->tgl_22 == null && strtoupper($row['22']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_22 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_22 == null || $presensiSinkron->tgl_22 != null && strtoupper($row['22']) == 'X'
                                || $presensiSinkron->tgl_22 == null && strtoupper($row['22']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_22 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_22) != strtoupper($row['22'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_22 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_22 ='X';
                    }
                
                    if(strtoupper($row['23']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_23 == null && strtoupper($row['23']) == 'P' 
                                || $presensiSinkron->tgl_23 != null && strtoupper($row['23']) == 'X'
                                || $presensiSinkron->tgl_23 == null && strtoupper($row['23']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_23 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_23 == null || $presensiSinkron->tgl_23 != null && strtoupper($row['23']) == 'X'
                                || $presensiSinkron->tgl_23 == null && strtoupper($row['23']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_23 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_23) != strtoupper($row['23'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_23 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_23 ='X';
                    }
                
                    if(strtoupper($row['24']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_24 == null && strtoupper($row['24']) == 'P' 
                                || $presensiSinkron->tgl_24 != null && strtoupper($row['24']) == 'X'
                                || $presensiSinkron->tgl_24 == null && strtoupper($row['24']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_24 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_24 == null || $presensiSinkron->tgl_24 != null && strtoupper($row['24']) == 'X'
                                || $presensiSinkron->tgl_24 == null && strtoupper($row['24']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_24 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_24) != strtoupper($row['24'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_24 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_24 ='X';
                    }
                    
                    if(strtoupper($row['25']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_25 == null && strtoupper($row['25']) == 'P' 
                                || $presensiSinkron->tgl_25 != null && strtoupper($row['25']) == 'X'
                                || $presensiSinkron->tgl_25 == null && strtoupper($row['25']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_25 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_25 == null || $presensiSinkron->tgl_25 != null && strtoupper($row['25']) == 'X'
                                || $presensiSinkron->tgl_25 == null && strtoupper($row['25']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_25 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_25) != strtoupper($row['25'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_25 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->tgl_25 ='X';
                    }
                    
                    if(strtoupper($row['26']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_26 == null && strtoupper($row['26']) == 'P' 
                                || $presensiSinkron->tgl_26 != null && strtoupper($row['26']) == 'X'
                                || $presensiSinkron->tgl_26 == null && strtoupper($row['26']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_26 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_26 == null || $presensiSinkron->tgl_26 != null && strtoupper($row['26']) == 'X'
                                || $presensiSinkron->tgl_26 == null && strtoupper($row['26']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_26 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_26) != strtoupper($row['26'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_26 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_26 ='X';
                    }
                
                    if(strtoupper($row['27']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_27 == null && strtoupper($row['27']) == 'P' 
                                || $presensiSinkron->tgl_27 != null && strtoupper($row['27']) == 'X'
                                || $presensiSinkron->tgl_27 == null && strtoupper($row['27']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_27 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_27 == null || $presensiSinkron->tgl_27 != null && strtoupper($row['27']) == 'X'
                                || $presensiSinkron->tgl_27 == null && strtoupper($row['27']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_27 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_27) != strtoupper($row['27'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_27 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_27 ='X';
                    }
                
                    if(strtoupper($row['28']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_28 == null && strtoupper($row['28']) == 'P' 
                                || $presensiSinkron->tgl_28 != null && strtoupper($row['28']) == 'X'
                                || $presensiSinkron->tgl_28 == null && strtoupper($row['28']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_28 = 'X';
                            } 
                        }else{
                            if($presensiSinkron->tgl_28 == null || $presensiSinkron->tgl_28 != null && strtoupper($row['28']) == 'X'
                                || $presensiSinkron->tgl_28 == null && strtoupper($row['28']) =='C'){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_28 = 'X';
                            }else if(crosCekPresensi($presensiSinkron->tgl_28) != strtoupper($row['28'])){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_28 = 'X';
                            } 
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_28 ='X';
                    }
                
                    if($lamaHari > 28){
                        if(strtoupper($row['29']) !='X' ){
                            if($tipePegawai->statusShift == 0){
                                if($presensiSinkron->tgl_29 == null && strtoupper($row['29']) == 'P' 
                                    || $presensiSinkron->tgl_29 != null && strtoupper($row['29']) == 'X'
                                    || $presensiSinkron->tgl_29 == null && strtoupper($row['29']) =='C'){
                                    $tidakCocok = $tidakCocok + 1;
                                    $presensiSinkron->hasil_tgl_29 = 'X';
                                } 
                            }else{
                                if($presensiSinkron->tgl_29 == null || $presensiSinkron->tgl_29 != null && strtoupper($row['29']) == 'X'
                                    || $presensiSinkron->tgl_29 == null && strtoupper($row['29']) =='C'){
                                    $tidakCocok = $tidakCocok + 1;
                                    $presensiSinkron->hasil_tgl_29 = 'X';
                                }else if(crosCekPresensi($presensiSinkron->tgl_29) != strtoupper($row['29'])){
                                    $tidakCocok = $tidakCocok + 1;
                                    $presensiSinkron->hasil_tgl_29 = 'X';
                                } 
                            }
                        }else{
                            $presensiSinkron->hasil_tgl_29 ='X';
                        } 

                        if($lamaHari > 29){
                            if(strtoupper($row['30']) !='X' ){
                                if($tipePegawai->statusShift == 0){
                                    if($presensiSinkron->tgl_30 == null && strtoupper($row['30']) == 'P' 
                                        || $presensiSinkron->tgl_30 != null && strtoupper($row['30']) == 'X'
                                        || $presensiSinkron->tgl_30 == null && strtoupper($row['30']) =='C'){
                                        $tidakCocok = $tidakCocok + 1;
                                        $presensiSinkron->hasil_tgl_30 = 'X';
                                    } 
                                }else{
                                    if($presensiSinkron->tgl_30 == null || $presensiSinkron->tgl_30 != null && strtoupper($row['30']) == 'X'
                                        || $presensiSinkron->tgl_30 == null && strtoupper($row['30']) =='C'){
                                        $tidakCocok = $tidakCocok + 1;
                                        $presensiSinkron->hasil_tgl_30 = 'X';
                                    }else if(crosCekPresensi($presensiSinkron->tgl_30) != strtoupper($row['30'])){
                                        $tidakCocok = $tidakCocok + 1;
                                        $presensiSinkron->hasil_tgl_30 = 'X';
                                    } 
                                }
                            }else{
                                $presensiSinkron->hasil_tgl_30 ='X';
                            }

                            if($lamaHari > 31){
                                if(strtoupper($row['31']) !='X' ){
                                    if($tipePegawai->statusShift == 0){
                                        if($presensiSinkron->tgl_31 == null && strtoupper($row['31']) == 'P' 
                                            || $presensiSinkron->tgl_31 != null && strtoupper($row['31']) == 'X'
                                            || $presensiSinkron->tgl_31 == null && strtoupper($row['31']) =='C'){
                                            $tidakCocok = $tidakCocok + 1;
                                            $presensiSinkron->hasil_tgl_31 = 'X';
                                        } 
                                    }else{
                                        if($presensiSinkron->tgl_31 == null || $presensiSinkron->tgl_31 != null && strtoupper($row['31']) == 'X'
                                            || $presensiSinkron->tgl_31 == null && strtoupper($row['31']) =='C'){
                                            $tidakCocok = $tidakCocok + 1;
                                            $presensiSinkron->hasil_tgl_31 = 'X';
                                        }else if(crosCekPresensi($presensiSinkron->tgl_31) != strtoupper($row['31'])){
                                            $tidakCocok = $tidakCocok + 1;
                                            $presensiSinkron->hasil_tgl_31 = 'X';
                                        } 
                                    }
                                }else{
                                    $presensiSinkron->hasil_tgl_31 ='X';
                                }
                            }
                        }
                    }
                $presensiSinkron->status = 1;
                $presensiSinkron->keterangan = 'Terdapat '.$tidakCocok.' data yang tidak sama';
                $presensiSinkron->save();
                echo $tidakCocok;
            }
        });
    }

}
