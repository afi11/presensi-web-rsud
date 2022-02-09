<?php

use Illuminate\Support\Str;

function genKodePegawai() {
    return Str::random(8);
}