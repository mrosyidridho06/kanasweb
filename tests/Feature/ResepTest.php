<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Resep;
use App\Models\ResepDetails;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResepTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_resep()
    {
        $role = 'admin';

        $user = User::where('role', $role)->first();

        Resep::create([
            'nama_resep' => 'Pudding baut tes',
            'jumlah_produksi' => '10',
            'total' => '12500',
            'hpp' => '125',
            'jual' => '10',
            'harga_jual' => '1250'
        ]);

        ResepDetails::create([
            'resep_id' => '5',
            'bahan_id' => '10',
            'qty' => '5',
            'harga' => '15',
            'subtotal' => '150'
        ]);

        $response = $this->actingAs($user)->get('/resep');

        $response->assertStatus(200);
        // $response->assertSee('buat resep');
        // $response->assertRedirect(route('resep.index'));
    }

    public function test_lihat_resep()
    {
        $role = 'admin';
        $user = User::where('role', $role)->first();

        $response = $this->actingAs($user)->get(route('resep.index'));
        $response->assertStatus(200);
        // $response->assertSee('daftar resep');
    }

    public function test_update_resep()
    {
        $role = 'admin';
        $user = User::where('role', $role)->first();

        $requestres = [
            'nama_resep' => 'Pudding edit',
            'jumlah_produksi' => '10',
            'total' => '12500',
            'hpp' => '125',
            'jual' => '10',
            'harga_jual' => '1250'
        ];

        $requestdet = [
            'bahan_id' => '11',
            'qty' => '5',
            'resep_id' => '1',
            'harga' => '15',
            'subtotal' => '75',
        ];

        // $response = $this->call('PUT', route('supplier.update'),$request);
        // $this->assertEquals(200, $response->getStatusCode());
        $responser = $this->actingAs($user)
        ->put(route('resep.update',1), $requestres);

        $responsed = $this->actingAs($user)
        ->post(route('tambaheditresep',5), $requestdet);

        $responser->assertStatus(302);
        $responsed->assertStatus(302);
    }

    public function test_hapus_resep()
    {
        $role = 'admin';
        $user = User::where('role', $role)->first();

        $response = $this->actingAs($user)
        ->delete(route('resep.destroy',5));

        $response->assertStatus(302);
    }
}
