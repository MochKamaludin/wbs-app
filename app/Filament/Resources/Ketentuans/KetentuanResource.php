<?php

namespace App\Filament\Resources\Ketentuans;

use App\Filament\Resources\Ketentuans\Pages\CreateKetentuan;
use App\Filament\Resources\Ketentuans\Pages\EditKetentuan;
use App\Filament\Resources\Ketentuans\Pages\ListKetentuans;
use App\Filament\Resources\Ketentuans\Pages\ViewKetentuan;
use App\Filament\Resources\Ketentuans\Schemas\KetentuanForm;
use App\Filament\Resources\Ketentuans\Schemas\KetentuanInfolist;
use App\Filament\Resources\Ketentuans\Tables\KetentuansTable;
use App\Models\DefinisiWbs;
use App\Models\Ketentuan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Illuminate\Database\Eloquent\Builder;

class KetentuanResource extends Resource
{
    protected static ?string $model = DefinisiWbs::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Ketentuan & Kebijakan';
    protected static ?string $pluralModelLabel = 'Ketentuan & Kebijakan';

    protected static string|UnitEnum|null $navigationGroup = 'Tentang';

    protected static ?int $navigationSort = 8;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('i_wbls_about', '4');
    }

    public static function form(Schema $schema): Schema
    {
        return KetentuanForm::configure($schema);
    }

    // public static function infolist(Schema $schema): Schema
    // {
    //     return KetentuanInfolist::configure($schema);
    // }

    public static function table(Table $table): Table
    {
        return KetentuansTable::configure($table);
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
            'index' => ListKetentuans::route('/'),
            'create' => CreateKetentuan::route('/create'),
            // 'view' => ViewKetentuan::route('/{record}'),
            'edit' => EditKetentuan::route('/{record}/edit'),
        ];
    }
}
