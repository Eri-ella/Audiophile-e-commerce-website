<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;


class CategorySeeder extends Seeder
{

    public function run(): void
    {
        foreach (['headphones', 'speakers', 'earphones'] as $name) {
            Category::create(['name' => $name]);
        }
    }
}