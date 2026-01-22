<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Schemas\Schema;
use Illuminate\Validation\ValidationException;
use Filament\Forms\Components\Actions\Action as FormAction;

class Login extends BaseLogin
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('i_wbls_adm')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->autofocus(),

                $this->getPasswordFormComponent()
                    ->label('Password')
                    ->required(),

                $this->getRememberFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'i_wbls_adm' => $data['i_wbls_adm'],
            'password'  => $data['password'],
        ];
    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.i_wbls_adm' => __('Maaf, email atau password yang Anda masukkan salah.'),
        ]);
    }
}
