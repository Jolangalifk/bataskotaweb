<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_name',
        'quantity',
        'unit',
    ];

    public function histories()
    {
        return $this->hasMany(StockHistory::class);
    }

    public function addStock($amount, $description = null)
    {
        $this->increment('quantity', $amount);
        $this->histories()->create([
            'change' => $amount,
            'description' => $description ?? 'Stok masuk',
        ]);
    }

    public function reduceStock($amount, $description = null)
    {
        $this->decrement('quantity', $amount);
        $this->histories()->create([
            'change' => -$amount,
            'description' => $description ?? 'Stok keluar',
        ]);
    }
}
