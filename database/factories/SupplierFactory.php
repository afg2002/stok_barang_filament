<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    protected $model = \App\Models\Supplier::class;
    public function definition(): array
    {
        return [
            'nama' => $this->faker->company,
            'kontak' => $this->faker->phoneNumber,
            'alamat' => $this->faker->address,
        ];
    }
}
