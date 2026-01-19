<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Spatie\Activitylog\Facades\LogBatch;

class LogSuccessfulLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;
        
        $logName = match($user->c_wbls_admauth) {
            '0' => 'admin_activity',
            '1' => 'operator_activity',
            '2' => 'verifikator_activity',
            default => 'default',
        };

        activity($logName)
            ->causedBy($user)
            ->event('login')
            ->log('User ' . $user->n_wbls_adm . ' logged in');
    }
}
