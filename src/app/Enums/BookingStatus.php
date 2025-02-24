<?php

namespace App\Enums;

enum BookingStatus: string
{
    case PENDING = 'PENDING';
    case CONFIRMED = 'CONFIRMED';
    case CANCELLED = 'CANCELLED';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
