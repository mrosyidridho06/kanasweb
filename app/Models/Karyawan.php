<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawans';
    protected $fillable = ['nama_karyawan', 'alamat_karyawan', 'jenis_kelamin', 'hp_karyawan', 'agama', 'jabatan', 'tanggal', 'foto'];


    public function kehadiran()
    {
        return $this->hasManyThrough(Kehadiran::class, Gaji::class);
    }

}
