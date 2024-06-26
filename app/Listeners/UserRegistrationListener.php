<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistrationListener implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        /* @var \App\Models\User $user */
        $user = $event->user;
        $user->sendEmailVerificationNotification();
    }
}
