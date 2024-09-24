<?php

namespace App\Models;

use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;
use App\Models\Filters\InvoiceCreatedAtFilter;
use App\Models\Filters\InvoiceCustomerFilter;
use App\Models\Filters\InvoiceStatusFilter;
use App\Models\Filters\InvoiceTotalFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Lacodix\LaravelModelFilter\Enums\SearchMode;
use Lacodix\LaravelModelFilter\Traits\HasFilters;
use Lacodix\LaravelModelFilter\Traits\IsSearchable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;


/**
 * @property int $id
 * @property int $user_id
 * @property Carbon $date_issued
 * @property Carbon $due_date
 * @property float $subtotal
 * @property float $tax
 * @property float $discount
 * @property float $total
 * @property string $status
 * @property Carbon $payment_date
 * @property PaymentMethodEnum $payment_method
 * @property User $user
 */
class Invoice extends Model
{
    use HasFactory, HasFilters, LogsActivity;

    protected $guarded = [];

    protected $casts = [
        'date_issued'    => 'datetime:Y-m-d H:i:s',
        'due_date'       => 'datetime:Y-m-d H:i:s',
        'subtotal'       => 'float',
        'tax'            => 'float',
        'discount'       => 'float',
        'total'          => 'float',
        'status'         => PaymentStatusEnum::class,
        'payment_date'   => 'datetime:Y-m-d H:i:s',
        'payment_method' => PaymentMethodEnum::class,
    ];

    protected array $filters = [
        InvoiceStatusFilter::class,
        InvoiceTotalFilter::class,
        InvoiceCreatedAtFilter::class,
        InvoiceCustomerFilter::class
    ];

    protected $appends = ['customer_name'];

    // Log Activity
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logUnguarded();
    }

    public function isPaid(): bool
    {
        return $this->status === PaymentStatusEnum::PAID;
    }

    public function scopeWhereCustomerName(Builder $query, string $customer_name): Builder
    {
        return $query->whereHas('customer', function(Builder $query) use ($customer_name) {
            $query->where('name', 'like' ,"%{$customer_name}%");
        });
    }
    /**
     * |-------------------------------------------------
     * | The attributes that should be cast.
     * |-------------------------------------------------
     * |
     */
    public function customerName(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->customer->name
        );
    }

    /**
     * |-------------------------------------------------
     * | The relationships that should always be loaded.
     * |-------------------------------------------------
     * |
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
