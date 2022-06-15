<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAbsen extends Model
{
    use HasFactory;

    protected $table='data_absen';

    protected $fillable = ['id_finger', 'nama', 'tanggal', 'jam_kerja', 'jam_masuk', 'jam_pulang', 'check_in', 'check_out', 'terlambat', 'absen', 'lembur', 'work_time'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
