<?php

namespace App\Observers;

use App\Models\Pengaduan;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Notifications\DatabaseNotification;

class PengaduanObserver
{
    /**
     * Handle the Pengaduan "created" event.
     */
    public function created(Pengaduan $pengaduan): void
    {
        $verificators = User::where('c_wbls_admauth', '1')->get();

        foreach ($verificators as $user) {

            Notification::make()
                ->title('Pengaduan Baru')
                ->body("Pengaduan dengan Nomor {$pengaduan->i_wbls} telah masuk.")
                ->success()
                ->actions([
                    Action::make('lihat')
                        ->label('Lihat Laporan')
                        ->url("/admin/wbs-verifications")
                        ->markAsRead()
                ])
                ->sendToDatabase($user);
        }
    }

    /**
     * Handle the Pengaduan "updated" event.
     */
    public function updated(Pengaduan $pengaduan): void
    {
        if ($pengaduan->wasChanged('f_wbls_agree') && $pengaduan->f_wbls_agree == 1) {

            $investigators = User::where('c_wbls_admauth', '2')->get();

            foreach ($investigators as $user) {

                Notification::make()
                    ->title('Pengaduan Disetujui Verifikator')
                    ->body("Pengaduan dengan Nomor {$pengaduan->i_wbls} telah disetujui.")
                    ->success()
                    ->actions([
                        Action::make('lihat')
                            ->label('Lihat Laporan')
                            ->url("/admin/wbs-investigations")
                            ->markAsRead()
                    ])
                    ->sendToDatabase($user);
            }
        }
    }

    /**
     * Handle the Pengaduan "deleted" event.
     */
    public function deleted(Pengaduan $pengaduan): void
    {
        //
    }

    /**
     * Handle the Pengaduan "restored" event.
     */
    public function restored(Pengaduan $pengaduan): void
    {
        //
    }

    /**
     * Handle the Pengaduan "force deleted" event.
     */
    public function forceDeleted(Pengaduan $pengaduan): void
    {
        //
    }
}
