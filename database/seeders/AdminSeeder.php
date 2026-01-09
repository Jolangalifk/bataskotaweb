<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name' => 'Owner BatasKota',
            'email' => 'owner@bataskota.com',
            'password' => Hash::make('password123'),
            'role' => 'owner',
        ]);

        Admin::create([
            'name' => 'Kasir BatasKota',
            'email' => 'kasir@bataskota.com',
            'password' => Hash::make('password123'),
            'role' => 'kasir',
        ]);
    }
}
