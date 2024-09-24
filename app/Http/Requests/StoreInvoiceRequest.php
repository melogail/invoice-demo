<?php

namespace App\Http\Requests;

use App\Models\Invoice;
use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Invoice::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'invoice_number' => ['required', 'string', 'unique:invoices,invoice_number'],
            'date_issued'    => ['required', 'date'],
            'due_date'       => ['required', 'date'],
            'subtotal'       => ['required', 'numeric'],
            'tax'            => ['numeric'],
            'discount'       => ['numeric'],
            'total'          => ['required', 'numeric'],
            'status'         => ['required', 'string'],
            'payment_date'   => ['required', 'date'],
            'payment_method' => ['required', 'string'],
        ];
    }
}
