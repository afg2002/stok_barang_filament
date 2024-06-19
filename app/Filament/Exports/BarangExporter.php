<?php

namespace App\Filament\Exports;

use App\Models\Barang;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class BarangExporter extends Exporter
{
    protected static ?string $model = Barang::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('nama'),
            ExportColumn::make('deskripsi'),
            ExportColumn::make('jumlah'),
            ExportColumn::make('harga'),
            ExportColumn::make('gambar'),
            ExportColumn::make('supplier_id'),
            ExportColumn::make('tanggal_masuk'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your barang export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}