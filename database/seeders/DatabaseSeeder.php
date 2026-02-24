<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder Admin
        Admin::create([
            'username' => 'admin',
            'email' => 'admin@perpustakaan.com',
            'password' => Hash::make('admin123'), 
        ]);
    }
}