#!/bin/bash

# ===========================================
# Script para crear estructura ISS-LOOPS
# Ejecutar en la raíz del proyecto Laravel
# ===========================================

echo "🚀 Creando estructura modular ISS-LOOPS..."

# Módulos principales
modules=("Article" "Category" "Author" "User" "Subscription" "Media")
module_folders=("Models" "Services" "Repositories" "Actions" "DTOs" "Enums" "Events")

for module in "${modules[@]}"; do
    for folder in "${module_folders[@]}"; do
        mkdir -p "app/Modules/$module/$folder"
    done
    echo "✅ Módulo $module creado"
done

# Módulo Shared (estructura especial)
mkdir -p app/Modules/Shared/{Traits,Interfaces,Helpers}
echo "✅ Módulo Shared creado"

# API versionada
mkdir -p app/Api/V1/{Controllers,Resources,Requests}
echo "✅ Estructura API V1 creada"

# Livewire components
mkdir -p app/Livewire/{Articles,Subscription,User,Shared}
echo "✅ Estructura Livewire creada"

# HTTP (Controllers web, Middleware, Requests)
mkdir -p app/Http/Controllers/Web
mkdir -p app/Http/Middleware
mkdir -p app/Http/Requests
echo "✅ Estructura HTTP creada"

# Views
mkdir -p resources/views/layouts/partials
mkdir -p resources/views/components/ui
mkdir -p resources/views/livewire/{articles,subscription,shared}
mkdir -p resources/views/pages/{articles,categories,authors,interviews}
mkdir -p resources/views/user
mkdir -p resources/views/auth
mkdir -p resources/views/emails/{newsletter,layouts}
mkdir -p resources/views/errors
echo "✅ Estructura de vistas creada"

# JavaScript (animaciones GSAP)
mkdir -p resources/js/animations
echo "✅ Estructura JS creada"

# Storage para uploads
mkdir -p storage/app/public/{articles,authors,media}
echo "✅ Estructura storage creada"

# Crear archivos .gitkeep para que Git trackee carpetas vacías
find app/Modules -type d -empty -exec touch {}/.gitkeep \;
find app/Api -type d -empty -exec touch {}/.gitkeep \;
find app/Livewire -type d -empty -exec touch {}/.gitkeep \;
find resources/views -type d -empty -exec touch {}/.gitkeep \;
find resources/js/animations -type d -empty -exec touch {}/.gitkeep \;

echo ""
echo "🎉 Estructura ISS-LOOPS creada exitosamente!"
echo ""
echo "Siguiente paso: Instalar dependencias con:"
echo "  composer require livewire/livewire filament/filament:^3.0 spatie/laravel-translatable spatie/laravel-medialibrary spatie/laravel-permission"