<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gaji extends Model
{
    use HasFactory;

    protected $table = "gajis";

    protected $fillable = ['kehadiran_id', 'uang_lembur', 'bonus', 'bpjs', 'tunjangan', 'potongan', 'gaji_harian', 'total_gaji'];

    public function kehadiran()
    {
        return $this->belongsTo(Kehadiran::class);
    }
}
