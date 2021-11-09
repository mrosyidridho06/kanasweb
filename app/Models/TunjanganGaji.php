<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TunjanganGaji extends Model
{
    use HasFactory;

    protected $table = 'karyawans';
    protected $fillable = ['tunjangan', 'bpjs'];
}
