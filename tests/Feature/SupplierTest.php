<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupplierTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_data()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('supplier.store'),[
            'nama_supplier' => $this->faker->name,
            'alamat_supplier' => $this->faker->address,
            'hp_supplier' => $this->faker->phoneNumber,
        ]);

        $response->assertStatus(302);
        // $response->assertRedirect(route('supplier.index'));
    }
}
