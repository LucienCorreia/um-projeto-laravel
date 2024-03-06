<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'cancelled',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'sale_product')->using(SaleProduct::class)->withPivot(['quantity', 'price', 'total', 'id', 'created_at', 'updated_at']);
    }

    public function productsPivoted()
    {
        return $this->belongsTo(SaleProduct::class, 'id', 'sale_id');
    }
}
