<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => ['es' => 'Física', 'en' => 'Physics'],
                'slug' => 'fisica',
                'color' => '#3B82F6',
                'description' => ['es' => 'Artículos sobre física y sus ramas', 'en' => 'Articles about physics and its branches'],
            ],
            [
                'name' => ['es' => 'Biología', 'en' => 'Biology'],
                'slug' => 'biologia',
                'color' => '#10B981',
                'description' => ['es' => 'Ciencias de la vida', 'en' => 'Life sciences'],
            ],
            [
                'name' => ['es' => 'Astronomía', 'en' => 'Astronomy'],
                'slug' => 'astronomia',
                'color' => '#8B5CF6',
                'description' => ['es' => 'El cosmos y más allá', 'en' => 'The cosmos and beyond'],
            ],
            [
                'name' => ['es' => 'Tecnología', 'en' => 'Technology'],
                'slug' => 'tecnologia',
                'color' => '#F59E0B',
                'description' => ['es' => 'Innovación y avances tecnológicos', 'en' => 'Innovation and technological advances'],
            ],
            [
                'name' => ['es' => 'Química', 'en' => 'Chemistry'],
                'slug' => 'quimica',
                'color' => '#EF4444',
                'description' => ['es' => 'La ciencia de la materia', 'en' => 'The science of matter'],
            ],
            [
                'name' => ['es' => 'Medio Ambiente', 'en' => 'Environment'],
                'slug' => 'medio-ambiente',
                'color' => '#14B8A6',
                'description' => ['es' => 'Ecología y sostenibilidad', 'en' => 'Ecology and sustainability'],
            ],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => json_encode($category['name']),
                'slug' => $category['slug'],
                'color' => $category['color'],
                'description' => json_encode($category['description']),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Crear subcategorías
        $physicsId = DB::table('categories')->where('slug', 'fisica')->value('id');
        
        $subcategories = [
            [
                'parent_id' => $physicsId,
                'name' => ['es' => 'Física Cuántica', 'en' => 'Quantum Physics'],
                'slug' => 'fisica-cuantica',
                'color' => '#6366F1',
            ],
            [
                'parent_id' => $physicsId,
                'name' => ['es' => 'Astrofísica', 'en' => 'Astrophysics'],
                'slug' => 'astrofisica',
                'color' => '#7C3AED',
            ],
        ];

        foreach ($subcategories as $sub) {
            DB::table('categories')->insert([
                'parent_id' => $sub['parent_id'],
                'name' => json_encode($sub['name']),
                'slug' => $sub['slug'],
                'color' => $sub['color'],
                'description' => json_encode(['es' => '', 'en' => '']),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}