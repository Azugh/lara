<?php

namespace App\Enums;

enum PaymentStatus: string
{
    //
    case PENDING = 'PENDING';
    case PAID = 'PAID';

    public function getLabel()
    {
        return match ($this) {
            self::PENDING => 'Ожидает оплаты',
            self::PAID => 'Оплачен',
        };
    }
}
