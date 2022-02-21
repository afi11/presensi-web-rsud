<?php

use App\Models\Presensi;
use App\Models\RuleTelat;

function cekPresensiMasuk($pegawaiCode) 
{
    $masuk = Presensi::where('pegawaiCode', $pegawaiCode)
        ->where('statusPresensi', 0)
        ->orderBy('created_at', 'DESC')
        ->first();
    return $masuk;
}


function cekPresensiPulang($pegawaiCode, $activityCode) 
{
    $pulang = Presensi::where('pegawaiCode', $pegawaiCode)
        ->where('activityCode', $activityCode)
        ->where('statusPresensi', 1)
        ->orderBy('created_at', 'DESC')
        ->first();
    return $pulang;
}

function getLatestPresensi($pegawaiCode)
{
    $presensi = Presensi::where('pegawaiCode', $pegawaiCode)
        ->orderBy('created_at', 'DESC')
        ->first();
    return $presensi;
}

function getStatusTelat($tipePresensi, $nTelat)
{
    $ruleTelat = RuleTelat::all();
    $idRuleTelat = 0;
    foreach($ruleTelat as $row){
        if($tipePresensi == 'jam-masuk'){
            if($nTelat <= $row->maxTelatMasuk){
                $idRuleTelat = $row->id;
                break;
            }
        }else if($tipePresensi == 'jam-pulang'){
            if($nTelat <= $row->maxTelatPulang){
                $idRuleTelat = $row->id;
                break;
            }
        }
    }
    return $idRuleTelat;
}

function crosCekPresensi($kode)
{
    $presensi = Presensi::where('activityCode', $kode)->first();
    if($presensi->waktuShift == 'PAGI'){
        $waktu = 'P';
    }else if($presensi->waktuShift == 'SIANG'){
        $waktu = 'S';
    }else{
        $waktu = 'M';
    }
    return $waktu;
}