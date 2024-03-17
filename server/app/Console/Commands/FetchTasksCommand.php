<?php

namespace App\Console\Commands;

use App\Jobs\FetchTaskJob;
use App\Services\TaskProviderFactory;
use Illuminate\Console\Command;

class FetchTasksCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:tasks {provider}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch tasks from the API and store them in the database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        FetchTaskJob::dispatch(TaskProviderFactory::create($this->argument('provider')))->onQueue('fetch-tasks');
    }
}
