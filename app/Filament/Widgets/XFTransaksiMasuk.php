<?php

namespace App\Filament\Widgets;

use App\Models\Transaksi as TransaksiModel;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class XFTransaksiMasuk extends ChartWidget
{
    protected static ?string $heading = 'Grafik Transaksi Masuk Harian';

    protected function getData(): array
    {
        // Mengambil data transaksi masuk dari tabel Transaksi
        $transaksiMasuk = TransaksiModel::where('jenis_transaksi', 'masuk')
            ->selectRaw('DATE(tanggal_transaksi) as tanggal, COUNT(*) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        // Inisialisasi data untuk chart
        $chartData = [
            'labels' => [],
            'datasets' => [
                [
                    'label' => 'Jumlah Transaksi Masuk',
                    'backgroundColor' => '#4CAF50',
                    'data' => [],
                ],
            ],
        ];

        // Mengisi data harian untuk setiap tanggal transaksi masuk
        foreach ($transaksiMasuk as $data) {
            $chartData['labels'][] = Carbon::parse($data->tanggal)->format('d M'); // Format tanggal ke 'dd M' misalnya
            $chartData['datasets'][0]['data'][] = $data->total; // Jumlah transaksi masuk per tanggal
        }

        return $chartData;
    }

    protected function getType(): string
    {
        return 'bar'; // Jenis chart, bisa 'bar', 'line', 'pie', dll.
    }
}
