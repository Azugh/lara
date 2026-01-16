<?php

namespace App\Enums;

enum ShippingStatus: string
{
    //
    case PENDING = 'PENDING';
    case PROCESSING = 'PROCESSING';
    case COMPLETED = 'COMPLETED';
}
