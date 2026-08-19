<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Deatail;
use App\Models\Product;


class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();


        foreach ($orders as $order) {
           
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
