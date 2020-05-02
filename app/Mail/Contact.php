<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $mes, $email,$enterprise;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name,string $enterprise, string $email, string $message)
    {
       $this->name = $name;
       $this->enterprise = $enterprise;
       $this->mes = $message;
       $this->email = $email;
   }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email)->view('mails.contact')->subject("Formulario Contacto Web");
    }
}
