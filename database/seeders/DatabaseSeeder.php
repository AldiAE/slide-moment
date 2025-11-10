<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 🔹 Panggil seeder lain (contohnya PageSeeder)
        $this->call(PageSeeder::class);

        // 🔹 Tambahkan akun admin default
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('12345678'), // ganti dengan password aman
            ]
        );
    }
}
