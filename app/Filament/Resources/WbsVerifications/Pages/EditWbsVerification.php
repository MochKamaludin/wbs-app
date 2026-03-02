<?php

namespace App\Filament\Resources\WbsVerifications\Pages;

use App\Filament\Resources\WbsVerifications\WbsVerificationResource;
use App\Models\Verification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditWbsVerification extends EditRecord    {
    protected static string $resource = WbsVerificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $verificationData = [
            'f_wbls_usrname' => $data['f_wbls_usrname'] ?? null,
            'f_wbls_file' => $data['f_wbls_file'] ?? null,
        ];

        $verification = Verification::where('i_wbls', $this->record->i_wbls)->first();

        if (! $verification) {
            $seq = (Verification::max('i_wbls_bavrfseq') ?? 0) + 1;

            $kode = 'BAV/' .
                str_pad($seq, 4, '0', STR_PAD_LEFT) .
                '/PTD/' .
                now()->format('m/Y');

            $verificationData = array_merge($verificationData, [
                'i_wbls' => $this->record->i_wbls,
                'i_wbls_bavrfseq' => $seq,
                'i_wbls_bavrf' => $kode,
                'i_wbls_adm' => Auth::user()->i_wbls_adm,
                'd_wbls_vrf' => now(),
            ]);
        }

        Verification::updateOrCreate(
            ['i_wbls' => $this->record->i_wbls],
            $verificationData,
        );

        unset($data['f_wbls_usrname'], $data['f_wbls_file']);

        return $data;
    }
}

