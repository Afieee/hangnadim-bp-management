<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PengubahStatusInspeksiMail extends Mailable
{
    use Queueable, SerializesModels;

    public $namaPengubah;
    public $field;
    public $value;
    public $emailPengubah; 

    /**
     * Buat instance baru dari mailable.
     */
    public function __construct($namaPengubah, $field, $value, $emailPengubah)
    {
        $this->namaPengubah = $namaPengubah;
        $this->field = $field;
        $this->value = $value;
        $this->emailPengubah = $emailPengubah;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Notifikasi Perubahan Status Inspeksi')
                    ->view('emails.pengubah_status_inspeksi')
                    ->with([
                        'namaPengubah' => $this->namaPengubah,
                        'field' => $this->field,
                        'value' => $this->value,
                        'emailPengubah' => $this->emailPengubah, // <-- kirim ke view
                    ]);
    }
}
