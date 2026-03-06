<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class InvestigatorNotification extends Mailable
{
    public function build()
    {
        return $this->subject('Notifikasi Laporan Baru - Whistleblowing System, ' . now()->format('Y-m-d H:i:s'))
            ->view('emails.investigator_notification');
    }
}
