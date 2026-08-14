<?php

namespace Database\Factories;

use App\Models\Quantity;
use App\Models\Content;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Quantity>
 */
class QuantityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'value' => fake()->numberBetween(1, 10),
            
            'content_id' => Content::factory(),
            'product_id' => Product::factory(),
        ];
    }
}
