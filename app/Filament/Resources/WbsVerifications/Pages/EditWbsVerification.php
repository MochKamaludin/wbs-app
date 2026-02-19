<?php

namespace App\Filament\Resources\WbsVerifications\Pages;

use App\Filament\Resources\WbsVerifications\WbsVerificationResource;
use App\Models\TmwblsVrf;
use App\Models\Verification;
use App\Services\BaVerifikasiService;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditWbsVerification extends EditRecord
{
    protected static string $resource = WbsVerificationResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Action::make('generate_ba')
                ->label('Generate BA Verifikasi')
                ->color('success')
                ->action(function () {
                    return BaVerifikasiService::generate($this->record);
                }),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $verificationData = $data['verification'] ?? [];

        unset($data['verification']);

        $this->record->update($data);

        $this->record->verification()->updateOrCreate(
            ['i_wbls' => $this->record->i_wbls],
            array_merge($verificationData, [
                'i_wbls_adm' => Auth::user()->i_wbls_adm,
                'd_wbls_vrf' => now(),
            ])
        );

        return [];
    }


    protected function afterSave(): void
    {
        $data = $this->form->getState();

        $verification = $this->record->verification;

        if (!$verification) {
            $verification = $this->record->verification()->create([
                'i_wbls' => $this->record->i_wbls,
            ]);
        }

        $verification->update([
            'f_wbls_usrname'  => $data['f_wbls_usrname'] ?? null,
            'f_wbls_file'     => $data['f_wbls_file'] ?? null,
            'e_wbls_stat'     => $data['e_wbls_stat'] ?? null,

            'i_wbls_bavrf'    => $data['i_wbls_bavrf'] ?? null,
            'i_wbls_bavrfseq' => $data['i_wbls_bavrfseq'] ?? null,
            'i_wbls_adm'      => Auth::user()->i_wbls_adm,
            'd_wbls_vrf'      => now(),
        ]);
    }



}
