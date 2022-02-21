<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PresensiCroscheckImport;
use App\Models\PresensiCroscheck;
use App\Models\Pegawai;
use DB;

class PresensiController extends Controller
{
    
    public function crosCheckView()
    {
        return view('pages.croscheck.index_croscheck');
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
                
                    if(strtoupper($row['1']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_01 = 'L';
                    }

                    if(strtoupper($row['2']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_02 = 'L';
                    }

                    if(strtoupper($row['3']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_03 = 'L';
                    }

                    if(strtoupper($row['4']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_04 = 'L';
                    }
                    
                    if(strtoupper($row['5']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_05 = 'L';
                    }
                
                    if(strtoupper($row['6']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_06 = 'L';
                    }
                    
                    if(strtoupper($row['7']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_07 = 'L';
                    }
                    
                    if(strtoupper($row['8']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_08 = 'L';
                    }
                
                    if(strtoupper($row['9']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_09 = 'L';
                    }

                    if(strtoupper($row['10']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_10 = 'L';
                    }
                
                    if(strtoupper($row['11']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_11 = 'L';
                    }

                    if(strtoupper($row['12']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_12 = 'L';
                    } 

                    if(strtoupper($row['13']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_13 = 'L';
                    }

                    if(strtoupper($row['14']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_14 = 'L';
                    }

                    if(strtoupper($row['15']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_15 = 'L';
                    }
                
                    if(strtoupper($row['16']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_16 = 'L';
                    }
                
                    if(strtoupper($row['17']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_17 = 'L';
                    }

                    if(strtoupper($row['18']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_18 = 'L';
                    }
                    
                    if(strtoupper($row['19']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_19 = 'L';
                    }
                
                    if(strtoupper($row['20']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_20 = 'L';
                    }
                
                    if(strtoupper($row['21']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_21 = 'L';
                    }
                
                    if(strtoupper($row['22']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_22 = 'L';
                    }
                
                    if(strtoupper($row['23']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_23 = 'L';
                    }
                
                    if(strtoupper($row['24']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_24 = 'L';
                    }
                    
                    if(strtoupper($row['25']) != 'L' ){
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
                        $presensiSinkron->tgl_25 = 'L';
                    }
                    
                    if(strtoupper($row['26']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_26 = 'L';
                    }
                
                    if(strtoupper($row['27']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_27 = 'L';
                    }
                
                    if(strtoupper($row['28']) != 'L' ){
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
                        $presensiSinkron->hasil_tgl_28 = 'L';
                    }
                
                    if($lamaHari > 28){
                        if(strtoupper($row['29']) != 'L' ){
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
                            $presensiSinkron->hasil_tgl_29 = 'L';
                        } 

                        if($lamaHari > 29){
                            if(strtoupper($row['30']) != 'L' ){
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
                                $presensiSinkron->hasil_tgl_30 = 'L';
                            }

                            if($lamaHari > 31){
                                if(strtoupper($row['31']) != 'L' ){
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
                                    $presensiSinkron->hasil_tgl_31 = 'L';
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
