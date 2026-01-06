<?php

namespace App\Filament\Resources\WaktuDigunakans;

use App\Filament\Resources\WaktuDigunakans\Pages\CreateWaktuDigunakan;
use App\Filament\Resources\WaktuDigunakans\Pages\EditWaktuDigunakan;
use App\Filament\Resources\WaktuDigunakans\Pages\ListWaktuDigunakans;
use App\Filament\Resources\WaktuDigunakans\Pages\ViewWaktuDigunakan;
use App\Filament\Resources\WaktuDigunakans\Schemas\WaktuDigunakanForm;
use App\Filament\Resources\WaktuDigunakans\Schemas\WaktuDigunakanInfolist;
use App\Filament\Resources\WaktuDigunakans\Tables\WaktuDigunakansTable;
use App\Models\DefinisiWbs;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Illuminate\Database\Eloquent\Builder;

class WaktuDigunakanResource extends Resource
{
    protected static ?string $model = DefinisiWbs::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClock;

    protected static ?string $navigationLabel = 'Kapan WBS Dapat Digunakan?';
    protected static ?string $pluralModelLabel = 'Kapan WBS Dapat Digunakan?';

    protected static string|UnitEnum|null $navigationGroup = 'Tentang';

    protected static ?int $navigationSort = 3;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('i_wbls_about', '2');
    }

    public static function form(Schema $schema): Schema
    {
        return WaktuDigunakanForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WaktuDigunakanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WaktuDigunakansTable::configure($table);
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
            'index' => ListWaktuDigunakans::route('/'),
            'create' => CreateWaktuDigunakan::route('/create'),
            'view' => ViewWaktuDigunakan::route('/{record}'),
            'edit' => EditWaktuDigunakan::route('/{record}/edit'),
        ];
    }
}
