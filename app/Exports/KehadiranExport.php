<?php

namespace App\Exports;

use App\Models\Kehadiran;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KehadiranExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $bulan;
    protected $tahun;

    function __construct($bulan,$tahun) {
            $this->bulan = $bulan;
            $this->tahun = $tahun;
    }

    // public function query()
    // {
    //     $kehadiran = DB::table('kehadirans')->with('karyawans')->whereMonth('to_date', '=', $bulan)->whereYear('to_date', '=', $tahun)->orderBy('id');

    // }

    public function collection()
    {
        return Kehadiran::with('karyawan')
                ->whereMonth('to_date', '=', $this->bulan)
                ->whereYear('to_date', '=', $this->tahun)
                ->get();
    }

    public function map($kehadiran): array
    {
        return[
            $kehadiran->karyawan->nama_karyawan,
            $kehadiran->masuk,
            $kehadiran->izin,
            $kehadiran->lembur,
            $kehadiran->from_date,
            $kehadiran->to_date,
        ];
    }

    public function headings(): array
    {
        return ["Nama Karyawan", "Masuk", "Izin", "Lembur", "Dari tanggal", "Sampai Tanggal"];
    }
}
