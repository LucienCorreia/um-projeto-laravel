<?php

namespace Database\Seeders;

use App\Models\SaleProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Sale::factory(10)->create()->each(function ($sale) {
                $products = \App\Models\Product::inRandomOrder()->limit(rand(1, 10))->get();
                foreach($products as $product) {
                        $quantity = rand(1, 10);
                        $price = $product->price;
                        $total = $product->price * $quantity;

                        SaleProduct::create([
                            'quantity' => $quantity,
                            'price' => $price,
                            'total' => $total,
                            'product_id' => $product->id,
                            'sale_id' => $sale->id,
                        ]);
                    }
        });
    }
}
