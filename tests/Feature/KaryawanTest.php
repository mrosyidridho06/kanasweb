<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KaryawanTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_store_data_karyawan()
    {
        $role = 'admin';

        $user = User::where('role', $role)->first();

        $request = [
            'nama_karyawan' => 'Fulan',
            'alamat_karyawan' => 'Jl. Sei Lais',
            'jenis_kelamin' => 'laki-laki',
            'hp_karyawan' => '081221831239',
            'agama' => 'islam',
            'jabatan' => 'staff',
            'tanggal_masuk' => date('Y-m-d'),
            'foto' => UploadedFile::fake()->create('fulan.jpg', 1024),
        ];

        $response = $this->actingAs($user)->post(route('karyawan.store'),$request);

        $response->assertStatus(302);
    }

    public function test_lihat_daftar_karyawan()
    {
        $role = 'admin';
        $user = User::where('role', $role)->first();

        $response = $this->actingAs($user)->get(route('karyawan.index'));

        $response->assertStatus(200);
    }

    public function test_update_karyawan()
    {
        $role = 'admin';
        $user = User::where('role', $role)->first();

        $request = [
            'nama_karyawan' => 'Sahaya',
            'alamat_karyawan' => 'Jl. Sei Qain',
            'jenis_kelamin' => 'laki-laki',
            'hp_karyawan' => '081221831239',
            'agama' => 'islam',
            'jabatan' => 'staff',
            'tanggal_masuk' => date('Ymd'),
            'foto' => UploadedFile::fake()->create('tidhoedot.jpg', 1024),
        ];

        $response = $this->actingAs($user)
        ->put(route('karyawan.update',6), $request);

        $response->assertStatus(302);
    }

    public function test_hapus_karyawan()
    {
        $role = 'admin';
        $user = User::where('role', $role)->first();

        $response = $this->actingAs($user)
        ->delete(route('karyawan.destroy',7));

        $response->assertStatus(302);
    }
}
