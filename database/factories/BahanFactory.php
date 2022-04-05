<?php

namespace Database\Factories;

use App\Models\Bahan;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

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
            'jumlah_bahan' => $this->faker->numberBetween($min = 1, $max=1000),
            'satuan_bahan' => $this->faker->randomElement(array('Gram', 'mL', 'Pcs')),
            'harga_bahan' => $this->faker->randomElement(array('13400', '15000', '20000', '25000', '12000')),
            'supplier_id' => Supplier::factory()
        ];
    }
}
