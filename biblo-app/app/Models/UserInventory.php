<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInventory extends Model {
    protected $table = 'user_inventory';
    protected $fillable = ['user_id', 'item_id', 'is_equipped'];

    public function item() {
        return $this->belongsTo(Item::class);
    }
}
