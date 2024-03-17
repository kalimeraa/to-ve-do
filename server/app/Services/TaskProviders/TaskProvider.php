<?php

namespace App\Services\TaskProviders;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

abstract class TaskProvider
{
    protected Collection $tasks;

    abstract protected function parse(): Collection;

    abstract protected function getUrl(): string;

    protected function fetch(): array
    {
        return Http::get($this->getUrl())->json();
    }

    public function handle(): Collection 
    {
        $this->tasks = collect($this->fetch());

        return $this->parse();
    }

    abstract public function getProviderName(): string;
}