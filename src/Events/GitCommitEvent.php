<?php

namespace LaravelGpt\Vscode\Events;

use LaravelGpt\Vscode\VscodeLaravelGit;

class GitCommitEvent
{
    public $git;
    public $message;
    public $files;

    public function __construct(VscodeLaravelGit $git, string $message, array $files = [])
    {
        $this->git = $git;
        $this->message = $message;
        $this->files = $files;
    }
}