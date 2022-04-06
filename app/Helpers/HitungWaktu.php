<?php

use Carbon\Carbon;

function getNameDay() {
    $now = Carbon::now();
    return $now->format('l');
}

function getHitungTelat($startDate, $endDate) {
    $selisihWaktu = "00:00:00";
    if(getDiffTime($startDate, $endDate) != "00:00:00"){
        $selisihWaktu = getDiffTime($startDate, $endDate);
    }
    return $selisihWaktu;
}

function getDiffTime($startDate, $endDate){
   $dteStart = new DateTime($startDate);
   $dteEnd = new DateTime($endDate);
   $dteDiff = $dteStart->diff($dteEnd);
   return $dteDiff->format("%H:%I:%S");
}

function getDiffTimeByHour($startDate, $endDate){
    $strTime = strtotime($startDate);
    $endTime = strtotime($endDate);
    $hour = ($endTime - $strTime) / 3600;
    return $hour;
}

function getDiffTimeByMinute($startDate, $endDate){
    $strTime = strtotime($startDate);
    $endTime = strtotime($endDate);
    $minute = ($endTime - $strTime) / 60;
    return $minute;
}

function getDiffTimeBySecond($startDate, $endDate){
    $strTime = strtotime($startDate);
    $endTime = strtotime($endDate);
    $second = ($endTime - $strTime);
    return $second;
}

function getHourFromDateTime($dateTime) {
    $time = new DateTime($dateTime);
    return $time->format('H');
}

function hitungJumlahHari($bulan, $tahun) {
    $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
    return $jumlahHari;
}

function getDatesFromRange($start, $end, $format = 'Y-m-d') {
    $array = array();
    $interval = new DateInterval('P1D');
  
    $realEnd = new DateTime($end);
    $realEnd->add($interval);
  
    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
  
    foreach($period as $date) {                 
        $array[] = $date->format($format); 
    }
  
    return $array;
}