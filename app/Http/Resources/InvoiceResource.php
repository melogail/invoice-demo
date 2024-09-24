<?php

namespace App\Http\Resources;

use App\Enums\PaymentMethodEnum;
use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $invoice_number
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
 * @property Invoice[] $invoices
 */
class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'invoice_number' => $this->invoice_number,
            'date_issued'    => $this->date_issued,
            'due_date'       => $this->due_date,
            'subtotal'       => $this->subtotal,
            'tax'            => $this->tax,
            'discount'       => $this->discount,
            'total'          => $this->total,
            'status'         => $this->status,
            'payment_date'   => $this->payment_date,
            'payment_method' => $this->payment_method,
            'user'           => UserResource::make($this->whenLoaded('user')),
            'invoices'       => InvoiceResource::collection($this->whenLoaded('invoices')),
        ];
    }
}
