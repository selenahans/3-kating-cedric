<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HighlightNote extends Model
{
    protected $table = 'highlights_notes';
    protected $fillable = ['user_id', 'book_id', 'cfi_range', 'highlighted_text', 'note_content', 'color_code'];

    public function book()
    {
        // A note belongs to a single book
        return $this->belongsTo(Book::class, 'book_id');
    }
}
