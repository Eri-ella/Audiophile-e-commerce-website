<?php

namespace Database\Seeders;

use App\Models\Detail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DetailSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ On prend les commandes EXISTANTES (créées par OrderSeeder)
        $orders = Order::all();

        foreach ($orders as $order) {
            // 1 à 3 VRAIS produits par commande
            $productIds = Product::inRandomOrder()->take(rand(1, 3))->pluck('id');

            foreach ($productIds as $productId) {
                Detail::create([
                    'order_id'   => $order->id,
                    'product_id' => $productId,
                    'quantity'   => rand(1, 5),
                ]);
            }
        }
    }
}