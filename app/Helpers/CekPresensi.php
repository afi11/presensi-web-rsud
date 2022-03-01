<?php

use App\Models\Presensi;
use App\Models\Pegawai;
use App\Models\RuleTelat;
use App\Models\HariLibur;
use App\Models\PresensiCroscheck;
use Carbon\Carbon;

function cekPresensiMasuk($pegawaiCode) 
{
    $masuk = Presensi::where('pegawaiCode', $pegawaiCode)
        ->where('statusPresensi', 0)
        ->where('statusIzin', null)
        ->orderBy('created_at', 'DESC')
        ->first();
    return $masuk;
}


function cekPresensiPulang($pegawaiCode, $activityCode) 
{
    $pulang = Presensi::where('pegawaiCode', $pegawaiCode)
        ->where('activityCode', $activityCode)
        ->where('statusPresensi', 1)
        ->where('statusIzin', null)
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
    if($presensi->tipeWaktu == 'PAGI'){
        $waktu = 'P';
    }else if($presensi->tipeWaktu == 'SIANG'){
        $waktu = 'S';
    }else if($presensi->tipeWaktu == 'Dinas Luar'){
        $waktu = 'DL';
    }else if($presensi->tipeWaktu == 'Izin'){
        $waktu = 'I';
    }else if($presensi->tipeWaktu == 'Sakit'){
        $waktu = 'SKT';
    }else if($presensi->tipeWaktu == 'Pulang Cepat'){
        $waktu = 'PC';
    }else if($presensi->tipeWaktu == 'CUTI'){
        $waktu = 'CT';
    }else{
        $waktu = 'M';
    }
    return $waktu;
}

function cekIzin($pegawaiCode)
{
    $today = date('Y-m-d');
    $today = date('Y-m-d', strtotime($today));

    $presensi = Presensi::where('pegawaiCode', $pegawaiCode)
        ->orderBy('created_at', 'desc')
        ->first();
    if($presensi != null){
        $stratDate = date('Y-m-d', strtotime($presensi->tanggalMulaiIzin));
        $endDate = date('Y-m-d', strtotime($presensi->tanggalAkhirIzin));
        if(($today >= $stratDate) && ($today <= $endDate)){
            $state = true;
        }else{
            $state = false;
        }
    }else{
        $state = false;
    }
    return $state;
}

function cekLibur($pegawaiCode)
{
    $today = Carbon::now()->format('Y-m-d');
    $pegawai = Pegawai::where('code', $pegawaiCode)->first();
    if($pegawai->statusShift == 0){
        $cek = HariLibur::where('forlibur', 'reguler')->where('status', 1)->get();
    }else{
        $cek = HariLibur::where('forlibur', 'shift')->where('status', 1)->get();
    }
    $state = true;
    $todayKalkulasi = date('Y-m-d', strtotime($today));
    foreach($cek as $row){
        $tanggalMulaiLibur = date('Y-m-d', strtotime($row->tanggalMulaiLibur));
        $tanggalSelesaiLibur = date('Y-m-d', strtotime($row->tanggalSelesaiLibur));
        if($todayKalkulasi >= $tanggalMulaiLibur && $todayKalkulasi <= $tanggalSelesaiLibur){
            $state = false;
            break;
        }
    }

    return $state;
}

function getJamMasukPulang($pegawaiCode, $bulan, $tahun, $field)
{   
    $hasil = "";
    $presensi = PresensiCroscheck::leftJoin('presensi', 'presensi.activityCode', '=', 'presensi_croscheck.'.$field) 
        ->where('presensi_croscheck.pegawaiCode', $pegawaiCode)
        ->where('presensi_croscheck.bulan', $bulan)
        ->where('presensi_croscheck.tahun', $tahun)
        ->first();
    if($presensi != null){
        $data = $presensi->toArray();
        $fieldTambahan = 'hasil_'.$field;
        if($data['jamMasuk'] != null || $data['jamPulang'] != null){
            $hasil = $data['jamMasuk'].' '. $data['jamPulang'].'<br/>'.$data[$fieldTambahan];
        }else{
            $hasil = $data['tipeWaktu'].'<br/>'.$data[$fieldTambahan];
        }
    }
    return $hasil;

}

function getCroshcekKeterangan($pegawai, $bulan, $tahun)
{   
    $ket = "";
    $presensiCroshCheck = PresensiCroscheck::where('pegawaiCode', $pegawai)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->first();
    if($presensiCroshCheck != null){
        $ket = $presensiCroshCheck->keterangan;
    }
    return $ket;
}

function getPegawaiName($pegawaiCode)
{
    $pegawai = Pegawai::where('code', $pegawaiCode)->first();
    return $pegawai->nama;
}

function getRuanganId($pegawaiCode)
{
    $pegawai = Pegawai::where('code', $pegawaiCode)->first();
    return $pegawai->idDivisi;
}

function sumTelatMasuk($ruangan, $pegawai, $bulan)
{
    $presensi = Presensi::join('pegawai', 'pegawai.code', '=', 'presensi.pegawaiCode')
        ->where('pegawai.idDivisi', $ruangan)
        ->where('presensi.pegawaiCode', $pegawai)
        ->whereMonth('presensi.created_at', $bulan)
        ->sum(\DB::raw("TIME_TO_SEC(presensi.telatMasuk)"));
    return gmdate("H:i:s", $presensi);
}

function sumLewatPulang($ruangan, $pegawai, $bulan)
{
    $presensi = Presensi::join('pegawai', 'pegawai.code', '=', 'presensi.pegawaiCode')
        ->where('pegawai.idDivisi', $ruangan)
        ->where('presensi.pegawaiCode', $pegawai)
        ->whereMonth('presensi.created_at', $bulan)
        ->sum(\DB::raw("TIME_TO_SEC(presensi.lewatPulang)"));
    return gmdate("H:i:s", $presensi);
}