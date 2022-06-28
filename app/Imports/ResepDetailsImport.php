<?php

namespace App\Imports;

use App\Models\ResepDetails;
use Maatwebsite\Excel\Concerns\ToModel;

class ResepDetailsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ResepDetails([
            'id' => $row[0],
            'resep_id' => $row[1],
            'bahan_id' => $row[2],
            'qty' => $row[3],
            'harga' => $row[4],
            'subtotal' => $row[5]
        ]);
    }
}
