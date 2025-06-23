<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@fastore.test',
            'password' => bcrypt('password'), // ganti passwordnya!
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'User Biasa',
            'email' => 'user@fastore.test',
            'password' => bcrypt('password'), // ganti password juga!
            'role' => 'user'
        ]);
    }
}
