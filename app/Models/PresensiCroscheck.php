<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiCroscheck extends Model
{
    use HasFactory;
    protected $table = "presensi_croscheck";
    protected $fillable = [
        "pegawaiCode",
        "idDivisi",
        "status",
        "bulan",
        "tahun",
        "keterangan",
        "tgl_01",
        "tgl_02",
        "tgl_03",
        "tgl_04",
        "tgl_05",
        "tgl_06",
        "tgl_07",
        "tgl_08",
        "tgl_09",
        "tgl_10",
        "tgl_11",
        "tgl_12",
        "tgl_13",
        "tgl_14",
        "tgl_15",
        "tgl_16",
        "tgl_17",
        "tgl_18",
        "tgl_19",
        "tgl_20",
        "tgl_21",
        "tgl_22",
        "tgl_23",
        "tgl_24",
        "tgl_25",
        "tgl_26",
        "tgl_27",
        "tgl_28",
        "tgl_29",
        "tgl_30",
        "tgl_31",
    ];
    public $timestamps = false;
}
