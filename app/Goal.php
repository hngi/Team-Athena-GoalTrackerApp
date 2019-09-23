<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = ['user_id', 'title'];

    public function todo()
    {
        return $this->hasMany(Todo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value)
    {
        return ucfirst($value);
    }

    public static function getGoalsWithTodos()
    {
        return self::with('todo', 'user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->toArray();
    }
}
