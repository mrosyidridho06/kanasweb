<?php

namespace Database\Factories;

use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Factories\Factory;

class KaryawanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Karyawan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return
        [
            'nama_karyawan' => $this->faker->name(),
            'alamat_karyawan' => $this->faker->address(),
            'jenis_kelamin' => $this->faker->randomElement(array('Laki-laki', 'Perempuan')),
            'hp_karyawan' => $this->faker->phoneNumber(),
            'agama' => $this->faker->randomElement(array('islam', 'kristen', 'katolik', 'hindu', 'buddha')),
            'jabatan' => $this->faker->title(),
            'tanggal_masuk' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
