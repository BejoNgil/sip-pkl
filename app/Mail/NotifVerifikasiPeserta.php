<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifVerifikasiPeserta extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $nama_peserta = '';
    protected $url = '';

    public function __construct($nama_peserta, $url)
    {
        //
        $this->nama_peserta = $nama_peserta;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('kampungmarketer00@gmail.com', 'Kampung Marketer')
            ->subject('Verifikasi Pendaftaran')
            ->markdown('mails.verifikasipeserta')
            ->with([
                'name' => $this->nama_peserta,
                'link' => $this->url
            ]);
    }
}
