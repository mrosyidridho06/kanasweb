<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepDetails extends Model
{
    use HasFactory;

    protected $table='resep_details';

    protected $fillable = [ 'resep_id', 'bahan_id', 'qty', 'harga', 'subtotal' ];

    public function bahan()
    {
        return $this->belongsTo(Bahan::class);
    }

    public function resep()
    {
        return $this->belongsTo(Resep::class);
    }

    // public function updatedetail($itemdetail, $qty, $harga) {
    //     $this->attributes['qty'] = $itemdetail->qty + $qty;
    //     $this->attributes['subtotal'] = $itemdetail->subtotal + ($qty * $harga);
    //     self::save();
    // }
}
