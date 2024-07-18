<?php

namespace App\Filament\Resources;

use App\Filament\Exports\BarangExporter;
use App\Filament\Resources\BarangResource\Pages;
use App\Filament\Resources\BarangResource\RelationManagers;
use App\Filament\Resources\BarangResource\Widgets\StatsOverview;
use App\Models\Barang;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\Exports\Models\Export;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\Action;


class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('nama')->required(),
                    Textarea::make('deskripsi')->required(),
                    TextInput::make('jumlah')->required()->numeric(),
                    TextInput::make('harga')->required()->numeric(),
                    FileUpload::make('gambar')->nullable()->image(),
                    Select::make('supplier_id')->relationship('supplier','nama')->required()->searchable(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('Export pdf')->url(fn (): string => route('download.barang.pdf'))->openUrlInNewTab(true),
                ExportAction::make()->label('Export CSV')
                ->exporter(BarangExporter::class)->formats([
                    ExportFormat::Csv,
                ])->fileName(fn (Export $export): string => "Barang-{$export->getKey()}.csv")
            ])
            ->columns([
                TextColumn::make('nama')->searchable(),
                TextColumn::make('deskripsi'),
                TextColumn::make('jumlah'),
                TextColumn::make('harga')->money('IDR', locale : 'id'),
                ImageColumn::make('gambar')->rounded(),
                TextColumn::make('supplier.nama')->label('Supplier')->searchable(),
            ])
            ->filters([
                SelectFilter::make('supplier')->relationship('supplier','nama')->multiple()->searchable()->preload(),
                Filter::make('created_at')
                ->form([
                    DatePicker::make('created_from'),
                    DatePicker::make('created_until'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                        )
                        ->when(
                            $data['created_until'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                        );
                })
                        ])
            ->actions([

                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}
