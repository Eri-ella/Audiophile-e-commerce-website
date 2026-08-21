<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ CRÉER 15 commandes avec la factory
        Order::factory()->count(5)->create();
    }
}