<?php

namespace App\Filament\Resources\ActivityLogResource\Pages;

use App\Filament\Resources\ActivityLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\TextEntry;
use Filament\Schemas\Components\KeyValueEntry;

class ViewActivityLog extends ViewRecord
{
    protected static string $resource = ActivityLogResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Activity Details')
                    ->schema([
                        TextEntry::make('log_name')
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
                            }),

                        TextEntry::make('event')
                            ->label('Event')
                            ->badge()
                            ->color(fn ($state) => match ($state) {
                                'created' => 'success',
                                'updated' => 'warning',
                                'deleted' => 'danger',
                                'login' => 'info',
                                'logout' => 'gray',
                                default => 'primary',
                            }),

                        TextEntry::make('description')
                            ->label('Description'),

                        TextEntry::make('subject_type')
                            ->label('Subject Type')
                            ->formatStateUsing(fn ($state) => $state ? class_basename($state) : '-'),

                        TextEntry::make('subject_id')
                            ->label('Subject ID'),

                        TextEntry::make('causer.n_wbls_adm')
                            ->label('User'),

                        TextEntry::make('causer.c_wbls_admauth')
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

                        TextEntry::make('created_at')
                            ->label('Tanggal')
                            ->dateTime('d M Y H:i:s'),
                    ])
                    ->columns(2),

                Section::make('Properties')
                    ->schema([
                        KeyValueEntry::make('properties')
                            ->label('Properties')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }
}
