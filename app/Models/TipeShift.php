<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeShift extends Model
{
    use HasFactory;
    protected $table = 'tipe_shift';
    protected $fillable = ['kode_shift', 'nama_shift', 'jam_masuk', 'jam_pulang'];
}
