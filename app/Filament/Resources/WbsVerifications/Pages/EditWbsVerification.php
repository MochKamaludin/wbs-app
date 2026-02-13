<?php

namespace App\Filament\Resources\WbsVerifications\Pages;

use App\Filament\Resources\WbsVerifications\WbsVerificationResource;
use App\Models\TmwblsVrf;
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
    if (empty($this->record->i_wbls_bavrf)) {

        $seq = (TmwblsVrf::max('i_wbls_bavrfseq') ?? 0) + 1;

        $kode = 'BAV/' .
            str_pad($seq, 4, '0', STR_PAD_LEFT) .
            '/PTD/' .
            now()->format('m/Y');

        $data['i_wbls_bavrfseq'] = $seq;
        $data['i_wbls_bavrf'] = $kode;
        $data['i_wbls_adm'] = Auth::user()->i_wbls_adm;
        $data['d_wbls_vrf'] = now();
    }

    return $data;
}



}
