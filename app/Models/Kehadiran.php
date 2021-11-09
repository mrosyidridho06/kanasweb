<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $table = "kehadirans";

    protected $fillable = ['karyawan_id', 'masuk', 'lembur', 'izin', 'from_date', 'to_date'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
