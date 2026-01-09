<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'description',
        'amount',
        'expense_date',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'expense_date' => 'date',
    ];

    public static function categories()
    {
        return [
            'stock' => 'Pembelian Bahan Baku',
            // 'operational' => 'Operasional',
            // 'salary' => 'Gaji Karyawan',
            // 'other' => 'Lainnya',
        ];
    }

    public function getCategoryLabelAttribute()
    {
        return self::categories()[$this->category] ?? $this->category;
    }
}
