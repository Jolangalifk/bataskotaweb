<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'strength',
        'size',
        'shot',
        'extra_price',
        'quantity',
        'notes',
    ];

    protected $casts = [
        'extra_price' => 'decimal:2',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getSubtotalAttribute()
    {
        return ($this->product->price + $this->extra_price) * $this->quantity;
    }

    public function getUnitPriceAttribute()
    {
        return $this->product->price + $this->extra_price;
    }

    public function getVariantTextAttribute()
    {
        $variants = [];
        if ($this->strength) $variants[] = $this->strength;
        if ($this->size) $variants[] = $this->size;
        if ($this->shot) $variants[] = $this->shot;
        return implode(', ', $variants);
    }
}
