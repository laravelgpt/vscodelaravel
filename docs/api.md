# API Reference

## VscodeLaravelGit Class

The main class for all Git operations.

### Methods

#### executeGitCommand(string $command, ?string $path = null): GitResult

Execute a raw Git command.

**Parameters:**
- `$command`: The Git command to execute (without `git`)
- `$path`: Optional path to execute the command in

**Returns:** [GitResult](file:///e%3A/tool%20project/package/vscode-editor/src/DataTransferObjects/GitResult.php#L5-L37)

**Throws:** [GitException](file:///e%3A/tool%20project/package/vscode-editor/src/Exceptions/GitException.php#L5-L7)

#### getStatus(?string $path = null): GitResult

Get the Git status.

**Parameters:**
- `$path`: Optional path to get status for

**Returns:** [GitResult](file:///e%3A/tool%20project/package/vscode-editor/src/DataTransferObjects/GitResult.php#L5-L37)

#### getLog(?string $path = null): GitResult

Get the Git log.

**Parameters:**
- `$path`: Optional path to get log for

**Returns:** [GitResult](file:///e%3A/tool%20project/package/vscode-editor/src/DataTransferObjects/GitResult.php#L5-L37)

#### getCurrentBranch(?string $path = null): GitResult

Get the current Git branch.

**Parameters:**
- `$path`: Optional path to get branch for

**Returns:** [GitResult](file:///e%3A/tool%20project/package/vscode-editor/src/DataTransferObjects/GitResult.php#L5-L37)

#### getBranches(?string $path = null): GitResult

Get all Git branches.

**Parameters:**
- `$path`: Optional path to get branches for

**Returns:** [GitResult](file:///e%3A/tool%20project/package/vscode-editor/src/DataTransferObjects/GitResult.php#L5-L37)

#### stageFiles(string|array $files, ?string $path = null): GitResult

Stage files for commit.

**Parameters:**
- `$files`: File or array of files to stage
- `$path`: Optional path to stage files in

**Returns:** [GitResult](file:///e%3A/tool%20project/package/vscode-editor/src/DataTransferObjects/GitResult.php#L5-L37)

#### commit(string $message, ?string $path = null): GitResult

Commit staged changes.

**Parameters:**
- `$message`: Commit message
- `$path`: Optional path to commit in

**Returns:** [GitResult](file:///e%3A/tool%20project/package/vscode-editor/src/DataTransferObjects/GitResult.php#L5-L37)

#### push(?string $remote = null, ?string $branch = null, ?string $path = null): GitResult

Push changes to a remote repository.

**Parameters:**
- `$remote`: Remote repository name (default: 'origin')
- `$branch`: Branch to push (default: current branch)
- `$path`: Optional path to push from

**Returns:** [GitResult](file:///e%3A/tool%20project/package/vscode-editor/src/DataTransferObjects/GitResult.php#L5-L37)

#### pull(?string $remote = null, ?string $branch = null, ?string $path = null): GitResult

Pull changes from a remote repository.

**Parameters:**
- `$remote`: Remote repository name (default: 'origin')
- `$branch`: Branch to pull (default: current branch)
- `$path`: Optional path to pull to

**Returns:** [GitResult](file:///e%3A/tool%20project/package/vscode-editor/src/DataTransferObjects/GitResult.php#L5-L37)

#### isGitAvailable(): bool

Check if Git is available on the system.

**Returns:** bool

## GitResult Class

Data Transfer Object for Git command results.

### Properties

- `exitCode`: int - The exit code of the Git command
- `stdout`: string - The standard output of the command
- `stderr`: string - The standard error output of the command

### Methods

#### isSuccess(): bool

Check if the command was successful (exit code 0).

**Returns:** bool

#### getLines(): array

Get the output as an array of lines.

**Returns:** array

## GitInterface

Interface defining all Git operations.

## GitException

Custom exception for Git-related errors.

## Facades\VscodeLaravelGit

Static facade for easy access to Git operations.

### Methods

All methods from [VscodeLaravelGit](file:///e%3A/tool%20project/package/vscode-editor/src/VscodeLaravelGit.php#L10-L186) are available statically through the facade.

## Events\GitCommitEvent

Event dispatched when a commit is made.

## Console\Commands\GitStatusCommand

Console command to show Git status.

## Http\Controllers\GitController

Controller for Git operations in web context.

## Http\Middleware\GitMiddleware

Middleware to add Git information to requests.

## Helpers\GitHelper

Helper class for formatting Git output.

## Utils\PathResolver

Utility class for resolving file paths.