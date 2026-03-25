<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('category_id');
        });

        $usedSlugs = [];
        $books = DB::table('books')->select('id', 'title')->orderBy('id')->get();

        foreach ($books as $book) {
            $baseSlug = Str::slug((string) $book->title);
            $baseSlug = $baseSlug !== '' ? $baseSlug : 'book';
            $slug = $baseSlug;
            $counter = 2;

            while (in_array($slug, $usedSlugs, true) || DB::table('books')->where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            DB::table('books')->where('id', $book->id)->update(['slug' => $slug]);
            $usedSlugs[] = $slug;
        }

        Schema::table('books', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
