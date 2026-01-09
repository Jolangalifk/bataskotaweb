<?php

namespace Database\Seeders;

use App\Models\CompanyProfile;
use Illuminate\Database\Seeder;

class CompanyProfileSeeder extends Seeder
{
    public function run(): void
    {
        CompanyProfile::create([
            'name' => 'BatasKota Coffee',
            'description' => 'Kedai kopi lokal dengan cita rasa premium. Kami menyajikan kopi berkualitas dengan harga terjangkau untuk menemani aktivitas harianmu.',
            'address' => 'Jl. Contoh No. 123, Kota Anda',
            'phone' => '08123456789',
            'email' => 'hello@bataskota.coffee',
            'instagram' => '@bataskotacoffee',
            'whatsapp' => '628123456789',
            'open_time' => '08:00',
            'close_time' => '22:00',
            'is_open' => true,
        ]);
    }
}
