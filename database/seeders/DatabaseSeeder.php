<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AdminUserSeeder::class,
            CategorySeeder::class,
            ArticleSeeder::class,          // ✅ AGREGADO
            FestivalWinnerSeeder::class,
            FunFactSeeder::class,          // ✅ AGREGADO (si existe)
            GameSeeder::class,             // ✅ AGREGADO (si existe)
        ]);

        // Asignar rol admin al primer usuario
        $admin = \App\Models\User::first();
        if ($admin) {
            $admin->assignRole('admin');
        }
    }
}