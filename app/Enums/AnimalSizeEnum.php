<?php

namespace App\Enums;

enum AnimalSizeEnum: int
{
    case SMALL = 1;
    case MEDIUM = 2;
    case LARGE = 3;

    public function label(): string
    {
        return match($this) {
            self::SMALL => 'Маленький',
            self::MEDIUM => 'Средний',
            self::LARGE => 'Большой',
        };
    }
}
