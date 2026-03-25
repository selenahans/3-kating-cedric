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
        Schema::create('user_book_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->string('current_location')->nullable(); // Stores EPUB CFI (e.g. "epubcfi(/6/4[chap01]!/4/2/12/2)")
            $table->decimal('progress_percentage', 5, 2)->default(0); // 0.00 to 100.00
            $table->boolean('is_favorite')->default(false);
            $table->enum('status', ['reading', 'completed', 'dropped'])->default('reading');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_book_progress');
    }
};
