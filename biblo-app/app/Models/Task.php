<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'coin_reward', 'xp_reward', 'target_value'];

    public function completions()
    {
        return $this->hasMany(TaskCompletion::class);
    }
}