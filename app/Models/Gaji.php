<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gaji extends Model
{
    use HasFactory;

    protected $table = "gajis";

    protected $fillable = ['karyawan_id', 'uang_lembur', 'bonus', 'potongan', 'gaji_harian', 'total_gaji'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

}
