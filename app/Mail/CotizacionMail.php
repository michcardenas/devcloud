<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CotizacionMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Los datos de la cotización.
     *
     * @var array
     */
    public $datos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $datos)
    {
        $this->datos = $datos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nueva solicitud de cotización: ' . $this->datos['servicio'] . ' - ' . $this->datos['nombre'])
            ->view('emails.cotizacion')
            ->replyTo($this->datos['email'], $this->datos['nombre']);
    }
}