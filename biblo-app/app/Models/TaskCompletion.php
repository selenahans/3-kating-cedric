<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskCompletion extends Model {
    protected $fillable = ['user_id', 'task_id', 'completed_at'];
}
