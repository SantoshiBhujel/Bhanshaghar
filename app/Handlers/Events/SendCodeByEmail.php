<?php

namespace App\Handlers\Events;

use queue;
use App\User;
use App\ActivationCode;

use App\Mail\ActivationEmail;
use App\Events\ActivationEmailEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;


class SendCodeByEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ActivationEmailEvent  $event
     * @return void
     */
    public function handle(ActivationEmailEvent $event)
    {
        Mail::to($event->user)->send(new ActivationEmail($event->user->ActivationCode) );
    }
}
