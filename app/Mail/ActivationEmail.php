<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\ActivationCode;
use App\User;

class ActivationEmail extends Mailable /*implements ShouldQueue*/
{
    use Queueable, SerializesModels;
    public $code;
    public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ActivationCode $code)
    {
        $this->code = $code;
        $this->url=route('user.activation', $this->code);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.user_activation');
    }
}
