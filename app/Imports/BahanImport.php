<?php

namespace App\Imports;

use App\Models\Bahan;
use Maatwebsite\Excel\Concerns\ToModel;

class BahanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Bahan([
            'id' => $row[0],
            'supplier_id' => $row[1],
            'nama_bahan' => $row[2],
            'jumlah_bahan' => $row[3],
            'satuan_bahan' => $row[4],
            'harga_bahan' => $row[5],
            'harga_satuan' => $row[6],
        ]);
    }
}
