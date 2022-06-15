<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawans';
    protected $fillable = ['nama_karyawan', 'alamat_karyawan', 'jenis_kelamin', 'hp_karyawan', 'agama', 'jabatan', 'tanggal_masuk', 'foto'];


    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class);
    }

    public function dataabsen()
    {
        return $this->hasMany(DataAbsen::class);
    }

}
