<?php

namespace App\Listeners;

use App\Events\Registered;
use App\Notifications\Registration;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRegistrationMail implements ShouldQueue
{
    /**
     * Handle the event. Notify user
     * with registration email.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $event->user->notify(new Registration($event->user));
    }
}
