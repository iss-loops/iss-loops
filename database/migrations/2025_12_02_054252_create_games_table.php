<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->json('title'); // {"es": "...", "en": "..."}
            $table->string('slug')->unique();
            $table->json('description'); // Descripción del juego
            $table->json('instructions')->nullable(); // Instrucciones de cómo jugar
            $table->string('type')->default('physics'); // physics, math, biology, chemistry
            $table->string('difficulty')->default('medium'); // easy, medium, hard
            $table->string('thumbnail')->nullable(); // Imagen miniatura
            $table->string('game_file')->nullable(); // Nombre del archivo del juego
            $table->json('learning_objectives')->nullable(); // Objetivos de aprendizaje
            $table->integer('estimated_time')->default(10); // Tiempo estimado en minutos
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('play_count')->default(0); // Contador de veces jugado
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('type');
            $table->index('difficulty');
            $table->index('is_active');
            $table->index('is_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};