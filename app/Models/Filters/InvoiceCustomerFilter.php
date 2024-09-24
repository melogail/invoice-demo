<?php

namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Lacodix\LaravelModelFilter\Enums\FilterMode;
use Lacodix\LaravelModelFilter\Filters\Filter;

class InvoiceCustomerFilter extends Filter
{
    public FilterMode $mode = FilterMode::LIKE;

    protected string $field = 'customer_id';

    public function apply(Builder $query): Builder
    {
        $value = is_array($this->values) ? current($this->values) : $this->values;

        return $query->whereHas('customer', function(Builder $query) use ($value) {
            $query->where('name', 'like' ,"%{$value}%");
        });
    }

    public function populate(string|array $values): static
    {
        $this->values = Arr::wrap($values);

        return $this;
    }
}
