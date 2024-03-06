<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SaleProduct extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'price',
        'quantity',
        'total',
        'sale_id',
        'product_id',
    ];
}
