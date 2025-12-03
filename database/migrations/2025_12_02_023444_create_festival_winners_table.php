<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('festival_winners', function (Blueprint $table) {
            $table->id();
            
            // Información del estudiante
            $table->json('student_name'); // {"es": "Juan Pérez", "en": "Juan Pérez"}
            $table->string('photo')->nullable(); // Foto del estudiante/equipo
            $table->string('school'); // Nombre del plantel
            $table->string('state')->nullable(); // Estado de México
            
            // Información del proyecto
            $table->json('project_title'); // {"es": "Título", "en": "Title"}
            $table->json('project_description'); // {"es": "Descripción", "en": "Description"}
            $table->string('category'); // physics, biology, technology, chemistry, mathematics
            $table->integer('year'); // 2025
            $table->string('award_level'); // first_place, second_place, third_place, honorable_mention
            
            // Metadata
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(false); // Destacar ganador
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
            
            // Índices para optimizar búsquedas
            $table->index('year');
            $table->index('category');
            $table->index('award_level');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('festival_winners');
    }
};