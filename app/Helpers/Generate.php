<?php

use Illuminate\Support\Str;

function genKodePegawai() {
    return Str::random(8);
}

function getKodePresensi() {
    return Str::random(16);
}

function getKodeJamKerja() {
    return Str::random(16);
}