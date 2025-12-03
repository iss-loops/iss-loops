<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->string('slug')->unique();
            $table->json('excerpt');
            $table->json('body');
            $table->string('featured_image')->nullable();
            $table->string('source_name')->nullable();  // "NASA", "Nature"
            $table->string('source_url')->nullable();   // Link original
            $table->string('status')->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_breaking')->default(false); // Noticia urgente
            $table->timestamp('published_at')->nullable();
            $table->timestamp('scheduled_at')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('is_featured');
            $table->index('is_breaking');
            $table->index('published_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};