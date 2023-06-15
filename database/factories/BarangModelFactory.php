<?php

namespace Database\Factories;

use App\Models\BarangModel;
use Illuminate\Database\Eloquent\Factories\Factory;


class BarangModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = BarangModel::class;
    public function definition()
    {
        return [
            'nama_barang' => $this->faker->company,
            'stok' => $this->faker->numberBetween(1, 10),
            'kondisi' => $this->faker->randomElement(['cukup', 'baik', 'sangat baik']),
        ];
    }
}
