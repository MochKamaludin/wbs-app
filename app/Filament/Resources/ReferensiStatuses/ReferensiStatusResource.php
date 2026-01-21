<?php

namespace App\Filament\Resources\ReferensiStatuses;

use App\Filament\Resources\ReferensiStatuses\Pages\CreateReferensiStatus;
use App\Filament\Resources\ReferensiStatuses\Pages\EditReferensiStatus;
use App\Filament\Resources\ReferensiStatuses\Pages\ListReferensiStatuses;
use App\Filament\Resources\ReferensiStatuses\Pages\ViewReferensiStatus;
use App\Filament\Resources\ReferensiStatuses\Schemas\ReferensiStatusForm;
use App\Filament\Resources\ReferensiStatuses\Schemas\ReferensiStatusInfolist;
use App\Filament\Resources\ReferensiStatuses\Tables\ReferensiStatusesTable;
use App\Models\ReferensiStatus;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ReferensiStatusResource extends Resource
{
    protected static ?string $model = ReferensiStatus::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookmark;

    protected static ?string $navigationLabel = 'Referensi Status';

    protected static ?string $pluralModelLabel = 'Referensi Status';
    protected static string|UnitEnum|null $navigationGroup = 'Referensi';

    protected static ?int $navigationSort = 7;

    public static function form(Schema $schema): Schema
    {
        return ReferensiStatusForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ReferensiStatusInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReferensiStatusesTable::configure($table);
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
            'index' => ListReferensiStatuses::route('/'),
            'create' => CreateReferensiStatus::route('/create'),
            'view' => ViewReferensiStatus::route('/{record}'),
            'edit' => EditReferensiStatus::route('/{record}/edit'),
        ];
    }
}
