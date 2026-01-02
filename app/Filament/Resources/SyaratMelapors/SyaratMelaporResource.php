<?php

namespace App\Filament\Resources\SyaratMelapors;

use App\Filament\Resources\SyaratMelapors\Pages\CreateSyaratMelapor;
use App\Filament\Resources\SyaratMelapors\Pages\EditSyaratMelapor;
use App\Filament\Resources\SyaratMelapors\Pages\ListSyaratMelapors;
use App\Filament\Resources\SyaratMelapors\Pages\ViewSyaratMelapor;
use App\Filament\Resources\SyaratMelapors\Schemas\SyaratMelaporForm;
use App\Filament\Resources\SyaratMelapors\Schemas\SyaratMelaporInfolist;
use App\Filament\Resources\SyaratMelapors\Tables\SyaratMelaporsTable;
use App\Models\SyaratMelapor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SyaratMelaporResource extends Resource
{
    protected static ?string $model = SyaratMelapor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    protected static ?string $navigationLabel = 'Syarat Melapor';
    protected static ?string $pluralModelLabel = 'Syarat Melapor';

    protected static string|UnitEnum|null $navigationGroup = 'Tentang';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return SyaratMelaporForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SyaratMelaporInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SyaratMelaporsTable::configure($table);
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
            'index' => ListSyaratMelapors::route('/'),
            'create' => CreateSyaratMelapor::route('/create'),
            'view' => ViewSyaratMelapor::route('/{record}'),
            'edit' => EditSyaratMelapor::route('/{record}/edit'),
        ];
    }
}
