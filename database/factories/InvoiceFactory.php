<?php

namespace Database\Factories;

use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'customer_id' => Customer::factory(),
            'invoice_number' => Str::ulid(),
            'date_issued' => now(),
            'due_date' => now()->addDays(30),
            'subtotal' => 100.00,
            'tax' => 10.00,
            'discount' => 0.00,
            'total' => 110.00,
            'status' => fake()->randomElement(PaymentStatusEnum::class),
            'payment_date' => null,
            'payment_method' => fake()->randomElement(PaymentMethodEnum::class),
            'notes' => null,
        ];
    }
}
