<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class VerifikatorNotification extends Mailable
{
    public function build()
    {
        return $this->subject('Notifikasi Laporan Baru - Whistleblowing System, ' . now()->format('Y-m-d H:i:s'))
            ->view('emails.verifikator_notification');
    }
}
