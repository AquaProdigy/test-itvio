<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    const PUBLIC = 'public';
    const PRIVATE = 'private';
    const COMPLETED = 'completed';
    const CANCELLED = 'cancelled';

    protected $guarded = false;

    public function todoList()
    {
        return $this->belongsTo(TodoList::class);
    }
}
