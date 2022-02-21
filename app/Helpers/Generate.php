<?php

use Illuminate\Support\Str;
use App\Models\Pegawai;

function genKodePegawai() {
    $count = Pegawai::count();
    $ulang = false;
    do{
        if($count > 0){
            $lastRecord = Pegawai::orderBy('id', 'desc')->first();
            $kodeLama = $lastRecord->code;
            $getKodeAwal = substr($kodeLama, 0, 3);
            if($getKodeAwal == 'PEG'){
                $kodeBelakang = $count + 1;
                if(strlen($kodeBelakang) == 1){
                    $kodeBelakang = '00'.$kodeBelakang;
                }else if(strlen($kodeBelakang) == 2){
                    $kodeBelakang = '0'.$kodeBelakang;
                }
            }
        }else{
            $kodeBelakang = '001';
        }
        $kodeBaru = 'PEG'.$kodeBelakang;
        $cekKode = Pegawai::where('code', $kodeBaru)->count();
        if($cekKode > 0){
            $ulang = true;
        }else{
            $ulang = false;
        }
    }while($ulang);
    return $kodeBaru;
}

function getKodePresensi() {
    return Str::random(16);
}

function getKodeJamKerja() {
    return Str::random(16);
}