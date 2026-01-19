<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;

class LogSuccessfulLogout
{
    /**
     * Handle the event.
     */
    public function handle(Logout $event): void
    {
        $user = $event->user;
        
        if ($user) {
            $logName = match($user->c_wbls_admauth) {
                '0' => 'admin_activity',
                '1' => 'operator_activity',
                '2' => 'verifikator_activity',
                default => 'default',
            };

            activity($logName)
                ->causedBy($user)
                ->event('logout')
                ->log('User ' . $user->n_wbls_adm . ' logged out');
        }
    }
}
