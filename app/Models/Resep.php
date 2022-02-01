<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;
    protected $table='reseps';
    protected $fillable = [ 'user_id', 'nama_resep', 'jumlah_produksi', 'total', 'hpp', 'harga_jual' ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function detail()
    {
        return $this->hasMany(ResepDetails::class);
    }

    public function updatetotal($itemcart, $subtotal) {
        $this->attributes['subtotal'] = $itemcart->subtotal + $subtotal;
        $this->attributes['total'] = $itemcart->total + $subtotal;
        self::save();
    }
}
