<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $table = "presensi";
    protected $fillable = [
        "pegawaiCode",
        "idRuleIzin",
        "idWaktuReguler",
        "idWaktuShift",
        "tanggalPresensi",
        "tipePresensi",
        "jamPresensi",
        "telatMasuk",
        "jarakWaktuPulang",
        "jarakPresensi",
        "latitudePresensi",
        "longitudePresensi",
        "keteranganIzin",
        "tanggalMulaiIzin",
        "tanggalAkhirIzin",
        "dokumenPendukung",
        "statusIzin"
    ];
}
