<?php

namespace App\Enums;

enum PaymentMethodEnum: string
{

    case CASH          = 'cash';
    case CREDIT_CARD   = 'credit_card';
    case BANK_TRANSFER = 'bank_transfer';
    case PAYPAL        = 'paypal';

}
