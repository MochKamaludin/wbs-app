<?php

namespace App\Filament\Resources\PerlindunganPelapors\Schemas;

use App\Models\PerlindunganPelapor;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;

class PerlindunganPelaporForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('n_wbls_protect')
                    ->label('Judul')
                    ->required(),
                
                TextInput::make('c_wbls_protectord')
                    ->label('Urutan')
                    ->numeric()
                    ->required()
                    ->default(function () {
                        $last = PerlindunganPelapor::max('c_wbls_protectord');
                        return $last ? $last + 1 : 1;
                    })
                    ->unique(
                        table: PerlindunganPelapor::class,
                        column: 'i_wbls_protect',
                        ignoreRecord: true
                    )
                    ->validationMessages([
                        'unique' => 'No urut sudah digunakan',
                    ]),

                RichEditor::make('e_wbls_protect')
                    ->label('Deskripsi')
                    ->required()
                    ->columnSpanFull()
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('faq')
                    ->fileAttachmentsVisibility('public'),

                Toggle::make('f_wbls_protectstat')
                    ->label('Publish')
                    ->default(true),
            ]);
    }
}
