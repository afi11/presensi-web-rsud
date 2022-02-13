<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityPresensi extends Model
{
    use HasFactory;
    protected $table = "activity_presensi";
    protected $fillable = ["activityCode", "pegawaiCode", "tanggalActivity"];
}
