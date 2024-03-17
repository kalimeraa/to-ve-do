<?php

namespace App\Services\TaskProviders;

use Illuminate\Support\Collection;

class Trello extends TaskProvider
{
    protected function getUrl(): string
    {
        return 'https://run.mocky.io/v3/7b0ff222-7a9c-4c54-9396-0df58e289143';
    }

    protected function parse(): Collection
    {
        return $this->tasks->map(function (array $task) {
            return [
                'task_id' => $task['id'],
                'difficulty' => $task['value'],
                'duration' => $task['estimated_duration'],
                'provider' => $this->getProviderName(),
            ];
        });
    }

    public function getProviderName(): string
    {
        return 'Trello';
    }
}