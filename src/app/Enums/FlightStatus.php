<?php

namespace App\Enums;

enum FlightStatus: string
{
    case SCHEDULED = 'SCHEDULED';
    case DELAYED = 'DELAYED';
    case DEPARTED = 'DEPARTED';
    case ARRIVED = 'ARRIVED';
    case CANCELLED = 'CANCELLED';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
