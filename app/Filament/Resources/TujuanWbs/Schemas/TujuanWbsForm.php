<?php

namespace App\Filament\Resources\TujuanWbs\Schemas;

use App\Models\TujuanWbs;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class TujuanWbsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('n_wbls_purpose')
                ->label('Judul')
                ->required()
                ->maxLength(100),

            TextInput::make('c_wbls_purposeord')
                ->label('Urutan Tampil')
                ->numeric()
                ->required()
                ->default(function () {
                    $last = TujuanWbs::max('i_wbls_purpose');
                    return $last ? $last + 1 : 1;
                })
                ->unique(
                    table: TujuanWbs::class,
                    column: 'i_wbls_purpose',
                    ignoreRecord: true
                )
                ->validationMessages([
                    'unique' => 'No urut sudah digunakan',
                ]),

            RichEditor::make('e_wbls_purpose')
                ->label('Deskripsi')
                ->required()
                ->columnSpanFull()
                ->fileAttachmentsDisk('public')
                ->fileAttachmentsDirectory('faq')
                ->fileAttachmentsVisibility('public'),

            Toggle::make('f_wbls_purposestat')
                ->label('Publish')
                ->default(true),
            ]);
    }
}
