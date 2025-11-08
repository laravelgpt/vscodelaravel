<?php

namespace LaravelGpt\Vscode\DataTransferObjects;

class GitResult
{
    public int $exitCode;
    public string $stdout;
    public string $stderr;

    public function __construct(int $exitCode, string $stdout, string $stderr)
    {
        $this->exitCode = $exitCode;
        $this->stdout = $stdout;
        $this->stderr = $stderr;
    }

    /**
     * Check if the command was successful
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->exitCode === 0;
    }

    /**
     * Get the output as array of lines
     *
     * @return array
     */
    public function getLines(): array
    {
        return explode("\n", trim($this->stdout));
    }
}