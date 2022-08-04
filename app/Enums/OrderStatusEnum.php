<?php

namespace App\Enums;

enum OrderStatusEnum: int
{
    case CANCELED = -1;
    case OPENED = 0;
    case ACCEPTED = 1;
    case COMPLETED = 2;

    public function label(): string
    {
        return match($this) {
            self::CANCELED => 'Отменён',
            self::OPENED => 'Открыт',
            self::ACCEPTED => 'Принят',
            self::COMPLETED => 'Завершён',
        };
    }
}
