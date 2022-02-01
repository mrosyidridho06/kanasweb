<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Karyawan;
use App\Models\Resep;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $karwa = Karyawan::get()->count();
        $bah = Bahan::get()->count();
        $supp = Supplier::get()->count();
        $res = Resep::get()->count();

        return view('dashboard', compact('karwa', 'bah', 'supp', 'res'));
    }
}
