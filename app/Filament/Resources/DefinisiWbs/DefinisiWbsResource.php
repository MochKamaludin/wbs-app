<?php

namespace App\Filament\Resources\DefinisiWbs;

use App\Filament\Resources\DefinisiWbs\Pages\CreateDefinisiWbs;
use App\Filament\Resources\DefinisiWbs\Pages\EditDefinisiWbs;
use App\Filament\Resources\DefinisiWbs\Pages\ListDefinisiWbs;
use App\Filament\Resources\DefinisiWbs\Pages\ViewDefinisiWbs;
use App\Filament\Resources\DefinisiWbs\Schemas\DefinisiWbsForm;
use App\Filament\Resources\DefinisiWbs\Schemas\DefinisiWbsInfolist;
use App\Filament\Resources\DefinisiWbs\Tables\DefinisiWbsTable;
use App\Models\DefinisiWbs;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class DefinisiWbsResource extends Resource
{
    protected static ?string $model = DefinisiWbs::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;


    protected static ?string $navigationLabel = 'Definisi WBS';
    protected static ?string $pluralModelLabel = 'Definisi WBS';

    protected static string|UnitEnum|null $navigationGroup = 'Tentang';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return DefinisiWbsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DefinisiWbsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DefinisiWbsTable::configure($table);
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
            'index' => ListDefinisiWbs::route('/'),
            'create' => CreateDefinisiWbs::route('/create'),
            'view' => ViewDefinisiWbs::route('/{record}'),
            'edit' => EditDefinisiWbs::route('/{record}/edit'),
        ];
    }
}
