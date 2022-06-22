<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TunjanganGajiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_lihat_tunjangangaji()
    {
        $role = 'admin';
        $user = User::where('role', $role)->first();

        $response = $this->actingAs($user)->get(route('tunjangangaji.index'));
        $response->assertStatus(200);
        // $response->assertSee('daftar mastergaji');
    }

    public function test_update_tunjangangaji()
    {
        $role = 'admin';
        $user = User::where('role', $role)->first();

        $request = [
            'bpjs' => '75000',
            'tunjangan' => '1750000',
        ];

        // $response = $this->call('PUT', route('supplier.update'),$request);
        // $this->assertEquals(200, $response->getStatusCode());
        $response = $this->actingAs($user)
        ->put(route('tunjangangaji.update',1), $request);

        $response->assertStatus(302);
    }

}
