<?php

namespace App\Filament\Resources;

use App\Filament\Exports\TransaksiExporter;
use App\Filament\Resources\TransaksiResource\Pages;
use App\Filament\Resources\TransaksiResource\RelationManagers;
use App\Models\Transaksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Carbon\Carbon;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\Exports\Models\Export;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('barang_id')
                ->relationship('barang', 'nama')
                ->required()
                ->searchable(),
            TextInput::make('jumlah')
                ->required()
                ->numeric(),
            Select::make('jenis_transaksi')
                ->options([
                    'masuk' => 'Masuk',
                    'keluar' => 'Keluar',
                ])
                ->required(),
            DatePicker::make('tanggal_transaksi')
                ->default(Carbon::now())
                ->required(),
            Textarea::make('keterangan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
    ->headerActions([
        Action::make('Export pdf')->url(fn (): string => route('download.transaksi.pdf'))->openUrlInNewTab(true),
        ExportAction::make()->label('Export CSV')
                ->exporter(TransaksiExporter::class)->formats([
                    ExportFormat::Csv,
                ])->fileName(fn (Export $export): string => "Transaksi-{$export->getKey()}.csv")
    ])
    ->columns([
        TextColumn::make('id')->sortable(),
        TextColumn::make('barang.nama')->label('Barang')->sortable(),
        TextColumn::make('jumlah')->sortable(),
        TextColumn::make('jenis_transaksi')->sortable(),
        TextColumn::make('tanggal_transaksi')->sortable(),
        TextColumn::make('keterangan'),
        TextColumn::make('created_at')->label('Created At')->dateTime(),
        TextColumn::make('updated_at')->label('Updated At')->dateTime()
    ])
    ->filters([
        // Filter untuk rentang tanggal
        Filter::make('tanggal_transaksi_range')
            ->form([
                Forms\Components\DatePicker::make('from')->label('Dari Tanggal'),
                Forms\Components\DatePicker::make('until')->label('Sampai Tanggal'),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                    ->when(
                        $data['from'],
                        fn (Builder $query, $date): Builder => $query->whereDate('tanggal_transaksi', '>=', $date),
                    )
                    ->when(
                        $data['until'],
                        fn (Builder $query, $date): Builder => $query->whereDate('tanggal_transaksi', '<=', $date),
                    );
            }),

        // SelectFilter untuk periode tertentu
        SelectFilter::make('periode_transaksi')
            ->label('Periode Transaksi')
            ->options([
                'today' => 'Hari Ini',
                'this_week' => 'Minggu Ini',
                'this_month' => 'Bulan Ini',
                'this_year' => 'Tahun Ini',
            ])
            ->query(function (Builder $query, array $data): Builder {
                $value = $data['value'] ?? null;
                if ($value === 'today') {
                    return $query->whereDate('tanggal_transaksi', Carbon::today());
                } elseif ($value === 'this_week') {
                    return $query->whereBetween('tanggal_transaksi', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                } elseif ($value === 'this_month') {
                    return $query->whereBetween('tanggal_transaksi', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
                } elseif ($value === 'this_year') {
                    return $query->whereBetween('tanggal_transaksi', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()]);
                }
                return $query;
            }),
    ])
    ->actions([
        Tables\Actions\ViewAction::make(),
        Tables\Actions\EditAction::make(),
        Tables\Actions\DeleteAction::make(),
    ])
    ->bulkActions([
        Tables\Actions\BulkActionGroup::make([
            Tables\Actions\DeleteBulkAction::make(),
        ]),
    ]);

    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }
}
