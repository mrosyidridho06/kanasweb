<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Bahan;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class BahanTest extends TestCase
{
    use WithFaker;
    // use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_bahan()
    {
        $role = 'user';

        $user = User::where('role', $role)->first();

        Bahan::create([
            'nama_bahan' => $this->faker->name(),
            'jumlah_bahan' => $this->faker->numberBetween($min = 1, $max=1000),
            'satuan_bahan' => $this->faker->randomElement(array('Gram', 'mL', 'Pcs')),
            'harga_bahan' => $this->faker->randomElement(array('13400', '15000', '20000', '25000', '12000')),
            'harga_satuan' => '12000',
            'supplier_id' => '3'
        ]);

        $response = $this->actingAs($user)->get('/bahan');

        $response->assertStatus(200);
        // $response->assertSee('buat bahan');
        // $response->assertRedirect(route('bahan.index'));
    }

    public function test_lihat_bahan()
    {
        $role = 'user';
        $user = User::where('role', $role)->first();

        $response = $this->actingAs($user)->get(route('supplier.index'));
        $response->assertStatus(200);
        // $response->assertSee('daftar bahan');
    }

    public function test_update_bahan()
    {
        $role = 'user';
        $user = User::where('role', $role)->first();

        $request = [
            'nama_bahan' => 'Tepung',
            'jumlah_bahan' => '1000',
            'satuan_bahan' => 'Gram',
            'harga_bahan' => '15000',
            'supplier_id' => '3'
        ];

        // $response = $this->call('PUT', route('supplier.update'),$request);
        // $this->assertEquals(200, $response->getStatusCode());
        $response = $this->actingAs($user)
        ->put(route('bahan.update',10), $request);

        $response->assertStatus(302);
    }

    public function test_hapus_bahan()
    {
        $role = 'user';
        $user = User::where('role', $role)->first();

        $response = $this->actingAs($user)
        ->delete(route('bahan.destroy',15));

        $response->assertStatus(302);
    }


}
