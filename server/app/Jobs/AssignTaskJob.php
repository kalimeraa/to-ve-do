<?php

namespace App\Jobs;

use App\Models\Developer;
use App\Services\TaskAssigner;
use App\Services\TaskManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class AssignTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly Collection $tasks)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       // developerları seniority'ye göre sırala
       $developers = Developer::orderBy('seniority', 'desc')->get();

       $taskManager = new TaskManager($this->tasks,$developers);

       $taskManager->handle();
        
    }
}
