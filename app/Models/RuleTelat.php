<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleTelat extends Model
{
    use HasFactory;
    protected $table = "rule_telat";
    protected $fillable = ["namaRuleTelat", "maxTelatMasuk", "maxTelatPulang"];
}
