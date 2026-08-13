<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => fake()->numberBetween(300, 20000),
            'status' => fake()->randomElement(['en attente', 'validee']),
            
            'client_id' => Order::factory(),
            'delivery_id' => Product::factory(),
        ];
    }
}
