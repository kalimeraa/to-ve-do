<?php

namespace App\Jobs;

use App\Models\Task;
use App\Services\TaskProviders\TaskProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     */
    public function __construct(private readonly TaskProvider $taskProvider)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $fetchedTasks = $this->taskProvider->handle();
        
        $createdTasks = $fetchedTasks->map(function (array $task) {
            $task['time'] = $task['duration'] * $task['difficulty'];
            return Task::create($task);
        });

        // taskları zorluk derecesi ve süresine göre sırala
        $tasks = $createdTasks->sortBy([
            ['difficulty', 'desc'],
            ['duration', 'desc']
        ]);

        // developerları seniority'ye göre sırala
        

        AssignTaskJob::dispatch($tasks)->onQueue('assign_task');
    }
}
