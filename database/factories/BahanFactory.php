<?php

namespace Database\Factories;

use App\Models\Bahan;
use Illuminate\Database\Eloquent\Factories\Factory;

class BahanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bahan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_bahan' => $this->faker->name(),
            'jumlah_bahan' => $this->faker->numberBetween($min = 1000, $max=10000),
            'satuan_bahan' => $this->faker->randomElement(array('Gram', 'mL', 'Pcs')),
            'harga_bahan' => $this->faker->numberBetween($min = 6000, $max=15000),
            'supplier_id' => factory(Supplier::class)->id,
        ];
    }
}
