<?php

namespace Database\Factories;

use App\Models\Delivery;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            // ✅ Un des 5 vrais clients (pas de client fantôme)
            'client_id'   => User::where('role', 'client')->inRandomOrder()->first()?->id ?? User::factory(),
            'delivery_id' => Delivery::factory(),
            'payment_id'  => Payment::factory(),   // ✅ sûr maintenant (Payment ne crée plus d'order)
            'amount'      => fake()->numberBetween(500, 20000),
            'status'      => fake()->randomElement(['paid', 'pending', 'failed']),
        ];
    }
}