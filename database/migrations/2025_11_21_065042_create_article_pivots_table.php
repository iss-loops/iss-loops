<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Article <-> Category
        Schema::create('article_category', function (Blueprint $table) {
            $table->foreignId('article_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->primary(['article_id', 'category_id']);
        });

        // Article <-> Tag
        Schema::create('article_tag', function (Blueprint $table) {
            $table->foreignId('article_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->primary(['article_id', 'tag_id']);
        });

        // Article <-> User (autores)
        Schema::create('article_user', function (Blueprint $table) {
            $table->foreignId('article_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('role')->default('author'); // author, contributor, reviewer
            $table->primary(['article_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_user');
        Schema::dropIfExists('article_tag');
        Schema::dropIfExists('article_category');
    }
};

