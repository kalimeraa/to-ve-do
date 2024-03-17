<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function weeks()
    {
        return $this->belongsToMany(PlanWeek::class,'weekly_task','task_id','week_id');
    }

    public function developers()
    {
        return $this->belongsToMany(Developer::class,'developer_task')->withPivot('spend_hours');
    }
}
