<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    protected $model = \App\Models\Barang::class;
    
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word,
            'deskripsi' => $this->faker->sentence,
            'jumlah' => $this->faker->numberBetween(1, 100),
            'harga' => $this->faker->randomFloat(2, 1000, 100000),
            'gambar' => $this->faker->imageUrl,
            'supplier_id' => Supplier::factory(),
            'tanggal_masuk' => now(),
        ];
    }
}
