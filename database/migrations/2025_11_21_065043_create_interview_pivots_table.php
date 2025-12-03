<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interview_category', function (Blueprint $table) {
            $table->foreignId('interview_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->primary(['interview_id', 'category_id']);
        });

        Schema::create('interview_tag', function (Blueprint $table) {
            $table->foreignId('interview_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->primary(['interview_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interview_tag');
        Schema::dropIfExists('interview_category');
    }
};