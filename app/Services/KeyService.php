<?php

namespace App\Services;

class KeyService
{
    protected string $path;

    public function __construct()
    {
        $this->path = storage_path('keys/app.key');
    }

    public function getKey(): string
    {
        if (!file_exists($this->path)) {
            throw new \Exception('Key file not found');
        }

        return trim(file_get_contents($this->path));
    }
}