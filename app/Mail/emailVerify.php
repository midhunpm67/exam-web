<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class emailVerify extends Mailable
{
    use Queueable, SerializesModels;

    protected $tkn;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tkn)
    {
        $this->token = $tkn;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.verify-email', ["token" => $this->token]);
    }
}
