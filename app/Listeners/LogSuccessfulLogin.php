<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Spatie\Activitylog\Models\Activity;

class LogSuccessfulLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;

        $logName = match ($user->c_wbls_admauth) {
            '0' => 'admin_activity',
            '1' => 'verifikator_activity',
            '2' => 'investigator_activity',
            default => 'default',
        };

        $recentLog = Activity::where('log_name', $logName)
            ->where('causer_id', $user->i_wbls_adm)
            ->where('event', 'login')
            ->where('created_at', '>=', now()->subSeconds(5))
            ->exists();

        if ($recentLog) {
            return;
        }

        activity($logName)
            ->causedBy($user->i_wbls_adm)
            ->event('login')
            ->log('User ' . $user->n_wbls_adm . ' berhasil login');
    }
}
