<?php

namespace Tests\Feature;

use App\Models\Supplier;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SupplierTest extends TestCase
{
    use WithFaker;
    // use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_data()
    {
        $role = 'user';

        $user = User::where('role', $role)->first();

        Supplier::create([
            'nama_supplier' => $this->faker->name,
            'alamat_supplier' => $this->faker->address,
            'hp_supplier' => $this->faker->phoneNumber,
        ]);

        $response = $this->actingAs($user)->get('/supplier');

        $response->assertStatus(200);
        // $response->assertSee('Data Supplier');
        // $response->assertRedirect(route('supplier.index'));
    }

    public function test_lihat_daftar_supplier()
    {
        $role = 'user';
        $user = User::where('role', $role)->first();

        $response = $this->actingAs($user)->get(route('supplier.index'));

        $response->assertStatus(200);
    }

    public function test_update_supplier()
    {
        $role = 'admin';
        $user = User::where('role', $role)->first();

        $request = [
            'nama_supplier' => 'tesnama',
            'alamat_supplier' => 'jl. alamat',
            'hp_supplier' => '081237123123',
        ];

        $response = $this->actingAs($user)
        ->put(route('supplier.update',7), $request);

        $response->assertStatus(302);
    }

    public function test_hapus_supplier()
    {
        $role = 'user';
        $user = User::where('role', $role)->first();

        $response = $this->actingAs($user)
        ->delete(route('supplier.destroy',15));

        $response->assertStatus(302);
    }
}
