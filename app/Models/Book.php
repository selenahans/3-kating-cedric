<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    protected $fillable = [
        'category_id',
        'slug',
        'title',
        'author',
        'total_pages',
        'file_path',
        'cover_image',
    ];

    protected static function booted(): void
    {
        static::creating(function (Book $book) {
            if (empty($book->slug)) {
                $book->slug = static::generateUniqueSlug($book->title);
            }
        });

        static::updating(function (Book $book) {
            if ($book->isDirty('title') && empty($book->slug)) {
                $book->slug = static::generateUniqueSlug($book->title, $book->id);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    private static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug !== '' ? $baseSlug : 'book';
        $counter = 2;

        while (
            static::query()
                ->when($ignoreId !== null, function ($query) use ($ignoreId) {
                    $query->where('id', '!=', $ignoreId);
                })
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function highlights()
    {
        return $this->hasMany(HighlightNote::class);
    }

    public function progressRecords()
    {
        return $this->hasMany(UserBookProgress::class);
    }

    public function readingLogs()
    {
        return $this->hasMany(ReadingLog::class);
    }
}