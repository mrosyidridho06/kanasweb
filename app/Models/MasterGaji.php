<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterGaji extends Model
{
    use HasFactory;

    protected $table = 'master_gajis';

    protected $fillable = ['harian', 'lembur'];
}
