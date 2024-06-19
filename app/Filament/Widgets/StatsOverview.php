<?php

namespace App\Filament\Widgets;

use App\Models\Barang;
use App\Models\Supplier;
use Filament\Forms\Components\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use NumberFormatter;

class StatsOverview extends BaseWidget
{
    
    protected function getStats(): array
    {

        $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
        return [
        Stat::make("Jumlah Barang", Barang::count()),
        Stat::make("Jumlah Supplier", Supplier::count()),
        Stat::make("Barang Termahal", $formatter->formatCurrency(Barang::max('harga'),'IDR')),
        Stat::make("Barang Termurah", $formatter->formatCurrency(Barang::min('harga'),'IDR')),
    ];
    }
}
