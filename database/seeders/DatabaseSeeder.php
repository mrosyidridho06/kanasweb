<?php

namespace Database\Seeders;

use App\Models\Bahan;
use App\Models\Karyawan;
use App\Models\Kehadiran;
use App\Models\User;
use App\Models\Supplier;
use App\Models\MasterGaji;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create();
        Bahan::factory(15)->create();
        MasterGaji::factory(1)->create();
        Kehadiran::factory(10)->create();
    }
}
