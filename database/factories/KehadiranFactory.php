<?php

namespace Database\Factories;

use App\Models\Karyawan;
use App\Models\Kehadiran;
use Illuminate\Database\Eloquent\Factories\Factory;

class KehadiranFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kehadiran::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startingDate = $this->faker->dateTimeBetween('this week', '+6 days');
        // Random datetime of the current week *after* `$startingDate`
        $endingDate   = $this->faker->dateTimeBetween($startingDate, strtotime('+6 days'));
        return [
            'masuk' => $this->faker->numberBetween($min = 10, $max=26),
            'izin' => $this->faker->numberBetween($min = 1, $max=10),
            'lembur' => $this->faker->numberBetween($min = 1, $max=12),
            'from_date' => $startingDate,
            'to_date' => $endingDate,
            'karyawan_id' => Karyawan::factory()
        ];
    }
}
