<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Spatie\Activitylog\Models\Activity;

class LogSuccessfulLogout
{
    /**
     * Handle the event.
     */
    public function handle(Logout $event): void
    {
        // Kadang logout tanpa user (session expired)
        if (! $event->user) {
            return;
        }

        $user = $event->user;

        $logName = match ($user->c_wbls_admauth) {
            '0' => 'admin_activity',
            '1' => 'verifikator_activity',
            '2' => 'investigator_activity',
            default => 'default',
        };

        // Cegah double log logout
        $recentLog = Activity::where('log_name', $logName)
            ->where('causer_id', $user->i_wbls_adm)
            ->where('event', 'logout')
            ->where('created_at', '>=', now()->subSeconds(5))
            ->exists();

        if ($recentLog) {
            return;
        }

        activity($logName)
            ->causedBy($user->i_wbls_adm)
            ->event('logout')
            ->log('User ' . $user->n_wbls_adm . ' berhasil logout');
    }
}
