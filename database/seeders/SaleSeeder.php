<?php

namespace Database\Seeders;

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
            $products = \App\Models\Product::inRandomOrder()->take(rand(1, 5))->get();
            $sale->products()->attach($products->pluck('id')->toArray(), [
                'quantity' => $products->count(),
                'price' => $products->sum('price'),
                'total' => $products->sum(function ($product) use ($products) {
                    return $products->count() * $product->price;
                }),
            ]);
        });

    }
}
