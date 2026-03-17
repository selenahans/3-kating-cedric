<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_pets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->string('nickname');
            $table->string('type'); // e.g., 'dragon', 'owl'
            $table->integer('xp')->default(0);
            $table->enum('stage', ['baby', 'teen', 'adult'])->default('baby');
            $table->integer('health')->default(100);
            $table->integer('happiness')->default(100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_pets');
    }
};
