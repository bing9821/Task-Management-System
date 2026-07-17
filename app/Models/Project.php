<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public const STATUSES = [
        'not_started' => 'Not Started',
        'in_progress' => 'In Progress',
        'completed' => 'Completed',
        'on_hold' => 'On Hold',
    ];
    
    // Project belongs to one user
    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
