<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingGoal extends Model
{
    protected $fillable = [
        'user_id',
        'daily_target_pages',
        'reminder_enabled',
        'reminder_time',
    ];

    protected $casts = [
        'reminder_enabled' => 'boolean',
        'reminder_time' => 'datetime:H:i',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}