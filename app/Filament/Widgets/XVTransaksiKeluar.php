<?php

namespace App\Filament\Widgets;

use App\Models\Transaksi as TransaksiModel;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class XVTransaksiKeluar extends ChartWidget
{
    protected static ?string $heading = 'Grafik Transaksi Keluar Harian';

    protected function getData(): array
    {
        // Mengambil data transaksi keluar dari tabel Transaksi
        $transaksiKeluar = TransaksiModel::where('jenis_transaksi', 'keluar')
            ->selectRaw('DATE(tanggal_transaksi) as tanggal, COUNT(*) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        // Inisialisasi data untuk chart
        $chartData = [
            'labels' => [],
            'datasets' => [
                [
                    'label' => 'Jumlah Transaksi Keluar',
                    'backgroundColor' => '#F44336',
                    'data' => [],
                ],
            ],
        ];

        // Mengisi data harian untuk setiap tanggal transaksi keluar
        foreach ($transaksiKeluar as $data) {
            $chartData['labels'][] = Carbon::parse($data->tanggal)->format('d M'); // Format tanggal ke 'dd M' misalnya
            $chartData['datasets'][0]['data'][] = $data->total; // Jumlah transaksi keluar per tanggal
        }

        return $chartData;
    }

    protected function getType(): string
    {
        return 'bar'; // Jenis chart, bisa 'bar', 'line', 'pie', dll.
    }
}
