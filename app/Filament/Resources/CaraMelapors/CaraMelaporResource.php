<?php

namespace App\Filament\Resources\CaraMelapors;

use App\Filament\Resources\CaraMelapors\Pages\CreateCaraMelapor;
use App\Filament\Resources\CaraMelapors\Pages\EditCaraMelapor;
use App\Filament\Resources\CaraMelapors\Pages\ListCaraMelapors;
use App\Filament\Resources\CaraMelapors\Pages\ViewCaraMelapor;
use App\Filament\Resources\CaraMelapors\Schemas\CaraMelaporForm;
use App\Filament\Resources\CaraMelapors\Schemas\CaraMelaporInfolist;
use App\Filament\Resources\CaraMelapors\Tables\CaraMelaporsTable;
use App\Models\CaraMelapor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CaraMelaporResource extends Resource
{
    protected static ?string $model = CaraMelapor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSpeakerWave;

    protected static ?string $navigationLabel = 'Cara Melapor';
    protected static ?string $pluralModelLabel = 'Cara Melapor';

    protected static string|UnitEnum|null $navigationGroup = 'Tentang';

    protected static ?int $navigationSort = 6;
    public static function form(Schema $schema): Schema
    {
        return CaraMelaporForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CaraMelaporInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CaraMelaporsTable::configure($table);
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
            'index' => ListCaraMelapors::route('/'),
            'create' => CreateCaraMelapor::route('/create'),
            'view' => ViewCaraMelapor::route('/{record}'),
            'edit' => EditCaraMelapor::route('/{record}/edit'),
        ];
    }
}
