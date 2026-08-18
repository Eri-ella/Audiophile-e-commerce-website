<?php

namespace Database\Factories;

use App\Models\Detail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Detail>
 */
class DetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => fake()->numberBetween(1, 5),
            'order_id' => Order::factory(),
            'product_id' => Product::inRandomOrder()->first()?->id ?? Product::factory(),
        ];
    }
}
