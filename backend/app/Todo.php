<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['goal_id', 'todo', 'completed', 'description'];

    protected $casts = ['completed'=>'boolean'];
    
    public function getTaskAttribute($value)
    {
        return ucfirst($value);
    }

    public function goal()
    {
        return $this->hasOne(Goal::class);
    }
}
