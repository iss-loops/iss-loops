<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Articles
        Schema::table('articles', function (Blueprint $table) {
            $table->index('slug'); // Para búsquedas por slug
            $table->index('status'); // Para filtrar por estado
            $table->index('published_at'); // Para ordenar por fecha
            $table->index(['status', 'published_at']); // Índice compuesto
            $table->index('is_featured'); // Para artículos destacados
        });

        // Categories
        Schema::table('categories', function (Blueprint $table) {
            $table->index('slug');
            $table->index('is_active');
            $table->index('parent_id'); // Para subcategorías
            $table->index('sort_order');
        });

        // Tags
        Schema::table('tags', function (Blueprint $table) {
            $table->index('slug');
        });

        // Favorites
        Schema::table('favorites', function (Blueprint $table) {
            $table->index('user_id');
            $table->index(['favorable_type', 'favorable_id']);
        });

        // Subscribers
        Schema::table('subscribers', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('is_active');
        });

        // Games
        Schema::table('games', function (Blueprint $table) {
            $table->index('slug');
            $table->index('is_active');
            $table->index('type');
        });

        // Festival Winners
        Schema::table('festival_winners', function (Blueprint $table) {
            $table->index('year');
            $table->index('category');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropIndex(['slug']);
            $table->dropIndex(['status']);
            $table->dropIndex(['published_at']);
            $table->dropIndex(['status', 'published_at']);
            $table->dropIndex(['is_featured']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['slug']);
            $table->dropIndex(['is_active']);
            $table->dropIndex(['parent_id']);
            $table->dropIndex(['sort_order']);
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->dropIndex(['slug']);
        });

        Schema::table('favorites', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['favorable_type', 'favorable_id']);
        });

        Schema::table('subscribers', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['is_active']);
        });

        Schema::table('games', function (Blueprint $table) {
            $table->dropIndex(['slug']);
            $table->dropIndex(['is_active']);
            $table->dropIndex(['type']);
        });

        Schema::table('festival_winners', function (Blueprint $table) {
            $table->dropIndex(['year']);
            $table->dropIndex(['category']);
        });
    }
};