<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->json('title');          // {"es": "...", "en": "..."}
            $table->string('slug')->unique();
            $table->json('excerpt');        // Resumen corto
            $table->json('body');           // Contenido principal
            $table->string('featured_image')->nullable();
            $table->string('status')->default('draft'); // draft, published, scheduled
            $table->integer('reading_time')->default(0); // Minutos estimados
            $table->boolean('is_featured')->default(false); // Destacado en home
            $table->timestamp('published_at')->nullable();
            $table->timestamp('scheduled_at')->nullable(); // Para publicación programada
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('is_featured');
            $table->index('published_at');
            $table->index('scheduled_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
