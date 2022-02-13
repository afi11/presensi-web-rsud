<?php

use App\Models\Presensi;
use App\Models\RuleTelat;

function cekPresensiMasuk($pegawaiCode) 
{
    $masuk = Presensi::where('pegawaiCode', $pegawaiCode)
        ->where('tipePresensi', 'jam-masuk')
        ->orderBy('created_at', 'DESC')
        ->first();
    return $masuk;
}


function cekPresensiPulang($pegawaiCode, $activityCode) 
{
    $pulang = Presensi::where('pegawaiCode', $pegawaiCode)
        ->where('tipePresensi', 'jam-pulang')
        ->where('activityCode', $activityCode)
        ->where('statusPresensiPulang', 1)
        ->orderBy('created_at', 'DESC')
        ->first();
    return $pulang;
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