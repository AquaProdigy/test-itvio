<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;
    const PUBLIC = 'public';
    const PRIVATE = 'private';
    protected $guarded = false;

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function canAccess($user)
    {
        return $this->status !== self::PRIVATE || $this->user_id === $user->id;
    }
}
