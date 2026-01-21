<?php

namespace App\Filament\Resources\PerlindunganPelapors;

use App\Filament\Resources\PerlindunganPelapors\Pages\CreatePerlindunganPelapor;
use App\Filament\Resources\PerlindunganPelapors\Pages\EditPerlindunganPelapor;
use App\Filament\Resources\PerlindunganPelapors\Pages\ListPerlindunganPelapors;
use App\Filament\Resources\PerlindunganPelapors\Pages\ViewPerlindunganPelapor;
use App\Filament\Resources\PerlindunganPelapors\Schemas\PerlindunganPelaporForm;
use App\Filament\Resources\PerlindunganPelapors\Schemas\PerlindunganPelaporInfolist;
use App\Filament\Resources\PerlindunganPelapors\Tables\PerlindunganPelaporsTable;
use App\Models\PerlindunganPelapor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PerlindunganPelaporResource extends Resource
{
    protected static ?string $model = PerlindunganPelapor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldCheck;

    protected static ?string $navigationLabel = 'Perlindungan Pelapor';
    protected static ?string $pluralModelLabel = 'Perlindungan Pelapor';

    protected static string|UnitEnum|null $navigationGroup = 'Tentang';

    protected static ?int $navigationSort = 5;
    public static function form(Schema $schema): Schema
    {
        return PerlindunganPelaporForm::configure($schema);
    }

    // public static function infolist(Schema $schema): Schema
    // {
    //     return PerlindunganPelaporInfolist::configure($schema);
    // }

    public static function table(Table $table): Table
    {
        return PerlindunganPelaporsTable::configure($table);
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
            'index' => ListPerlindunganPelapors::route('/'),
            'create' => CreatePerlindunganPelapor::route('/create'),
            // 'view' => ViewPerlindunganPelapor::route('/{record}'),
            'edit' => EditPerlindunganPelapor::route('/{record}/edit'),
        ];
    }
}