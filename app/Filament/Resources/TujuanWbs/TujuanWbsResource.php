<?php

namespace App\Filament\Resources\TujuanWbs;

use App\Filament\Resources\TujuanWbs\Pages\CreateTujuanWbs;
use App\Filament\Resources\TujuanWbs\Pages\EditTujuanWbs;
use App\Filament\Resources\TujuanWbs\Pages\ListTujuanWbs;
use App\Filament\Resources\TujuanWbs\Pages\ViewTujuanWbs;
use App\Filament\Resources\TujuanWbs\Schemas\TujuanWbsForm;
use App\Filament\Resources\TujuanWbs\Schemas\TujuanWbsInfolist;
use App\Filament\Resources\TujuanWbs\Tables\TujuanWbsTable;
use App\Models\TujuanWbs;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TujuanWbsResource extends Resource
{
    protected static ?string $model = TujuanWbs::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFlag;

    protected static ?string $navigationLabel = 'Tujuan WBS';
    protected static ?string $pluralModelLabel = 'Tujuan WBS';

    protected static string|UnitEnum|null $navigationGroup = 'Tentang';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return TujuanWbsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TujuanWbsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TujuanWbsTable::configure($table);
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
            'index' => ListTujuanWbs::route('/'),
            'create' => CreateTujuanWbs::route('/create'),
            'view' => ViewTujuanWbs::route('/{record}'),
            'edit' => EditTujuanWbs::route('/{record}/edit'),
        ];
    }
}
