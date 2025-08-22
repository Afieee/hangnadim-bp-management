<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\InspeksiGedung;

class JadwalInspeksiMail extends Mailable
{
    use Queueable, SerializesModels;

    public $inspeksi;

    public function __construct(InspeksiGedung $inspeksi)
    {
        $this->inspeksi = $inspeksi;
    }

    public function build()
    {
        return $this->subject('Jadwal Inspeksi AEROCITY-BP Management')
                    ->view('emails.jadwal_inspeksi');
    }
}
