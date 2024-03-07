<?php

namespace App\Http\Repositories;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProduct;

class SaleRepository
{
    public function save(array $data)
    {
        $sale = new Sale();

        $sale->save();

        $saleProducts = [];

        foreach ($data['products'] as $saleProduct) {
            $product = Product::find($saleProduct['id']);

            $total = $saleProduct['quantity'] * $product->price;

            $saleProducts[] = SaleProduct::create([
                'quantity' => $saleProduct['quantity'],
                'price' =>  $product->price,
                'total' => $total,
                'product_id' => $product->id,
                'sale_id' => $sale->id,
            ]);
        }

        $sale->load('products');

        return $sale;
    }

    public function addProducts(Sale $sale, array $data)
    {
        $saleProducts = [];

        foreach ($data['products'] as $saleProduct) {
            $product = Product::find($saleProduct['id']);

            $total = $saleProduct['quantity'] * $product->price;

            $saleProducts[] = SaleProduct::updateOrCreate([
                'product_id' => $product->id,
                'sale_id' => $sale->id,
            ],[
                'quantity' => $saleProduct['quantity'],
                'price' =>  $product->price,
                'total' => $total,
            ]);
        }

        $sale->load('products');

        return $sale;
    }
}
