<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'strength',
        'size',
        'shot',
        'quantity',
        'price',
        'extra_price',
        'subtotal',
        'notes',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'extra_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getVariantTextAttribute()
    {
        $variants = [];
        if ($this->strength) $variants[] = $this->strength;
        if ($this->size) $variants[] = $this->size;
        if ($this->shot) $variants[] = $this->shot;
        return implode(', ', $variants);
    }

    public function getUnitPriceAttribute()
    {
        return $this->price + $this->extra_price;
    }
}
