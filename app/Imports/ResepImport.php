<?php

namespace App\Imports;

use App\Models\Resep;
use Maatwebsite\Excel\Concerns\ToModel;

class ResepImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Resep([
            'id' => $row[0],
            'nama_resep' => $row[1],
            'jumlah_produksi' => $row[2],
            'total' => $row[3],
            'hpp' => $row[4],
            'harga_jual' => $row[5],
            'jual' => $row[6]
        ]);
    }
}
