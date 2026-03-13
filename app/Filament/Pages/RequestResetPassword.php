<?php

namespace App\Filament\Administrator\Pages\Auth;

use Filament\Auth\Pages\PasswordReset\RequestPasswordReset as BaseRequestPasswordReset;
use Filament\Forms\Components\TextInput;

class RequestPasswordReset extends BaseRequestPasswordReset
{
    protected function getEmailFormComponent(): TextInput
    {
        return TextInput::make('i_wbls_adm')
            ->label('Email')
            ->email()
            ->required()
            ->autofocus()
            ->placeholder('Masukkan email Anda');
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'i_wbls_adm' => $data['i_wbls_adm'],
        ];
    }
}