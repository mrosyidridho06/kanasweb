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
        User::create([
            'name' => 'Muhammad Rosyid Ridho',
            'username' => 'ridho',
            'email' => 'ridho@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Fulan',
            'username' => 'fulan',
            'email' => 'fulan@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Muhammad Fulan Syam',
            'username' => 'hr',
            'email' => 'hr@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 'hr',
        ]);


        Bahan::factory(15)->create();
        MasterGaji::factory(1)->create();
        Kehadiran::factory(10)->create();
    }
}
