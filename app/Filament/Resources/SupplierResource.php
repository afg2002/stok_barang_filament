<?php

namespace App\Filament\Resources;

use App\Filament\Exports\SupplierExporter;
use App\Filament\Resources\SupplierResource\Pages;
use App\Filament\Resources\SupplierResource\RelationManagers;
use App\Models\Supplier;
use Filament\Tables\Actions\ExportAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\Exports\Models\Export;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('nama')->required(),
                    TextInput::make('kontak')->required(),
                    Textarea::make('alamat')->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->headerActions([
            ExportAction::make()->label('Export CSV')
                ->exporter(SupplierExporter::class)->formats([
                    ExportFormat::Csv,
                ])->fileName(fn (Export $export): string => "Supplier-{$export->getKey()}.csv"),
            Action::make('Export pdf')->url(fn (): string => route('download.supplier.pdf'))->openUrlInNewTab(true)
        ])
        ->columns([
            TextColumn::make('nama')->sortable()->searchable(),
            TextColumn::make('kontak')->sortable()->searchable(),
            TextColumn::make('alamat')->sortable()->searchable(),
            TextColumn::make('created_at')->dateTime()
        ])
        ->filters([
            
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
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }
}
