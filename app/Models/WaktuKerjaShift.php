<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuKerjaShift extends Model
{
    use HasFactory;
    protected $table = 'waktu_kerja_shift';
    protected $fillable = [
        'kodeJamKerja',
        'namaProfile', 
        'reguler', 
    ];
}
