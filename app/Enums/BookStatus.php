<?php

namespace App\Enums;

enum BookStatus: string
{
    case ToRead = 'to_read';
    case Reading = 'reading';
    case Finished = 'finished';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
