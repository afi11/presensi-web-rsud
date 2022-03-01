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
        $logPresensi = Pegawai::where('idDivisi', $request->ruangan)->get();
            
        $data = array();
        $no = 0;
        $fieldTanggal = "tgl";
     
        foreach($logPresensi as $row){
            array_push($data, [
                'kode' => $row->code,
                'nama' => $row->nama,
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
                'telatMasuk' => sumTelatMasuk($request->idDivisi, $row->code, $bulan),
                'lewatPulang' => sumLewatPulang($request->idDivisi, $row->code, $bulan),
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
                                || $presensiSinkron->tgl_01 == null && strtoupper($row['1']) == 'CT'
                                || $presensiSinkron->tgl_01 == null && strtoupper($row['1']) == 'SKT'
                                || $presensiSinkron->tgl_01 == null && strtoupper($row['1']) == 'I'
                                || $presensiSinkron->tgl_01 == null && strtoupper($row['1']) == 'DL'
                                || $presensiSinkron->tgl_01 != null && strtoupper($row['1']) != crosCekPresensi($presensiSinkron->tgl_01)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_01 = 'X';
                                $ketTidakCocok .= " 1,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_01 != null && strtoupper($row['1']) == 'X'
                                || $presensiSinkron->tgl_01 == null && strtoupper($row['1']) == 'CT'
                                || $presensiSinkron->tgl_01 == null && strtoupper($row['1']) == 'SKT'
                                || $presensiSinkron->tgl_01 == null && strtoupper($row['1']) == 'I'
                                || $presensiSinkron->tgl_01 == null && strtoupper($row['1']) == 'DL'
                                || $presensiSinkron->tgl_01 != null && strtoupper($row['1']) != crosCekPresensi($presensiSinkron->tgl_01)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_01 = 'X';
                                $ketTidakCocok .= " 1,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_01 ='X';
                    }

                    if(strtoupper($row['2']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_02 == null && strtoupper($row['2']) == 'P' 
                                || $presensiSinkron->tgl_02 != null && strtoupper($row['2']) == 'X'
                                || $presensiSinkron->tgl_02 == null && strtoupper($row['2']) == 'CT'
                                || $presensiSinkron->tgl_02 == null && strtoupper($row['2']) == 'SKT'
                                || $presensiSinkron->tgl_02 == null && strtoupper($row['2']) == 'I'
                                || $presensiSinkron->tgl_02 == null && strtoupper($row['2']) == 'DL'
                                || $presensiSinkron->tgl_02 != null && strtoupper($row['2']) != crosCekPresensi($presensiSinkron->tgl_02)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_02 = 'X';
                                $ketTidakCocok .= " 2,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_02 != null && strtoupper($row['2']) == 'X'
                                || $presensiSinkron->tgl_02 == null && strtoupper($row['2']) == 'CT'
                                || $presensiSinkron->tgl_02 == null && strtoupper($row['2']) == 'SKT'
                                || $presensiSinkron->tgl_02 == null && strtoupper($row['2']) == 'I'
                                || $presensiSinkron->tgl_02 == null && strtoupper($row['2']) == 'DL'
                                || $presensiSinkron->tgl_02 != null && strtoupper($row['2']) != crosCekPresensi($presensiSinkron->tgl_02)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_02 = 'X';
                                $ketTidakCocok .= " 2,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_02 ='X';
                    }

                    if(strtoupper($row['3']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_03 == null && strtoupper($row['3']) == 'P' 
                                || $presensiSinkron->tgl_03 != null && strtoupper($row['3']) == 'X'
                                || $presensiSinkron->tgl_03 == null && strtoupper($row['3']) == 'CT'
                                || $presensiSinkron->tgl_03 == null && strtoupper($row['3']) == 'SKT'
                                || $presensiSinkron->tgl_03 == null && strtoupper($row['3']) == 'I'
                                || $presensiSinkron->tgl_03 == null && strtoupper($row['3']) == 'DL'
                                || $presensiSinkron->tgl_03 != null && strtoupper($row['3']) != crosCekPresensi($presensiSinkron->tgl_03)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_03 = 'X';
                                $ketTidakCocok .= " 3,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_03 != null && strtoupper($row['3']) == 'X'
                                || $presensiSinkron->tgl_03 == null && strtoupper($row['3']) == 'CT'
                                || $presensiSinkron->tgl_03 == null && strtoupper($row['3']) == 'SKT'
                                || $presensiSinkron->tgl_03 == null && strtoupper($row['3']) == 'I'
                                || $presensiSinkron->tgl_03 == null && strtoupper($row['3']) == 'DL'
                                || $presensiSinkron->tgl_03 != null && strtoupper($row['3']) != crosCekPresensi($presensiSinkron->tgl_03)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_03 = 'X';
                                $ketTidakCocok .= " 3,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_03 ='X';
                    }

                    if(strtoupper($row['4']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_04 == null && strtoupper($row['4']) == 'P' 
                                || $presensiSinkron->tgl_04 != null && strtoupper($row['4']) == 'X'
                                || $presensiSinkron->tgl_04 == null && strtoupper($row['4']) == 'CT'
                                || $presensiSinkron->tgl_04 == null && strtoupper($row['4']) == 'SKT'
                                || $presensiSinkron->tgl_04 == null && strtoupper($row['4']) == 'I'
                                || $presensiSinkron->tgl_04 == null && strtoupper($row['4']) == 'DL'
                                || $presensiSinkron->tgl_04 != null && strtoupper($row['4']) != crosCekPresensi($presensiSinkron->tgl_04)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_04 = 'X';
                                $ketTidakCocok .= " 4,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_04 != null && strtoupper($row['4']) == 'X'
                                || $presensiSinkron->tgl_04 == null && strtoupper($row['4']) == 'CT'
                                || $presensiSinkron->tgl_04 == null && strtoupper($row['4']) == 'SKT'
                                || $presensiSinkron->tgl_04 == null && strtoupper($row['4']) == 'I'
                                || $presensiSinkron->tgl_04 == null && strtoupper($row['4']) == 'DL'
                                || $presensiSinkron->tgl_04 != null && strtoupper($row['4']) != crosCekPresensi($presensiSinkron->tgl_04)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_04 = 'X';
                                $ketTidakCocok .= " 4,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_04 ='X';
                    }
                    
                    if(strtoupper($row['5']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_05 == null && strtoupper($row['5']) == 'P' 
                                || $presensiSinkron->tgl_05 != null && strtoupper($row['5']) == 'X'
                                || $presensiSinkron->tgl_05 == null && strtoupper($row['5']) == 'CT'
                                || $presensiSinkron->tgl_05 == null && strtoupper($row['5']) == 'SKT'
                                || $presensiSinkron->tgl_05 == null && strtoupper($row['5']) == 'I'
                                || $presensiSinkron->tgl_05 == null && strtoupper($row['5']) == 'DL'
                                || $presensiSinkron->tgl_05 != null && strtoupper($row['5']) != crosCekPresensi($presensiSinkron->tgl_05)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_05 = 'X';
                                $ketTidakCocok .= " 5,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_05 != null && strtoupper($row['5']) == 'X'
                                || $presensiSinkron->tgl_05 == null && strtoupper($row['5']) == 'CT'
                                || $presensiSinkron->tgl_05 == null && strtoupper($row['5']) == 'SKT'
                                || $presensiSinkron->tgl_05 == null && strtoupper($row['5']) == 'I'
                                || $presensiSinkron->tgl_05 == null && strtoupper($row['5']) == 'DL'
                                || $presensiSinkron->tgl_05 != null && strtoupper($row['5']) != crosCekPresensi($presensiSinkron->tgl_05)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_05 = 'X';
                                $ketTidakCocok .= " 5,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_05 ='X';
                    }
                
                    if(strtoupper($row['6']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_06 == null && strtoupper($row['6']) == 'P' 
                                || $presensiSinkron->tgl_06 != null && strtoupper($row['6']) == 'X'
                                || $presensiSinkron->tgl_06 == null && strtoupper($row['6']) == 'CT'
                                || $presensiSinkron->tgl_06 == null && strtoupper($row['6']) == 'SKT'
                                || $presensiSinkron->tgl_06 == null && strtoupper($row['6']) == 'I'
                                || $presensiSinkron->tgl_06 == null && strtoupper($row['6']) == 'DL'
                                || $presensiSinkron->tgl_06 != null && strtoupper($row['6']) != crosCekPresensi($presensiSinkron->tgl_06)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_06 = 'X';
                                $ketTidakCocok .= " 6,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_06 != null && strtoupper($row['6']) == 'X'
                                || $presensiSinkron->tgl_06 == null && strtoupper($row['6']) == 'CT'
                                || $presensiSinkron->tgl_06 == null && strtoupper($row['6']) == 'SKT'
                                || $presensiSinkron->tgl_06 == null && strtoupper($row['6']) == 'I'
                                || $presensiSinkron->tgl_06 == null && strtoupper($row['6']) == 'DL'
                                || $presensiSinkron->tgl_06 != null && strtoupper($row['6']) != crosCekPresensi($presensiSinkron->tgl_06)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_06 = 'X';
                                $ketTidakCocok .= " 6,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_06 ='X';
                    }
                    
                    if(strtoupper($row['7']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_07 == null && strtoupper($row['7']) == 'P' 
                                || $presensiSinkron->tgl_07 != null && strtoupper($row['7']) == 'X'
                                || $presensiSinkron->tgl_07 == null && strtoupper($row['7']) == 'CT'
                                || $presensiSinkron->tgl_07 == null && strtoupper($row['7']) == 'SKT'
                                || $presensiSinkron->tgl_07 == null && strtoupper($row['7']) == 'I'
                                || $presensiSinkron->tgl_07 == null && strtoupper($row['7']) == 'DL'
                                || $presensiSinkron->tgl_07 != null && strtoupper($row['7']) != crosCekPresensi($presensiSinkron->tgl_07)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_07 = 'X';
                                $ketTidakCocok .= " 7,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_07 != null && strtoupper($row['7']) == 'X'
                                || $presensiSinkron->tgl_07 == null && strtoupper($row['7']) == 'CT'
                                || $presensiSinkron->tgl_07 == null && strtoupper($row['7']) == 'SKT'
                                || $presensiSinkron->tgl_07 == null && strtoupper($row['7']) == 'I'
                                || $presensiSinkron->tgl_07 == null && strtoupper($row['7']) == 'DL'
                                || $presensiSinkron->tgl_07 != null && strtoupper($row['7']) != crosCekPresensi($presensiSinkron->tgl_07)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_07 = 'X';
                                $ketTidakCocok .= " 7,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_07 ='X';
                    }
                    
                    if(strtoupper($row['8']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_08 == null && strtoupper($row['8']) == 'P' 
                                || $presensiSinkron->tgl_08 != null && strtoupper($row['8']) == 'X'
                                || $presensiSinkron->tgl_08 == null && strtoupper($row['8']) == 'CT'
                                || $presensiSinkron->tgl_08 == null && strtoupper($row['8']) == 'SKT'
                                || $presensiSinkron->tgl_08 == null && strtoupper($row['8']) == 'I'
                                || $presensiSinkron->tgl_08 == null && strtoupper($row['8']) == 'DL'
                                || $presensiSinkron->tgl_08 != null && strtoupper($row['8']) != crosCekPresensi($presensiSinkron->tgl_08)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_08 = 'X';
                                $ketTidakCocok .= " 8,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_08 != null && strtoupper($row['8']) == 'X'
                                || $presensiSinkron->tgl_08 == null && strtoupper($row['8']) == 'CT'
                                || $presensiSinkron->tgl_08 == null && strtoupper($row['8']) == 'SKT'
                                || $presensiSinkron->tgl_08 == null && strtoupper($row['8']) == 'I'
                                || $presensiSinkron->tgl_08 == null && strtoupper($row['8']) == 'DL'
                                || $presensiSinkron->tgl_08 != null && strtoupper($row['8']) != crosCekPresensi($presensiSinkron->tgl_08)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_08 = 'X';
                                $ketTidakCocok .= " 8,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_08 ='X';
                    }
                
                    if(strtoupper($row['9']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_09 == null && strtoupper($row['9']) == 'P' 
                                || $presensiSinkron->tgl_09 != null && strtoupper($row['9']) == 'X'
                                || $presensiSinkron->tgl_09 == null && strtoupper($row['9']) == 'CT'
                                || $presensiSinkron->tgl_09 == null && strtoupper($row['9']) == 'SKT'
                                || $presensiSinkron->tgl_09 == null && strtoupper($row['9']) == 'I'
                                || $presensiSinkron->tgl_09 == null && strtoupper($row['9']) == 'DL'
                                || $presensiSinkron->tgl_09 != null && strtoupper($row['9']) != crosCekPresensi($presensiSinkron->tgl_09)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_09 = 'X';
                                $ketTidakCocok .= " 9,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_09 != null && strtoupper($row['9']) == 'X'
                                || $presensiSinkron->tgl_09 == null && strtoupper($row['9']) == 'CT'
                                || $presensiSinkron->tgl_09 == null && strtoupper($row['9']) == 'SKT'
                                || $presensiSinkron->tgl_09 == null && strtoupper($row['9']) == 'I'
                                || $presensiSinkron->tgl_09 == null && strtoupper($row['9']) == 'DL'
                                || $presensiSinkron->tgl_09 != null && strtoupper($row['9']) != crosCekPresensi($presensiSinkron->tgl_09)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_09 = 'X';
                                $ketTidakCocok .= " 9,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_09 ='X';
                    }

                    if(strtoupper($row['10']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_10 == null && strtoupper($row['10']) == 'P' 
                                || $presensiSinkron->tgl_10 != null && strtoupper($row['10']) == 'X'
                                || $presensiSinkron->tgl_10 == null && strtoupper($row['10']) == 'CT'
                                || $presensiSinkron->tgl_10 == null && strtoupper($row['10']) == 'SKT'
                                || $presensiSinkron->tgl_10 == null && strtoupper($row['10']) == 'I'
                                || $presensiSinkron->tgl_10 == null && strtoupper($row['10']) == 'DL'
                                || $presensiSinkron->tgl_10 != null && strtoupper($row['10']) != crosCekPresensi($presensiSinkron->tgl_10)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_10 = 'X';
                                $ketTidakCocok .= " 10,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_10 != null && strtoupper($row['10']) == 'X'
                                || $presensiSinkron->tgl_10 == null && strtoupper($row['10']) == 'CT'
                                || $presensiSinkron->tgl_10 == null && strtoupper($row['10']) == 'SKT'
                                || $presensiSinkron->tgl_10 == null && strtoupper($row['10']) == 'I'
                                || $presensiSinkron->tgl_10 == null && strtoupper($row['10']) == 'DL'
                                || $presensiSinkron->tgl_10 != null && strtoupper($row['10']) != crosCekPresensi($presensiSinkron->tgl_10)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_10 = 'X';
                                $ketTidakCocok .= " 10,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_10 ='X';
                    }
                
                    if(strtoupper($row['11']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_11 == null && strtoupper($row['11']) == 'P' 
                                || $presensiSinkron->tgl_11 != null && strtoupper($row['11']) == 'X'
                                || $presensiSinkron->tgl_11 == null && strtoupper($row['11']) == 'CT'
                                || $presensiSinkron->tgl_11 == null && strtoupper($row['11']) == 'SKT'
                                || $presensiSinkron->tgl_11 == null && strtoupper($row['11']) == 'I'
                                || $presensiSinkron->tgl_11 == null && strtoupper($row['11']) == 'DL'
                                || $presensiSinkron->tgl_11 != null && strtoupper($row['11']) != crosCekPresensi($presensiSinkron->tgl_11)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_11 = 'X';
                                $ketTidakCocok .= " 11,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_11 != null && strtoupper($row['11']) == 'X'
                                || $presensiSinkron->tgl_11 == null && strtoupper($row['11']) == 'CT'
                                || $presensiSinkron->tgl_11 == null && strtoupper($row['11']) == 'SKT'
                                || $presensiSinkron->tgl_11 == null && strtoupper($row['11']) == 'I'
                                || $presensiSinkron->tgl_11 == null && strtoupper($row['11']) == 'DL'
                                || $presensiSinkron->tgl_11 != null && strtoupper($row['11']) != crosCekPresensi($presensiSinkron->tgl_11)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_11 = 'X';
                                $ketTidakCocok .= " 11,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_11 ='X';
                    }

                    if(strtoupper($row['12']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_12 == null && strtoupper($row['12']) == 'P' 
                                || $presensiSinkron->tgl_12 != null && strtoupper($row['12']) == 'X'
                                || $presensiSinkron->tgl_12 == null && strtoupper($row['12']) == 'CT'
                                || $presensiSinkron->tgl_12 == null && strtoupper($row['12']) == 'SKT'
                                || $presensiSinkron->tgl_12 == null && strtoupper($row['12']) == 'I'
                                || $presensiSinkron->tgl_12 == null && strtoupper($row['12']) == 'DL'
                                || $presensiSinkron->tgl_12 != null && strtoupper($row['12']) != crosCekPresensi($presensiSinkron->tgl_12)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_12 = 'X';
                                $ketTidakCocok .= " 12,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_12 != null && strtoupper($row['12']) == 'X'
                                || $presensiSinkron->tgl_12 == null && strtoupper($row['12']) == 'CT'
                                || $presensiSinkron->tgl_12 == null && strtoupper($row['12']) == 'SKT'
                                || $presensiSinkron->tgl_12 == null && strtoupper($row['12']) == 'I'
                                || $presensiSinkron->tgl_12 == null && strtoupper($row['12']) == 'DL'
                                || $presensiSinkron->tgl_12 != null && strtoupper($row['12']) != crosCekPresensi($presensiSinkron->tgl_12)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_12 = 'X';
                                $ketTidakCocok .= " 12,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_12 ='X';
                    } 

                    if(strtoupper($row['13']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_13 == null && strtoupper($row['13']) == 'P' 
                                || $presensiSinkron->tgl_13 != null && strtoupper($row['13']) == 'X'
                                || $presensiSinkron->tgl_13 == null && strtoupper($row['13']) == 'CT'
                                || $presensiSinkron->tgl_13 == null && strtoupper($row['13']) == 'SKT'
                                || $presensiSinkron->tgl_13 == null && strtoupper($row['13']) == 'I'
                                || $presensiSinkron->tgl_13 == null && strtoupper($row['13']) == 'DL'
                                || $presensiSinkron->tgl_13 != null && strtoupper($row['13']) != crosCekPresensi($presensiSinkron->tgl_13)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_13 = 'X';
                                $ketTidakCocok .= " 13,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_13 != null && strtoupper($row['13']) == 'X'
                                || $presensiSinkron->tgl_13 == null && strtoupper($row['13']) == 'CT'
                                || $presensiSinkron->tgl_13 == null && strtoupper($row['13']) == 'SKT'
                                || $presensiSinkron->tgl_13 == null && strtoupper($row['13']) == 'I'
                                || $presensiSinkron->tgl_13 == null && strtoupper($row['13']) == 'DL'
                                || $presensiSinkron->tgl_13 != null && strtoupper($row['13']) != crosCekPresensi($presensiSinkron->tgl_13)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_13 = 'X';
                                $ketTidakCocok .= " 13,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_13 ='X';
                    }

                    if(strtoupper($row['14']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_14 == null && strtoupper($row['14']) == 'P' 
                                || $presensiSinkron->tgl_14 != null && strtoupper($row['14']) == 'X'
                                || $presensiSinkron->tgl_14 == null && strtoupper($row['14']) == 'CT'
                                || $presensiSinkron->tgl_14 == null && strtoupper($row['14']) == 'SKT'
                                || $presensiSinkron->tgl_14 == null && strtoupper($row['14']) == 'I'
                                || $presensiSinkron->tgl_14 == null && strtoupper($row['14']) == 'DL'
                                || $presensiSinkron->tgl_14 != null && strtoupper($row['14']) != crosCekPresensi($presensiSinkron->tgl_14)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_14 = 'X';
                                $ketTidakCocok .= " 14,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_14 != null && strtoupper($row['14']) == 'X'
                                || $presensiSinkron->tgl_14 == null && strtoupper($row['14']) == 'CT'
                                || $presensiSinkron->tgl_14 == null && strtoupper($row['14']) == 'SKT'
                                || $presensiSinkron->tgl_14 == null && strtoupper($row['14']) == 'I'
                                || $presensiSinkron->tgl_14 == null && strtoupper($row['14']) == 'DL'
                                || $presensiSinkron->tgl_14 != null && strtoupper($row['14']) != crosCekPresensi($presensiSinkron->tgl_14)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_14 = 'X';
                                $ketTidakCocok .= " 14,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_14 ='X';
                    }

                    if(strtoupper($row['15']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_15 == null && strtoupper($row['15']) == 'P' 
                                || $presensiSinkron->tgl_15 != null && strtoupper($row['15']) == 'X'
                                || $presensiSinkron->tgl_15 == null && strtoupper($row['15']) == 'CT'
                                || $presensiSinkron->tgl_15 == null && strtoupper($row['15']) == 'SKT'
                                || $presensiSinkron->tgl_15 == null && strtoupper($row['15']) == 'I'
                                || $presensiSinkron->tgl_15 == null && strtoupper($row['15']) == 'DL'
                                || $presensiSinkron->tgl_15 != null && strtoupper($row['15']) != crosCekPresensi($presensiSinkron->tgl_15)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_15 = 'X';
                                $ketTidakCocok .= " 15,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_15 != null && strtoupper($row['15']) == 'X'
                                || $presensiSinkron->tgl_15 == null && strtoupper($row['15']) == 'CT'
                                || $presensiSinkron->tgl_15 == null && strtoupper($row['15']) == 'SKT'
                                || $presensiSinkron->tgl_15 == null && strtoupper($row['15']) == 'I'
                                || $presensiSinkron->tgl_15 == null && strtoupper($row['15']) == 'DL'
                                || $presensiSinkron->tgl_15 != null && strtoupper($row['15']) != crosCekPresensi($presensiSinkron->tgl_15)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_15 = 'X';
                                $ketTidakCocok .= " 15,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_15 ='X';
                    }
                
                    if(strtoupper($row['16']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_16 == null && strtoupper($row['16']) == 'P' 
                                || $presensiSinkron->tgl_16 != null && strtoupper($row['16']) == 'X'
                                || $presensiSinkron->tgl_16 == null && strtoupper($row['16']) == 'CT'
                                || $presensiSinkron->tgl_16 == null && strtoupper($row['16']) == 'SKT'
                                || $presensiSinkron->tgl_16 == null && strtoupper($row['16']) == 'I'
                                || $presensiSinkron->tgl_16 == null && strtoupper($row['16']) == 'DL'
                                || $presensiSinkron->tgl_16 != null && strtoupper($row['16']) != crosCekPresensi($presensiSinkron->tgl_16)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_16 = 'X';
                                $ketTidakCocok .= " 16,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_16 != null && strtoupper($row['16']) == 'X'
                                || $presensiSinkron->tgl_16 == null && strtoupper($row['16']) == 'CT'
                                || $presensiSinkron->tgl_16 == null && strtoupper($row['16']) == 'SKT'
                                || $presensiSinkron->tgl_16 == null && strtoupper($row['16']) == 'I'
                                || $presensiSinkron->tgl_16 == null && strtoupper($row['16']) == 'DL'
                                || $presensiSinkron->tgl_16 != null && strtoupper($row['16']) != crosCekPresensi($presensiSinkron->tgl_16)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_16 = 'X';
                                $ketTidakCocok .= " 16,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_16 ='X';
                    }
                
                    if(strtoupper($row['17']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_17 == null && strtoupper($row['17']) == 'P' 
                                || $presensiSinkron->tgl_17 != null && strtoupper($row['17']) == 'X'
                                || $presensiSinkron->tgl_17 == null && strtoupper($row['17']) == 'CT'
                                || $presensiSinkron->tgl_17 == null && strtoupper($row['17']) == 'SKT'
                                || $presensiSinkron->tgl_17 == null && strtoupper($row['17']) == 'I'
                                || $presensiSinkron->tgl_17 == null && strtoupper($row['17']) == 'DL'
                                || $presensiSinkron->tgl_17 != null && strtoupper($row['17']) != crosCekPresensi($presensiSinkron->tgl_17)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_17 = 'X';
                                $ketTidakCocok .= " 17,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_17 != null && strtoupper($row['17']) == 'X'
                                || $presensiSinkron->tgl_17 == null && strtoupper($row['17']) == 'CT'
                                || $presensiSinkron->tgl_17 == null && strtoupper($row['17']) == 'SKT'
                                || $presensiSinkron->tgl_17 == null && strtoupper($row['17']) == 'I'
                                || $presensiSinkron->tgl_17 == null && strtoupper($row['17']) == 'DL'
                                || $presensiSinkron->tgl_17 != null && strtoupper($row['17']) != crosCekPresensi($presensiSinkron->tgl_17)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_17 = 'X';
                                $ketTidakCocok .= " 17,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_17 ='X';
                    }

                    if(strtoupper($row['18']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_18 == null && strtoupper($row['18']) == 'P' 
                                || $presensiSinkron->tgl_18 != null && strtoupper($row['18']) == 'X'
                                || $presensiSinkron->tgl_18 == null && strtoupper($row['18']) == 'CT'
                                || $presensiSinkron->tgl_18 == null && strtoupper($row['18']) == 'SKT'
                                || $presensiSinkron->tgl_18 == null && strtoupper($row['18']) == 'I'
                                || $presensiSinkron->tgl_18 == null && strtoupper($row['18']) == 'DL'
                                || $presensiSinkron->tgl_18 != null && strtoupper($row['18']) != crosCekPresensi($presensiSinkron->tgl_18)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_18 = 'X';
                                $ketTidakCocok .= " 18,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_18 != null && strtoupper($row['18']) == 'X'
                                || $presensiSinkron->tgl_18 == null && strtoupper($row['18']) == 'CT'
                                || $presensiSinkron->tgl_18 == null && strtoupper($row['18']) == 'SKT'
                                || $presensiSinkron->tgl_18 == null && strtoupper($row['18']) == 'I'
                                || $presensiSinkron->tgl_18 == null && strtoupper($row['18']) == 'DL'
                                || $presensiSinkron->tgl_18 != null && strtoupper($row['18']) != crosCekPresensi($presensiSinkron->tgl_18)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_18 = 'X';
                                $ketTidakCocok .= " 18,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_18 ='X';
                    }
                    
                    if(strtoupper($row['19']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_19 == null && strtoupper($row['19']) == 'P' 
                                || $presensiSinkron->tgl_19 != null && strtoupper($row['19']) == 'X'
                                || $presensiSinkron->tgl_19 == null && strtoupper($row['19']) == 'CT'
                                || $presensiSinkron->tgl_19 == null && strtoupper($row['19']) == 'SKT'
                                || $presensiSinkron->tgl_19 == null && strtoupper($row['19']) == 'I'
                                || $presensiSinkron->tgl_19 == null && strtoupper($row['19']) == 'DL'
                                || $presensiSinkron->tgl_19 != null && strtoupper($row['19']) != crosCekPresensi($presensiSinkron->tgl_19)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_19 = 'X';
                                $ketTidakCocok .= " 19,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_19 != null && strtoupper($row['19']) == 'X'
                                || $presensiSinkron->tgl_19 == null && strtoupper($row['19']) == 'CT'
                                || $presensiSinkron->tgl_19 == null && strtoupper($row['19']) == 'SKT'
                                || $presensiSinkron->tgl_19 == null && strtoupper($row['19']) == 'I'
                                || $presensiSinkron->tgl_19 == null && strtoupper($row['19']) == 'DL'
                                || $presensiSinkron->tgl_19 != null && strtoupper($row['19']) != crosCekPresensi($presensiSinkron->tgl_19)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_19 = 'X';
                                $ketTidakCocok .= " 19,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_19 ='X';
                    }
                
                    if(strtoupper($row['20']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_20 == null && strtoupper($row['20']) == 'P' 
                                || $presensiSinkron->tgl_20 != null && strtoupper($row['20']) == 'X'
                                || $presensiSinkron->tgl_20 == null && strtoupper($row['20']) == 'CT'
                                || $presensiSinkron->tgl_20 == null && strtoupper($row['20']) == 'SKT'
                                || $presensiSinkron->tgl_20 == null && strtoupper($row['20']) == 'I'
                                || $presensiSinkron->tgl_20 == null && strtoupper($row['20']) == 'DL'
                                || $presensiSinkron->tgl_20 != null && strtoupper($row['20']) != crosCekPresensi($presensiSinkron->tgl_20)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_20 = 'X';
                                $ketTidakCocok .= " 20,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_20 != null && strtoupper($row['20']) == 'X'
                                || $presensiSinkron->tgl_20 == null && strtoupper($row['20']) == 'CT'
                                || $presensiSinkron->tgl_20 == null && strtoupper($row['20']) == 'SKT'
                                || $presensiSinkron->tgl_20 == null && strtoupper($row['20']) == 'I'
                                || $presensiSinkron->tgl_20 == null && strtoupper($row['20']) == 'DL'
                                || $presensiSinkron->tgl_20 != null && strtoupper($row['20']) != crosCekPresensi($presensiSinkron->tgl_20)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_20 = 'X';
                                $ketTidakCocok .= " 20,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_20 ='X';
                    }
                
                    if(strtoupper($row['21']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_21 == null && strtoupper($row['21']) == 'P' 
                                || $presensiSinkron->tgl_21 != null && strtoupper($row['21']) == 'X'
                                || $presensiSinkron->tgl_21 == null && strtoupper($row['21']) == 'CT'
                                || $presensiSinkron->tgl_21 == null && strtoupper($row['21']) == 'SKT'
                                || $presensiSinkron->tgl_21 == null && strtoupper($row['21']) == 'I'
                                || $presensiSinkron->tgl_21 == null && strtoupper($row['21']) == 'DL'
                                || $presensiSinkron->tgl_21 != null && strtoupper($row['21']) != crosCekPresensi($presensiSinkron->tgl_21)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_21 = 'X';
                                $ketTidakCocok .= " 21,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_21 != null && strtoupper($row['21']) == 'X'
                                || $presensiSinkron->tgl_21 == null && strtoupper($row['21']) == 'CT'
                                || $presensiSinkron->tgl_21 == null && strtoupper($row['21']) == 'SKT'
                                || $presensiSinkron->tgl_21 == null && strtoupper($row['21']) == 'I'
                                || $presensiSinkron->tgl_21 == null && strtoupper($row['21']) == 'DL'
                                || $presensiSinkron->tgl_21 != null && strtoupper($row['21']) != crosCekPresensi($presensiSinkron->tgl_21)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_21 = 'X';
                                $ketTidakCocok .= " 21,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_21 ='X';
                    }
                
                    if(strtoupper($row['22']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_22 == null && strtoupper($row['22']) == 'P' 
                                || $presensiSinkron->tgl_22 != null && strtoupper($row['22']) == 'X'
                                || $presensiSinkron->tgl_22 == null && strtoupper($row['22']) == 'CT'
                                || $presensiSinkron->tgl_22 == null && strtoupper($row['22']) == 'SKT'
                                || $presensiSinkron->tgl_22 == null && strtoupper($row['22']) == 'I'
                                || $presensiSinkron->tgl_22 == null && strtoupper($row['22']) == 'DL'
                                || $presensiSinkron->tgl_22 != null && strtoupper($row['22']) != crosCekPresensi($presensiSinkron->tgl_22)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_22 = 'X';
                                $ketTidakCocok .= " 22,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_22 != null && strtoupper($row['22']) == 'X'
                                || $presensiSinkron->tgl_22 == null && strtoupper($row['22']) == 'CT'
                                || $presensiSinkron->tgl_22 == null && strtoupper($row['22']) == 'SKT'
                                || $presensiSinkron->tgl_22 == null && strtoupper($row['22']) == 'I'
                                || $presensiSinkron->tgl_22 == null && strtoupper($row['22']) == 'DL'
                                || $presensiSinkron->tgl_22 != null && strtoupper($row['22']) != crosCekPresensi($presensiSinkron->tgl_22)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_22 = 'X';
                                $ketTidakCocok .= " 22,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_22 ='X';
                    }
                
                    if(strtoupper($row['23']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_23 == null && strtoupper($row['23']) == 'P' 
                                || $presensiSinkron->tgl_23 != null && strtoupper($row['23']) == 'X'
                                || $presensiSinkron->tgl_23 == null && strtoupper($row['23']) == 'CT'
                                || $presensiSinkron->tgl_23 == null && strtoupper($row['23']) == 'SKT'
                                || $presensiSinkron->tgl_23 == null && strtoupper($row['23']) == 'I'
                                || $presensiSinkron->tgl_23 == null && strtoupper($row['23']) == 'DL'
                                || $presensiSinkron->tgl_23 != null && strtoupper($row['23']) != crosCekPresensi($presensiSinkron->tgl_23)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_23 = 'X';
                                $ketTidakCocok .= " 23,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_23 != null && strtoupper($row['23']) == 'X'
                                || $presensiSinkron->tgl_23 == null && strtoupper($row['23']) == 'CT'
                                || $presensiSinkron->tgl_23 == null && strtoupper($row['23']) == 'SKT'
                                || $presensiSinkron->tgl_23 == null && strtoupper($row['23']) == 'I'
                                || $presensiSinkron->tgl_23 == null && strtoupper($row['23']) == 'DL'
                                || $presensiSinkron->tgl_23 != null && strtoupper($row['23']) != crosCekPresensi($presensiSinkron->tgl_23)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_23 = 'X';
                                $ketTidakCocok .= " 23,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_23 ='X';
                    }
                
                    if(strtoupper($row['24']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_24 == null && strtoupper($row['24']) == 'P' 
                                || $presensiSinkron->tgl_24 != null && strtoupper($row['24']) == 'X'
                                || $presensiSinkron->tgl_24 == null && strtoupper($row['24']) == 'CT'
                                || $presensiSinkron->tgl_24 == null && strtoupper($row['24']) == 'SKT'
                                || $presensiSinkron->tgl_24 == null && strtoupper($row['24']) == 'I'
                                || $presensiSinkron->tgl_24 == null && strtoupper($row['24']) == 'DL'
                                || $presensiSinkron->tgl_24 != null && strtoupper($row['24']) != crosCekPresensi($presensiSinkron->tgl_24)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_24 = 'X';
                                $ketTidakCocok .= " 24,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_24 != null && strtoupper($row['24']) == 'X'
                                || $presensiSinkron->tgl_24 == null && strtoupper($row['24']) == 'CT'
                                || $presensiSinkron->tgl_24 == null && strtoupper($row['24']) == 'SKT'
                                || $presensiSinkron->tgl_24 == null && strtoupper($row['24']) == 'I'
                                || $presensiSinkron->tgl_24 == null && strtoupper($row['24']) == 'DL'
                                || $presensiSinkron->tgl_24 != null && strtoupper($row['24']) != crosCekPresensi($presensiSinkron->tgl_24)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_24 = 'X';
                                $ketTidakCocok .= " 24,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_24 ='X';
                    }
                    
                    if(strtoupper($row['25']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_25 == null && strtoupper($row['25']) == 'P' 
                                || $presensiSinkron->tgl_25 != null && strtoupper($row['25']) == 'X'
                                || $presensiSinkron->tgl_25 == null && strtoupper($row['25']) == 'CT'
                                || $presensiSinkron->tgl_25 == null && strtoupper($row['25']) == 'SKT'
                                || $presensiSinkron->tgl_25 == null && strtoupper($row['25']) == 'I'
                                || $presensiSinkron->tgl_25 == null && strtoupper($row['25']) == 'DL'
                                || $presensiSinkron->tgl_25 != null && strtoupper($row['25']) != crosCekPresensi($presensiSinkron->tgl_25)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_25 = 'X';
                                $ketTidakCocok .= " 25,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_25 != null && strtoupper($row['25']) == 'X'
                                || $presensiSinkron->tgl_25 == null && strtoupper($row['25']) == 'CT'
                                || $presensiSinkron->tgl_25 == null && strtoupper($row['25']) == 'SKT'
                                || $presensiSinkron->tgl_25 == null && strtoupper($row['25']) == 'I'
                                || $presensiSinkron->tgl_25 == null && strtoupper($row['25']) == 'DL'
                                || $presensiSinkron->tgl_25 != null && strtoupper($row['25']) != crosCekPresensi($presensiSinkron->tgl_25)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_25 = 'X';
                                $ketTidakCocok .= " 25,";
                            }
                        }
                    }else{
                        $presensiSinkron->tgl_25 ='X';
                    }
                    
                    if(strtoupper($row['26']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_26 == null && strtoupper($row['26']) == 'P' 
                                || $presensiSinkron->tgl_26 != null && strtoupper($row['26']) == 'X'
                                || $presensiSinkron->tgl_26 == null && strtoupper($row['26']) == 'CT'
                                || $presensiSinkron->tgl_26 == null && strtoupper($row['26']) == 'SKT'
                                || $presensiSinkron->tgl_26 == null && strtoupper($row['26']) == 'I'
                                || $presensiSinkron->tgl_26 == null && strtoupper($row['26']) == 'DL'
                                || $presensiSinkron->tgl_26 != null && strtoupper($row['26']) != crosCekPresensi($presensiSinkron->tgl_26)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_26 = 'X';
                                $ketTidakCocok .= " 26,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_26 != null && strtoupper($row['26']) == 'X'
                                || $presensiSinkron->tgl_26 == null && strtoupper($row['26']) == 'CT'
                                || $presensiSinkron->tgl_26 == null && strtoupper($row['26']) == 'SKT'
                                || $presensiSinkron->tgl_26 == null && strtoupper($row['26']) == 'I'
                                || $presensiSinkron->tgl_26 == null && strtoupper($row['26']) == 'DL'
                                || $presensiSinkron->tgl_26 != null && strtoupper($row['26']) != crosCekPresensi($presensiSinkron->tgl_26)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_26 = 'X';
                                $ketTidakCocok .= " 26,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_26 ='X';
                    }
                
                    if(strtoupper($row['27']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_27 == null && strtoupper($row['27']) == 'P' 
                                || $presensiSinkron->tgl_27 != null && strtoupper($row['27']) == 'X'
                                || $presensiSinkron->tgl_27 == null && strtoupper($row['27']) == 'CT'
                                || $presensiSinkron->tgl_27 == null && strtoupper($row['27']) == 'SKT'
                                || $presensiSinkron->tgl_27 == null && strtoupper($row['27']) == 'I'
                                || $presensiSinkron->tgl_27 == null && strtoupper($row['27']) == 'DL'
                                || $presensiSinkron->tgl_27 != null && strtoupper($row['27']) != crosCekPresensi($presensiSinkron->tgl_27)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_27 = 'X';
                                $ketTidakCocok .= " 27,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_27 != null && strtoupper($row['27']) == 'X'
                                || $presensiSinkron->tgl_27 == null && strtoupper($row['27']) == 'CT'
                                || $presensiSinkron->tgl_27 == null && strtoupper($row['27']) == 'SKT'
                                || $presensiSinkron->tgl_27 == null && strtoupper($row['27']) == 'I'
                                || $presensiSinkron->tgl_27 == null && strtoupper($row['27']) == 'DL'
                                || $presensiSinkron->tgl_27 != null && strtoupper($row['27']) != crosCekPresensi($presensiSinkron->tgl_27)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_27 = 'X';
                                $ketTidakCocok .= " 27,";
                            }
                        }
                    }else{
                        $presensiSinkron->hasil_tgl_27 ='X';
                    }
                
                    if(strtoupper($row['28']) !='X' ){
                        if($tipePegawai->statusShift == 0){
                            if($presensiSinkron->tgl_28 == null && strtoupper($row['28']) == 'P' 
                                || $presensiSinkron->tgl_28 != null && strtoupper($row['28']) == 'X'
                                || $presensiSinkron->tgl_28 == null && strtoupper($row['28']) == 'CT'
                                || $presensiSinkron->tgl_28 == null && strtoupper($row['28']) == 'SKT'
                                || $presensiSinkron->tgl_28 == null && strtoupper($row['28']) == 'I'
                                || $presensiSinkron->tgl_28 == null && strtoupper($row['28']) == 'DL'
                                || $presensiSinkron->tgl_28 != null && strtoupper($row['28']) != crosCekPresensi($presensiSinkron->tgl_28)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_28 = 'X';
                                $ketTidakCocok .= " 28,";
                            } 
                        }
                        else{
                            if($presensiSinkron->tgl_28 != null && strtoupper($row['28']) == 'X'
                                || $presensiSinkron->tgl_28 == null && strtoupper($row['28']) == 'CT'
                                || $presensiSinkron->tgl_28 == null && strtoupper($row['28']) == 'SKT'
                                || $presensiSinkron->tgl_28 == null && strtoupper($row['28']) == 'I'
                                || $presensiSinkron->tgl_28 == null && strtoupper($row['28']) == 'DL'
                                || $presensiSinkron->tgl_28 != null && strtoupper($row['28']) != crosCekPresensi($presensiSinkron->tgl_28)){
                                $tidakCocok = $tidakCocok + 1;
                                $presensiSinkron->hasil_tgl_28 = 'X';
                                $ketTidakCocok .= " 28,";
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
                                    || $presensiSinkron->tgl_29 == null && strtoupper($row['29']) == 'CT'
                                    || $presensiSinkron->tgl_29 == null && strtoupper($row['29']) == 'SKT'
                                    || $presensiSinkron->tgl_29 == null && strtoupper($row['29']) == 'I'
                                    || $presensiSinkron->tgl_29 == null && strtoupper($row['29']) == 'DL'
                                    || $presensiSinkron->tgl_29 != null && strtoupper($row['29']) != crosCekPresensi($presensiSinkron->tgl_29)){
                                    $tidakCocok = $tidakCocok + 1;
                                    $presensiSinkron->hasil_tgl_29 = 'X';
                                    $ketTidakCocok .= " 29,";
                                } 
                            }
                            else{
                                if($presensiSinkron->tgl_29 != null && strtoupper($row['29']) == 'X'
                                    || $presensiSinkron->tgl_29 == null && strtoupper($row['29']) == 'CT'
                                    || $presensiSinkron->tgl_29 == null && strtoupper($row['29']) == 'SKT'
                                    || $presensiSinkron->tgl_29 == null && strtoupper($row['29']) == 'I'
                                    || $presensiSinkron->tgl_29 == null && strtoupper($row['29']) == 'DL'
                                    || $presensiSinkron->tgl_29 != null && strtoupper($row['29']) != crosCekPresensi($presensiSinkron->tgl_29)){
                                    $tidakCocok = $tidakCocok + 1;
                                    $presensiSinkron->hasil_tgl_29 = 'X';
                                    $ketTidakCocok .= " 29,";
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
                                        || $presensiSinkron->tgl_30 == null && strtoupper($row['30']) == 'CT'
                                        || $presensiSinkron->tgl_30 == null && strtoupper($row['30']) == 'SKT'
                                        || $presensiSinkron->tgl_30 == null && strtoupper($row['30']) == 'I'
                                        || $presensiSinkron->tgl_30 == null && strtoupper($row['30']) == 'DL'
                                        || $presensiSinkron->tgl_30 != null && strtoupper($row['30']) != crosCekPresensi($presensiSinkron->tgl_30)){
                                        $tidakCocok = $tidakCocok + 1;
                                        $presensiSinkron->hasil_tgl_30 = 'X';
                                        $ketTidakCocok .= " 30,";
                                    } 
                                }
                                else{
                                    if($presensiSinkron->tgl_30 != null && strtoupper($row['30']) == 'X'
                                        || $presensiSinkron->tgl_30 == null && strtoupper($row['30']) == 'CT'
                                        || $presensiSinkron->tgl_30 == null && strtoupper($row['30']) == 'SKT'
                                        || $presensiSinkron->tgl_30 == null && strtoupper($row['30']) == 'I'
                                        || $presensiSinkron->tgl_30 == null && strtoupper($row['30']) == 'DL'
                                        || $presensiSinkron->tgl_30 != null && strtoupper($row['30']) != crosCekPresensi($presensiSinkron->tgl_30)){
                                        $tidakCocok = $tidakCocok + 1;
                                        $presensiSinkron->hasil_tgl_30 = 'X';
                                        $ketTidakCocok .= " 30,";
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
                                            || $presensiSinkron->tgl_31 == null && strtoupper($row['31']) == 'CT'
                                            || $presensiSinkron->tgl_31 == null && strtoupper($row['31']) == 'SKT'
                                            || $presensiSinkron->tgl_31 == null && strtoupper($row['31']) == 'I'
                                            || $presensiSinkron->tgl_31 == null && strtoupper($row['31']) == 'DL'
                                            || $presensiSinkron->tgl_31 != null && strtoupper($row['31']) != crosCekPresensi($presensiSinkron->tgl_31)){
                                            $tidakCocok = $tidakCocok + 1;
                                            $presensiSinkron->hasil_tgl_31 = 'X';
                                            $ketTidakCocok .= " 31,";
                                        } 
                                    }
                                    else{
                                        if($presensiSinkron->tgl_31 != null && strtoupper($row['31']) == 'X'
                                            || $presensiSinkron->tgl_31 == null && strtoupper($row['31']) == 'CT'
                                            || $presensiSinkron->tgl_31 == null && strtoupper($row['31']) == 'SKT'
                                            || $presensiSinkron->tgl_31 == null && strtoupper($row['31']) == 'I'
                                            || $presensiSinkron->tgl_31 == null && strtoupper($row['31']) == 'DL'
                                            || $presensiSinkron->tgl_31 != null && strtoupper($row['31']) != crosCekPresensi($presensiSinkron->tgl_31)){
                                            $tidakCocok = $tidakCocok + 1;
                                            $presensiSinkron->hasil_tgl_31 = 'X';
                                            $ketTidakCocok .= " 31,";
                                        }
                                    }
                                }else{
                                    $presensiSinkron->hasil_tgl_31 ='X';
                                }
                            }
                        }
                    }
                $presensiSinkron->status = 1;
                $presensiSinkron->keterangan = 'Terdapat '.$tidakCocok.' data yang tidak sama '.$ketTidakCocok;
                $presensiSinkron->save(); 
            }
        });
        return redirect()->back()->with('success', 'Sinkronisasi Hasil Presensi Berhasil');
    }

}
