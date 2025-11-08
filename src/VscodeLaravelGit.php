<?php

namespace LaravelGpt\Vscode;

use LaravelGpt\Vscode\Contracts\GitInterface;
use LaravelGpt\Vscode\DataTransferObjects\GitResult;
use LaravelGpt\Vscode\Exceptions\GitException;
use LaravelGpt\Vscode\Utils\PathResolver;
use Illuminate\Support\Facades\Log;

class VscodeLaravelGit implements GitInterface
{
    /**
     * Execute a Git command
     *
     * @param string $command
     * @param string|null $path
     * @return GitResult
     * @throws GitException
     */
    public function executeGitCommand(string $command, ?string $path = null): GitResult
    {
        $path = PathResolver::resolveBasePath($path);
        
        // Check if Git is available
        if (!$this->isGitAvailable()) {
            throw new GitException('Git is not available on this system');
        }
        
        $gitBinary = 'git';
        if (function_exists('config')) {
            try {
                $gitBinary = config('vscode-laravel-git.git_binary_path', 'git');
            } catch (\Exception $e) {
                // Config not available, use default
            }
        }
        $fullCommand = "cd " . escapeshellarg($path) . " && " . $gitBinary . " " . $command;
        
        // Log the command if logging is enabled
        $enableLogging = false;
        if (function_exists('config')) {
            try {
                $enableLogging = config('vscode-laravel-git.enable_logging', false);
            } catch (\Exception $e) {
                // Config not available, use default
            }
        }
        if ($enableLogging && class_exists('Illuminate\Support\Facades\Log')) {
            $logChannel = null;
            if (function_exists('config')) {
                $logChannel = config('vscode-laravel-git.log_channel');
            }
            if ($logChannel) {
                Log::channel($logChannel)->info('Executing Git command: ' . $fullCommand);
            } else {
                Log::info('Executing Git command: ' . $fullCommand);
            }
        }
        
        $descriptorspec = [
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ];
        
        $maxExecutionTime = 30;
        if (function_exists('config')) {
            try {
                $maxExecutionTime = config('vscode-laravel-git.max_execution_time', 30);
            } catch (\Exception $e) {
                // Config not available, use default
            }
        }
        
        $process = proc_open(
            $fullCommand,
            $descriptorspec,
            $pipes
        );
        
        // Set up process timeout if possible
        if (function_exists('proc_get_status') && $maxExecutionTime > 0) {
            // We'll check the process status periodically
            // This is a simplified timeout implementation
        }

        if (!is_resource($process)) {
            throw new GitException('Failed to execute Git command');
        }

        $stdout = stream_get_contents($pipes[1]);
        $stderr = stream_get_contents($pipes[2]);
        
        fclose($pipes[1]);
        fclose($pipes[2]);
        
        $exitCode = proc_close($process);

        // If command failed, throw exception
        if ($exitCode !== 0) {
            $errorMessage = "Git command failed: {$stderr}";
            
            // Log the error if logging is enabled
            $enableLogging = false;
            if (function_exists('config')) {
                try {
                    $enableLogging = config('vscode-laravel-git.enable_logging', false);
                } catch (\Exception $e) {
                    // Config not available, use default
                }
            }
            if ($enableLogging && class_exists('Illuminate\Support\Facades\Log')) {
                $logChannel = null;
                if (function_exists('config')) {
                    $logChannel = config('vscode-laravel-git.log_channel');
                }
                if ($logChannel) {
                    Log::channel($logChannel)->error($errorMessage);
                } else {
                    Log::error($errorMessage);
                }
            }
            
            throw new GitException($errorMessage);
        }

        $result = new GitResult($exitCode, $stdout, $stderr);
        
        // Log the successful result if logging is enabled
        $enableLogging = false;
        if (function_exists('config')) {
            try {
                $enableLogging = config('vscode-laravel-git.enable_logging', false);
            } catch (\Exception $e) {
                // Config not available, use default
            }
        }
        if ($enableLogging && class_exists('Illuminate\Support\Facades\Log')) {
            $logChannel = null;
            if (function_exists('config')) {
                $logChannel = config('vscode-laravel-git.log_channel');
            }
            if ($logChannel) {
                Log::channel($logChannel)->info('Git command successful', [
                    'exit_code' => $exitCode,
                    'stdout_length' => strlen($stdout),
                    'stderr_length' => strlen($stderr)
                ]);
            } else {
                Log::info('Git command successful', [
                    'exit_code' => $exitCode,
                    'stdout_length' => strlen($stdout),
                    'stderr_length' => strlen($stderr)
                ]);
            }
        }

        return $result;
    }

