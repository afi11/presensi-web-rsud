<?php

use Carbon\Carbon;

function getNameDay() {
    $now = Carbon::now();
    return $now->format('l');
}

function getHitungTelat($startDate, $endDate) {
    $selisihWaktu = "00:00:00";
    if(getDiffTimeBySecond($startDate, $endDate) > 0){
        $selisihWaktu = getDiffTime($startDate, $endDate);
    }else if(getDiffTimeByMinute($startDate, $endDate) > 0){
        $selisihWaktu = getDiffTime($startDate, $endDate);
    }else if(getDiffTimeByHour($startDate, $endDate) > 0){
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