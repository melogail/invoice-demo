<?php

namespace App\Models\Filters;

use App\Enums\PaymentStatusEnum;
use Lacodix\LaravelModelFilter\Filters\EnumFilter;

class InvoiceStatusFilter extends EnumFilter
{
    protected string $field = 'status';

    protected string $enum = PaymentStatusEnum::class; // add enum::class here

}
