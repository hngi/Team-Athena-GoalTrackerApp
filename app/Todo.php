<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['goal_id', 'task', 'status', 'description'];

    public function getTaskAttribute($value) {
        return ucfirst($value);
    }
}
