<?php

use App\Models\Presensi;

function cekPresensiMasuk($pegawaiCode, $tanggal) 
{
    $count = Presensi::where('pegawai_code', $pegawaiCode)
        ->where('tanggal_presensi', $tanggal)
        ->where('presensi_masuk', '<>', null)
        ->count();
    if ($count > 0){
        $state = "Sudah";
    }else{
        $state = "Belum";
    }
    return $state;
}


function cekPresensiPulang($pegawaiCode, $tanggal) 
{
    $count = Presensi::where('pegawai_code', $pegawaiCode)
        ->where('tanggal_presensi', $tanggal)
        ->where('presensi_pulang', '<>', null)
        ->count();
    if ($count > 0){
        $state = "Sudah";   
    }else{
        $state = "Belum";
    }
    return $state;
}