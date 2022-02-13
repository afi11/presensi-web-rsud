<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailWaktuKerjaShift extends Model
{
    use HasFactory;
    protected $table = 'detail_waktu_kerja_shift';
    protected $fillable = [
        'kodeJamKerja',
        'shift',
        'jam_mulai_masuk',
        'jam_akhir_masuk',
        'jam_awal_pulang',
        'jam_akhir_pulang',
        'is_active'
    ];
}
