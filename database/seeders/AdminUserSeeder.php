<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin ISS-LOOPS',
            'email' => 'admin@iss-loops.com',
            'password' => Hash::make('password'),
            'preferred_locale' => 'es',
            'email_verified_at' => now(),
        ]);
    }
}