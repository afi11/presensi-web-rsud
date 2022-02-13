<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuReguler extends Model
{
    use HasFactory;
    protected $table = 'waktu_reguler';
    protected $fillable = [
        "hariKerja", 
        "jam_mulai_masuk", 
        "jam_akhir_masuk", 
        "jam_awal_pulang",
        "jam_akhir_pulang"
    ];
}
