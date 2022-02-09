<?php

use App\Models\Pegawai;

function getJumlahPegawai($code) {
    $count = Pegawai::where('ruangan_id', $code)->count();
    return $count;
}