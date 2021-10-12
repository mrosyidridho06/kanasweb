<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $table = "gajis";

    protected $fillable = ['kehadiran_id', 'tanggal_bayar', 'gaji_harian', 'jumlah_hari', 'bpjs', 'bonus', 'lembur', 'potongan', 'total_gaji'];

    public function kehadiran()
    {
        return $this->belongsTo(Kehadiran::class);
    }

}
