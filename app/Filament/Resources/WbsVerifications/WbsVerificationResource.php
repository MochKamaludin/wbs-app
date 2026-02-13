<?php

namespace App\Filament\Resources\WbsVerifications;

use App\Filament\Resources\WbsVerifications\Pages\CreateWbsVerification;
use App\Filament\Resources\WbsVerifications\Pages\EditWbsVerification;
use App\Filament\Resources\WbsVerifications\Pages\ListWbsVerifications;
use App\Filament\Resources\WbsVerifications\Pages\ViewWbsVerification;
use App\Filament\Resources\WbsVerifications\Schemas\WbsVerificationForm;
use App\Filament\Resources\WbsVerifications\Schemas\WbsVerificationInfolist;
use App\Filament\Resources\WbsVerifications\Tables\WbsVerificationsTable;
use App\Models\Tmwbls;
use App\Models\WbsVerification;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class WbsVerificationResource extends Resource
{
    protected static ?string $model = Tmwbls::class;

    protected static ?string $navigationLabel = 'Verifikasi Laporan';
    protected static ?string $pluralModelLabel = 'Verifikasi Laporan';
    protected static ?string $modelLabel = 'Verifikasi Laporan';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldCheck;

    protected static string|UnitEnum|null $navigationGroup = 'Laporan';

    protected static ?int $navigationSort = 2;

    public static function canAccess(): bool
    {
        $user = Auth::user();
        return $user && $user->c_wbls_admauth === '1';
    }

    public static function getNavigationBadge(): ?string
    {
        return Tmwbls::whereNull('f_wbls_agree')
            ->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return "success";
    }

    public static function form(Schema $schema): Schema
    {
        return WbsVerificationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WbsVerificationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WbsVerificationsTable::configure($table);
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
            'index' => ListWbsVerifications::route('/'),
            // 'create' => CreateWbsVerification::route('/create'),
            // 'view' => ViewWbsVerification::route('/{record}'),
            // 'edit' => EditWbsVerification::route('/{record}/edit'),
        ];
    }
}
