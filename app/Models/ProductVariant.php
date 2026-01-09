<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'extra_price',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'extra_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function scopeStrength($query)
    {
        return $query->where('type', 'strength')->where('is_active', true)->orderBy('sort_order');
    }

    public function scopeSize($query)
    {
        return $query->where('type', 'size')->where('is_active', true)->orderBy('sort_order');
    }

    public function scopeShot($query)
    {
        return $query->where('type', 'shot')->where('is_active', true)->orderBy('sort_order');
    }
}
