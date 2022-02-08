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
        "ruangan_id",
        "shift_id",
        "nik_pegawai",
        "nama_pegawai",
        "gender",
        "tanggal_lahir",
        "status",
        "telepon_pegawai",
        "alamat_pegawai",
        "foto_pegawai"
    ];
}
