<?php

namespace App\Filament\Resources\SyaratMelapors\Schemas;

use App\Models\SyaratMelapor;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;

class SyaratMelaporForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            TextInput::make('n_wbls_req')
                ->label('Judul')
                ->required()
                ->maxLength(100),
            
            TextInput::make('c_wbls_reqord')
                ->label('Urutan Tampil')
                ->numeric()
                ->required()
                ->default(function () {
                    $last = SyaratMelapor::max('c_wbls_reqord');
                    return $last ? $last + 1 : 1;
                })
                ->unique(
                    table: SyaratMelapor::class,
                    column: 'i_wbls_req',
                    ignoreRecord: true
                )
                ->validationMessages([
                    'unique' => "No urut sudah digunakan"
                ]),

            RichEditor::make('e_wbls_req')
                ->label('Deskripsi')
                ->required()
                ->columnSpanFull()
                ->fileAttachmentsDisk('public')
                ->fileAttachmentsDirectory('faq')
                ->fileAttachmentsVisibility('public'),

            Toggle::make('f_wbls_reqstat')
                ->label('Publish')
                ->default(true),
            ]);
    }
}
