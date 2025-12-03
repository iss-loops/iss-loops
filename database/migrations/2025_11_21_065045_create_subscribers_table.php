
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('frequency')->default('weekly'); // daily, weekly, monthly
            $table->json('category_preferences')->nullable(); // [1, 3, 5] IDs de categorías
            $table->boolean('is_active')->default(true);
            $table->timestamp('subscribed_at');
            $table->timestamp('unsubscribed_at')->nullable();
            $table->timestamps();

            $table->unique('user_id');
            $table->index('is_active');
            $table->index('frequency');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscribers');
    }
};
