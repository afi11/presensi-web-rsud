<?php

use App\Models\Divisi;

function getIdDivisi($divisi) {
    $divisi = Divisi::where('namaDivisi', $divisi)->first();
    return $divisi->id;
}