<?php

namespace App\Models\Filters;

use Lacodix\LaravelModelFilter\Filters\DateFilter;

class InvoiceCreatedAtFilter extends DateFilter
{
    protected string $field = 'created_at';


}
