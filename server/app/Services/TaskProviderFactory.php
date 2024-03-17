<?php

namespace App\Services;

use App\Services\TaskProviders\Jira;
use App\Services\TaskProviders\TaskProvider;
use App\Services\TaskProviders\Trello;

class TaskProviderFactory
{
    public static function create(string $provider): TaskProvider
    {
        return match ($provider) {
            'trello' => new Trello(),
            'jira' => new Jira(),
        };
    }
}