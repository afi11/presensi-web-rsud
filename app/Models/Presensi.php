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
        "idRuleTelatMasuk",
        "idRuleTelat",
        "idRuleLewatPulang",
        "idWaktuReguler",
        "idWaktuShift",
        "waktuShift",
        "tanggalPresensi",
        "jamMasuk",
        "jamPulang",
        "telatMasuk",
        "lewatPulang",
        "jarakJamMasuk",
        "latJamMasuk",
        "longJamMasuk",
        "jarakJamPulang",
        "latJamPulang",
        "longJamPulang",
        "keteranganIzin",
        "tanggalMulaiIzin",
        "tanggalAkhirIzin",
        "dokumenPendukung",
        "statusIzin",
        "statusPresensi"
    ];
}
