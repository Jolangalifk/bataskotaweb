<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // ==================== VARIANT OPTIONS ====================
        // Strength variants
        ProductVariant::create(['type' => 'strength', 'name' => 'Normal', 'extra_price' => 0, 'sort_order' => 1]);
        ProductVariant::create(['type' => 'strength', 'name' => 'Strong', 'extra_price' => 2000, 'sort_order' => 2]);

        // Size variants
        ProductVariant::create(['type' => 'size', 'name' => 'Small', 'extra_price' => 0, 'sort_order' => 1]);
        ProductVariant::create(['type' => 'size', 'name' => 'Medium', 'extra_price' => 2000, 'sort_order' => 2]);
        ProductVariant::create(['type' => 'size', 'name' => 'Large', 'extra_price' => 4000, 'sort_order' => 3]);

        // Shot variants
        ProductVariant::create(['type' => 'shot', 'name' => '1 Shot', 'extra_price' => 0, 'sort_order' => 1]);
        ProductVariant::create(['type' => 'shot', 'name' => '2 Shot', 'extra_price' => 2000, 'sort_order' => 2]);
        ProductVariant::create(['type' => 'shot', 'name' => '3 Shot', 'extra_price' => 3500, 'sort_order' => 3]);

        // ==================== AMERICANO (has_shot) ====================
        Product::create([
            'name' => 'Americano',
            'category' => 'coffee',
            'price' => 4500,
            'description' => 'Kopi hitam dengan rasa smooth dan aroma lembut. Tersedia pilihan 1–3 shot espresso.',
            'is_active' => true,
            'has_shot' => true,
        ]);

        // ==================== KOPI SUSU BATAS KOTA (has_strength) ====================
        Product::create([
            'name' => 'Kopi Susu Batas Kota',
            'category' => 'coffee',
            'price' => 8000,
            'description' => 'Perpaduan kopi dan susu yang creamy dan seimbang. Pilihan Normal atau Strong.',
            'is_active' => true,
            'has_strength' => true,
        ]);

        // ==================== KOPI SUSU VARIAN RASA ====================
        Product::create([
            'name' => 'Kopi Susu Gula Aren',
            'category' => 'coffee',
            'price' => 12000,
            'description' => 'Kopi susu dengan manis alami dari gula aren pilihan.',
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Kopi Susu Vanilla',
            'category' => 'coffee',
            'price' => 11000,
            'description' => 'Kombinasi kopi susu dengan sentuhan vanilla yang wangi dan lembut.',
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Kopi Susu Caramel',
            'category' => 'coffee',
            'price' => 12000,
            'description' => 'Perpaduan kopi, susu, dan caramel yang creamy dengan rasa manis yang pas.',
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Kopi Susu Butterscotch',
            'category' => 'coffee',
            'price' => 12000,
            'description' => 'Rasa khas butterscotch yang creamy berpadu dengan kopi.',
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Kopi Susu Hazelnut',
            'category' => 'coffee',
            'price' => 12000,
            'description' => 'Kopi susu dengan aroma kacang hazelnut yang harum dan khas.',
            'is_active' => true,
        ]);

        // ==================== NON COFFEE (has_size) ====================
        Product::create([
            'name' => 'Lemon Tea',
            'category' => 'non-coffee',
            'price' => 5000,
            'description' => 'Perpaduan Teh dengan perasan lemon yang segar.',
            'is_active' => true,
            'has_size' => true,
        ]);

        Product::create([
            'name' => 'Lemonade',
            'category' => 'non-coffee',
            'price' => 5000,
            'description' => 'Minuman lemon segar dengan rasa manis dan asam seimbang.',
            'is_active' => true,
            'has_size' => true,
        ]);

        Product::create([
            'name' => 'Milo',
            'category' => 'non-coffee',
            'price' => 8000,
            'description' => 'Minuman cokelat malt yang creamy dan mengenyangkan.',
            'is_active' => true,
            'has_size' => true,
        ]);

        Product::create([
            'name' => 'Matcha',
            'category' => 'non-coffee',
            'price' => 10000,
            'description' => 'Minuman teh hijau matcha dengan rasa lembut dan creamy.',
            'is_active' => true,
            'has_size' => true,
        ]);

        Product::create([
            'name' => 'Red Velvet',
            'category' => 'non-coffee',
            'price' => 10000,
            'description' => 'Minuman manis dengan rasa khas red velvet yang creamy.',
            'is_active' => true,
            'has_size' => true,
        ]);

        // ==================== TOAST ====================
        Product::create(['name' => 'Toast Chocolate', 'category' => 'toast', 'price' => 8000, 'description' => 'Toast dengan isian cokelat leleh yang manis dan creamy.', 'is_active' => true]);
        Product::create(['name' => 'Toast Choco Crunchy', 'category' => 'toast', 'price' => 8000, 'description' => 'Toast dengan perpaduan cokelat manis dan topping crunchy.', 'is_active' => true]);
        Product::create(['name' => 'Toast Tiramisu', 'category' => 'toast', 'price' => 8000, 'description' => 'Toast dengan isian khas tiramisu.', 'is_active' => true]);
        Product::create(['name' => 'Toast Strawberry', 'category' => 'toast', 'price' => 8000, 'description' => 'Toast dengan isian selai stroberi.', 'is_active' => true]);
        Product::create(['name' => 'Toast Blueberry', 'category' => 'toast', 'price' => 8000, 'description' => 'Toast dengan isian selai blueberry.', 'is_active' => true]);
        Product::create(['name' => 'Toast Matcha', 'category' => 'toast', 'price' => 8000, 'description' => 'Toast dengan isian selai matcha.', 'is_active' => true]);
        Product::create(['name' => 'Toast Beef BBQ', 'category' => 'toast', 'price' => 10000, 'description' => 'Toast dengan isian daging sapi dan saus BBQ.', 'is_active' => true]);
        Product::create(['name' => 'Toast Beef and Cheese', 'category' => 'toast', 'price' => 12000, 'description' => 'Toast dengan daging sapi dan keju leleh.', 'is_active' => true]);
        Product::create(['name' => 'Extra Toast', 'category' => 'toast', 'price' => 15000, 'description' => 'Tambahan porsi roti.', 'is_active' => true]);

        // ==================== TOPPING ====================
        Product::create(['name' => 'Extra Topping Oreo', 'category' => 'topping', 'price' => 3000, 'description' => 'Tambahan remahan biskuit oreo.', 'is_active' => true]);
        Product::create(['name' => 'Extra Topping Keju', 'category' => 'topping', 'price' => 3000, 'description' => 'Ekstra keju parut.', 'is_active' => true]);
        Product::create(['name' => 'Extra Topping Egg', 'category' => 'topping', 'price' => 4000, 'description' => 'Tambahan telur.', 'is_active' => true]);
        Product::create(['name' => 'Extra Topping Kombinasi', 'category' => 'topping', 'price' => 5000, 'description' => 'Kombinasi topping pilihan.', 'is_active' => true]);
    }
}
