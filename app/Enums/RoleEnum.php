<?php

namespace App\Enums;

enum RoleEnum: int
{
    case ADMIN = 10;
    case GUEST = 0;
    case OWNER = 1;
    case RECIPIENT = 2;

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Администратор',
            self::GUEST => 'Гость',
            self::OWNER => 'Владелец',
            self::RECIPIENT => 'Получатель',
        };
    }
}
