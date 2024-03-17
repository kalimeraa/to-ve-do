<?php

namespace App\Services\TaskProviders;

use Illuminate\Support\Collection;

class Jira extends TaskProvider
{
    protected function getUrl(): string
    {
        return 'https://run.mocky.io/v3/27b47d79-f382-4dee-b4fe-a0976ceda9cd';
    }

    protected function parse(): Collection
    {
        return $this->tasks->map(function (array $task) {
            return [
                'task_id' => $task['id'],
                'difficulty' => $task['zorluk'],
                'duration' => $task['sure'],
                'provider' => $this->getProviderName(),
            ];
        });
    }

    public function getProviderName(): string
    {
        return 'Jira';
    }
}