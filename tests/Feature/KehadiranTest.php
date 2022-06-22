<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Kehadiran;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KehadiranTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_create_kehadiran()
    {
        $role = 'admin';

        $user = User::where('role', $role)->first();

        Kehadiran::create([
            'karyawan_id' => '1',
            'from_date' => date('Ymd'),
            'to_date' => date('Ymd'),
            'masuk' => '24',
            'izin' => '1',
            'lembur' => '5'
        ]);

        $response = $this->actingAs($user)->get('/kehadiran');

        $response->assertStatus(200);
        // $response->assertSee('buat kehadiran');
        // $response->assertRedirect(route('kehadiran.index'));
    }

    public function test_lihat_kehadiran()
    {
        $role = 'admin';
        $user = User::where('role', $role)->first();

        $response = $this->actingAs($user)->get(route('kehadiran.index'));
        $response->assertStatus(200);
        // $response->assertSee('daftar kehadiran');
    }

    public function test_update_kehadiran()
    {
        $role = 'admin';
        $user = User::where('role', $role)->first();

        $request = [
            'karyawan_id' => '1',
            'from_date' => date('Ymd'),
            'to_date' => date('Ymd'),
            'masuk' => '22',
            'izin' => '2',
            'lembur' => '1'
        ];

        // $response = $this->call('PUT', route('supplier.update'),$request);
        // $this->assertEquals(200, $response->getStatusCode());
        $response = $this->actingAs($user)
        ->put(route('kehadiran.update',1), $request);

        $response->assertStatus(302);
    }

    public function test_hapus_kehadiran()
    {
        $role = 'admin';
        $user = User::where('role', $role)->first();

        $response = $this->actingAs($user)
        ->delete(route('kehadiran.destroy',2));

        $response->assertStatus(302);
    }
}
