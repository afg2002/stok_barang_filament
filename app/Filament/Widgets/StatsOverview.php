<?php

namespace App\Filament\Widgets;

use App\Models\Barang;
use App\Models\Supplier;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use NumberFormatter;
use Filament\Support\Colors\Color;
class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);

        return [
            Card::make("Jumlah Barang", Barang::count())
                ->description('Total barang dalam inventaris')
                ->descriptionIcon('heroicon-s-academic-cap')
                ->color(Color::Indigo),
        
            Card::make("Jumlah Supplier", Supplier::count())
                ->description('Total supplier aktif')
                ->descriptionIcon('heroicon-s-user-group')
                ->color(Color::Yellow),
        
            Card::make("Total Stok Barang", Barang::sum('jumlah'))
                ->description('Jumlah seluruh stok barang')
                ->descriptionIcon('heroicon-s-cube')
                ->color(Color::Teal),
        
            Card::make("Rata-rata Barang per Supplier", $this->getAverageBarangPerSupplier())
                ->description('Rata-rata jumlah barang tiap supplier')
                ->descriptionIcon('heroicon-s-calculator')
                ->color(Color::Pink),
        ];
    }

    protected function getAverageBarangPerSupplier(): string
    {
        $avgBarang = Barang::count() / max(Supplier::count(), 1);
        return number_format($avgBarang, 2);
    }
}
