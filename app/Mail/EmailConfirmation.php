<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $confirmation_code;

    public function __construct($confirmation_code) {
        $this->confirmation_code = $confirmation_code;
    }

    public function build()
    {
        return $this->subject('Проверка почтового адреса')
            ->view('mail.email_confirm')->with([
            'confirmation_code' => $this->confirmation_code
        ]);
    }
}
