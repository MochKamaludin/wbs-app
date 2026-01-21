<?php

namespace App\Filament\Resources\DasarWbs;

use App\Filament\Resources\DasarWbs\Pages\CreateDasarWbs;
use App\Filament\Resources\DasarWbs\Pages\EditDasarWbs;
use App\Filament\Resources\DasarWbs\Pages\ListDasarWbs;
use App\Filament\Resources\DasarWbs\Pages\ViewDasarWbs;
use App\Filament\Resources\DasarWbs\Schemas\DasarWbsForm;
use App\Filament\Resources\DasarWbs\Schemas\DasarWbsInfolist;
use App\Filament\Resources\DasarWbs\Tables\DasarWbsTable;
use App\Models\DefinisiWbs;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Illuminate\Database\Eloquent\Builder;

class DasarWbsResource extends Resource
{
    protected static ?string $model = DefinisiWbs::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedScale;

    protected static ?string $navigationLabel = 'Dasar WBS';
    protected static ?string $pluralModelLabel = 'Dasar WBS';

    protected static string|UnitEnum|null $navigationGroup = 'Tentang';

    protected static ?int $navigationSort = 7;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('i_wbls_about', '3');
    }

    public static function form(Schema $schema): Schema
    {
        return DasarWbsForm::configure($schema);
    }

    // public static function infolist(Schema $schema): Schema
    // {
    //     return DasarWbsInfolist::configure($schema);
    // }

    public static function table(Table $table): Table
    {
        return DasarWbsTable::configure($table);
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
            'index' => ListDasarWbs::route('/'),
            'create' => CreateDasarWbs::route('/create'),
            // 'view' => ViewDasarWbs::route('/{record}'),
            'edit' => EditDasarWbs::route('/{record}/edit'),
        ];
    }
}
