<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class VerifikatorNotification extends Mailable
{
    public $i_wbls;
    public $uraian;

    public function __construct($i_wbls, $uraian)
    {
        $this->i_wbls = $i_wbls;
        $this->uraian = $uraian;
    }

    public function build()
    {
        return $this->subject('Laporan Baru untuk Verifikasi')
            ->view('emails.verifikator_notification')
            ->with([
                'i_wbls' => $this->i_wbls,
                'uraian' => $this->uraian,
            ]);
    }
}
