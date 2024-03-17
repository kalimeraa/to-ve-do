<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const WORK_HOURS = 45;
    
    public function tasks()
    {
        return $this->belongsToMany(Task::class,'developer_task')->withPivot('spend_hours');
    }

    public function assignTask(Task $task,float $spendHours)
    {
        $this->tasks()->attach($task, ['spend_hours' => $spendHours]);
    }
}
