<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'author',
        'total_pages',
        'file_path',
        'cover_image',
    ];

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
}