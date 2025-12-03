<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->string('slug')->unique();
            $table->json('description');
            $table->string('video_url');         // YouTube, Vimeo, etc.
            $table->string('video_provider')->default('youtube'); // youtube, vimeo, local
            $table->string('thumbnail')->nullable();
            $table->string('interviewee_name');  // Nombre del entrevistado
            $table->string('interviewee_title')->nullable(); // "Dr. en Física, MIT"
            $table->string('interviewee_photo')->nullable();
            $table->integer('duration')->default(0); // Duración en segundos
            $table->string('status')->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamp('scheduled_at')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('is_featured');
            $table->index('published_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};