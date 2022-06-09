<?php

namespace App\Imports;

use App\Models\DataAbsen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DataAbsenImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    public function transformTime($value, $format = 'h:mm:ss')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    public function model(array $row)
    {
        return new DataAbsen([
            'id_finger' => $row[1],
            'nama' => $row[2],
            'tanggal' => $this->transformDate($row[3]),
            'jam_masuk' => $this->transformTime($row[4]),
            'jam_pulang' => $this->transformTime($row[5]),
            'check_in' => $this->transformTime($row[6]),
            'check_out' => $this->transformTime($row[7]),
            'terlambat' => $this->transformTime($row[8]),
            'absen' => $row[9],
            'lembur' => $row[10],
            'work_time' => $this->transformTime($row[11]),
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
