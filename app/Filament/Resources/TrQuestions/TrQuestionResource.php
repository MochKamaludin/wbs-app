<?php

namespace App\Filament\Resources\TrQuestions;

use App\Filament\Resources\TrQuestions\Pages\CreateTrQuestion;
use App\Filament\Resources\TrQuestions\Pages\EditTrQuestion;
use App\Filament\Resources\TrQuestions\Pages\ListTrQuestions;
use App\Filament\Resources\TrQuestions\Pages\ViewTrQuestion;
use App\Filament\Resources\TrQuestions\Schemas\TrQuestionForm;
use App\Filament\Resources\TrQuestions\Infolists\TrQuestionInfolist;
use App\Filament\Resources\TrQuestions\Tables\TrQuestionsTable;
use App\Models\TrQuestion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;


class TrQuestionResource extends Resource
{
    protected static ?string $model = TrQuestion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    
    protected static ?string $navigationLabel = 'Pertanyaan';

    protected static ?string $pluralModelLabel = 'Pertanyaan';

    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return TrQuestion::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return "primary";
    }

    public static function form(Schema $schema): Schema
    {
        return TrQuestionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TrQuestionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TrQuestionsTable::configure($table);
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
            'index' => ListTrQuestions::route('/'),
            'create' => CreateTrQuestion::route('/create'),
            'edit' => EditTrQuestion::route('/{record}/edit'),
            'view'   => ViewTrQuestion::route('/{record}'),
        ];
    }
}
