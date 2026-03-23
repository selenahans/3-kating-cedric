<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    public function readingLogs()
    {
        return $this->hasMany(ReadingLog::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'coins',
        'onboarding_completed_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'onboarding_completed_at' => 'datetime',
        ];
    }

    public function pet()
    {
        return $this->hasOne(UserPet::class);
    }

    public function inventory()
    {
        return $this->hasMany(UserInventory::class);
    }

    public function bookProgress()
    {
        return $this->hasMany(UserBookProgress::class);
    }

    public function taskCompletions()
    {
        return $this->hasMany(TaskCompletion::class);
    }

    public function readingGoal()
    {
        return $this->hasOne(ReadingGoal::class);
    }

    public function preferredCategories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function appNotifications()
    {
        return $this->hasMany(UserNotification::class, 'user_id');
    }

    public function getIsOnboardedAttribute(): bool
    {
        return !is_null($this->onboarding_completed_at);
    }
}