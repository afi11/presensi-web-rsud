<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleTelatV2 extends Model
{
    use HasFactory;
    protected $table = "rule_telat_v2";
    protected $fillable = [
        "nameTelat",
        "tipe",
        "max_telat-1",
        "max_telat-2",
    ];
}
