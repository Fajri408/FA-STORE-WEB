<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder akun admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@fastore.test',
            'password' => bcrypt('password'), // silakan ganti password!
            'role' => 'admin',
        ]);

        // Seeder akun user biasa
        User::create([
            'name' => 'User Biasa',
            'email' => 'user@fastore.test',
            'password' => bcrypt('password'), // silakan ganti password!
            'role' => 'user',
        ]);

        // (Opsional) Hapus atau komen User::factory() jika tidak diperlukan
        // User::factory(10)->create();
    }
}
