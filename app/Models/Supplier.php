<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = "suppliers";

    protected $fillable = ["nama_supplier", "alamat_supplier", "hp_supplier"];

    public function bahan()
    {
        return $this->hasMany(Bahan::class);
    }
}
