<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    public function run(): void
    {
        $stocks = [
            ['material_name' => 'Biji Kopi Arabica', 'quantity' => 0, 'unit' => 'gram'],
            ['material_name' => 'Biji Kopi Robusta', 'quantity' => 0, 'unit' => 'gram'],
            ['material_name' => 'Gula Aren', 'quantity' => 0, 'unit' => 'gram'],
            ['material_name' => 'Susu Fresh Milk', 'quantity' => 0, 'unit' => 'ml'],
            ['material_name' => 'Matcha Powder', 'quantity' => 0, 'unit' => 'gram'],
            ['material_name' => 'Roti Tawar', 'quantity' => 0, 'unit' => 'lembar'],
            ['material_name' => 'Keju Slice', 'quantity' => 0, 'unit' => 'lembar'],
            ['material_name' => 'Selai Kaya', 'quantity' => 0, 'unit' => 'gram'],
            ['material_name' => 'Es Batu', 'quantity' => 0, 'unit' => 'pack'],
            ['material_name' => 'Cup Plastik', 'quantity' => 0, 'unit' => 'pcs'],
        ];

        foreach ($stocks as $stock) {
            Stock::create($stock);
            // No initial history since quantity is 0
        }
    }
}
