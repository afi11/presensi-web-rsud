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
        "status",
        "bulan",
        "tahun",
        "keterangan",
        "tgl_1",
        "tgl_2",
        "tgl_3",
        "tgl_4",
        "tgl_5",
        "tgl_6",
        "tgl_7",
        "tgl_8",
        "tgl_9",
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
