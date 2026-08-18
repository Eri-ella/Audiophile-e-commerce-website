<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'stock' => fake()->numberBetween(0, 200),
            'status' => fake()->randomElement(['active', 'inactive']),
            'price' => $this->faker->randomFloat(2, 10, 1000), 
            'description' => fake()->paragraph(10),
            'features' => fake()->text(200),
            'image_description' => 'page_autre/audiophile_black.jpg',
            'image_1' => 'page_autre/h1.jpg',
            'image_2' => 'page_autre/h2.jpg',
            'image_3' => 'page_autre/h3.jpg',
            'category_id' => Category::factory(),

        ];
    }
}
