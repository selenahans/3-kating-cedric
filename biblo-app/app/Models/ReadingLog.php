<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingLog extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'pages_read'
    ];
}
