<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CotizacionClienteMail extends Mailable
{
    use Queueable, SerializesModels;


   public $datos;

    public function __construct(array $datos)
    {
        $this->datos = $datos;
    }

    public function build()
    {
        return $this->subject('¡Gracias por tu solicitud en Helmcode!')
                    ->view('emails.cliente_confirmacion')
                    ->from(config('mail.from.address'), 'Helmcode');
    }

}
