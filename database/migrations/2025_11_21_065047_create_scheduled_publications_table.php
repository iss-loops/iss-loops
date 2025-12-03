<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scheduled_publications', function (Blueprint $table) {
            $table->id();
            $table->morphs('publishable'); // publishable_type, publishable_id
            $table->timestamp('publish_at');
            $table->string('status')->default('pending'); // pending, published, failed
            $table->text('error_message')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('publish_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scheduled_publications');
    }
};