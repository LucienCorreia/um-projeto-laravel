<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'sale_product')->using(SaleProduct::class)->withPivot(['quantity', 'price', 'total', 'id', 'created_at', 'updated_at']);
    }
}
