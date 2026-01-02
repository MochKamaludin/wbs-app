<?php

namespace App\Filament\Resources\Referensis;

use App\Filament\Resources\Referensis\Pages\CreateReferensi;
use App\Filament\Resources\Referensis\Pages\EditReferensi;
use App\Filament\Resources\Referensis\Pages\ListReferensis;
use App\Filament\Resources\Referensis\Pages\ViewReferensi;
use App\Filament\Resources\Referensis\Schemas\ReferensiForm;
use App\Filament\Resources\Referensis\Schemas\ReferensiInfolist;
use App\Filament\Resources\Referensis\Tables\ReferensisTable;
use App\Models\Referensi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ReferensiResource extends Resource
{
    protected static ?string $model = Referensi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?string $navigationLabel = 'Referensi';

    protected static ?string $pluralModelLabel = 'Referensi';

    protected static ?int $navigationSort = 6;

    public static function form(Schema $schema): Schema
    {
        return ReferensiForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ReferensiInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReferensisTable::configure($table);
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
            'index' => ListReferensis::route('/'),
            'create' => CreateReferensi::route('/create'),
            'view' => ViewReferensi::route('/{record}'),
            'edit' => EditReferensi::route('/{record}/edit'),
        ];
    }
}
