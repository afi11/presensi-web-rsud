<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $table = "presensi";
    protected $fillable = [
        "pegawai_code",
        "jadwal_id",
        "tanggal_presensi",
        "presensi_masuk",
        "presensi_pulang",
        "jarak",
        "telat_masuk",
        "telat_pulang"
    ];
}
