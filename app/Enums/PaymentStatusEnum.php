<?php

namespace App\Enums;

enum PaymentStatusEnum: string
{

    case PENDING  = 'pending';
    case PAID     = 'paid';
    case CANCELED = 'canceled';
    case OVERDUE  = 'overdue';

}