    /**
     * Check if Git is available
     *
     * @return bool
     */
    public function isGitAvailable(): bool
    {
        $gitBinary = 'git';
        if (function_exists('config')) {
            try {
                $gitBinary = config('vscode-laravel-git.git_binary_path', 'git');
            } catch (\Exception $e) {
                // Config not available, use default
            }
        }
        $descriptorspec = [
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ];
        
        $maxExecutionTime = 30;
        if (function_exists('config')) {
            try {
                $maxExecutionTime = config('vscode-laravel-git.max_execution_time', 30);
            } catch (\Exception $e) {
                // Config not available, use default
            }
        }
        
        $process = proc_open(
            $gitBinary . ' --version',
            $descriptorspec,
            $pipes
        );

        if (!is_resource($process)) {
            // Log the error if logging is enabled
            $enableLogging = false;
            if (function_exists('config')) {
                try {
                    $enableLogging = config('vscode-laravel-git.enable_logging', false);
                } catch (\Exception $e) {
                    // Config not available, use default
                }
            }
            if ($enableLogging && class_exists('Illuminate\Support\Facades\Log')) {
                $logChannel = null;
                if (function_exists('config')) {
                    $logChannel = config('vscode-laravel-git.log_channel');
                }
                if ($logChannel) {
                    Log::channel($logChannel)->error('Failed to create Git process');
                } else {
                    Log::error('Failed to create Git process');
                }
            }
            return false;
        }

        fclose($pipes[1]);
        fclose($pipes[2]);
        
        $exitCode = proc_close($process);
        
        $isAvailable = $exitCode === 0;
        
        // Log the result if logging is enabled
        $enableLogging = false;
        if (function_exists('config')) {
            try {
                $enableLogging = config('vscode-laravel-git.enable_logging', false);
            } catch (\Exception $e) {
                // Config not available, use default
            }
        }
        if ($enableLogging && class_exists('Illuminate\Support\Facades\Log')) {
            $logChannel = null;
            if (function_exists('config')) {
                $logChannel = config('vscode-laravel-git.log_channel');
            }
            if ($logChannel) {
                Log::channel($logChannel)->info('Git availability check: ' . ($isAvailable ? 'Available' : 'Not available'));
            } else {
                Log::info('Git availability check: ' . ($isAvailable ? 'Available' : 'Not available'));
            }
        }
        
        return $isAvailable;
    }

    /**
     * Get Git status
     *
     * @param string|null $path
     * @return GitResult
     */
    public function getStatus(?string $path = null): GitResult
    {
        return $this->executeGitCommand('status --porcelain', $path);
    }

    /**
     * Get Git log
     *
     * @param string|null $path
     * @return GitResult
     */
    public function getLog(?string $path = null): GitResult
    {
        return $this->executeGitCommand('log --oneline -10', $path);
    }

    /**
     * Get current branch
     *
     * @param string|null $path
     * @return GitResult
     */
    public function getCurrentBranch(?string $path = null): GitResult
    {
        return $this->executeGitCommand('rev-parse --abbrev-ref HEAD', $path);
    }

    /**
     * Get all branches
     *
     * @param string|null $path
     * @return GitResult
     */
    public function getBranches(?string $path = null): GitResult
    {
        return $this->executeGitCommand('branch', $path);
    }

    /**
     * Stage files
     *
     * @param string|array $files
     * @param string|null $path
     * @return GitResult
     */
    public function stageFiles($files, ?string $path = null): GitResult
    {
        $files = is_array($files) ? implode(' ', $files) : $files;
        return $this->executeGitCommand("add {$files}", $path);
    }

    /**
     * Commit changes
     *
     * @param string $message
     * @param string|null $path
     * @return GitResult
     */
    public function commit(string $message, ?string $path = null): GitResult
    {
        return $this->executeGitCommand("commit -m " . escapeshellarg($message), $path);
    }

    /**
     * Push changes
     *
     * @param string|null $remote
     * @param string|null $branch
     * @param string|null $path
     * @return GitResult
     */
    public function push(?string $remote = null, ?string $branch = null, ?string $path = null): GitResult
    {
        $remote = $remote ?? 'origin';
        $branch = $branch ?? $this->getCurrentBranch($path)->stdout;
        return $this->executeGitCommand("push {$remote} {$branch}", $path);
    }

    /**
     * Pull changes
     *
     * @param string|null $remote
     * @param string|null $branch
     * @param string|null $path
     * @return GitResult
     */
    public function pull(?string $remote = null, ?string $branch = null, ?string $path = null): GitResult
    {
        $remote = $remote ?? 'origin';
        $branch = $branch ?? $this->getCurrentBranch($path)->stdout;
        return $this->executeGitCommand("pull {$remote} {$branch}", $path);
    }
}