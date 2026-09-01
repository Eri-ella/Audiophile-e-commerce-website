<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'type'     => fake()->randomElement(['e-money', 'cash']),
            'status'   => fake()->randomElement(['approved', 'pending', 'declined']),
            'fedapay_id' => null,
            'order_id' => null,  
        ];
    }
}