<?php

namespace App\Enums;

enum AnimalSizeEnum: int
{
    case MINI = 1;
    case SMALL = 2;
    case MEDIUM = 3;
    case BIG = 4;

    public function label(): string
    {
        return match ($this) {
            self::MINI => 'Мини',
            self::SMALL => 'Маленький',
            self::MEDIUM => 'Средний',
            self::BIG => 'Большой',
        };
    }
}
