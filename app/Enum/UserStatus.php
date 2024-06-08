<?php

namespace App\Enum;

enum UserStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case PENDING = 'pending';
    case BLOCKED = 'blocked';

    public static function values(): array
    {
        return collect([
            self::ACTIVE,
            self::INACTIVE,
            self::PENDING,
            self::BLOCKED,
        ])->pluck('value')->toArray();
    }
}
