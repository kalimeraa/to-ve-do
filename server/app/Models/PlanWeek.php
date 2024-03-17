<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanWeek extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tasks()
    {
        return $this->belongsToMany(Task::class,'weekly_task','week_id','task_id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

}
