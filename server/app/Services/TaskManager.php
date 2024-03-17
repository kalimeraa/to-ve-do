<?php

namespace App\Services;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class TaskManager
{
    public function __construct(private Collection $tasks, private readonly EloquentCollection $developers)
    {
    }

    protected function getTasksDuration(): float
    {
        return $this->tasks->sum('time');
    }

    public function getTotalWeeksToDone(): int
    {
        $totalTaskHours = $this->getTasksDuration();

        $weeklyWorkHours = $this->developers->map(function($developer) {
            return $developer->seniority * $this->getWorkHours();
        })->sum();

        return ceil($totalTaskHours / $weeklyWorkHours);
    }

    public function handle()
    {
        $weeks = $this->getTotalWeeksToDone();

        $plan = Plan::create(
            [
                'name' => 'Plan ' . Plan::count() + 1,
                'duration' => $this->getTasksDuration(),
                'minimum_weeks' => $weeks,
            ]
        );

        foreach(range(1, $weeks) as $week) {
            $planWeek = $plan->weeks()->create([
                'week' => $week
            ]);

            foreach($this->developers as $developer) {
                $workHours = $this->getWorkHours();

                foreach($this->tasks->where('difficulty','<=',$developer->seniority) as $taskKey => $task) {
                    
                    $taskDuration = ($task['difficulty'] * $task['duration']) / $developer->seniority;

                    if($taskDuration <= $workHours) {
                        $workHours -= $taskDuration;
                        
                        $planWeek->tasks()->attach($task);

                        $developer->assignTask($task,$taskDuration);

                        $this->tasks->forget($taskKey);
                    } 
                }
            }
        }
       
    }

    protected function getWorkHours() : int
    {
        return 45;    
    }
}