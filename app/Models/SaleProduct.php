<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SaleProduct extends Pivot
{
    use HasFactory;

    public $fillable = [
        'price',
        'quantity',
        'total',
        'sale_id',
        'product_id',
    ];
}
