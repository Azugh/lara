<?php

namespace App\Enums;

enum ShippingStatus: string
{
    //
    case PENDING = 'PENDING';
    case PROCESSING = 'PROCESSING';
    case COMPLETED = 'COMPLETED';

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'Ожидает',
            self::PROCESSING => 'В обработке',
            self::COMPLETED => 'Доставлен',
        };
    }
}
