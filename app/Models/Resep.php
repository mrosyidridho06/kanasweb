<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;
    protected $table='reseps';
    protected $fillable = [ 'nama_resep', 'jumlah_produksi', 'total', 'hpp', 'harga_jual' ];

    public function detail()
    {
        return $this->hasMany(ResepDetails::class);
    }
}
