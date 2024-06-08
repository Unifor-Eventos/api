<?php

namespace App\Enum;

class UserRole
{
    public const ADMIN = 'admin';
    public const ORGANIZER = 'organizer';

    public static function values(): array
    {
        return collect([
            self::ADMIN,
            self::ORGANIZER,
        ])->pluck('value')->toArray();
    }
}
