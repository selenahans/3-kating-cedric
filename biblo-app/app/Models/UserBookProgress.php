<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBookProgress extends Model
{
    protected $table = 'user_book_progress';

    protected $fillable = [
        'user_id',
        'book_id',
        'current_location',
        'progress_percentage',
        'is_favorite',
        'status',
    ];

    protected $casts = [
        'progress_percentage' => 'float',
        'is_favorite' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}