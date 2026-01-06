<?php

namespace App\Filament\Resources\ReferensiKategoris;

use App\Filament\Resources\ReferensiKategoris\Pages\CreateReferensiKategori;
use App\Filament\Resources\ReferensiKategoris\Pages\EditReferensiKategori;
use App\Filament\Resources\ReferensiKategoris\Pages\ListReferensiKategoris;
use App\Filament\Resources\ReferensiKategoris\Pages\ViewReferensiKategori;
use App\Filament\Resources\ReferensiKategoris\Schemas\ReferensiKategoriForm;
use App\Filament\Resources\ReferensiKategoris\Schemas\ReferensiKategoriInfolist;
use App\Filament\Resources\ReferensiKategoris\Tables\ReferensiKategorisTable;
use App\Models\ReferensiKategori;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ReferensiKategoriResource extends Resource
{
    protected static ?string $model = ReferensiKategori::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?string $navigationLabel = 'Referensi Kategori';

    protected static ?string $pluralModelLabel = 'Referensi Kategori';
    protected static string|UnitEnum|null $navigationGroup = 'Referensi';

    protected static ?int $navigationSort = 6;

    public static function form(Schema $schema): Schema
    {
        return ReferensiKategoriForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ReferensiKategoriInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReferensiKategorisTable::configure($table);
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
            'index' => ListReferensiKategoris::route('/'),
            'create' => CreateReferensiKategori::route('/create'),
            'view' => ViewReferensiKategori::route('/{record}'),
            'edit' => EditReferensiKategori::route('/{record}/edit'),
        ];
    }
}
