<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnakFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_anak' => $this->faker->name(),
            'nama_ortu' => $this->faker->name(), 
            'tempat_lahir' => $this->faker->city(),
            'tgl_lahir' => $this->faker->date('Y-m-d', 'now'), 
            'jenis_kelamin' => $this->faker->randomElement(['Laki - Laki', 'Perempuan']), 
            'anak_ke' => $this->faker->numberBetween(1, 10), 
            'umur' => $this->faker->numberBetween(1, 20), 
        ];
    }
}
