<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = 'pegawai';
    protected $fillable = [
        "code",
        "idDivisi",
        "statusShift",
        "idJamKerjaShift",
        "nik",
        "nama",
        "gender",
        "tglLahir",
        "status",
        "telepon",
        "alamat",
        "jabatan",
        "foto_pegawai"
    ];
}
