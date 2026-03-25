<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPet extends Model
{
    protected $fillable = ['user_id', 'nickname', 'type', 'xp', 'stage', 'health', 'happiness'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    // Accessor to determine image based on stage
    public function getPetImageAttribute() {
        return "assets/pets/{$this->type}_{$this->stage}.png";
    }
}
