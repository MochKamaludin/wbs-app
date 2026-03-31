<?php

<<<<<<< HEAD:app/Filament/Pages/Auth/RequestResetPassword.php
namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\PasswordReset\RequestPasswordReset as BaseRequestPasswordReset;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Log;
=======
namespace App\Filament\Administrator\Pages\Auth;

use Filament\Auth\Pages\PasswordReset\RequestPasswordReset as BaseRequestPasswordReset;
use Filament\Forms\Components\TextInput;
>>>>>>> 872cd6be2cd6e6f94beaf0372aa219999783b36a:app/Filament/Pages/RequestResetPassword.php

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
<<<<<<< HEAD:app/Filament/Pages/Auth/RequestResetPassword.php

    protected function sendPasswordResetNotification($user, $token)
    {
        try {
            parent::sendPasswordResetNotification($user, $token);
            Log::info('Password reset email sent', [
                'user' => $user->i_wbls_adm ?? null,
                'token' => $token,
            ]);
        } catch (\Exception $e) {
            Log::error('Password reset email failed', [
                'user' => $user->i_wbls_adm ?? null,
                'token' => $token,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }
=======
>>>>>>> 872cd6be2cd6e6f94beaf0372aa219999783b36a:app/Filament/Pages/RequestResetPassword.php
}