<?php

namespace App\Filament\Resources\RekapData;

use App\Filament\Resources\RekapData\Pages\CreateRekapData;
use App\Filament\Resources\RekapData\Pages\EditRekapData;
use App\Filament\Resources\RekapData\Pages\ListRekapData;
use App\Filament\Resources\RekapData\Pages\ViewRekapData;
use App\Filament\Resources\RekapData\Schemas\RekapDataForm;
use App\Filament\Resources\RekapData\Schemas\RekapDataInfolist;
use App\Filament\Resources\RekapData\Tables\RekapDataTable;
use App\Models\Pengaduan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class RekapDataResource extends Resource
{
    protected static ?string $model = Pengaduan::class;

    protected static ?string $navigationLabel = 'Rekap Data';
    protected static ?string $pluralModelLabel = 'Rekap Data';
    protected static ?string $modelLabel = 'Rekap Data';
    

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Laporan';

    protected static ?int $navigationSort = 3;

    public static function canAccess(): bool
    {
        $user = Auth::user();
        return $user && ($user->c_wbls_admauth === '1' || $user->c_wbls_admauth === '2');
    }

    public static function getNavigationBadge(): ?string
    {
        return Pengaduan::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return "success";
    }

    public static function form(Schema $schema): Schema
    {
        return RekapDataForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RekapDataInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RekapDataTable::configure($table);
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
            'index' => ListRekapData::route('/'),
            // 'create' => CreateRekapData::route('/create'),
            // 'view' => ViewRekapData::route('/{record}'),
            // 'edit' => EditRekapData::route('/{record}/edit'),
        ];
    }
}
