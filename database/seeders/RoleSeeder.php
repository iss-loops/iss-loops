<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Crear roles
        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);
        $author = Role::create(['name' => 'author']);
        $contributor = Role::create(['name' => 'contributor']);
        $subscriber = Role::create(['name' => 'subscriber']);

        // Crear permisos
        $permissions = [
            'manage users',
            'manage roles',
            'manage categories',
            'manage tags',
            
            'create articles',
            'edit articles',
            'delete articles',
            'publish articles',
            
            'create interviews',
            'edit interviews',
            'delete interviews',
            'publish interviews',
            
            'create news',
            'edit news',
            'delete news',
            'publish news',
            
            'view analytics',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Asignar permisos a roles
        $admin->givePermissionTo(Permission::all());
        
        $editor->givePermissionTo([
            'manage categories',
            'manage tags',
            'create articles',
            'edit articles',
            'delete articles',
            'publish articles',
            'create interviews',
            'edit interviews',
            'publish interviews',
            'create news',
            'edit news',
            'publish news',
            'view analytics',
        ]);
        
        $author->givePermissionTo([
            'create articles',
            'edit articles',
            'create interviews',
            'create news',
        ]);
        
        $contributor->givePermissionTo([
            'create articles',
        ]);
    }
}