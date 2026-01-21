<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityLogResource\Pages;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Models\Activity;
use BackedEnum;
use Filament\Support\Icons\Heroicon;

class ActivityLogResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static ?string $navigationLabel = 'Activity Log';

    protected static ?string $pluralModelLabel = 'Activity Logs';

    protected static ?int $navigationSort = 100;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('log_name')
                    ->label('Log Type')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'admin_activity' => 'Admin Activity',
                        'operator_activity' => 'Operator Activity',
                        'verifikator_activity' => 'Verifikator Activity',
                        default => $state,
                    })
                    ->color(fn ($state) => match ($state) {
                        'admin_activity' => 'danger',
                        'operator_activity' => 'info',
                        'verifikator_activity' => 'success',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),

                TextColumn::make('event')
                    ->label('Event')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        'login' => 'info',
                        'logout' => 'gray',
                        default => 'primary',
                    })
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Description')
                    ->searchable()
                    ->limit(50),

                TextColumn::make('subject_type')
                    ->label('Subject Type')
                    ->formatStateUsing(fn ($state) => class_basename($state))
                    ->searchable(),

                TextColumn::make('causer.n_wbls_adm')
                    ->label('User')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('causer.c_wbls_admauth')
                    ->label('Role')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        '0' => 'Admin',
                        '1' => 'Operator',
                        '2' => 'Verifikator',
                        default => 'Unknown',
                    })
                    ->color(fn ($state) => match ($state) {
                        '0' => 'danger',
                        '1' => 'info',
                        '2' => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('log_name')
                    ->label('Log Type')
                    ->options([
                        'admin_activity' => 'Admin Activity',
                        'operator_activity' => 'Operator Activity',
                        'verifikator_activity' => 'Verifikator Activity',
                    ])
                    ->placeholder('Semua Log Type'),

                SelectFilter::make('event')
                    ->label('Event')
                    ->options([
                        'login' => 'Login',
                        'logout' => 'Logout',
                        'created' => 'Created',
                        'updated' => 'Updated',
                        'deleted' => 'Deleted',
                    ])
                    ->placeholder('Semua Event'),

                SelectFilter::make('causer_id')
                    ->label('User')
                    ->options(fn () => \App\Models\User::pluck('n_wbls_adm', 'i_wbls_adm')->toArray())
                    ->searchable()
                    ->placeholder('Semua User'),

                Filter::make('created_at')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('created_from')
                            ->label('Dari Tanggal'),
                        \Filament\Forms\Components\DatePicker::make('created_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Dari: ' . \Carbon\Carbon::parse($data['created_from'])->format('d M Y');
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Sampai: ' . \Carbon\Carbon::parse($data['created_until'])->format('d M Y');
                        }
                        return $indicators;
                    }),
            // ])
            // ->actions([
            //     ViewAction::make()
            //         ->label('Detail'),
            ]);
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
            'index' => Pages\ListActivityLogs::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
