<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    use HasFactory;

    protected $table = "bahans";

    protected $fillable = ["supplier_id", "nama_bahan", "jumlah_bahan", "satuan_bahan", "harga_bahan", "harga_satuan"];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function detail()
    {
        return $this->hasMany(ResepDetails::class);
    }
}
