<?php

namespace App\Listeners;

use App\Enum\UserRole;
use App\Enum\UserStatus;
use Illuminate\Auth\Events\Verified;

class UserEmailVerificationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Verified $event): void
    {
        /* @var \App\Models\User $user */
        $user = $event->user;

        if (!$user->hasRole(UserRole::ORGANIZER)) {
            $user->update(['status' => UserStatus::ACTIVE]);
        }
    }
}
