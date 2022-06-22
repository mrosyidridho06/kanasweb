<?php

namespace Tests\Feature;

use App\Models\MasterGaji;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MasterGajiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_create_mastergaji()
    {
        $role = 'admin';

        $user = User::where('role', $role)->first();

        MasterGaji::create([
            'harian' => '50000',
            'lembur' => '10000'
        ]);

        $response = $this->actingAs($user)->get('/mastergaji');

        $response->assertStatus(200);
        // $response->assertSee('buat mastergaji');
        // $response->assertRedirect(route('mastergaji.index'));
    }

    public function test_lihat_mastergaji()
    {
        $role = 'admin';
        $user = User::where('role', $role)->first();

        $response = $this->actingAs($user)->get(route('mastergaji.index'));
        $response->assertStatus(200);
        // $response->assertSee('daftar mastergaji');
    }

    public function test_update_mastergaji()
    {
        $role = 'admin';
        $user = User::where('role', $role)->first();

        $request = [
            'harian' => '60000',
            'lembur' => '15000',
        ];

        // $response = $this->call('PUT', route('supplier.update'),$request);
        // $this->assertEquals(200, $response->getStatusCode());
        $response = $this->actingAs($user)
        ->put(route('mastergaji.update',1), $request);

        $response->assertStatus(302);
    }

    public function test_hapus_mastergaji()
    {
        $role = 'admin';
        $user = User::where('role', $role)->first();

        $response = $this->actingAs($user)
        ->delete(route('mastergaji.destroy',1));

        $response->assertStatus(302);
    }
}
