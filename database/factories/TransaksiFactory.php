<?php

namespace Database\Factories;

use App\Models\Transaksi;
use App\Models\Barang;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class TransaksiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaksi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $jenisTransaksi = $this->faker->randomElement(['masuk', 'keluar']);
        $jumlah = $this->faker->numberBetween(1, 10);
        $tanggalTransaksi = $this->faker->dateTimeThisMonth();
        $keterangan = $this->faker->sentence;

        return [
            'barang_id' => Barang::factory(),
            'jumlah' => $jumlah,
            'jenis_transaksi' => $jenisTransaksi,
            'tanggal_transaksi' => $tanggalTransaksi,
            'keterangan' => $keterangan,
        ];
    }
}
