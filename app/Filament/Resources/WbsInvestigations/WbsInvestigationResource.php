<?php

namespace App\Filament\Resources\WbsInvestigations;

use App\Filament\Resources\WbsInvestigations\Pages\CreateWbsInvestigation;
use App\Filament\Resources\WbsInvestigations\Pages\EditWbsInvestigation;
use App\Filament\Resources\WbsInvestigations\Pages\ListWbsInvestigations;
use App\Filament\Resources\WbsInvestigations\Pages\ViewWbsInvestigation;
use App\Filament\Resources\WbsInvestigations\Schemas\WbsInvestigationForm;
use App\Filament\Resources\WbsInvestigations\Schemas\WbsInvestigationInfolist;
use App\Filament\Resources\WbsInvestigations\Tables\WbsInvestigationsTable;
use App\Filament\Widgets\StatWidget;
use App\Models\Tmwbls;
use App\Models\WbsInvestigation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use UnitEnum;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class WbsInvestigationResource extends Resource
{
    protected static ?string $model = Tmwbls::class;

    protected static ?string $navigationLabel = 'Investigasi Laporan';
    protected static ?string $pluralModelLabel = 'Investigasi Laporan';
    protected static ?string $modelLabel = 'Investigasi Laporan';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;

    protected static string|UnitEnum|null $navigationGroup = 'Laporan';

    protected static ?int $navigationSort = 2;

    public static function canAccess(): bool
    {
        $user = Auth::user();
        return $user && $user->c_wbls_admauth === '2';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('f_wbls_agree', '1')
            ->where('c_wbls_stat', '4');
    }

    public static function getNavigationBadge(): ?string
    {
        return Tmwbls::where('f_wbls_agree', '1')
            ->where('c_wbls_stat', '4')
            ->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return "success";
    }

    public static function form(Schema $schema): Schema
    {
        return WbsInvestigationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WbsInvestigationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WbsInvestigationsTable::configure($table);
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
            'index' => ListWbsInvestigations::route('/'),
            //'create' => CreateWbsInvestigation::route('/create'),
            // 'view' => ViewWbsInvestigation::route('/{record}'),
            // 'edit' => EditWbsInvestigation::route('/{record}/edit'),
        ];
    }
}
