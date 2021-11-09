<?php

namespace App\Exports;

use App\Models\Supplier;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SupplierExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Supplier::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama Supplier',
            'Alamat Supplier',
            'Nomor Telepon',
            'created_at',
            'updated_at'
        ];
    }
}
