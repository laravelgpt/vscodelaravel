<?php

namespace LaravelGpt\Vscode\Contracts;

use LaravelGpt\Vscode\DataTransferObjects\GitResult;

interface GitInterface
{
    /**
     * Execute a Git command
     *
     * @param string $command
     * @param string|null $path
     * @return GitResult
     */
    public function executeGitCommand(string $command, ?string $path = null): GitResult;

    /**
     * Get Git status
     *
     * @param string|null $path
     * @return GitResult
     */
    public function getStatus(?string $path = null): GitResult;

    /**
     * Get Git log
     *
     * @param string|null $path
     * @return GitResult
     */
    public function getLog(?string $path = null): GitResult;

    /**
     * Get current branch
     *
     * @param string|null $path
     * @return GitResult
     */
    public function getCurrentBranch(?string $path = null): GitResult;

    /**
     * Get all branches
     *
     * @param string|null $path
     * @return GitResult
     */
    public function getBranches(?string $path = null): GitResult;

    /**
     * Stage files
     *
     * @param string|array $files
     * @param string|null $path
     * @return GitResult
     */
    public function stageFiles($files, ?string $path = null): GitResult;

    /**
     * Commit changes
     *
     * @param string $message
     * @param string|null $path
     * @return GitResult
     */
    public function commit(string $message, ?string $path = null): GitResult;

    /**
     * Push changes
     *
     * @param string|null $remote
     * @param string|null $branch
     * @param string|null $path
     * @return GitResult
     */
    public function push(?string $remote = null, ?string $branch = null, ?string $path = null): GitResult;

    /**
     * Pull changes
     *
     * @param string|null $remote
     * @param string|null $branch
     * @param string|null $path
     * @return GitResult
     */
    public function pull(?string $remote = null, ?string $branch = null, ?string $path = null): GitResult;
}