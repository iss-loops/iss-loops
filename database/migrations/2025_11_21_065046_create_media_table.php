<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->morphs('mediable'); // mediable_type, mediable_id (YA CREA EL INDEX)
            $table->string('collection')->default('default'); // images, videos, documents
            $table->string('filename');
            $table->string('path');
            $table->string('disk')->default('public');
            $table->string('mime_type');
            $table->unsignedBigInteger('size'); // Bytes
            $table->json('metadata')->nullable(); // width, height, duration, etc.
            $table->string('alt_text')->nullable();
            $table->integer('sort_order')->default(0);
            $table->foreignId('uploaded_by')->constrained('users');
            $table->timestamps();

            // ELIMINA ESTA LÍNEA:
            // $table->index(['mediable_type', 'mediable_id']);
            
            $table->index('collection');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};