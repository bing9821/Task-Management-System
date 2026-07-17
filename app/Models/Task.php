<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public const STATUSES =[
        'todo' => 'Todo',
        'in_progress' => 'In Progress',
        'done' => 'Done', 
    ];

    public const PRIORITIES = [
        'low' => 'Low',
        'medium' => 'Medium',
        'high' => ' High',
    ];
    
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
    ];
    
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
